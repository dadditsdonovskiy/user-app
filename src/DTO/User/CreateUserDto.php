<?php

namespace App\DTO\User;

use App\DTO\MainDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDto implements MainDtoInterface
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 6, max: 32)]
    public string $email;
    #[Assert\NotBlank()]
    #[Assert\Length(min: 6, max: 32)]
    public $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}