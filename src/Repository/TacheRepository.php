<?php

namespace App\Repository;

use App\Entity\Tache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tache>
 *
 * @method Tache|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tache[]    findAll()
 * @method Tache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }

    public function search(\App\Entity\Utilisateur $user, ?string $term, ?string $sortBy = null, ?string $sortDirection = 'ASC'): array
    {
        $qb = $this->createQueryBuilder('t')
            ->andWhere('t.utilisateur = :user')
            ->setParameter('user', $user);

        if ($term) {
            $prioriteVal = null;
            $termLower = strtolower($term);
            if (str_contains('haute', $termLower))
                $prioriteVal = 3;
            elseif (str_contains('moyenne', $termLower))
                $prioriteVal = 2;
            elseif (str_contains('basse', $termLower))
                $prioriteVal = 1;

            $qb->leftJoin('t.taskSpace', 'ts')
                ->leftJoin('t.assignedTo', 'a');

            $orX = $qb->expr()->orX(
                't.titre LIKE :term',
                't.description LIKE :term',
                't.statut LIKE :term',
                'ts.nom LIKE :term',
                'a.nom LIKE :term',
                'a.prenom LIKE :term',
                'a.email LIKE :term'
            );

            if ($prioriteVal) {
                $orX->add('t.priorite = :prio');
                $qb->setParameter('prio', $prioriteVal);
            }

            $qb->andWhere($orX)
                ->setParameter('term', '%' . $term . '%');
        }

        if ($sortBy) {
            $direction = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';
            if ($sortBy === 'priorite') {
                $qb->orderBy('t.priorite', $direction);
            }
            elseif ($sortBy === 'statut') {
                $qb->orderBy('t.statut', $direction);
            }
            else {
                $qb->orderBy('t.deadline', 'ASC');
            }
        }
        else {
            $qb->orderBy('t.deadline', 'ASC');
        }

        return $qb->getQuery()->getResult();
    }

    public function getGlobalStats(): array
    {
        $qb = $this->createQueryBuilder('t');
        $total = (int) $qb->select('COUNT(t.id)')->getQuery()->getSingleScalarResult();
        
        $qb = $this->createQueryBuilder('t');
        $completed = (int) $qb->select('COUNT(t.id)')
            ->where('t.statut = :status')
            ->setParameter('status', 'Done')
            ->getQuery()->getSingleScalarResult();
            
        $qb = $this->createQueryBuilder('t');
        $overdue = (int) $qb->select('COUNT(t.id)')
            ->where('t.deadline < :now')
            ->andWhere('t.statut != :status')
            ->setParameter('now', new \DateTime())
            ->setParameter('status', 'Done')
            ->getQuery()->getSingleScalarResult();

        $qb = $this->createQueryBuilder('t');
        $statusDist = $qb->select('t.statut, COUNT(t.id) as count')
            ->groupBy('t.statut')
            ->getQuery()->getResult();

        $qb = $this->createQueryBuilder('t');
        $priorityDist = $qb->select('t.priorite, COUNT(t.id) as count')
            ->groupBy('t.priorite')
            ->getQuery()->getResult();

        return [
            'total' => $total,
            'completed' => $completed,
            'overdue' => $overdue,
            'statusDistribution' => $statusDist,
            'priorityDistribution' => $priorityDist,
        ];
    }

    public function getActivityTrends(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sqlCreation = "SELECT DATE(created_at) as date, COUNT(id) as count 
                        FROM tache 
                        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                        GROUP BY DATE(created_at)
                        ORDER BY date ASC";
        return $conn->fetchAllAssociative($sqlCreation);
    }

    public function getAverageDuration(): float
    {
        $qb = $this->createQueryBuilder('t');
        return (float) $qb->select('AVG(t.realTimeSpent)')
            ->where('t.statut = :status')
            ->setParameter('status', 'Done')
            ->getQuery()->getSingleScalarResult();
    }
}
