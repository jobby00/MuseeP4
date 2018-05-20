<?php
namespace JD\LouvreBundle\Contraintes\Email;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EmailContraint extends Constraint
{
    public $message = 'Veillez verifier votre adresse Email, exmple email: jean@gmail.com';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}