<?php 
// src/Validator/ContainsAlphanumeric.php
namespace App\Validator;
use App\Repository\CoursRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;


class DateChevaucheValidator extends ConstraintValidator
{

    public ?CoursRepository $coursRepo = null ; 

    public function __constructor(CoursRepository  $coursRepository ){

        echo "<h1>  CONSTRUIT  </h1>"; 
        var_dump( $coursRepository ); 
        $this->coursRepo = $coursRepository; 
    }


    public function validate($value, Constraint $constraint  ): void
    {
        // throw new UnexpectedValueException($array, 'resultat');
        // $this->getE



        $array =  $this->coursRepo->getCoursChevauched( $value->getDateHeureDebut() ,  $value->getDateHeureFin() )  ; 
        var_dump($array); 
        if(!empty($array)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{dateDebut}}' , $array[0]->getDateHeureDebut() )
            ->setParameter( '{{dateFin}}' , $array[0]->getDateHeureFin() )
            ->addViolation();
        } 
    }



}


