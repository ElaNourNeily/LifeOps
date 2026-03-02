<?php

namespace App\Repository;

use App\Entity\Planning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Planning>
 *
 * @method Planning|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method Planning|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method Planning[]    findAll()
 * @method Planning[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class PlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planning::class);
    }

    /**
     * Find plannings for a user within a date range.
     * Used by AIPlannerService to collect current planning data.
     * 
     * @param int $userId
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return Planning[]
     */
    public function findByUserAndPeriod(int $userId, \DateTime $startDate, \DateTime $endDate): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.utilisateur = :userId')
            ->andWhere('p.date BETWEEN :start AND :end')
            ->setParameter('userId', $userId)
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
