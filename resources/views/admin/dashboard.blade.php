@extends('layouts.app')

@section('title', 'Dashboard Admin') 

@section('content')
    {{-- HEADER --}}
    <div class="mb-4">
        <p class="text-muted mb-0">Ringkasan data dalam sistem admin</p>
    </div>

    {{-- TOP CARDS --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Total Users</h6>
                    <h3 class="fw-bold">{{ $totalUsers }}</h3>
                    <p class="text-muted small mb-0">Total pengguna sistem</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Clients</h6>
                    <h3 class="fw-bold">{{ $totalClients }}</h3>
                    <p class="text-muted small mb-0">Total klien terdaftar</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Produk / Layanan</h6>
                    <h3 class="fw-bold">{{ $totalProducts }}</h3>
                    <p class="text-muted small mb-0">Produk dan layanan tersedia</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Total Kontrak</h6>
                    <h3 class="fw-bold">{{ $totalContracts }}</h3>
                    <p class="text-muted small mb-0">Semua kontrak aktif</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- KOLOM KIRI --}}
        <div class="col-md-8">
            {{-- STATUS KONTRAK --}}
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card shadow rounded-4 border-0 bg-primary text-white">
                        <div class="card-body">
                            <h6 class="text-white">Kontrak Aktif</h6>
                            <h3 class="fw-bold text-white">{{ $kontrakAktif }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow rounded-4 border-0 bg-primary text-dark">
                        <div class="card-body">
                            <h6 class="text-white">Menunggu ACC</h6>
                            <h3 class="fw-bold text-white">{{ $kontrakMenunggu }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card shadow rounded-4 border-0 bg-primary text-white">
                        <div class="card-body">
                            <h6 class="text-white">Kedaluwarsa</h6>
                            <h3 class="fw-bold text-white">{{ $kontrakExpired }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRAFIK --}}
            <div class="card shadow rounded-4 border-0 mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-bold">Grafik Kontrak Per Bulan</h6>
                </div>
                <div class="card-body">
                    <canvas id="kontrakChart" height="120"></canvas>
                </div>
            </div>


            {{-- KONTRAK MENUNGGU ACC --}}
            <div class="card shadow rounded-4 border-0 mb-4">
                <div class="card-header bg-light fw-semibold">
                    Kontrak Menunggu ACC Client
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($accPending as $k)
                        <li class="list-group-item">
                            {{ $k->nomor_kontrak }} — {{ $k->client->user->name }}
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Tidak ada kontrak menunggu persetujuan.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-md-4">
            {{-- AKTIVITAS TERBARU --}}
            <div class="card shadow rounded-4 border-0 mb-4">
                <div class="card-header bg-warning fw-semibold">
                    Aktivitas Terbaru
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($recentActivities as $act)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Kontrak {{ $act->nomor_kontrak }}</h6>
                                    <small class="text-muted">{{ $act->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">Dibuat oleh {{ $act->client->user->name }}</p>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada aktivitas terbaru.</li>
                        @endforelse

                    </ul>
                </div>
            </div>

            {{-- STAFF & TEKNISI --}}
            <div class="card shadow rounded-4 border-0 mb-4">
                <div class="card-header bg-warning fw-semibold">
                    Team
                </div>
                <div class="card-body">
                    <!-- Staff -->
                    <div class="mb-3">
                        <h6 class="text-dark fw-semibold">Staff</h6>
                        <ol class="mb-0 ps-3">
                            @forelse ($staff as $s)
                                <li>{{ $s->name }}</li>
                            @empty
                                <li class="text-muted">Belum ada staff terdaftar.</li>
                            @endforelse

                        </ol>
                        <hr>
                    </div>
                    <!-- Teknisi -->
                    <div>
                        <h6 class="text-dark fw-semibold">Teknisi</h6>
                        <ol class="mb-0 ps-3">
                            @forelse ($teknisi as $t)
                                <li>{{ $t->name }}</li>
                            @empty
                                <li class="text-muted">Belum ada teknisi terdaftar.</li>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>


            {{-- KONTRAK HAMPIR EXPIRED --}}
            <div class="card shadow rounded-4 border-0 mb-4">
                <div class="card-header bg-warning fw-semibold">
                    Kontrak Hampir Kedaluwarsa (7 Hari Lagi)
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($hampirExpired as $k)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $k->nomor_kontrak }}</strong> — {{ $k->client->user->name }}
                            </div>
                            <span class="badge bg-danger">{{ $k->tanggal_berakhir }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Tidak ada kontrak yang hampir kedaluwarsa.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kontrakChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Kontrak Dibuat',
                    data: @json($chartData),
                    borderWidth: 2,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
