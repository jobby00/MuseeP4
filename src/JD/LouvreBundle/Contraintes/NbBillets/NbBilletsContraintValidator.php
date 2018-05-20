<?php
namespace JD\LouvreBundle\Contraintes\NbBillets;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Tests\Fixtures\ConstraintAValidator;

class NbBilletsContraintValidator extends ConstraintAValidator
{
    private $nbBilletsMaxParJour = 1;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        dump($value);

        if($value->getPayer())
        {
            foreach ($value->getBillets() as $billet)
            {
                $query = $this->em->createQueryBuilder();
                $count = $query->select('count(r.payer)')
                    ->from('JDLouvreBundle:Billets', 'b')
                    ->innerJoin('b.reservation', 'r')
                    ->where('r.payer = 1')
                    ->andWhere('b.dateResa = :dateBillet')
                    ->setParameter('dateBillet', $billet->getDateResa())
                    ->getQuery()
                    ->getSingleScalarResult();
                dump($count);
                if ($count + 1 > $this->nbBilletsMaxParJour) {
                    $this->context->buildViolation($constraint->messageNbBillets)
                        ->setParameter('{{date}}', $billet->getDateResa()->format('d/m/Y'))
                        ->addViolation();
                }
            }
        }
    }
}