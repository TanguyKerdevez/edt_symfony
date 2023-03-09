<?php 
namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Attribute\HasNamedArguments;

#[\Attribute]
class DateChevauche extends Constraint
{
    public string $message = " le cours chevauche un autre cours qui demarre a {{ dateDebut }} et fini a {{ dateFin }} , prenez un créneau différent ";
    // If the constraint has configuration options, define them as public properties


    /* public function validatedBy()
    {
        echo static::class.'Validator'; 
        return static::class.'Validator';
    } */

     public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

}

