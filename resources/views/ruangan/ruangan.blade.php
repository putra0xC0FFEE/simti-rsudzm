@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<h1 class="page-title mb-4">Daftar Ruangan</h1>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm table-card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tabel Ruangan</h5>
        <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
          <i data-feather="plus"></i>
          <span>Tambah Ruangan</span>
        </a>
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('rooms.index') }}" class="mb-1">
          <div class="col-md-4 px-0">
            <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control search-rounded" placeholder="Cari Data">
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead>
              <tr>
                <th style="width:60px">No</th>
                <th>Kode Ruangan</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th style="width:160px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php($start = ($rooms->currentPage() - 1) * $rooms->perPage())
              @forelse($rooms as $index => $room)
                <tr>
                  <td>{{ $start + $index + 1 }}</td>
                  <td>{{ $room->room_id }}</td>
                  <td>{{ $room->kategori }}</td>
                  <td>{{ $room->name }}</td>
                  <td>
                    @php($encoded = encrypt($room->room_id))
                    <div class="d-flex gap-2">
                      <a href="{{ route('rooms.edit', $encoded) }}" class="btn btn-sm btn-outline-secondary">
                        <i data-feather="edit-2"></i> Edit
                      </a>
                      <form method="POST" action="{{ route('rooms.destroy', $encoded) }}" class="js-delete-room">
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
                  <td colspan="5" class="text-center text-muted">Belum ada data ruangan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        @if($rooms->hasPages())
          <div class="d-flex justify-content-between flex-wrap gap-2 mt-3 align-items-center">
            <small class="text-muted">
              Menampilkan {{ $rooms->firstItem() }}-{{ $rooms->lastItem() }} dari {{ $rooms->total() }} ruangan
            </small>
            {{ $rooms->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        @endif
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
    const errorMessage = @json(session('error'));
    if (errorMessage && typeof Swal !== 'undefined') {
      Swal.fire({ icon: 'error', title: 'Gagal', text: errorMessage });
    }

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
