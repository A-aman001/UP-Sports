<?php

namespace App\Models;

class Person extends User
{
    protected static function booted() {
        static::addGlobalScope('person', function ($query) {
            $query->where('role', 'person');
        });
    }

    // ความสัมพันธ์เพิ่มเติม เช่น การ check-in
    public function checkins() {
        return $this->hasMany(Checkin::class, 'user_id');
    }
}