<?php

namespace App\Event;

use App\DTO\MainDtoInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterDtoCreatedEvent extends Event
{
    public const NAME = 'dto.created';

    public function __construct(protected MainDtoInterface $dto)
    {
    }

    public function getDto(): MainDtoInterface
    {
        return $this->dto;
    }
}