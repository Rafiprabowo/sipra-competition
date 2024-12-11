@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
<div class="container">
    <h1>Edit Finalisasi</h1>
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
            <input type="text" class="form-control" id="pembina_nama" value="{{ $finalisasi->pembina->nama }}" disabled>
        </div>
        <div class="form-group">
            <label for="pembina_pangkalan">Pangkalan</label>
            <input type="text" class="form-control" id="pembina_pangkalan" value="{{ $finalisasi->pembina->pangkalan }}" disabled>
        </div>

        <!-- Upload Dokumen Details -->
        <h3>Dokumen</h3>
        @foreach($finalisasi->pembina->upload_dokumen as $uploadDokumen)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $uploadDokumen->template_dokumen->nama ?? 'Template Tidak Ditemukan' }}</h5>
                    <p class="card-text"><strong>File:</strong> <a href="{{ route('viewFile', basename($uploadDokumen->file)) }}" target="_blank" class="text-info"><i class="fas fa-eye"></i> Lihat</a></p>
                    <div class="form-group">
                        <label for="dokumen_status_{{ $uploadDokumen->id }}">Status</label>
                        <select name="dokumen_status[{{ $uploadDokumen->id }}]" class="form-control">
                            <option value="1" {{ $uploadDokumen->status == 1 ? 'selected' : '' }}>Disetujui</option>
                            <option value="0" {{ $uploadDokumen->status == 0 ? 'selected' : '' }}>Ditolak</option>
                            <option value="" {{ is_null($uploadDokumen->status) ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dokumen_keterangan_{{ $uploadDokumen->id }}">Keterangan</label>
                        <textarea name="dokumen_keterangan[{{ $uploadDokumen->id }}]" class="form-control">{{ $uploadDokumen->keterangan }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Finalisasi Details -->
        <div class="form-group">
            <label for="status">Status Finalisasi</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $finalisasi->status == 1 ? 'selected' : '' }}>Lolos Verifikasi</option>
                <option value="0" {{ $finalisasi->status == 0 ? 'selected' : '' }}>Tidak Lolos Verifikasi</option>
                <option value="" {{ is_null($finalisasi->status) ? 'selected' : '' }}>Menunggu Verifikasi</option>
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan Finalisasi</label>
            <textarea name="keterangan" id="keterangan" class="form-control">{{ $finalisasi->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Finalisasi</button>
    </form>
</div>
@endsection
