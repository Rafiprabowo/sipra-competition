@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
<div class="container" style="font-size: 11px;">
    <h1 style="font-size: 11px;">Edit Finalisasi</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('finalisasi.update', $finalisasi->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Adding method directive for PUT request -->

        <!-- Pembina Details -->
        <div class="form-group">
            <label for="pembina_nama">Nama Pembina</label>
            <input type="text" class="form-control" id="pembina_nama" style="font-size: 11px;" value="{{ $finalisasi->pembina->nama }}" disabled>
        </div>
        <div class="form-group">
            <label for="pembina_pangkalan">Pangkalan</label>
            <input type="text" class="form-control" id="pembina_pangkalan" style="font-size: 11px;" value="{{ $finalisasi->pembina->pangkalan }}" disabled>
        </div>

        <!-- Upload Dokumen Details -->
        <h3 style="font-size: 11px;">Dokumen</h3>
        @foreach($finalisasi->pembina->upload_dokumen as $uploadDokumen)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 11px;">{{ $uploadDokumen->template_dokumen->nama ?? 'Template Tidak Ditemukan' }}</h5>
                    <p class="card-text"><strong>File:</strong> <a href="{{ route('viewFile', basename($uploadDokumen->file)) }}" target="_blank" class="text-info"><i class="fas fa-eye"></i> Lihat</a></p>
                    <div class="form-group">
                        <label for="dokumen_status_{{ $uploadDokumen->id }}">Status</label>
                        <select name="dokumen_status[{{ $uploadDokumen->id }}]" class="form-control" style="font-size: 11px;">
                            <option value="1" {{ $uploadDokumen->status == 1 ? 'selected' : '' }}>Disetujui</option>
                            <option value="0" {{ $uploadDokumen->status == 0 ? 'selected' : '' }}>Ditolak</option>
                            <option value="" {{ is_null($uploadDokumen->status) ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dokumen_keterangan_{{ $uploadDokumen->id }}">Keterangan</label>
                        <textarea name="dokumen_keterangan[{{ $uploadDokumen->id }}]" class="form-control" style="font-size: 11px;">{{ $uploadDokumen->keterangan }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Finalisasi Details -->
        <div class="form-group">
            <label for="status">Status Finalisasi</label>
            <select name="status" id="status" class="form-control" style="font-size: 11px;">
                <option value="1" {{ $finalisasi->status == 1 ? 'selected' : '' }}>Lolos Verifikasi</option>
                <option value="0" {{ $finalisasi->status == 0 ? 'selected' : '' }}>Tidak Lolos Verifikasi</option>
                <option value="" {{ is_null($finalisasi->status) ? 'selected' : '' }}>Menunggu Verifikasi</option>
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan Finalisasi</label>
            <textarea name="keterangan" id="keterangan" class="form-control" style="font-size: 11px;">{{ $finalisasi->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mr-2" style="font-size: 11px;" title="Update">
            <i class="fas fa-sync-alt"></i>
        </button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ml-2" title="Kembali" style="font-size: 11px;">
            <i class="fas fa-arrow-left"></i>
        </a>
    </form>
</div>
@endsection
