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

    public  function __construct(EntityManager $em = null, Session $session)
    {
        $this->em = $em;
        $this->session = $session;
    }
   /**
    public function verifDate(Billets $billets)
    {
        $dateResa = $billets->getDateresa();
        $dateUsuelle = new DateTime("now", new \DateTimeZone('Europe/Paris'));
        $dateResaForma = $dateResa->format('dm');
        $dateResaWeeck = $dateResa->format('w');
        if(
            $dateResaForma == "0105"
            || $dateResaForma == "2512"
            || $dateResaWeeck == '0'
            || $dateResaWeeck == '2'
        )
        {
            $this->session->getFlashBag()->add('erreurInterne', "Nous sommes désolé le musée n'est pas ouvert à cette date.");
            return false;
        }elseif (
            !$billets->getDemijournee()
            && $dateResa->format('dmY') == $dateUsuelle->format('dmY')
            && $dateUsuelle->format('H') >= $this->heureLimiteDemiJournee)
        {
            $this->session->getFlashBag()->add('erreurInterne', 'Nous sommes désolé vous ne pouvez plus sélectionner une réservation journée pour le jour même après 14h!');
            return false;
        }else
        {
            return true;
        }
    }

/**
    public function verifNbPlaces($date, $nbBillets = 1)
    {
        $nbBilleReserves = $this->em->getRepository('JDLouvreBundle:Billets')
            ->countByDateResa($date);

        if ($nbBilleReserves + $nbBillets <= $this->nbBilletsMaxParJour){
            return true;
        }else{
            $this->session->getFlashBag()->add('erreurInterne', "Nous sommes désolé, il reste seulement X billet(s) disponibles à la date demandée!");
            return false;
        }
    }

    public function verifNbPlaces(Billets $billets, Reservation $resa)
    {
        $nbBilleReserves = $this->em
            ->getRepository('JDLouvreBundle:Billets')
            ->findByDateResa($billets->getDateResa());
        $sombillets = 0;
        foreach ($nbBilleReserves as $nbBilleReserve)
        {
            $nbBilleReserve = $resa->getNbBillets();
            $sombillets += $nbBilleReserve;
        }
        $nbilletDisponible = $this->nbBilletsMaxParJour - $sombillets;
        if($nbilletDisponible < 1)
        {
            $this->session->getFlashBag()->add('erreurInterne', "Nous sommes désolé, il n'y a plus de billet disponible à la date demandée!");
            $billetDispo = false;
        }elseif ($nbilletDisponible < $resa->getNbBillets())
        {
            $this->session->getFlashBag()->add('erreurInterne', "Nous sommes désolé, il reste seulement ".$nbilletDisponible." billet(s) disponibles à la date demandée!");
            $billetDispo = false;
        }
        return $billetDispo;
    }
     */
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

    public function calculPrix($age)
    {
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
        }else{
            $prix = $this->tarifReduit;
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