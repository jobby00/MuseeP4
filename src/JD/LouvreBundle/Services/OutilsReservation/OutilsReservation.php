<?php
namespace JD\LouvreBundle\Services\OutilsReservation;

use JD\LouvreBundle\Entity\Billets;
use JD\LouvreBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager as ORM;


class OutilsReservation
{
    private $em;
    private $session;

    public function __construct($em, $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function serialCreate(Reservation $resa)
    {
        //Generation Du Code dela Reservation
        $lettres = 'AZERTYUIOPQSDFGHJKLMWXCVBNAZERTYUIOPQSDFGHJKLMWXCVBN';
        $lettres = str_split(str_shuffle($lettres), 6)[0];
        $chifres = rand(100000, 999999);
        $resaCode = str_split(str_shuffle($chifres.$lettres),12)[0];
        return $resaCode;
    }

    /**
     * @param $resaCode
     * @param $nouvelleResaAcceptee
     * @return Reservation|null
     */
    public function getCurrentReservation()
    {
        $resa = $this->session->get('resa');

        return $resa;
    }

    public function  initializeReservation(Reservation $resa)
    {
            $this->session->set('resa', $resa);

            $this->em->persist($resa);
            $this->em->flush();
    }

    public function addAndDelete(Reservation $resa)
    {
        $nb = $resa->getNbBillets();
        $this->session->set('resa', $resa->setNbBillets($nb));

        $this->em->persist($resa->setNbBillets($nb));
        $this->em->flush();
    }
}