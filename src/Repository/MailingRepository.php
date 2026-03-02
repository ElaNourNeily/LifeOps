<?php

namespace App\Repository;

use App\Entity\Mailing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mailing>
 *
 * @method Mailing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mailing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mailing[]    findAll()
 * @method Mailing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mailing::class);
    }

    public function save(Mailing $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mailing $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find scheduled mailings that need to be sent
     */
    public function findScheduledToSend(): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.statut = :statut')
            ->andWhere('m.date_programmee IS NOT NULL')
            ->andWhere('m.date_programmee <= :now')
            ->setParameter('statut', 'en_attente')
            ->setParameter('now', new \DateTime())
            ->orderBy('m.date_programmee', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find failed mailings to retry
     */
    public function findFailedMailings(): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.statut = :statut')
            ->setParameter('statut', 'erreur')
            ->orderBy('m.date_envoi', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find mailings by user and status
     */
    public function findByUserAndStatus($user, $status): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.utilisateur = :user')
            ->andWhere('m.statut = :status')
            ->setParameter('user', $user)
            ->setParameter('status', $status)
            ->orderBy('m.date_envoi', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
