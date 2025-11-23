@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<h1 class="page-title mb-4">Edit Pengguna</h1>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Form Edit Pengguna</h5>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
          <i data-feather="arrow-left"></i> Kembali
        </a>
      </div>

      <div class="card-body">
        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('users.update', $encoded ?? encrypt($user->username)) }}" class="row g-3">
          @csrf
          @method('PUT')

          {{-- Nama --}}
          <div class="col-md-6">
            <label for="edit_name" class="form-label">Nama Lengkap</label>
            <input type="text" id="edit_name" name="name" class="form-control" 
                   value="{{ old('name', $user->name) }}" required>
          </div>

          {{-- Username --}}
          <div class="col-md-6">
            <label for="edit_username" class="form-label">Username</label>
            <input type="text" id="edit_username" name="username" class="form-control" 
                   value="{{ old('username', $user->username) }}" required>
          </div>

          {{-- Role --}}
          <div class="col-md-6">
            <label for="edit_role" class="form-label">Role</label>
            <select id="edit_role" name="role" class="form-select" required>
              @php($currentRole = old('role', $user->role ?? 'staff'))
              <option value="staff" {{ $currentRole === 'staff' ? 'selected' : '' }}>Staff</option>
              <option value="admin" {{ $currentRole === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
          </div>

          {{-- (Email dihapus sesuai permintaan) --}}

          {{-- Password selalu terlihat --}}
          <div class="col-md-6">
            <label for="edit_password" class="form-label">Password (opsional)</label>
            <input type="text" id="edit_password" name="password" class="form-control" 
                   placeholder="Biarkan kosong jika tidak diubah" value="{{ old('password') }}">
          </div>

          {{-- Tombol simpan --}}
          <div class="col-12 text-end mt-3">
            <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
              <i data-feather="save"></i>
              <span>Simpan Perubahan</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  if (typeof feather !== 'undefined') feather.replace();
</script>
@endsection
