<?php
namespace JD\LouvreBundle\Contraintes\Date;

use \DateTime;
use JD\LouvreBundle\Entity\Billets;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Tests\Fixtures\ConstraintAValidator;

class DateContraintValidator extends  ConstraintAValidator
{
    private $heureLimiteDemiJournee = 12;
    public $billets;

    /**
     * @param $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $dateResa = $value->getDateResa();
        $dateUsuelle = new DateTime("now", new \DateTimeZone('Europe/Paris'));
        $dateResaForma = $dateResa->format('dm');
        $dateResaWeeck = $dateResa->format('w');
        if(
            $dateResaForma == "0105"
            || $dateResaForma == "2612"
            || $dateResaWeeck == '0'
            || $dateResaWeeck == '2'
        )
        {
            $this->context->buildViolation($constraint->messageWeeck)
                ->addViolation();
        }elseif (
            !$value->getDemijournee()
            && $dateResa->format('dmY') == $dateUsuelle->format('dmY')
            && $dateUsuelle->format('H') >= $this->heureLimiteDemiJournee)
        {
            $this->context->buildViolation($constraint->messageHalfDay)
                ->addViolation();
        }
    }
}