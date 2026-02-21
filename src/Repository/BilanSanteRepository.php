<?php

namespace App\Repository;

use App\Entity\BilanSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BilanSante>
 *
 * @method BilanSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method BilanSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method BilanSante[]    findAll()
 * @method BilanSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BilanSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BilanSante::class);
    }
}
