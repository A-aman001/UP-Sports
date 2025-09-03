<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function scan()
    {
        return view('scan'); // ถ้ายังไม่มี view นี้ไว้ค่อยทำทีหลัง
    }

    public function report()
    {
        return view('report');
    }

    public function choose(Request $request)
    {
        return view('choose'); // resources/views/choose.blade.php
    }

    public function generator()
    {
        return view('generator');
    }
}