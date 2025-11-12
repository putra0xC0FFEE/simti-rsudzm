@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<h1 class="page-title mb-4">Daftar Pengguna</h1>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tabel Pengguna</h5>
        {{-- Tombol Tambah Pengguna --}}
        <a href="{{ url('/pengguna/tambah') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
          <i data-feather="user-plus"></i>
          <span>Tambah Pengguna</span>
        </a>
      </div>

      <div class="card-body">

        {{-- Tabel data --}}
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead>
              <tr>
                <th style="width:60px">No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th style="width:160px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $index => $user)
                <tr>
                  <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td><span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }} text-uppercase">{{ $user->role }}</span></td>
                  <td>
                    <div class="d-flex gap-2">
                      {{-- Tombol Edit --}}
                      <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-outline-secondary">
                        <i data-feather="edit-2"></i> Edit
                      </a>

                      {{-- Tombol Hapus --}}
                      <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="js-delete-form" data-username="{{ $user->username }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                          <i data-feather="trash-2"></i> Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">Belum ada data pengguna.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $users->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

{{-- SweetAlert2 for delete confirmation and Feather icons --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  if (typeof feather !== 'undefined') feather.replace();

  // Tampilkan SweetAlert sukses jika ada flash 'success'
  @if (session('success'))
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: {!! json_encode(session('success')) !!},
        timer: 2000,
        showConfirmButton: false
      });
    }
  @endif

  (function () {
    const forms = document.querySelectorAll('form.js-delete-form');
    forms.forEach(function (form) {
      form.addEventListener('submit', function (e) {
        // Intercept default submit to show SweetAlert confirm
        e.preventDefault();
        const username = form.getAttribute('data-username') || '';
        if (typeof Swal === 'undefined') {
          // Fallback to native confirm if SweetAlert not loaded
          if (confirm(`Apakah Kamu Yakin Menghapus User ${username} ?`)) {
            form.submit();
          }
          return;
        }

        Swal.fire({
          title: 'Hapus Pengguna?',
          text: `Apakah Kamu Yakin Menghapus User ${username} ?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33', // merah untuk hapus
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  })();
</script>
@endsection
