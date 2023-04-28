<?php

namespace App\Validator\Constraints;

use App\Entity\User;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ExistUserEntity extends Constraint
{
    public string $message = 'Email should be unique';

    public string $propertyPath = 'some';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public $entityclass = User::class;
}