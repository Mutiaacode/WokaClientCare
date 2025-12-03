@extends('layouts.app')

@section('title', 'Tambah Invoices - Admin') 

@section('content')
    <div class="card p-4 shadow">

        <h4 class="mb-4">Buat Invoice</h4>

        <form action="{{ route('admin.invoices.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kontrak</label>
                <select name="contract_id" class="form-control" required>
                    <option value="">-- Pilih Kontrak --</option>
                    @foreach ($contracts as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->nomor_kontrak }} - {{ $c->client->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Diskon</label>
                    <input type="number" name="diskon" class="form-control" value="0" min="0">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Pajak</label>
                    <input type="number" name="pajak" class="form-control" value="0" min="0">
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.invoices.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>

                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Simpan
                </button>
            </div>

        </form>

    </div>
@endsection
