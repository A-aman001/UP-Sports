<?php

namespace App\Domain\Facility;

class FacilityFactory
{
    public static function make(string $type): Facility
    {
        return match ($type) {
            'badminton' => new BadmintonCourt('คอร์ทแบด', 16),
            'pool'      => new SwimmingPool('สระว่ายน้ำ', 60),
            'outdoor'   => new OutdoorField('สนามกลางแจ้ง', 200),
            default     => new OutdoorField('สนามทั่วไป', 100),
        };
    }
}