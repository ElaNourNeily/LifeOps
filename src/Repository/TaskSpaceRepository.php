<?php

namespace App\Repository;

use App\Entity\TaskSpace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaskSpace>
 *
 * @method TaskSpace|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method TaskSpace|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method TaskSpace[]    findAll()
 * @method TaskSpace[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class TaskSpaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskSpace::class);
    }
}
