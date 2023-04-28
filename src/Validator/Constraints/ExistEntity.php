<?php

namespace App\Validator\Constraints;

use App\Entity\Film;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ExistEntity extends Constraint
{
    public string $message = 'Title and Description combination should be unique';

    public string $propertyPath = 'some';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public $entityclass = Film::class;
}