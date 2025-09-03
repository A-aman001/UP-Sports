<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function console(Request $request)
    {
        $user = $request->session()->get('user', []);
        $displayName = $user['name'] ?? 'เจ้าหน้าที่';

        return view('staff.console', compact('displayName'));
    }
}