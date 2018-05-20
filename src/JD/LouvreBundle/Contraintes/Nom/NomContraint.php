<?php
namespace JD\LouvreBundle\Contraintes\Nom;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NomContraint extends Constraint
{
    public $messageNom = 'Vous avez connu une erreur, la première lettre votre Nom doit etres en majuscule exemple: Dupont Crousse';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}