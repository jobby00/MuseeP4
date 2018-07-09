<?php

namespace JD\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JD\LouvreBundle\Contraintes\Nom as NomAssert;
use JD\LouvreBundle\Contraintes\Prenoms as PrenomAssert;
use JD\LouvreBundle\Contraintes\Date as DateAssert;
use JD\LouvreBundle\Contraintes\NbBillets as NbBilletsAssert;

/**
 * Billets
 * @ORM\Table(name="billets")
 * @ORM\Entity(repositoryClass="JD\LouvreBundle\Repository\BilletsRepository")
 * @DateAssert\DateContraint()
 *
 */
class Billets
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 75,
     *      minMessage = "Votre nom ne peut faire moins de {{ limit }} caractères.",
     *      maxMessage = "Votre nom ne peut faire plus de {{ limit }} caractères."
     * )
     * @NomAssert\NomContraint()
     */
    private $nom = '';

    /**
     * @var string
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 75,
     *      minMessage = "Votre prénom ne peut faire moins de {{ limit }} caractères.",
     *      maxMessage = "Votre prénom ne peut faire plus de {{ limit }} caractères."
     * )
     * @PrenomAssert\PrenomContraint()
     */
    private $prenom = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="datetime")
     * @ORM\Column(name="dateNaissance", type="date")
     * @Assert\Date()
     * @Assert\LessThan(
     *     "today",
     *     message = "merci de vérifier la date de naissance"
     * )
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=2)
     * @Assert\Country()
     */
    private $pays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateResa", type="datetime")
     * @Assert\DateTime()
     * @Assert\GreaterThanOrEqual(
     *      "today",
     *      message = "merci ne pas choisir une date antérieure à celle du jour.."
     * )
     *
     */
    private $dateResa;

    /**
     * @var bool
     *
     * @ORM\Column(name="tarifReduit", type="boolean")
     */
    private $tarifReduit;

    /**
     * @var bool
     *
     * @ORM\Column(name="demiJournee", type="boolean")
     * @Assert\Type(type="boolean")
     *
     */
    private $demiJournee;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix = 0;

    /**
     * @ORM\ManyToOne(targetEntity="JD\LouvreBundle\Entity\Reservation", inversedBy="billets", cascade = {"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Billets
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Billets
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Billets
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Billets
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set dateResa
     *
     * @param \DateTime $dateResa
     *
     * @return Billets
     */
    public function setDateResa($dateResa)
    {
        $this->dateResa = $dateResa;

        return $this;
    }

    /**
     * Get dateResa
     *
     * @return \DateTime
     */
    public function getDateResa()
    {
        return $this->dateResa;
    }

    /**
     * Set tarifReduit
     *
     * @param boolean $tarifReduit
     *
     * @return Billets
     */
    public function setTarifReduit($tarifReduit)
    {
        $this->tarifReduit = $tarifReduit;

        return $this;
    }

    /**
     * Get tarifReduit
     *
     * @return bool
     */
    public function getTarifReduit()
    {
        return $this->tarifReduit;
    }

    /**
     * Set demiJournee
     *
     * @param boolean $demiJournee
     *
     * @return Billets
     */
    public function setDemiJournee($demiJournee)
    {
        $this->demiJournee = $demiJournee;

        return $this;
    }

    /**
     * Get demiJournee
     *
     * @return bool
     */
    public function getDemiJournee()
    {
        return $this->demiJournee;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Billets
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set reservation
     *
     * @param \JD\LouvreBundle\Entity\Reservation $reservation
     *
     * @return Billets
     */
    public function setReservation(\JD\LouvreBundle\Entity\Reservation $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \JD\LouvreBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
