<?php

namespace App\Tests\Entity;

use App\Entity\Activite;
use App\Entity\Planning;
use PHPUnit\Framework\TestCase;

class ActiviteTest extends TestCase
{
    public function testGetStatutDynamiqueReturnsEnAttenteWhenDateMissing(): void
    {
        $activite = new Activite();
        $this->assertEquals('En attente', $activite->getStatutDynamique());
    }

    public function testGetStatutDynamiqueReturnsEnAttenteBeforeStart(): void
    {
        $planning = new Planning();
        $planning->setDate(new \DateTime('today'));
        
        $activite = new Activite();
        $activite->setPlanning($planning);
        
        // Start 1 hour from now
        $start = (new \DateTime())->modify('+1 hour');
        $end = (clone $start)->modify('+1 hour');
        
        $activite->setHeureDebutEstimee($start);
        $activite->setHeureFinEstimee($end);
        
        $this->assertEquals('En attente', $activite->getStatutDynamique());
    }

    public function testGetStatutDynamiqueReturnsEnCoursDuringActivity(): void
    {
        $planning = new Planning();
        $planning->setDate(new \DateTime('today'));
        
        $activite = new Activite();
        $activite->setPlanning($planning);
        
        // Started 30 mins ago, ends in 30 mins
        $start = (new \DateTime())->modify('-30 minutes');
        $end = (clone $start)->modify('+1 hour');
        
        $activite->setHeureDebutEstimee($start);
        $activite->setHeureFinEstimee($end);
        
        $this->assertEquals('En cours', $activite->getStatutDynamique());
    }

    public function testGetStatutDynamiqueReturnsTermineAfterEnd(): void
    {
        $planning = new Planning();
        $planning->setDate(new \DateTime('today'));
        
        $activite = new Activite();
        $activite->setPlanning($planning);
        
        // Ended 1 hour ago
        $end = (new \DateTime())->modify('-1 hour');
        $start = (clone $end)->modify('-1 hour');
        
        $activite->setHeureDebutEstimee($start);
        $activite->setHeureFinEstimee($end);
        
        $this->assertEquals('Terminé', $activite->getStatutDynamique());
    }

    public function testSettingSuggestedByAi(): void
    {
        $activite = new Activite();
        $this->assertFalse($activite->isSuggestedByAi());
        
        $activite->setSuggestedByAi(true);
        $this->assertTrue($activite->isSuggestedByAi());
    }
}
