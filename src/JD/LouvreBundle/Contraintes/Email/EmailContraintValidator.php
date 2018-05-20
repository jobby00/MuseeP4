<?php
namespace JD\LouvreBundle\Contraintes\Email;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailContraintValidator extends ConstraintValidator
{
    public function Validate($value, Constraint $constraint)
    {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}