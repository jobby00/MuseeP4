<?php
namespace Tests\JD\LouvreBundle\Services\OutilsBilletsTest;

use JD\LouvreBundle\Services\OutilsBillets\OutilsBillets;
use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\Cloner\Data;

class OutilsBilletsTest extends TestCase
{
    public Function testCalculAge()
    {
        $billet = new OutilsBillets();
        $date =  new \DateTime('now');
        $date = $date->modify('-44 years');
        $age = $billet->calculAge($date);
        $this->assertEquals(44, $age);
    }


    public function testCalculPrix()
    {
        $prixBillets = new OutilsBillets();
        $age = 2;
        $prix = $prixBillets->calculPrix($age);
        $this->assertEquals(0, $prix);

        $prixBillets = new OutilsBillets();
        $age = 6;
        $prix = $prixBillets->calculPrix($age);
        $this->assertEquals(8, $prix);

        $prixBillets = new OutilsBillets();
        $age = 14;
        $prix = $prixBillets->calculPrix($age);
        $this->assertEquals(16, $prix);

        $prixBillets = new OutilsBillets();
        $age = 60;
        $prix = $prixBillets->calculPrix($age);
        $this->assertEquals(12, $prix);
    }
}