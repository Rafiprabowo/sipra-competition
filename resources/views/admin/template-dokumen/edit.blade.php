@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Edit Template Dokumen</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Dokumen</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                               value="{{ old('nama', $dokumen->nama) }}" placeholder="Masukkan nama dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe Dokumen</label>
                        <input type="text" class="form-control" id="tipe" name="tipe"
                               value="{{ old('tipe', $dokumen->tipe) }}" placeholder="Masukkan tipe dokumen">
                    </div>
                    <div class="form-group">
                        <label for="template">Template Dokumen</label>
                        <input type="file" class="form-control-file" id="template" name="template"
                               accept=".doc, .docx, .pdf">
                        <small class="form-text text-muted">Unggah template dokumen dalam format .doc, .docx, atau .pdf.
                            Kosongkan jika tidak ingin mengubah template.</small>
                    </div>
                    <div class="d-flex justify-content-start mt-5">
                        <button type="submit" class="btn btn-primary mr-3">Update Dokumen</button>
                        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
