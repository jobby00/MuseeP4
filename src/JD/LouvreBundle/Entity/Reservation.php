<?php

namespace JD\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JD\LouvreBundle\Contraintes\Email as EmailAssert;
use JD\LouvreBundle\Contraintes\NbBillets as NbBilletsAssert;
use DateTime;

/**
 * Resrvation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="JD\LouvreBundle\Repository\ReservationRepository")
 * @NbBilletsAssert\NbBilletsContraint()
 */
class Reservation
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
     * @var \DateTime
     *
     * @ORM\Column(name="datecreate", type="datetime")
     * @Assert\DateTime()
     * @Assert\GreaterThanOrEqual("today")
     */
    private $datecreate;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @EmailAssert\EmailContraint
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="nbBillets", type="integer")
     * NBilletsAssert\NBilletsContraint
     * @ASSERT\Range(
     *     min = 1,
     *     max = 20
     * )
     */
    private $nbBillets = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="resa_code", type="string")
     */
    private $resaCode = 0;

    /**
     * @var float
     */
    private $prixTotal = 0;

    /**
     * @var boolean
     * @ORM\Column(name="payer", type="boolean")
     * @Assert\Type(type="boolean")
     */
    private $payer = false;

    /**
     * @var boolean
     * @ORM\column(name="checkBillet", type="boolean")
     * @Assert\Type(type="boolean")
     */
     private $checkBillet = false;

    /**
     * @ORM\OneToMany(targetEntity="JD\LouvreBundle\Entity\Billets", mappedBy="reservation", cascade={"persist"})
     * @Assert\Valid
     */
    private $billets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->email = "";
        $this->datecreate = new \DateTime("now", new \DateTimeZone('Europe/Paris'));
    }

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
     * Set datecreate
     *
     * @param \DateTime $datecreate
     *
     * @return Reservation
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;

        return $this;
    }

    /**
     * Get datecreate
     *
     * @return \DateTime
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nbBillets
     *
     * @param integer $nbBillets
     *
     * @return Reservation
     */
    public function setNbBillets($nbBillets)
    {
        $this->nbBillets = $nbBillets;

        return $this;
    }

    /**
     * Get nbBillets
     *
     * @return int
     */
    public function getNbBillets()
    {
        return $this->nbBillets;
    }

    /**
     * Set resaCode
     *
     * @param string $resaCode
     *
     * @return Reservation
     */
    public function setResaCode($resaCode)
    {
        $this->resaCode = $resaCode;

        return $this;
    }
    /**
     * Get resaCode
     *
     * @return string
     */
    public function getResaCode()
    {
        return $this->resaCode;
    }

    /**
     * Add billet
     *
     * @param \JD\LouvreBundle\Entity\Billets $billet
     *
     * @return Reservation
     */
    public function addBillet(\JD\LouvreBundle\Entity\Billets $billet)
    {
        $this->billets[] = $billet;

        return $this;
    }

    /**
     * Remove billet
     *
     * @param \JD\LouvreBundle\Entity\Billets $billet
     */
    public function removeBillet(\JD\LouvreBundle\Entity\Billets $billet)
    {
        $this->billets->removeElement($billet);
    }

    /**
     * Get billets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillets()
    {
        return $this->billets;
    }

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     *
     * @return Reservation
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float
     */
    public function getPrixTotal()
    {
        $total = 0;
        if($this->getBillets()){
            foreach ($this->getBillets() as $billet)
            {
                $total += $billet->getPrix();
            }
        }
        return $total;
    }

    /**
     * Set payer.
     *
     * @param bool $payer
     *
     * @return Reservation
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer.
     *
     * @return bool
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set checkBillet.
     *
     * @param bool $checkBillet
     *
     * @return Reservation
     */
    public function setCheckBillet($checkBillet)
    {
        $this->checkBillet = $checkBillet;

        return $this;
    }

    /**
     * Get checkBillet.
     *
     * @return bool
     */
    public function getCheckBillet()
    {
        return $this->checkBillet;
    }
}
