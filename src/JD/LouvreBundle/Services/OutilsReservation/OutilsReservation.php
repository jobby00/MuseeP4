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

    /**
     * @param $resaCode
     * @param $nouvelleResaAcceptee
     * @return Reservation|null
     */
    public function getCurrentReservation()
    {
        $resa = $this->session->get('resa');
        //TODO redirection si resa == null
        /**
        if($resa){
            //$resa = $this->em->getRepository('JDLouvreBundle:Reservation')->findById($resa->getId());
        }
         **/

        return $resa;
    }

    public function  initializeReservation(Reservation $resa)
    {

            $this->session->set('resa', $resa);
            $this->em->persist($resa);
            $this->em->flush();
    }

     /**
     * @param $billets
     * @param $reservation
     */
    public function prixTotal($billets){
        $total = 0;
        if(!empty($billets))
        {
            foreach ($billets as  $billet){
                $total = $total + $billet->getPrix();
            }
        }

        return $total;
    }
}