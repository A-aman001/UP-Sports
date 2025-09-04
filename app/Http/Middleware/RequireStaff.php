<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireStaff
{
    public function handle(Request $request, Closure $next)
    {
        // รองรับทั้งแบบเก็บเป็น dot-key และเป็น array
        $role = $request->session()->get('user.role')
            ?? optional($request->session()->get('user'))['role']
            ?? null;

        if ($role !== 'staff') {
            return redirect()->route('login')->with('error', 'สำหรับเจ้าหน้าที่เท่านั้น');
        }
        return $next($request);
    }
}