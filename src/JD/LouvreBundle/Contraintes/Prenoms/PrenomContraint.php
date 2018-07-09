<?php
namespace JD\LouvreBundle\Contraintes\Prenoms;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PrenomContraint extends Constraint
{
    public $messagePrenom = 'Vous avez commis une erreur, la première lettre de votre Prénom doit être en majuscule exemple: Dupont Crousse';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}