<?php

namespace App\Repository;

use App\Entity\SuiviSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviSante>
 *
 * @method SuiviSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviSante[]    findAll()
 * @method SuiviSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviSante::class);
    }
}
