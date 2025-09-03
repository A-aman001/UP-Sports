<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffReportController extends Controller
{
    public function index(Request $request)
    {
        // รองรับโหมด demo=?1 (ข้าม middleware ได้โดยใช้ลอจิกในตัวคอนโทรลเลอร์)
        // ถ้าอยากให้ demo=1 ไม่ต้องเช็ค staff เลย ให้ลอจิกอยู่ที่นี่
        // หมายเหตุ: ตอนนี้เราใช้ middleware 'staff' ที่ route แล้ว
        // ถ้าต้องการ "ข้าม" จริง ๆ อาจเอา middleware ออก แล้วเขียนเช็คเองแบบนี้:

        // if ($request->query('demo') !== '1') {
        //     $role = $request->session()->get('user.role');
        //     if ($role !== 'staff') {
        //         return redirect()->route('login')->with('error', 'สำหรับเจ้าหน้าที่เท่านั้น');
        //     }
        // }

        return view('staff.report'); // ไปที่ Blade
    }
}