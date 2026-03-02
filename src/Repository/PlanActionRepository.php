<?php

namespace App\Repository;

use App\Entity\PlanAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanAction>
 *
 * @method PlanAction|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method PlanAction|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method PlanAction[]    findAll()
 * @method PlanAction[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class PlanActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanAction::class);
    }
}
