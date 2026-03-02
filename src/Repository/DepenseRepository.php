<?php

namespace App\Repository;

use App\Entity\Depense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Depense>
 *
 * @method Depense|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method Depense|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method Depense[]    findAll()
 * @method Depense[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class DepenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Depense::class);
    }

    /**
     * @return array<int, array{categorie: string, total: float}>
     */
    public function getTotalByCategorie(): array
    {
        return $this->createQueryBuilder('d')
            ->select('d.categorie, SUM(d.montant) as total')
            ->groupBy('d.categorie')
            ->getQuery()
            ->getResult();
    }
}
