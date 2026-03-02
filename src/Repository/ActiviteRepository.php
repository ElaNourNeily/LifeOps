<?php

namespace App\Repository;

use App\Entity\Activite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activite>
 *
 * @method Activite|null find(mixed $id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method Activite|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    /**
     * @param \App\Entity\Utilisateur $user
     * @return Activite[]
     */
    public function findByUser(\App\Entity\Utilisateur $user): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.planning', 'p')
            ->where('p.utilisateur = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
