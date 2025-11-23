@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        {{-- Cards --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Total Users</h6>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Clients</h6>
                <h3>{{ $totalClients }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Produk / Layanan</h6>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Total Kontrak</h6>
                <h3>{{ $totalContracts }}</h3>
            </div>
        </div>
    </div>

    <hr>

    {{-- KONTRAK STATUS BOX --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 bg-success text-white">
                <h6>Kontrak Aktif</h6>
                <h3>{{ $kontrakAktif }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 bg-warning text-white">
                <h6>Kontrak Menunggu ACC</h6>
                <h3>{{ $kontrakMenunggu }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 bg-danger text-white">
                <h6>Kontrak Kedaluwarsa</h6>
                <h3>{{ $kontrakExpired }}</h3>
            </div>
        </div>
    </div>

    <hr>

    {{-- KONTRAK HAMPIR EXPIRED --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-danger text-white">
            <strong>Kontrak Hampir Kedaluwarsa (7 Hari Lagi)</strong>
        </div>
        <ul class="list-group list-group-flush">
            @forelse ($hampirExpired as $k)
                <li class="list-group-item">
                    {{ $k->nomor_kontrak }} —
                    {{ $k->client->user->name }}
                    <span class="badge bg-danger float-end">{{ $k->tanggal_berakhir }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">Tidak ada kontrak yang hampir kedaluwarsa.</li>
            @endforelse
        </ul>
    </div>

    {{-- GRAFIK --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            Grafik Kontrak Per Bulan
        </div>
        <div class="card-body">
            <canvas id="kontrakChart" height="120"></canvas>
        </div>
    </div>

    {{-- STAFF & TEKNISI --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5>Staff</h5>
                <ul>
                    @foreach ($staff as $s)
                        <li>{{ $s->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5>Teknisi</h5>
                <ul>
                    @foreach ($teknisi as $t)
                        <li>{{ $t->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- KONTRAK MENUNGGU ACC CLIENT --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning">
            <strong>Kontrak Menunggu ACC Client</strong>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($accPending as $k)
                <li class="list-group-item">
                    {{ $k->nomor_kontrak }} — {{ $k->client->user->name }}
                </li>
            @endforeach
        </ul>
    </div>

    {{-- ACTIVITY LOG SEDERHANA --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
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
                    borderWidth: 2
                }]
            }
        });
    </script>
@endpush
