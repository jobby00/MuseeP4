<?php
namespace JD\LouvreBundle\Contraintes\Prenoms;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PrenomContraint extends Constraint
{
    public $messagePrenom = 'Vous avez connu une erreur, la première lettre votre Prenom doit etres en majuscule exemple: Dupont Crousse';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}