@extends('layouts.app')

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
                    <h6 class="text-primary">Total Users</h6>
                    <h3 class="fw-bold">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-primary">Clients</h6>
                    <h3 class="fw-bold">{{ $totalClients }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-primary">Produk / Layanan</h6>
                    <h3 class="fw-bold">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-primary">Total Kontrak</h6>
                    <h3 class="fw-bold">{{ $totalContracts }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- STATUS KONTRAK --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-4 border-0 bg-primary text-white">
                <div class="card-body">
                    <h6 class="text-white">Kontrak Aktif</h6>
                    <h3 class="fw-bold text-white">{{ $kontrakAktif }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-4 border-0 bg-primary text-dark">
                <div class="card-body">
                    <h6 class="text-white">Menunggu ACC</h6>
                    <h3 class="fw-bold text-white">{{ $kontrakMenunggu }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-4 border-0 bg-primary text-white">
                <div class="card-body">
                    <h6 class="text-white">Kedaluwarsa</h6>
                    <h3 class="fw-bold text-white">{{ $kontrakExpired }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTRAK HAMPIR EXPIRED --}}
    <div class="card shadow-sm rounded-4 border-0 mb-4">
        <div class="card-header bg-warning  fw-semibold">
            Kontrak Hampir Kedaluwarsa (7 Hari Lagi)
        </div>
        <ul class="list-group list-group-flush">
            @forelse ($hampirExpired as $k)
                <li class="list-group-item">
                    <strong>{{ $k->nomor_kontrak }}</strong> — {{ $k->client->user->name }}
                    <span class="badge bg-danger float-end">{{ $k->tanggal_berakhir }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">Tidak ada kontrak yang hampir kedaluwarsa.</li>
            @endforelse
        </ul>
    </div>

    {{-- GRAFIK --}}
    <div class="card shadow-sm rounded-4 border-0 mb-4">
        <div class="card-header bg-primary text-white">
            Grafik Kontrak Per Bulan
        </div>
        <div class="card-body">
            <canvas id="kontrakChart" height="120"></canvas>
        </div>
    </div>

    {{-- STAFF & TEKNISI --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm rounded-4 border-0 p-3">
                <h5 class="text-primary fw-bold">Staff</h5>
                <ul class="mb-0">
                    @foreach ($staff as $s)
                        <li>{{ $s->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm rounded-4 border-0 p-3">
                <h5 class="text-primary fw-bold">Teknisi</h5>
                <ul class="mb-0">
                    @foreach ($teknisi as $t)
                        <li>{{ $t->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- KONTRAK MENUNGGU ACC --}}
    <div class="card shadow-sm rounded-4 border-0 mb-4">
        <div class="card-header bg-warning ">
            Kontrak Menunggu ACC Client
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($accPending as $k)
                <li class="list-group-item">
                    {{ $k->nomor_kontrak }} — {{ $k->client->user->name }}
                </li>
            @endforeach
        </ul>
    </div>

    {{-- AKTIVITAS --}}
    <div class="card shadow-sm rounded-4 border-0 mb-4">
        <div class="card-header bg-light">
            <strong>Aktivitas Terbaru</strong>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($recentActivities as $act)
                <li class="list-group-item">
                    Kontrak <b>{{ $act->nomor_kontrak }}</b> dibuat pada {{ $act->created_at }}
                </li>
            @endforeach
        </ul>
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
                    tension: 0.3
                }]
            }
        });
    </script>
@endpush
