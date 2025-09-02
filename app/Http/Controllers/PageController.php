<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function scan()      { return view('scan'); }
    public function report()    { return view('report'); }
    public function choose()    { return view('choose'); }
    public function generator() { return view('generator'); }
}