@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3>Tambah Template Dokumen</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Dokumen</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                               placeholder="Masukkan nama dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe Dokumen</label>
                        <input type="text" class="form-control" id="tipe" name="tipe"
                               placeholder="Masukkan tipe dokumen">
                    </div>
                    <div class="form-group">
                        <label for="template">Template Dokumen</label>
                        <input type="file" class="form-control-file" id="template" name="template"
                               accept=".doc, .docx, .pdf">
                        <small class="form-text text-muted">Unggah template dokumen dalam format .doc, .docx,
                            .pdf, atau .jpg, .jpeg, .png</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
