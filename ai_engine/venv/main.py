from fastapi import FastAPI
from pydantic import BaseModel
from typing import List, Optional
from datetime import datetime, date, timezone

app = FastAPI()

# -----------------------------
# DATA MODEL
# -----------------------------

class Task(BaseModel):
    id: int
    titre: str
    priorite: str
    difficulte: int
    deadline: Optional[date] = None
    createdAt: datetime

# -----------------------------
# AI LOGIC
# -----------------------------

def deadline_score(deadline: Optional[date]):
    if not deadline:
        return 1

    today = date.today()
    days_left = (deadline - today).days

    if days_left <= 0:
        return 5
    elif days_left <= 2:
        return 4
    elif days_left <= 5:
        return 3
    else:
        return 1

def priority_weight(priorite: str):
    weights = {
        "low": 1,
        "medium": 2,
        "high": 3,
        "urgent": 4
    }
    return weights.get(priorite.lower(), 1)

def age_score(created_at: datetime):
    now = datetime.now(created_at.tzinfo or timezone.utc)
    days_old = (now - created_at).days
    return min(days_old / 5, 5)

def compute_score(task: Task):
    return (
        0.4 * deadline_score(task.deadline)
        + 0.3 * priority_weight(task.priorite)
        + 0.2 * task.difficulte
        + 0.1 * age_score(task.createdAt)
    )

# -----------------------------
# API ENDPOINTS
# -----------------------------

@app.post("/ai/prioritize")
def prioritize(tasks: List[Task]):

    scored_tasks = []

    for task in tasks:
        score = compute_score(task)
        scored_tasks.append({
            "id": task.id,
            "titre": task.titre,
            "score": round(score, 2),
            "justification": "Calculated based on deadline urgency, priority level, difficulty and age."
        })

    scored_tasks.sort(key=lambda x: x["score"], reverse=True)

    return {
        "suggested_order": scored_tasks
    }


@app.post("/ai/overload")
def detect_overload(tasks: List[Task]):

    total_difficulty = sum(t.difficulte for t in tasks)

    # Note: If your Twig only uses 'high', you might want to check for 'high' here too!
    urgent_count = sum(1 for t in tasks if t.priorite.lower() in ["urgent", "high"])

    deadlines_today = sum(
        1 for t in tasks
        if t.deadline and (t.deadline - date.today()).days <= 1
    )

    overloaded = (
        total_difficulty >= 12
        or urgent_count >= 3
        or deadlines_today >= 2
    )

    reasons = []
    if total_difficulty >= 12:
        reasons.append("charge de travail élevée")
    if urgent_count >= 3:
        reasons.append("plusieurs tâches urgentes/hautes")
    if deadlines_today >= 2:
        reasons.append("deadlines très proches")

    return {
        "overloaded": overloaded,
        "reasons": reasons,
        "score": total_difficulty
    }