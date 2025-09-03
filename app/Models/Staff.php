<?php

namespace App\Models;

class Staff extends User
{
    protected static function booted() {
        static::addGlobalScope('staff', function ($query) {
            $query->where('role', 'staff');
        });
    }

    // เพิ่ม method เฉพาะ staff
    public function managedReports() {
        return $this->hasMany(Report::class, 'staff_id');
    }
}