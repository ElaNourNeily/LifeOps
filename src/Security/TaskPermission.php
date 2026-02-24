<?php

namespace App\Security;


enum TaskPermission: string
{
    // ── Tache (task) level ────────────────────────────────────────────────────
    case TASK_VIEW         = 'TASK_VIEW';         // See the task details
    case TASK_EDIT         = 'TASK_EDIT';         // Edit title, description, priority…
    case TASK_MOVE_STATUS  = 'TASK_MOVE_STATUS';  // Move to todo/in-progress/review
    case TASK_COMPLETE     = 'TASK_COMPLETE';     // Move to "done" (leader-only in group)
    case TASK_DELETE       = 'TASK_DELETE';       // Delete the task
    case TASK_ASSIGN       = 'TASK_ASSIGN';       // Create & assign tasks to members

    // ── TaskSpace (project) level ─────────────────────────────────────────────
    case SPACE_MANAGE       = 'SPACE_MANAGE';       // Edit/delete the project itself
    case SPACE_VIEW_MEMBERS = 'SPACE_VIEW_MEMBERS'; // See the members page
    case SPACE_REMOVE_MEMBER = 'SPACE_REMOVE_MEMBER'; // Kick a member out
}