<?php

namespace App\Repository;

use App\Entity\Objectif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Objectif>
 *
 * @method Objectif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objectif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objectif[]    findAll()
 * @method Objectif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objectif::class);
    }

    public function findWithSearchAndFilter(UserInterface $user, ?string $query = null, ?string $category = null, string $sort = 'date_fin_asc'): array
    {
        return $this->getSearchQuery($user, $query, $category, $sort)->getResult();
    }

    public function getSearchQuery(UserInterface $user, ?string $query = null, ?string $category = null, string $sort = 'date_fin_asc')
    {
        $qb = $this->createQueryBuilder('o')
            ->andWhere('o.utilisateur = :user')
            ->setParameter('user', $user);

        if ($query) {
            $qb->andWhere('o.titre LIKE :query OR o.description LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        if ($category && $category !== 'all') {
            $qb->andWhere('o.categorie = :category')
               ->setParameter('category', $category);
        }

        switch ($sort) {
            case 'date_fin_desc':
                $qb->orderBy('o.date_fin', 'DESC');
                break;
            case 'progression_desc':
                $qb->orderBy('o.progression', 'DESC');
                break;
            case 'progression_asc':
                $qb->orderBy('o.progression', 'ASC');
                break;
            case 'date_fin_asc':
            default:
                $qb->orderBy('o.date_fin', 'ASC');
                break;
        }

        return $qb->getQuery();
    }

    public function getAdminSearchQuery(
        ?string $search = null,
        ?string $category = null,
        ?string $statut = null,
        string $sort = 'date_fin',
        string $order = 'asc'
    ) {
        $qb = $this->createQueryBuilder('o')
            ->join('o.utilisateur', 'u')
            ->addSelect('u');

        if ($search) {
            $qb->andWhere('o.titre LIKE :search OR o.description LIKE :search OR u.email LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        if ($category && $category !== 'all') {
            $qb->andWhere('o.categorie = :category')
               ->setParameter('category', $category);
        }

        if ($statut && $statut !== 'all') {
            $qb->andWhere('o.statut = :statut')
               ->setParameter('statut', $statut);
        }

        $allowedSorts = [
            'titre'       => 'o.titre',
            'date_fin'    => 'o.date_fin',
            'progression' => 'o.progression',
            'categorie'   => 'o.categorie',
            'statut'      => 'o.statut',
        ];
        $sortField = $allowedSorts[$sort] ?? 'o.date_fin';
        $qb->orderBy($sortField, strtoupper($order) === 'DESC' ? 'DESC' : 'ASC');

        return $qb->getQuery();
    }

    /**
     * Retourne des statistiques globales calculées via QueryBuilder.
     */
    public function getAdminStats(): array
    {
        // Total global
        $total = (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Par statut
        $perStatut = $this->createQueryBuilder('o')
            ->select('o.statut, COUNT(o.id) as nb')
            ->groupBy('o.statut')
            ->getQuery()
            ->getResult();

        $statuts = [];
        foreach ($perStatut as $row) {
            $statuts[$row['statut']] = (int) $row['nb'];
        }

        // Par catégorie
        $perCategory = $this->createQueryBuilder('o')
            ->select('o.categorie, COUNT(o.id) as nb')
            ->groupBy('o.categorie')
            ->getQuery()
            ->getResult();

        $categories = [];
        foreach ($perCategory as $row) {
            $categories[$row['categorie']] = (int) $row['nb'];
        }

        // Progression moyenne
        $avgProgression = (float) ($this->createQueryBuilder('o')
            ->select('AVG(o.progression)')
            ->getQuery()
            ->getSingleScalarResult() ?? 0);

        return [
            'total'          => $total,
            'achieved'       => $statuts['achieved'] ?? 0,
            'in_progress'    => $statuts['in_progress'] ?? 0,
            'avg_progression'=> round($avgProgression, 1),
            'categories'     => $categories,
        ];
    }
}

