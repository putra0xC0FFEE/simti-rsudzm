@extends('layouts.guest')

@section('title', 'Masuk Aplikasi')

@section('content')
<div class="text-center mt-4">
    <h1 class="h2">Selamat Datang</h1>
    <p class="lead">Masuk untuk melanjutkan ke SIMTI RSUDZM</p>
</div>

<div class="card">
    <div class="card-body">
        <div class="m-sm-3">
            <form>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control form-control-lg" type="text" name="username" placeholder="Masukkan username" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-lg btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="text-center mt-3">
    Belum punya akun?
   <span style="color: blue;"> Silahkan Lapor ke Admin</span>
</div>
@endsection
