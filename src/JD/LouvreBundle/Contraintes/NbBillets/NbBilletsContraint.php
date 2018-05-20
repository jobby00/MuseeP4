<?php
namespace JD\LouvreBundle\Contraintes\NbBillets;

use JD\LouvreBundle\Entity\Billets;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NbBilletsContraint extends Constraint
{
    public $messageNbBillets = 'Nous sommes désolé, il n\'y a plus de billet disponible pour le: {{date}}';
    /**
     * @param Billets $billets
     * @return \DateTime
     */
    public function dateRese(Billets $billets)
    {
        $this->laDate = $laDate = $billets->getDateResa();
        return $laDate;
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}