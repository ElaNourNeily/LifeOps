<?php

namespace App\EventSubscriber;

use App\Entity\Tache;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
#[AsDoctrineListener(event: Events::preUpdate, priority: 500, connection: 'default')]
class TaskDeadlineSubscriber
{
    private ExpressionLanguage $expression;

    public function __construct()
    {
        $this->expression = new ExpressionLanguage();
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $this->checkDeadline($args->getObject());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $this->checkDeadline($args->getObject());
    }

    private function checkDeadline(object $entity): void
    {
        // 1. On vérifie que c'est bien une Tache
        if (!$entity instanceof Tache) {
            return;
        }

        // ATTENTION : J'AI SUPPRIMÉ LE "dd()" ICI POUR QUE ÇA FONCTIONNE !

        $deadline = $entity->getDeadline();

        // 2. S'il n'y a pas de deadline, on ne fait rien
        if (!$deadline) {
            return;
        }

        // 3. On évalue la règle avec ExpressionLanguage
        $result = $this->expression->evaluate(
            'deadline_ts < now_ts and statut != "done"',
            [
                'deadline_ts' => $deadline->getTimestamp(),
                'now_ts'      => (new \DateTime())->getTimestamp(),
                'statut'      => $entity->getStatut(),
            ]
        );

        // 4. Si la date est dépassée et que ce n'est pas terminé, on force "Urgent"
        if ($result) {
            $entity->setPriorite('urgent');
        }
    }
}