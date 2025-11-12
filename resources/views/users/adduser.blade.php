@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<h1 class="page-title mb-4">Tambah Pengguna</h1>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Form Tambah Pengguna Baru</h5>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-2">
          <i data-feather="arrow-left"></i>
          <span>Kembali</span>
        </a>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
          @csrf
          <div class="row g-3">

            {{-- Nama Lengkap --}}
            <div class="col-md-6">
              <label for="full_name" class="form-label">Nama Lengkap</label>
              <input type="text" id="full_name" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
              @error('name')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            {{-- Username --}}
            <div class="col-md-6">
              <label for="username" class="form-label">Nama Pengguna</label>
              <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required>
              @error('username')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
              @error('password')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            {{-- Role --}}
            <div class="col-md-6">
              <label for="role" class="form-label">Role</label>
              <select id="role" name="role" class="form-select" required>
                 <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>          
              </select>
              @error('role')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>


            {{-- Tombol Aksi --}}
            <div class="col-12 text-end mt-4 d-flex justify-content-end gap-2">
              <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i data-feather="user-plus"></i>
                <span>Tambah Pengguna</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Feather Icon Support --}}
<script>
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
</script>

@endsection
