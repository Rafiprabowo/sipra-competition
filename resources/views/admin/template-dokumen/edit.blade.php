@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid mt-4" style="font-size: 11px;">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 style="font-size: 11px;">Edit Template Dokumen</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Dokumen</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                               value="{{ old('nama', $dokumen->nama) }}" placeholder="Masukkan nama dokumen" style="font-size: 11px;">
                        @error('nama')
                            <div class="invalid-feedback" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe Dokumen</label>
                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe"
                               value="{{ old('tipe', $dokumen->tipe) }}" placeholder="Masukkan tipe dokumen" style="font-size: 11px;">
                        @error('tipe')
                            <div class="invalid-feedback" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="template">Template Dokumen</label>
                        <input type="file" class="form-control-file @error('template') is-invalid @enderror" id="template" name="template"
                               accept=".doc, .docx, .pdf" style="font-size: 11px;">
                        <small class="form-text text-muted">Unggah template dokumen dalam format .doc, .docx, atau .pdf.
                            Kosongkan jika tidak ingin mengubah template.</small>
                        @error('template')
                            <div class="invalid-feedback d-block" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-primary mr-2" style="font-size: 11px;" title="Update">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
