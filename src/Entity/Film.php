<?php

namespace Sheepdev\Entity;

use Sheepdev\DBAL\Entity;

class Film extends Entity
{
    private string $name;
    private int $year;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }
}