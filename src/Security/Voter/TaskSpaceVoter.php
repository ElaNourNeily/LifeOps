<?php

namespace App\Security\Voter;

use App\Entity\TaskSpace;
use App\Entity\Utilisateur;
use App\Repository\TacheRepository;
use App\Security\TaskPermission;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * ═══════════════════════════════════════════════════════════════════════════
 * TaskSpaceVoter — Per-project permission logic
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * Used with TaskSpace objects:
 *   $this->denyAccessUnlessGranted(TaskPermission::SPACE_MANAGE, $taskSpace)
 *   $this->denyAccessUnlessGranted(TaskPermission::SPACE_VIEW_MEMBERS, $taskSpace)
 *
 * ROLES:
 *   LEADER  — taskSpace.utilisateur === current user
 *   MEMBER  — user has at least one task assigned in this project by the leader
 *   GUEST   — no relation to this project at all → denied everywhere
 * ═══════════════════════════════════════════════════════════════════════════
 */
class TaskSpaceVoter extends Voter
{
    private const SUPPORTED = [
        TaskPermission::SPACE_MANAGE->value,
        TaskPermission::SPACE_VIEW_MEMBERS->value,
        TaskPermission::SPACE_REMOVE_MEMBER->value,
        TaskPermission::TASK_ASSIGN->value,
        // TASK_VIEW on a TaskSpace = "can I see this project's board?"
        TaskPermission::TASK_VIEW->value,
    ];

    public function __construct(
        private readonly TacheRepository $tacheRepository
    ) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, self::SUPPORTED, true)
            && $subject instanceof TaskSpace;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof Utilisateur) {
            return false;
        }

        /** @var TaskSpace $taskSpace */
        $taskSpace = $subject;

        $isLeader = $taskSpace->getUtilisateur() === $user;

        // A member is someone who has been assigned at least one task in this project
        $isMember = !$isLeader && !empty(
            $this->tacheRepository->findAssignedToMember($user, $taskSpace)
        );

        return match ($attribute) {

            // Board view: both leaders and members can see the board
            TaskPermission::TASK_VIEW->value =>
                $isLeader || $isMember,

            // Task assignment (creating tasks for others): leader only
            TaskPermission::TASK_ASSIGN->value =>
                $isLeader,

            // Project management (edit, delete the project): leader only
            TaskPermission::SPACE_MANAGE->value =>
                $isLeader,

            // Members page: leader only
            TaskPermission::SPACE_VIEW_MEMBERS->value =>
                $isLeader,

            // Remove a member: leader only
            TaskPermission::SPACE_REMOVE_MEMBER->value =>
                $isLeader,

            default => false,
        };
    }
}