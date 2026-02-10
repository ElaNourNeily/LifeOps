<?php

namespace App\Repository;

use App\Entity\TaskSpace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaskSpace>
 *
 * @method TaskSpace|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskSpace|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskSpace[]    findAll()
 * @method TaskSpace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskSpaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskSpace::class);
    }

    public function search(\App\Entity\Utilisateur $user, ?string $term, ?string $sortBy = null, ?string $sortDirection = 'ASC'): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.members', 'm')
            ->where('p.utilisateur = :user')
            ->orWhere('m = :user')
            ->setParameter('user', $user)
            ->distinct();

        if ($term) {
            $qb->andWhere('p.nom LIKE :term')
                ->setParameter('term', '%' . $term . '%');
        }

        if ($sortBy === 'statut') {
            $direction = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';
            $qb->orderBy('p.status', $direction);
        }
        else {
            $qb->orderBy('p.dateCreation', 'DESC');
        }

        return $qb->getQuery()->getResult();
    }

    public function getTaskSpaceStats(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        // Solo vs Group (Group has entries in task_space_members)
        $sqlSoloCount = "SELECT COUNT(id) FROM task_space WHERE id NOT IN (SELECT task_space_id FROM task_space_members)";
        $sqlGroupCount = "SELECT COUNT(id) FROM task_space WHERE id IN (SELECT task_space_id FROM task_space_members)";

        $solo = (int)$conn->fetchOne($sqlSoloCount);
        $group = (int)$conn->fetchOne($sqlGroupCount);

        // Inactive (no tasks created in last 30 days)
        $sqlInactive = "SELECT COUNT(ts.id) 
                         FROM task_space ts 
                         WHERE ts.id NOT IN (
                             SELECT task_space_id 
                             FROM tache 
                             WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                             AND task_space_id IS NOT NULL
                         )";
        $inactive = (int)$conn->fetchOne($sqlInactive);
        $total = $solo + $group;

        return [
            'solo' => $solo,
            'group' => $group,
            'inactive' => $inactive,
            'inactive_percentage' => $total > 0 ? ($inactive / $total) * 100 : 0,
        ];
    }
}
