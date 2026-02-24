<?php

namespace App\Repository;

use App\Entity\Tache;
use App\Entity\TaskSpace;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tache>
 *
 * @method Tache|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tache[]    findAll()
 * @method Tache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }
    // ── SOLO: personal tasks with no TaskSpace ──
    public function findSoloTasks(Utilisateur $user): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.utilisateur = :user')
            ->andWhere('t.taskSpace IS NULL')
            ->setParameter('user', $user)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // ── LEADER: all tasks inside a TaskSpace (full view) ──
    public function findAllInTaskSpace(TaskSpace $taskSpace): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.taskSpace = :ts')
            ->setParameter('ts', $taskSpace)
            ->orderBy('t.priorite', 'DESC')
            ->addOrderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // ── MEMBER: only tasks assigned to this user inside a TaskSpace ──
    public function findAssignedToMember(Utilisateur $user, TaskSpace $taskSpace): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.utilisateur = :user')
            ->andWhere('t.taskSpace = :ts')
            ->setParameter('user', $user)
            ->setParameter('ts', $taskSpace)
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // ── WORKLOAD: count tasks per member in a TaskSpace (for leader dashboard) ──
    public function countPerMemberInTaskSpace(TaskSpace $taskSpace): array
    {
        $rows = $this->createQueryBuilder('t')
            ->select('IDENTITY(t.utilisateur) as userId, COUNT(t.id) as total')
            ->where('t.taskSpace = :ts')
            ->setParameter('ts', $taskSpace)
            ->groupBy('t.utilisateur')
            ->getQuery()
            ->getResult();

        $result = [];
        foreach ($rows as $row) {
            $result[$row['userId']] = (int) $row['total'];
        }
        return $result;
    }

    // ── STATS per statut for a TaskSpace ──
    public function countByStatutInTaskSpace(TaskSpace $taskSpace): array
    {
        $rows = $this->createQueryBuilder('t')
            ->select('t.statut, COUNT(t.id) as total')
            ->where('t.taskSpace = :ts')
            ->setParameter('ts', $taskSpace)
            ->groupBy('t.statut')
            ->getQuery()
            ->getResult();

        $base = ['todo' => 0, 'in-progress' => 0, 'review' => 0, 'done' => 0];
        foreach ($rows as $row) {
            $base[$row['statut']] = (int) $row['total'];
        }
        return $base;
    }

    // ── All tasks for a user (solo + group) ──
    public function findAllForUser(Utilisateur $user): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.utilisateur = :user')
            ->setParameter('user', $user)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findRecentlyAssignedToUser(\App\Entity\Utilisateur $user, int $limit = 5): array
    {
        return $this->createQueryBuilder('t')
            ->join('t.taskSpace', 'ts')
            ->where('t.utilisateur = :user')
            ->andWhere('ts.utilisateur != :user') // Group tasks only, not solo/leader tasks
            ->setParameter('user', $user)
            ->orderBy('t.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
