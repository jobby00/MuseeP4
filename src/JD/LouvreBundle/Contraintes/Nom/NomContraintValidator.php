<?php
namespace JD\LouvreBundle\Contraintes\Nom;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NomContraintValidator extends  ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if(!preg_match('/^([A-Z]{1}[a-z]{1,})$|^([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^$/', $value, $matches))
        {
            $this->context->buildViolation($constraint->messageNom)
                ->setParameter('{{ string }}', $value)->addViolation();
        }
    }
}