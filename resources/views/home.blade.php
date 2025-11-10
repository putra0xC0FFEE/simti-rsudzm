@extends('layouts.guest')

@section('title', 'Selamat Datang')

@push('styles')
<link href="{{ asset('adminkit/css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="text-center hero">
    <img src="{{ asset('adminkit/img/icons/logo-simti.png') }}" alt="Logo RSUDZM" class="hero-logo">

    <h1><span>SIMTI</span> RSUDZM</h1>

    <p>
        <strong>Sistem Informasi Manajemen Tim IT</strong><br>
        <strong>UPTD RSUD dr. Zubir Mahmud</strong><br>
    </p>

<a href="{{ url('/auth/login') }}" class="btn btn-login mt-3 d-inline-flex align-items-center justify-content-center gap-2">
    <i data-feather="log-in"></i>
    <span>Masuk ke Sistem</span>
</a>
</div>
@endsection
