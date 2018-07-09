<?php
namespace JD\LouvreBundle\Services\OutilsBillets;


use Doctrine\ORM\EntityManager;
use JD\LouvreBundle\Entity\Billets;
use Symfony\Component\HttpFoundation\Session\Session;
use \DateTime;

class OutilsBillets
{
    private $ageMaxGratuit  = 4;
    private $ageMaxEnfant   = 12;
    private $ageMinNormale  = 13;
    private $ageMinSenior   = 60;
    private $tarifEnfant    = 8;
    private $tarifSenior    = 12;
    private $tarifNormal    = 16;
    private $tarifReduit    = 10;
    private $em;
    private $session;

    public  function __construct(EntityManager $em = null, Session $session = null)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function getTarif()
    {
        $this->tarifEnfant;
        $this->tarifSenior;
        $this->tarifNormal;
        $this->tarifReduit;

    }
    /**
     * @param Billets $billets
     * @param $resa
     * @return bool|Billets
     */
    public  function validerBillet($billets, $resa)
    {
        $em = $this->em;
        try
        {
            $resa->addBillet($billets);
            $em->persist($resa);
            $em->persist($billets);
            $em->flush();
            $billets = true;
        }catch (Exception $e)
        {
            $this->session->getFlashBag()->add('erreurInterne', "Une erreur interne s'est produite, merci de réessayer.");
            $billets = false;
        }
        return $billets;
    }

    /**
     * @param $dateNaissance
     * @return int
     */
    public function calculAge($dateNaissance)
    {
        $today = new DateTime('now');
        $age = $today->diff($dateNaissance);
        return $age->y;
    }

    public function calculPrix($age/**,$tarifreduit = false**/)
    {
        /**
        if($tarifreduit)
        {
            return $this->tarifReduit;
        }
         * */
        if($age <= $this->ageMaxGratuit)
        {
            $prix = 0;
        }elseif ($age <= $this->ageMaxEnfant)
        {
            $prix = $this->tarifEnfant;
        }elseif ($age >= $this->ageMinSenior)
        {
            $prix = $this->tarifSenior;
        }elseif ($age >= $this->ageMinNormale)
        {
            $prix = $this->tarifNormal;
        }
        return $prix;
    }

    public function addBillet(Billets $billet)
    {
        $age = $this->calculAge($billet->getDateNaissance());
        $prix = $this->calculPrix($age);
        $billet->setPrix($prix);
        $resa = $this->session->get('resa');
        $billet->setReservation($resa);
        $resa->addBillet($billet);
        $this->session->set('resa', $resa);
    }

    public function isAllTicketsCompleted()
    {
        $resa = $this->session->get('resa');
        $totalBillet = count($resa->getBillets());

        return ($totalBillet == $resa->getNbBillets());
    }
}