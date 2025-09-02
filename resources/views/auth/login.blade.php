<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{ asset('img/Logo_of_University_of_Phayao.svg.png') }}" type="image/png">
    <title>กองกิจการนิสิต เข้าสู่ระบบ</title>
    <meta name="color-scheme" content="light dark">

    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <script src="{{ asset('js/login.js') }}" defer></script>
</head>

<body>
    <!-- แถบบนพร้อมโลโก้ย่อ -->
    <header class="topbar" aria-label="University Bar">
        <div class="brand-small" aria-label="DQSD logo small">
            <span>
                <img src="{{ asset('img/logoDSASMART.png') }}" alt="DSA" height="100">
            </span>
        </div>
    </header>

    <!-- เนื้อหาหลัก -->
    <main class="wrap">
        <section class="card" role="region" aria-labelledby="login-title">

            <!-- ปุ่มเลือกบทบาท -->
            <div class="segmented" role="tablist" aria-label="ประเภทผู้ใช้">
                <button id="tab-staff" role="tab" aria-selected="true" data-role="staff">เจ้าหน้าที่</button>
                <button id="tab-person" role="tab" aria-selected="false"
                    data-role="person">นิสิต/บุคคลทั่วไป</button>
                <!-- เส้นล็อก (ตัวชี้ตำแหน่งปุ่มที่เลือก) -->
                <span class="segmented-indicator" aria-hidden="true"></span>
            </div>

            {{-- <!-- ป้ายบอกสถานะล็อกบทบาท -->
            <div class="role-lock" aria-live="polite">
                <span class="lock-dot" aria-hidden="true"></span>
                <span id="role-label">ล็อกบทบาท: เจ้าหน้าที่</span>
            </div> --}}
            <!-- โลโก้/ชื่อหน่วยงาน -->
            <div class="logo-block" aria-live="polite">
                <img src="{{ asset('img/dsa.png') }}" alt="ตรากองพัฒนาคุณภาพนิสิตและนิสิตพิการ" height="250">
            </div>


            <div class="divider" role="separator" aria-hidden="true"></div>

            <!-- ปุ่มเข้าสู่ระบบ (ใช้บทบาทที่ล็อกไว้) -->
            <div class="cta">
                <button type="button" id="btn-continue">เข้าสู่ระบบด้วย UP ACCOUNT</button>
            </div>

            <!-- ลืมรหัสผ่าน -->
            <div class="actions">
                <a class="forgot" href="#" id="forgot-link" aria-label="ลืมรหัสผ่าน (เปิดหน้าช่วยเหลือ)">
                    <span class="key" aria-hidden="true"></span>
                    <span>ลืมรหัสผ่าน</span>
                </a>
            </div>
        </section>
    </main>
</body>

</html>
