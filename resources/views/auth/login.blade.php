<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('img/Logo_of_University_of_Phayao.svg.png') }}" type="image/png">
    <title>กองกิจการนิสิต เข้าสู่ระบบ</title>
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    <header class="topbar" aria-label="University Bar">
        <div class="brand-small" aria-label="DQSD logo small">
            <span><img src="{{ asset('img/logoDSASMART.png') }}" alt="DSA" height="100"></span>
        </div>
    </header>

    <main class="wrap">
        <section class="card" role="region" aria-labelledby="login-title">
            <!-- แท็บเลือกบทบาท -->
            <div class="segmented" role="tablist" aria-label="ประเภทผู้ใช้">
                <button id="tab-staff" role="tab" aria-selected="true" data-role="staff">เจ้าหน้าที่</button>
                <button id="tab-person" role="tab" aria-selected="false"
                    data-role="person">นิสิต/บุคคลทั่วไป</button>
                <span class="segmented-indicator" aria-hidden="true"></span>
            </div>

            <!-- โลโก้ -->
            <div class="logo-block" aria-live="polite">
                <img src="{{ asset('img/dsa.png') }}" alt="ตรากองพัฒนาคุณภาพนิสิตและนิสิตพิการ" height="250">
            </div>

            <div class="divider" role="separator" aria-hidden="true"></div>

            <!-- ปุ่มเข้าสู่ระบบด้วยบทบาทที่เลือก -->
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

    {{-- JS เฉพาะหน้านี้ --}}
    <script>
        (function() {
            let selectedRole = 'staff';
            const tabStaff = document.getElementById('tab-staff');
            const tabPerson = document.getElementById('tab-person');
            const indicator = document.querySelector('.segmented-indicator');
            const btn = document.getElementById('btn-continue');

            function moveIndicator(activeBtn) {
                if (!indicator || !activeBtn) return;
                const p = activeBtn.parentElement.getBoundingClientRect();
                const r = activeBtn.getBoundingClientRect();
                indicator.style.width = r.width + 'px';
                indicator.style.transform = `translateX(${r.left - p.left}px)`;
            }

            function activate(role) {
                selectedRole = role;
                const active = role === 'staff' ? tabStaff : tabPerson;
                const inactive = role === 'staff' ? tabPerson : tabStaff;

                active.setAttribute('aria-selected', 'true');
                active.tabIndex = 0;
                inactive.setAttribute('aria-selected', 'false');
                inactive.tabIndex = -1;

                moveIndicator(active);
            }

            tabStaff?.addEventListener('click', () => activate('staff'));
            tabPerson?.addEventListener('click', () => activate('person'));

            btn?.addEventListener('click', () => {
                const base = "{{ route('auth.redirect') }}";
                const url = new URL(base, window.location.origin);
                url.searchParams.set('role', selectedRole);
                window.location.href = url.toString();
            });

            window.addEventListener('load', () => {
                activate('staff');
                setTimeout(() => moveIndicator(document.querySelector('[role="tab"][aria-selected="true"]')),
                    50);
            });
            window.addEventListener('resize', () => moveIndicator(document.querySelector(
                '[role="tab"][aria-selected="true"]')));
        })();
    </script>
</body>

</html>
