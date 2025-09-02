<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckinController extends Controller
{
    // TODO: ย้าย logic บันทึกเช็คอินจาก PHP เดิมมาใส่ที่นี่
    public function submitScan(Request $request)
    {
        // ตัวอย่าง:
        // $data = $request->validate([ 'student_id' => 'required', ... ]);
        // CheckIn::create([...]);
        return back()->with('ok', true);
    }

    // TODO: ย้าย logic ของหน้า choose.php เดิม
    public function chooseSubmit(Request $request)
    {
        // ทำงานกับข้อมูล แล้วส่งกลับหรือ redirect
        return redirect()->route('choose')->with('saved', true);
    }
}