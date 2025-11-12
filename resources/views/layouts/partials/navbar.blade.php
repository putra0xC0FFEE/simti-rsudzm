<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle js-sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<div class="navbar-collapse collapse">
    <ul class="navbar-nav navbar-align">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
    <img src="{{ asset('adminkit/img/avatars/avatar.jpg') }}" 
         class="avatar img-fluid rounded-circle me-2" 
         alt="User" />
    <div class="d-flex flex-column lh-1">
        @auth
          <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
          <small class="text-muted" style="font-size: 12px;">{{ ucfirst(Auth::user()->role ?? 'staff') }}</small>
        @else
          <span class="fw-semibold text-dark">Tamu</span>
          <small class="text-muted" style="font-size: 12px;">Guest</small>
        @endauth
    </div>
                </a>
    
			</li>
		</ul>
	</div>
</nav>
