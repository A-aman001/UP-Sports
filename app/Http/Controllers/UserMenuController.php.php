<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMenuController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->session()->get('user', []);
        $displayName = $user['name']
            ?? $user['display_name']
            ?? $user['username']
            ?? 'ผู้ใช้งาน';

        return view('user.menu', compact('displayName'));
    }
}