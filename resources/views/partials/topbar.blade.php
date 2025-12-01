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
            <!-- Notifications -->
            <div class="dropdown me-3 me-lg-3">
                <button class="btn btn-link text-dark position-relative p-0" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="ti ti-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 9px; padding: 1px 4px; min-width: 16px;">
                        3
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-0" style="min-width: 320px;">
                    <li class="dropdown-header fw-semibold px-3 py-2 border-bottom">Notifikasi (3)</li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2 border-bottom" href="#">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                    <i class="ti ti-user-plus text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-medium">User baru terdaftar</div>
                                <div class="text-muted small">2 menit lalu</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2 border-bottom" href="#">
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                                    <i class="ti ti-alert-triangle text-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-medium">Kontrak hampir expired</div>
                                <div class="text-muted small">1 jam lalu</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2" href="#">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                    <i class="ti ti-check text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-medium">Pembayaran berhasil</div>
                                <div class="text-muted small">5 jam lalu</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider m-0">
                    </li>
                    <li>
                        <a class="dropdown-item small text-center px-3 py-2 text-primary" href="#">
                            Lihat semua notifikasi
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Messages (Desktop only) -->
            <div class="dropdown me-3 me-lg-3 d-none d-md-block">
                <button class="btn btn-link text-dark position-relative p-0" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="ti ti-mail fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                        style="font-size: 9px; padding: 1px 4px; min-width: 16px;">
                        5
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-0" style="min-width: 320px;">
                    <li class="dropdown-header fw-semibold px-3 py-2 border-bottom">Pesan (5)</li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2 border-bottom" href="#">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                    <i class="ti ti-user text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-medium">Sarah Wijaya</div>
                                <div class="text-muted small text-truncate">Apakah ada update untuk layanan...</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center px-3 py-2" href="#">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                    <i class="ti ti-user text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-medium">Budi Santoso</div>
                                <div class="text-muted small text-truncate">Terima kasih atas bantuannya...</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider m-0">
                    </li>
                    <li>
                        <a class="dropdown-item small text-center px-3 py-2 text-primary" href="#">
                            Lihat semua pesan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Profile -->
            <div class="dropdown">
                <button class="btn p-0 border-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-none d-md-block text-end me-3">
                        <div class="small fw-semibold">Admin Woka</div>
                        <div class="text-muted small" style="font-size: 0.75rem;">Super Admin</div>
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
                        <div class="fw-semibold">Admin Woka</div>
                        <div class="text-muted small">admin@wokacare.com</div>
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
