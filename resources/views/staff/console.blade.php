<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>UP-FMS · เมนูเจ้าหน้าที่</title>
    <meta name="color-scheme" content="light dark">
    <link rel="icon" href="{{ asset('img/Logo_of_University_of_Phayao.svg.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('assets/css/staff_console.css') }}">
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <img src="{{ asset('img/logoDSASMART.png') }}" alt="DSA" class="brand-logo">
        </div>

        <!-- ขวาบน: ชื่อผู้ใช้ + ออกจากระบบ -->
        <div class="righttools">
            <span class="user-btn" aria-label="ผู้ใช้ปัจจุบัน">
                {{-- ไอคอนผู้ใช้เล็ก ๆ --}}
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20 21a8 8 0 0 0-16 0" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                {{ $displayName }}
            </span>

            {{-- ออกจากระบบ: ใช้ POST + CSRF --}}
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout" title="ออกจากระบบ" aria-label="ออกจากระบบ">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <path d="M16 17l5-5-5-5" />
                        <path d="M21 12H9" />
                    </svg>
                    ออกจากระบบ
                </button>
            </form>
        </div>
    </header>

    <main>
        <div class="section-title">เมนูหลักสำหรับเจ้าหน้าที่</div>

        <section class="grid" aria-label="เมนูด่วน">

            <a class="tile" href="{{ url('/staff/equipment') }}">
                <div class="tile-inner">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h12l4 5-4 5H4l4-5-4-5z" fill="currentColor" />
                    </svg>
                    <b>ยืม-คืน อุปกรณ์กีฬา</b>
                    <small>จัดการรายการ/สต็อก</small>
                </div>
            </a>

            <a class="tile" href="{{ url('/staff/badminton-booking') }}">
                <div class="tile-inner">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16M8 6v12M16 6v12" stroke="currentColor" stroke-width="2"
                            fill="none" />
                    </svg>
                    <b>จองสนามแบดมินตัน</b>
                    <small>บริหารคอร์ท</small>
                </div>
            </a>

            <a class="tile" href="{{ url('/staff/report') }}">
                <div class="tile-inner">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 19h16M6 17V7m6 10V5m6 12V9" stroke="currentColor" stroke-width="2" fill="none" />
                    </svg>
                    <b>ข้อมูลการเข้าใช้สนาม</b>
                    <small>ดู/ค้นหา/ดาวน์โหลด</small>
                </div>
            </a>

            <a class="tile" href="{{ url('/staff/borrow-stats') }}">
                <div class="tile-inner">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 12l5 5 13-13" stroke="currentColor" stroke-width="2" fill="none" />
                    </svg>
                    <b>ข้อมูลสถิติการยืม-คืน</b>
                    <small>สรุปยอด/แนวโน้ม</small>
                </div>
            </a>

        </section>
    </main>
</body>

</html>
