<?php

// app/Http/Controllers/UserMenuController.php
namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMenuController extends Controller
{
    public function index() {
        $user = Person::find(Auth::id());       // ดึงเฉพาะ role=person
        abort_unless($user, 403);
        $displayName = $user->name ?? 'ผู้ใช้งาน';
        return view('user.menu', compact('displayName'));
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class UserMenuController extends Controller
// {
//     public function index(Request $request)
//     {
//         $user = $request->session()->get('user', []);
//         $displayName = $user['name'] ?? 'ผู้ใช้งาน';
//         return view('user.menu', compact('displayName'));
//     }
// }
