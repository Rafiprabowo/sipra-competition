@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">Edit Upload Lomba</div>
        <div class="card-body">
            <form action="{{ route('upload_lombas.update', $uploadLomba->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="upload_poster" class="form-label">Upload Poster</label>
                    <input type="file" class="form-control" id="upload_poster" name="upload_poster">
                    @if ($uploadLomba->upload_poster)
                        <small>Poster saat ini: {{ $uploadLomba->upload_poster }}</small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="upload_video" class="form-label">Link Video</label>
                    <input type="text" class="form-control" id="upload_video" name="upload_video" placeholder="Masukkan link video">
                </div>                
                <div class="mb-3">
                    <label for="peserta_id" class="form-label">Peserta</label>
                    <select class="form-control" id="peserta_id" name="peserta_id" required>
                        @foreach ($pesertas as $peserta)
                            <option value="{{ $peserta->id }}" {{ $uploadLomba->peserta_id == $peserta->id ? 'selected' : '' }}>
                                {{ $peserta->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mata_lomba_id" class="form-label">Mata Lomba</label>
                    <select class="form-control" id="mata_lomba_id" name="mata_lomba_id" required>
                        @foreach ($mataLombas as $mataLomba)
                            <option value="{{ $mataLomba->id }}" {{ $uploadLomba->mata_lomba_id == $mataLomba->id ? 'selected' : '' }}>
                                {{ $mataLomba->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pembina_id" class="form-label">Pangkalan</label>
                    <select class="form-control" id="pembina_id" name="pembina_id" required>
                        @foreach ($pembinas as $pembina)
                            <option value="{{ $pembina->id }}" {{ $uploadLomba->pembina_id == $pembina->id ? 'selected' : '' }}>
                                {{ $pembina->pangkalan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="regu_pembina_id" class="form-label">Regu</label>
                    <select class="form-control" id="regu_pembina_id" name="regu_pembina_id" required>
                        @foreach ($reguPembinas as $regu_pembina)
                            <option value="{{ $regu_pembina->id }}" {{ $uploadLomba->regu_pembina_id == $regu_pembina_id->id ? 'selected' : '' }}>
                                {{ $regu_pembina->nama_regu }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection
