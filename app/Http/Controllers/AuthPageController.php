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
        // รับ role จาก query: staff | person (default person)
        $role = strtolower((string) $request->query('role', 'person'));
        $role = $role === 'staff' ? 'staff' : 'person';

        // mock user + ตั้ง session ให้ชัดเจน (ไม่แตะ DB)
        $user = [
            'name'    => $role === 'staff' ? 'เจ้าหน้าที่ทดสอบ' : 'นิสิตทดสอบ',
            'email'   => $role === 'staff' ? 'staff@up.ac.th' : 'student@up.ac.th',
            'role'    => $role,
            'faculty' => $role === 'person' ? 'คณะวิทยาการคอมพิวเตอร์' : null,
        ];
        $request->session()->put('user', $user);

        // ส่งต่อไปเมนูตามบทบาท
        return $role === 'staff'
            ? redirect()->route('staff.console')
            : redirect()->route('user.menu');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'ออกจากระบบแล้ว');
    }
}