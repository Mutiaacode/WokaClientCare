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
                        {{ $notifCount ?? 0 }}
                    </span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-0" style="min-width: 320px;">
                    <li class="dropdown-header fw-semibold px-3 py-2 border-bottom d-flex justify-content-between">
                        <span>Notifikasi ({{ $notifCount ?? 0 }})</span>
                    </li>

                    {{-- ================== KONTRAK MENUNGGU ================== --}}
                    @foreach ($notifPending as $p)
                        <li class="position-relative">
                            <form action="{{ route('notif.hide') }}" method="POST" class="position-absolute"
                                style="right:10px; top:10px;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                <button class="btn btn-sm btn-light p-0 px-1" style="font-size: 10px;">✕</button>
                            </form>

                            <a class="dropdown-item d-flex align-items-center px-3 py-2 border-bottom" href="#">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                                        <i class="ti text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="small fw-medium">Kontrak menunggu ACC</div>
                                    <div class="text-muted small">{{ $p->nomor_kontrak }}</div>
                                </div>
                            </a>
                        </li>
                    @endforeach

                    {{-- ================== KONTRAK HAMPIR EXPIRED ================== --}}
                    @foreach ($notifHampir as $h)
                        <li class="position-relative">
                            <form action="{{ route('notif.hide') }}" method="POST" class="position-absolute"
                                style="right:10px; top:10px;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $h->id }}">
                                <button class="btn btn-sm btn-light p-0 px-1" style="font-size: 10px;">✕</button>
                            </form>

                            <a class="dropdown-item d-flex align-items-center px-3 py-2 border-bottom" href="#">
                                <div class="flex-shrink-0">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-2">
                                        <i class="ti ti-clock text-danger"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="small fw-medium">Kontrak hampir expired:
                                        {{ $h->client->nama ?? $h->nama }}</div>
                                    <div class="text-muted small">Berakhir {{ $h->tanggal_berakhir->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach

                    {{-- ================== KONTRAK EXPIRED ================== --}}
                    @foreach ($notifExpired as $e)
                        <li class="position-relative">
                            <form action="{{ route('notif.hide') }}" method="POST" class="position-absolute"
                                style="right:10px; top:10px;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $e->id }}">
                                <button class="btn btn-sm btn-light p-0 px-1" style="font-size: 10px;">✕</button>
                            </form>

                            <a class="dropdown-item d-flex align-items-center px-3 py-2 border-bottom" href="#">
                                <div class="flex-shrink-0">
                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-2">
                                        <i class="ti ti-x text-secondary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="small fw-medium">Kontrak expired: {{ $e->client->nama ?? $e->nama }}
                                    </div>
                                    <div class="text-muted small">{{ $e->tanggal_berakhir->diffForHumans() }}</div>
                                </div>
                            </a>
                        </li>
                    @endforeach

                    @if ($notifCount == 0)
                        <li>
                            <div class="text-center text-muted small py-3">
                                Tidak ada notifikasi
                            </div>
                        </li>
                    @endif

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


            <!-- User Profile -->
            <div class="dropdown">
                <button class="btn p-0 border-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-none d-md-block text-end me-3">
                        <div class="small fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-muted small" style="font-size: 0.75rem;"> {{ ucfirst(auth()->user()->role) }}
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="rounded-circle border border-3 border-white shadow-sm bg-primary d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="ti ti-user text-white fs-5"></i>
                        </div>
                        <span
                            class="position-absolute bottom-0 end-0 bg-success border       border-2 border-white rounded-circle"
                            style="width: 10px; height: 10px;"></span>
                    </div>
                    <i class="ti ti-chevron-down ms-2 text-muted d-none d-md-block" style="font-size: 0.875rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-0" style="min-width: 240px;">
                    <li class="dropdown-header px-3 py-2 border-bottom">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-muted small"> {{ ucfirst(auth()->user()->role) }}</div>
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

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>
