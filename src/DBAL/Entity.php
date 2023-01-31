<?php

namespace Sheepdev\DBAL;

use ReflectionClass;

abstract class Entity
{
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFields(): array
    {
        $output = array();

        $class = new ReflectionClass(get_class($this));
        $fields = array_column($class->getProperties(), 'name');

        foreach ($fields as $field) {
            $getter = 'get' . ucwords(str_replace('_', ' ', $field));
            $getter = str_replace(' ', '', $getter);

            if ($this->$getter() instanceof \DateTime) {
                $output[$field] = $this->$getter()->format(config('default_datetime_format'));
            } else {
                $output[$field] = $this->$getter();
            }
        }

        return $output;
    }
}