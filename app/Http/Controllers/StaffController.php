<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function console(Request $request)
    {
        $displayName = $request->session()->get('user.name', 'เจ้าหน้าที่');
        return view('staff.console', compact('displayName'));
    }
}