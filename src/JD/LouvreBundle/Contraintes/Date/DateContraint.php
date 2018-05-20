<?php
namespace JD\LouvreBundle\Contraintes\Date;


use Symfony\Component\Validator\Constraint;

/**
 * Class DateContraint
 * @Annotation
 */
class DateContraint extends Constraint
{
    public $messageWeeck = 'Nous sommes désolé le musée n\'est pas ouvert à cette date.';
    public $messageHalfDay = 'Nous sommes désolé vous ne pouvez plus sélectionner une réservation journée pour le jour même après 14h!';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}