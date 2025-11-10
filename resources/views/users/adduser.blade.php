@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="page-title">Tambah Pengguna</h1>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header">
        <h5 class="card-title mb-0">Tambah Pengguna Baru</h5>
      </div>
      <div class="card-body">

          <form>
          <div class="row g-3">

            <div class="col-md-6">
              <label for="first_name" class="form-label">Nama Depan</label>
              <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Masukkan nama depan" required>
            </div>

            <div class="col-md-6">
              <label for="last_name" class="form-label">Nama Belakang</label>
              <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Masukkan nama belakang">
            </div>

            <div class="col-md-6">
              <label for="username" class="form-label">Nama Pengguna</label>
              <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="col-md-6">
              <label for="photo" class="form-label">Upload Foto</label>
              <input type="file" id="photo" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
              <small class="text-muted">Format yang didukung: JPG, PNG, JPEG (maks. 1MB)</small>

              <div class="mt-2">
                <img id="preview" src="#" alt="Preview Foto" class="rounded shadow-sm" style="display:none; width:100px; height:100px; object-fit:cover;">
              </div>
            </div>

            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="col-md-6">
              <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-user-plus me-2"></i> Tambah Pengguna
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{-- Preview Script --}}
<script>
function previewImage(event) {
  const preview = document.getElementById('preview');
  const file = event.target.files[0];
  if (file) {
    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
  }
}
</script>
@endsection
