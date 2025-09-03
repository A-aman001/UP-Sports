{{-- resources/views/choose.blade.php --}}
@extends('layouts.basic')

@section('title', 'UP-FMS เช็คอิน')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/choose.css') }}">
@endsection

@section('content')
    <div class="wrap">
        <header class="topbar">
            <div class="brand">
                <img src="{{ asset('img/logoDSASMART.png') }}" alt="DSA" class="brand-logo">
            </div>
        </header>

        <main>
            <section class="card">
                <div class="row">
                    <label for="session">วันที่ (session)</label>
                    <input id="session" type="date" inputmode="numeric" autocomplete="off" />
                </div>
            </section>

            {{-- ชั้นที่ 1 --}}
            <section class="card" id="panel-top">
                <h3 class="h3">เลือกประเภทสนาม</h3>
                <div class="grid" id="grid-top"></div>
            </section>

            {{-- ชั้นที่ 2: เฉพาะ “สนามกลางแจ้ง” --}}
            <section class="card hidden" id="panel-outdoor">
                <div class="toolbar">
                    <button class="btn" id="btnBack" type="button" aria-label="กลับ">&larr; กลับ</button>
                    <span class="hint">เลือกชนิดสนามกลางแจ้ง</span>
                </div>
                <div class="grid" id="grid-outdoor"></div>
            </section>
        </main>
    </div>

    {{-- Overlay success --}}
    <div id="overlay" class="overlay" aria-live="polite">
        <div class="card-ok">
            <p class="ok-title">check in<br>เสร็จสิ้น</p>
            <div class="ok-icon">✔️</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/choose.js') }}" defer></script>
@endsection
