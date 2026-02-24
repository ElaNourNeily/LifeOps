<?php

namespace App\Repository;
use App\Entity\TaskSpace;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Utilisateur>
 *
 * @implements PasswordUpgraderInterface<Utilisateur>
 *
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Utilisateur) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * Find users by optional search and sort parameters.
     *
     * @param string|null $search search term for name or email
     * @param string|null $sort one of: 'created', 'name', 'email'
     * @param string $order 'asc' or 'desc'
     * @return Utilisateur[]
     */
    public function findByFilters(?string $search, ?string $sort, string $order = 'desc', ?int $minAge = null, ?int $maxAge = null): array
    {
        $qb = $this->createQueryBuilder('u');

        if ($search) {
            $term = mb_strtolower(trim($search));
            $orX = $qb->expr()->orX();
            $orX->add($qb->expr()->like("LOWER(CONCAT(u.nom, ' ', u.prenom))", ':s'));
            $orX->add($qb->expr()->like('LOWER(u.email)', ':s'));

            $qb->andWhere($orX)
               ->setParameter('s', '%' . $term . '%');
        }

        if ($minAge !== null) {
            $qb->andWhere('u.age >= :minAge')
               ->setParameter('minAge', $minAge);
        }

        if ($maxAge !== null) {
            $qb->andWhere('u.age <= :maxAge')
               ->setParameter('maxAge', $maxAge);
        }

        switch ($sort) {
            case 'name':
                $qb->orderBy('u.nom', $order);
                break;
            case 'email':
                $qb->orderBy('u.email', $order);
                break;
            case 'created':
            default:
                $qb->orderBy('u.created_at', $order);
                break;
        }

        return $qb->getQuery()->getResult();
    }

    public function countTotalUsers(): int
    {
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countAdmins(): int
    {
        // Counts users who have 'ROLE_ADMIN' as their primary role OR in their roles somehow.
        // Since the current implementation stores role as a single string column:
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->where('u.role = :role')
            ->setParameter('role', 'ROLE_ADMIN')
            ->getQuery()
            ->getSingleScalarResult();
    }
    /**
     * Search users by email OR full name — used by the Leader invite system.
     * Excludes the Leader themselves and already-assigned members.
     */
    public function searchForInvite(string $query, \App\Entity\Utilisateur $leader, \App\Entity\TaskSpace $taskSpace): array
    {
        $existingMembers = $this->findMembersOfTaskSpace($taskSpace);
        $excludeIds = array_map(fn($u) => $u->getId(), $existingMembers);
        $excludeIds[] = $leader->getId(); 

        $qb = $this->createQueryBuilder('u')
            ->where(
                $this->getEntityManager()->getExpressionBuilder()->orX(
                    'LOWER(u.nom) LIKE :q',
                    'LOWER(u.prenom) LIKE :q',
                    'LOWER(u.email) LIKE :q'
                )
            )
            ->setParameter('q', '%' . strtolower($query) . '%')
            ->orderBy('u.nom', 'ASC')
            ->setMaxResults(10);

        if (!empty($excludeIds)) {
            $qb->andWhere('u.id NOT IN (:excludeIds)')
               ->setParameter('excludeIds', $excludeIds);
        }

        return $qb->getQuery()->getResult();
    }
    /**
     * Get all distinct members of a TaskSpace
     * (= all users who have at least one Tache assigned in this TaskSpace)
     */
    public function findMembersOfTaskSpace(\App\Entity\TaskSpace $taskSpace): array
    {
        return $this->createQueryBuilder('u')
            ->distinct()
            ->join('u.taches', 't')
            ->where('t.taskSpace = :ts')
            ->andWhere('u != :leader')   // exclude the leader from the members list
            ->setParameter('ts', $taskSpace)
            ->setParameter('leader', $taskSpace->getUtilisateur())
            ->orderBy('u.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
    /**
     * Find user by email — used for direct invite lookup
     */
    public function findByEmail(string $email): ?Utilisateur
    {
        return $this->findOneBy(['email' => $email]);
    }
    
}
