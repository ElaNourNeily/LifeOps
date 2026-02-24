<?php

namespace App\Security\Voter;

use App\Entity\Tache;
use App\Entity\Utilisateur;
use App\Security\TaskPermission;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * ═══════════════════════════════════════════════════════════════════════════
 * TacheVoter — Per-task permission logic
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * Replaces all the manual $this->checkAccess() and ad-hoc if/throw blocks
 * scattered across TacheController and TaskSpaceController.
 *
 * HOW IT WORKS:
 *   Symfony calls vote() automatically when you call:
 *     $this->denyAccessUnlessGranted(TaskPermission::EDIT, $tache)
 *
 *   The voter inspects the task and the current user and returns:
 *     ACCESS_GRANTED or ACCESS_DENIED
 *
 * ROLES IN THIS VOTER:
 *   ┌────────────────────────────────────────────────────────────────────┐
 *   │ SOLO OWNER  — tache.taskSpace IS NULL && tache.utilisateur == user │
 *   │ GROUP MEMBER — tache.taskSpace != NULL && tache.utilisateur == user│
 *   │ LEADER      — tache.taskSpace.utilisateur == user                  │
 *   └────────────────────────────────────────────────────────────────────┘
 * ═══════════════════════════════════════════════════════════════════════════
 */
class TacheVoter extends Voter
{
    // The permissions this voter handles
    private const SUPPORTED = [
        TaskPermission::TASK_VIEW->value,
        TaskPermission::TASK_EDIT->value,
        TaskPermission::TASK_MOVE_STATUS->value,
        TaskPermission::TASK_COMPLETE->value,
        TaskPermission::TASK_DELETE->value,
        TaskPermission::TASK_ASSIGN->value,
    ];

    // ─────────────────────────────────────────────────────────────────────────
    //  supports() — called by Symfony to decide if THIS voter is relevant
    // ─────────────────────────────────────────────────────────────────────────

    protected function supports(string $attribute, mixed $subject): bool
    {
        // Only handle TaskPermission attributes on Tache objects
        return in_array($attribute, self::SUPPORTED, true)
            && $subject instanceof Tache;
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  voteOnAttribute() — the actual permission decision
    // ─────────────────────────────────────────────────────────────────────────

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Must be logged in
        if (!$user instanceof Utilisateur) {
            return false;
        }

        /** @var Tache $tache */
        $tache     = $subject;
        $taskSpace = $tache->getTaskSpace();

        // ── Determine the caller's role relative to this task ─────────────────
        $isLeader    = $taskSpace !== null && $taskSpace->getUtilisateur() === $user;
        $isAssigned  = $tache->getUtilisateur() === $user;
        $isSoloOwner = $taskSpace === null && $isAssigned;
        $isGroupMember = $taskSpace !== null && $isAssigned && !$isLeader;

        return match ($attribute) {

            // VIEW: leader sees all tasks in the project; assigned member/owner sees their task
            TaskPermission::TASK_VIEW->value =>
                $isLeader || $isAssigned,

            // EDIT: solo owner can always edit their task; group member can edit their own;
            //       leader can edit any task in the project
            TaskPermission::TASK_EDIT->value =>
                $isLeader || $isAssigned,

            // MOVE_STATUS (todo/in-progress/review): everyone who can see the task can move it
            //             EXCEPT moving to "done" — that's TASK_COMPLETE
            TaskPermission::TASK_MOVE_STATUS->value =>
                $isLeader || $isAssigned,

            // COMPLETE (→ done): solo owner can complete their own task;
            //                    in a group project, ONLY the leader can mark done
            TaskPermission::TASK_COMPLETE->value =>
                $isSoloOwner || $isLeader,

            // DELETE: solo owner can delete their own task;
            //         in a group project, only the leader can delete
            TaskPermission::TASK_DELETE->value =>
                $isSoloOwner || $isLeader,

            // ASSIGN: only the project leader can assign tasks to members
            TaskPermission::TASK_ASSIGN->value =>
                $isLeader,

            default => false,
        };
    }
}