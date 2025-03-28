<?php

namespace App\Application\DTO;

use Illuminate\Http\Request;
use App\Domain\Entities\Entity;
abstract class DTO
{
    public abstract static function fromRequest(Request $request): static;
    public abstract static function fromArray(array $data): static;
    public abstract static function fromEntity(Entity $entity): static;
}