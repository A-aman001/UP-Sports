<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\UserRole;
use App\Domain\Facility\FacilityFactory;
use App\Domain\CheckIn\CheckInService;

class CheckinController extends Controller
{
    public function submit(Request $request)
    {
        // type มาจากฟอร์มหรือ query เช่น ?type=badminton/pool/outdoor
        $type = $request->input('type', 'outdoor');

        // ดึง role จาก session ที่ SSO mock ไว้
        $raw = $request->session()->get('user.role', 'person');
        $role = new UserRole($raw);

        $facility = FacilityFactory::make($type);
        $service  = new CheckInService();

        $result = $service->checkIn($facility, $role);

        return response()->json($result);
    }
}