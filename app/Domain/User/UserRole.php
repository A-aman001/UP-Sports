<?php

namespace App\Domain\User;

final class UserRole
{
    public function __construct(public readonly string $value) {}

    public function isStaff(): bool  { return $this->value === 'staff'; }
    public function isPerson(): bool { return $this->value === 'person'; }
}