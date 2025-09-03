<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequirePerson
{
    public function handle(Request $request, Closure $next)
    {
        $role = $request->session()->get('user.role');
        if ($role !== 'person') {
            return redirect()->route('login')->with('error', 'สำหรับนิสิต/บุคลากรเท่านั้น');
        }
        return $next($request);
    }
}