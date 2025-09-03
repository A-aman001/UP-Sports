<?php

// app/Http/Controllers/StaffController.php
namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function console() {
        $staff = Staff::find(Auth::id());       // ดึงเฉพาะ role=staff
        abort_unless($staff, 403);
        $displayName = $staff->name ?? 'เจ้าหน้าที่';
        return view('staff.console', compact('displayName'));
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class StaffController extends Controller
// {
//     public function console(Request $request)
//     {
//         $displayName = $request->session()->get('user.name', 'เจ้าหน้าที่');
//         return view('staff.console', compact('displayName'));
//     }
// }
