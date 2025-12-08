@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow">

        <h4 class="mb-4">Tambah Kontrak</h4>

        <form action="{{ route('admin.contract.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Client</label>
                    <select name="client_id" class="form-control" required>
                        <option value="">-- Pilih Client --</option>
                        @foreach ($clients as $c)
                            <option value="{{ $c->id }}">
                                {{ $c->user->name }} - {{ $c->nama_usaha }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Staff Penanggung Jawab</label>
                    <select name="staff_id" class="form-control" required>
                        <option value="">-- Pilih Staff --</option>
                        @foreach ($staffList as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Produk / Layanan</label>
                    <select name="produk_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($products as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tipe Kontrak</label>
                    <select name="tipe_kontrak" id="tipe_kontrak" class="form-control" required>
                        <option value="langganan">Langganan</option>
                        <option value="satu_kali">Satu Kali</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3" id="periode_tagihan_group">
                    <label>Periode Tagihan</label>
                    <select name="periode_tagihan" id="periode_tagihan" class="form-control">
                        <option value="">-- Pilih Periode --</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal Berakhir</label>
                    <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Harga Layanan</label>
                    <input type="number" name="harga_layanan" class="form-control" min="0" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Upload File Kontrak (PDF/DOC/DOCX)</label>
                    <input type="file" name="file_kontrak" class="form-control" accept=".pdf,.doc,.docx">
                </div>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.contract.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>

                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Simpan
                </button>
            </div>

        </form>
    </div>

    <script>
        const tipeKontrak = document.getElementById('tipe_kontrak');
        const periodeGroup = document.getElementById('periode_tagihan_group');
        const periode = document.getElementById('periode_tagihan');
        const mulai = document.getElementById('tanggal_mulai');
        const berakhir = document.getElementById('tanggal_berakhir');

        function updateFields() {
            if (tipeKontrak.value === 'satu_kali') {
                periodeGroup.style.display = 'none';
                berakhir.removeAttribute('disabled');
                berakhir.value = '';
            } else {
                periodeGroup.style.display = 'block';
                berakhir.setAttribute('disabled', true);
                generateEndDate();
            }
        }

        function generateEndDate() {
            if (!mulai.value) return;
            if (!periode.value) return;

            let start = new Date(mulai.value);
            if (periode.value === 'bulanan') {
                start.setMonth(start.getMonth() + 1);
            }
            if (periode.value === 'tahunan') {
                start.setFullYear(start.getFullYear() + 1);
            }

            let d = start.toISOString().split('T')[0];
            berakhir.value = d;
        }

        tipeKontrak.addEventListener('change', updateFields);
        periode.addEventListener('change', generateEndDate);
        mulai.addEventListener('change', generateEndDate);

        updateFields();
    </script>
@endsection
