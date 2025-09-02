<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPageController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function redirectToSso(Request $request)
    {
        // 👉 จำลอง user ที่ login ผ่านเมลมหาลัย
        // ภายหลังเชื่อม SSO จริง ก็มาตั้งค่าตรงนี้ได้เลย
        $user = [
            'name'  => 'Aman Akikae',
            'email' => '67023086@up.ac.th',
            'role'  => 'staff', // ลองกำหนดเป็น staff
        ];

        // เก็บ user ลง session
        $request->session()->put('user', $user);

        // 👉 ถ้าเป็น staff → ไปหน้า staff.console
        if ($user['role'] === 'staff') {
            return redirect()->route('staff.console');
        }

        // 👉 ถ้าไม่ใช่ staff → ไปหน้าอื่น (เช่น choose)
        return redirect()->route('choose');
    }
}