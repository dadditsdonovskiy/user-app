<?php

namespace App\DTO\Actor;

use App\DTO\MainDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\ExistEntity;

class CreateActorDto implements MainDtoInterface
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 6, max: 32)]
    private string $full_name;
    #[Assert\NotBlank()]
    #[Assert\Length(min: 10, max: 12)]
    private ?string $birth_date;

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birth_date;
    }

    /**
     * @param string|null $birth_date
     */
    public function setBirthDate(?string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }
}