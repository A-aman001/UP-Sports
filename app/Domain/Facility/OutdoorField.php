<?php

namespace App\Domain\Facility;

use App\Domain\User\UserRole;

class OutdoorField extends Facility
{
    public function canCheckIn(UserRole $role): bool
    {
        // ทุกบทบาทเข้าได้
        return true;
    }
}