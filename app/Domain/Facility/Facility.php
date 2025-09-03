<?php

namespace App\Domain\Facility;

use App\Domain\User\UserRole;

abstract class Facility
{
    public function __construct(
        protected string $name,
        protected int $capacity
    ) {}

    public function name(): string     { return $this->name; }
    public function capacity(): int    { return $this->capacity; }

    // “สัญญา” ที่ลูกต้องกำหนดเอง → polymorphism
    abstract public function canCheckIn(UserRole $role): bool;

    // ตัวอย่างกติกาค่าใช้บริการ (ลูก override ได้)
    public function pricePerHour(UserRole $role): int
    {
        return 0; // ค่าเริ่มต้นฟรี (ลูกบางตัวคิดเงิน)
    }
}