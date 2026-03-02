import os
import json
from fastapi import FastAPI
from pydantic import BaseModel
from typing import List, Optional
from datetime import datetime, date, timezone
from openai import OpenAI
from dotenv import load_dotenv

load_dotenv()
API_KEY = os.getenv("OPENAI_API_KEY")

if not API_KEY:
    print("⚠️ OPENAI_API_KEY not found")
    client = None
else:
    client = OpenAI(api_key=API_KEY)


app = FastAPI()

class Task(BaseModel):
    id: int
    titre: str
    priorite: str
    difficulte: int
    deadline: Optional[date] = None
    createdAt: datetime

class TaskForAssignment(BaseModel):
    id: int
    titre: str
    priority: str
    difficulty: int
    deadline: Optional[date] = None

class Member(BaseModel):
    id: int
    name: str
    current_load: int

class AssignmentRequest(BaseModel):
    tasks: List[TaskForAssignment]
    members: List[Member]

def compute_score(task: Task):
    priority_weights = {"low": 1, "medium": 2, "high": 3, "urgent": 4}
    pw = priority_weights.get(task.priorite.lower(), 1)
    return (pw * 2.0) + (task.difficulte * 1.5)

@app.post("/ai/prioritize")
def prioritize(tasks: List[Task]):
    scored_tasks = []
    for task in tasks:
        scored_tasks.append({
            "id": task.id,
            "titre": task.titre,
            "score": round(compute_score(task), 2),
            "justification": "Calculé sur la base de la priorité et difficulté."
        })
    scored_tasks.sort(key=lambda x: x["score"], reverse=True)
    return {"suggested_order": scored_tasks}

@app.post("/ai/overload")
def detect_overload(tasks: List[Task]):
    total_difficulty = sum(t.difficulte for t in tasks)
    urgent_count = sum(1 for t in tasks if t.priorite.lower() in ["urgent", "high"])
    overloaded = (total_difficulty >= 12 or urgent_count >= 3)
    return {"overloaded": overloaded, "reasons": ["Charge globale élevée"] if overloaded else []}

@app.post("/ai/assign")
def assign_tasks(data: AssignmentRequest):
    
    suggestions = []

    for task in data.tasks:
        # choose member with smallest load
        best_member = min(data.members, key=lambda m: m.current_load)

        suggestions.append({
            "task_id": task.id,
            "assigned_to": best_member.id,
            "reason": "Fair load balancing based on workload score"
        })

        # simulate load increase
        best_member.current_load += task.difficulty

    return {"suggestions": suggestions}
    if not client:
        return {"suggestions": []}

    tasks_text = json.dumps([t.model_dump() for t in data.tasks], default=str)
    members_text = json.dumps([m.model_dump() for m in data.members], default=str)

    prompt = f"""
    Tu es un Scrum Master. Répartis équitablement les tâches suivantes entre les membres de l'équipe.
    TÂCHES: {tasks_text}
    MEMBRES: {members_text}
    Réponds UNIQUEMENT avec ce JSON exact:
    {{
        "suggestions": [
            {{"task_id": 1, "assigned_to": 2, "justification": "Texte explicatif court"}}
        ]
    }}
    """
    try:
        response = client.models.generate_content(
            model='gemini-2.0-flash',
            contents=prompt,
            config=types.GenerateContentConfig(response_mime_type="application/json")
        )
        return json.loads(response.text)
    except Exception as e:
        print(f"Erreur IA : {e}")
        return {"suggestions": []}