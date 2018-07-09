<?php
namespace JD\LouvreBundle\Contraintes\Nom;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NomContraint extends Constraint
{
    public $messageNom = 'Vous avez commis une erreur, la première lettre de votre Nom doit être en majuscule exemple: Dupont Crousse';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}