<?php

namespace App\Repository;

use App\Entity\SuiviSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviSante>
 *
 * @method SuiviSante|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method SuiviSante|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method SuiviSante[]    findAll()
 * @method SuiviSante[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class SuiviSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviSante::class);
    }
}
