<?php

namespace App\Domain\Facility;

use App\Domain\User\UserRole;

class BadmintonCourt extends Facility
{
    public function canCheckIn(UserRole $role): bool
    {
        // นิสิต/บุคลากรและเจ้าหน้าที่เข้าได้หมด
        return in_array($role->value, ['person', 'staff'], true);
    }

    public function pricePerHour(UserRole $role): int
    {
        return $role->isStaff() ? 0 : 40; // staff ฟรี / person 40
    }
}