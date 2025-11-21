@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row mb-4">
  {{-- Dashboard cards --}}
  <div class="col-md-3 mb-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <i class="ti ti-users fs-3"></i>
        <div class="text-end">
          <h3 class="mb-0">120</h3>
          <span class="text-muted">Users</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <i class="ti ti-file fs-3"></i>
        <div class="text-end">
          <h3 class="mb-0">45</h3>
          <span class="text-muted">Pages</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <i class="ti ti-activity fs-3"></i>
        <div class="text-end">
          <h3 class="mb-0">80</h3>
          <span class="text-muted">Orders</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <i class="ti ti-wallet fs-3"></i>
        <div class="text-end">
          <h3 class="mb-0">$500</h3>
          <span class="text-muted">Revenue</span>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Example table --}}
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="card-title">Recent Activities</h5>
    <div class="table-responsive">
      <table class="table table-striped mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>John Doe</td>
            <td><span class="badge bg-success">Active</span></td>
            <td>2025-11-21</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td><span class="badge bg-warning">Pending</span></td>
            <td>2025-11-20</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Robert Brown</td>
            <td><span class="badge bg-danger">Suspended</span></td>
            <td>2025-11-19</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Chart placeholder --}}
<div class="row mt-4">
  <div class="col-md-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Revenue Chart</h5>
        <div id="revenue-chart" style="height: 350px;"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  var options = {
    chart: { type: 'line', height: 350 },
    series: [{ name: 'Revenue', data: [100,200,150,300,250,400,350] }],
    xaxis: { categories: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] }
  };
  var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
  chart.render();
</script>
@endpush
