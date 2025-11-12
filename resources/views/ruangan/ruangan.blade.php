@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<h1 class="page-title mb-4">Daftar Ruangan</h1>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tabel Ruangan</h5>
        <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
          <i data-feather="plus"></i>
          <span>Tambah Ruangan</span>
        </a>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead>
              <tr>
                <th style="width:60px">No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th style="width:160px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($rooms as $index => $room)
                <tr>
                  <td>{{ ($rooms->currentPage() - 1) * $rooms->perPage() + $index + 1 }}</td>
                  <td>{{ $room->kode }}</td>
                  <td>{{ $room->name }}</td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('rooms.edit', ['id' => $room->id]) }}" class="btn btn-sm btn-outline-secondary">
                        <i data-feather="edit-2"></i> Edit
                      </a>
                      <form method="POST" action="{{ route('rooms.destroy', $room->id) }}" class="js-delete-room">
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
                  <td colspan="4" class="text-center text-muted">Belum ada data ruangan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          {{ $rooms->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  if (typeof feather !== 'undefined') feather.replace();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  (function () {
    const success = @json(session('success'));
    if (success && typeof Swal !== 'undefined') {
      Swal.fire({ icon: 'success', title: 'Berhasil', text: success, timer: 1800, showConfirmButton: false });
    }

    // SweetAlert konfirmasi hapus ruangan
    document.querySelectorAll('form.js-delete-room').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (typeof Swal === 'undefined') { form.submit(); return; }
        Swal.fire({
          title: 'Hapus Ruangan?',
          text: 'Apakah Kamu Yakin Menghapus Ruangan ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
      });
    });
  })();
  </script>
@endsection
