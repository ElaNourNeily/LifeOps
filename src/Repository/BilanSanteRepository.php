<?php

namespace App\Repository;

use App\Entity\BilanSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BilanSante>
 *
 * @method BilanSante|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method BilanSante|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method BilanSante[]    findAll()
 * @method BilanSante[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class BilanSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BilanSante::class);
    }
}
