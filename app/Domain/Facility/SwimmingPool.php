<?php

namespace App\Domain\Facility;

use App\Domain\User\UserRole;

class SwimmingPool extends Facility
{
    public function canCheckIn(UserRole $role): bool
    {
        // ต้องเป็น person เท่านั้น (ตัวอย่างกติกา)
        return $role->isPerson();
    }

    public function pricePerHour(UserRole $role): int
    {
        return 30;
    }
}