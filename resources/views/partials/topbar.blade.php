<header class="topbar navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top">
    <div class="container-fluid px-3 px-lg-4 py-2">
        <!-- Left: Sidebar Toggle -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar (Mobile) -->
            <button class="navbar-toggler d-lg-none me-2 border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                <i class="ti ti-menu-2 fs-5"></i>
            </button>
        </div>

        <!-- Right: Notifications & User Profile -->
        <div class="d-flex align-items-center ms-auto">

            <!-- User Profile -->
            <div class="dropdown">
                <button class="btn p-0 border-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-none d-md-block text-end me-3">
                        <div class="small fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-muted small" style="font-size: 0.75rem;">{{ ucfirst(auth()->user()->role) }}
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="rounded-circle border border-3 border-white shadow-sm bg-primary d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="ti ti-user text-white fs-5"></i>
                        </div>
                        <span
                            class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle"
                            style="width: 10px; height: 10px;"></span>
                    </div>
                    <i class="ti ti-chevron-down ms-2 text-muted d-none d-md-block" style="font-size: 0.875rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-0" style="min-width: 240px;">
                    <li class="dropdown-header px-3 py-2 border-bottom">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-muted small">{{ auth()->user()->email }}</div>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2" href="#">
                            <i class="ti ti-help me-3"></i>
                            <span>Bantuan</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider m-0">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2 text-danger"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout me-3"></i>
                            <span>Keluar</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf</form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
