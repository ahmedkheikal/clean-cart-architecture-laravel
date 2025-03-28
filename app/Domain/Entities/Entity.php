<?php

namespace App\Domain\Entities;

abstract class Entity
{
    public abstract static function fromDTO($dto): static;
    public abstract static function fromModel($model): static;
}