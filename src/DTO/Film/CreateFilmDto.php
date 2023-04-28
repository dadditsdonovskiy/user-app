<?php

namespace App\DTO\Film;

use App\DTO\MainDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\ExistEntity;

#[ExistEntity]
class CreateFilmDto implements MainDtoInterface
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 6, max: 32)]
    private string $title;
    #[Assert\NotBlank()]
    #[Assert\Length(min: 6, max: 320)]
    private string $description;
    #[Assert\NotBlank()]
    #[Assert\Length(min: 10, max: 12)]
    private ?string $released_at;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getReleasedAt(): ?string
    {
        return $this->released_at;
    }

    /**
     * @param string|null $released_at
     */
    public function setReleasedAt(?string $released_at): void
    {
        $this->released_at = $released_at;
    }
}