<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="{{ url('/') }}">
			<span class="align-middle">SIMTI RSUDZM</span>
		</a>

		<ul class="sidebar-nav">

			<li class="sidebar-item {{ request()->is('home') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ url('home') }}">
					<i class="align-middle" data-feather="home"></i>
					<span class="align-middle">Dashboard</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('intranet') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ url('intranet') }}">
					<i class="align-middle" data-feather="share-2"></i>
					<span class="align-middle">Intranet</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('isp') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ url('isp') }}">
					<i class="align-middle" data-feather="globe"></i>
					<span class="align-middle">ISP</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('perangkat') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ url('perangkat') }}">
					<i class="align-middle" data-feather="server"></i>
					<span class="align-middle">Perangkat</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('laporan') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ url('laporan') }}">
					<i class="align-middle" data-feather="clipboard"></i>
					<span class="align-middle">Laporan</span>
				</a>
			</li>

			@auth
			@if (Auth::user()->role === 'admin')
			<li class="sidebar-header">Administrator</li>
			<li class="sidebar-item">
    <a data-bs-target="#penggunaMenu" data-bs-toggle="collapse" class="sidebar-link collapsed" href="#">
        <i class="align-middle" data-feather="user"></i>
        <span class="align-middle">Pengguna</span>
    </a>
    <ul id="penggunaMenu" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item {{ request()->is('pengguna') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ url('/pengguna') }}">
                <i class="align-middle" data-feather="users"></i>
                <span class="align-middle">Daftar Pengguna</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->is('pengguna/tambah') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ url('/pengguna/tambah') }}">
                <i class="align-middle" data-feather="user-plus"></i>
                <span class="align-middle">Tambah Pengguna</span>
            </a>
        </li>
    </ul>
 </li>

<li class="sidebar-item">
    <a data-bs-target="#masterDataMenu" data-bs-toggle="collapse" class="sidebar-link collapsed" href="#">
        <i class="align-middle" data-feather="database"></i>
        <span class="align-middle">Master Data</span>	
    </a>

    <ul id="masterDataMenu" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('/ruangan') }}">
                <i class="align-middle" data-feather="layout"></i>
                <span class="align-middle">Ruangan</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('/kategori-perangkat') }}">
                <i class="align-middle" data-feather="cpu"></i>
                <span class="align-middle">Kategori Perangkat</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('/jenis-perangkat') }}">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">Jenis Perangkat</span>
            </a>
        </li>
    </ul>

</li>
                @endif
                @endauth

                @auth
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                        <i class="align-middle" data-feather="log-out"></i>
                        <span class="align-middle">Logout</span>
                    </a>
                    <form id="sidebar-logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                        @csrf
                    </form>
                </li>
                @endauth

            </ul>
	</div>
</nav>
