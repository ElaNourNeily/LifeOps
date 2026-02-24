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
}
