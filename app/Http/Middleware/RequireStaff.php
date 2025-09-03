<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireStaff
{
    public function handle(Request $request, Closure $next)
    {
        // เราเก็บโปรไฟล์ไว้ใน session key 'user'
        $role = data_get($request->session()->get('user', []), 'role');

        if ($role !== 'staff') {
            return redirect()->route('login')->with('error', 'สำหรับเจ้าหน้าที่เท่านั้น');
        }

        return $next($request);
    }
}