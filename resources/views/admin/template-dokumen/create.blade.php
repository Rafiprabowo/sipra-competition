@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid mt-4" style="font-size: 11px;">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 style="font-size: 11px;">Tambah Template Dokumen</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Dokumen</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                               placeholder="Masukkan nama dokumen" style="font-size: 11px;">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe Dokumen</label>
                        <input type="text" class="form-control" id="tipe" name="tipe"
                               placeholder="Masukkan tipe dokumen" style="font-size: 11px;">
                    </div>
                    <div class="form-group">
                        <label for="template">Template Dokumen</label>
                        <input type="file" class="form-control-file" id="template" name="template"
                               accept=".docx, .pdf, .jpg, .jpeg, .png" style="font-size: 11px;">
                        <small class="form-text text-muted">Unggah template dokumen dalam format
                            .pdf, atau .jpg, .jpeg, .png</small>
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                            <i class="fas fa-save"></i>
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
