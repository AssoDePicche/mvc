<?php

declare(strict_types=1);

namespace ORM;

abstract class ActiveRecord implements \Stringable
{
    protected array $attributes = [];

    public function __set(string $attribute, mixed $value): void
    {
        $this->attributes[$attribute] = $value;
    }

    public function __get(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? null;
    }

    public function __toString(): string
    {
        $class = new \ReflectionClass($this);

        $className = $class->getShortName();

        return strtolower($className);
    }

    public function execute(\ORM\Statement\Statement $statement): mixed
    {
        return $statement->execute($this);
    }
}
