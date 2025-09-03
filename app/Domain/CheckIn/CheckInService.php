<?php

namespace App\Domain\CheckIn;

use App\Domain\Facility\Facility;
use App\Domain\User\UserRole;

class CheckInService
{
    public function checkIn(Facility $facility, UserRole $role): array
    {
        if (! $facility->canCheckIn($role)) {
            return [
                'ok'      => false,
                'message' => 'บทบาทนี้ไม่สามารถเช็คอินที่ ' . $facility->name(),
            ];
        }

        return [
            'ok'       => true,
            'facility' => $facility->name(),
            'price'    => $facility->pricePerHour($role),
            'message'  => 'เช็คอินสำเร็จ',
        ];
    }
}