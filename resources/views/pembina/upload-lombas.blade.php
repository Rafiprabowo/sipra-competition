@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.pembina')
@endsection

@section('content')
<div class="container-fluid mt-4">
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
        <div class="card-header">Form Upload Lomba</div>
        <div class="card-body">
            <form action="{{ route('lomba_foto_vidio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_pembina" class="form-label">Nama Pembina</label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Pembina</th>
                                <th>Pangkalan</th>
                                <th>Kwartir Cabang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$pembina->nama}}</td>
                                <td>{{$pembina->pangkalan}}</td>
                                <td>{{$pembina->kwartir_cabang}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <label for="mata_lomba_id" class="form-label">Mata Lomba</label>
                    <select class="form-control" id="mata_lomba_id" name="mata_lomba_id" required>
                        <option value="">Pilih Mata Lomba</option>
                        @foreach($mataLombas as $mataLomba)
                            <option value="{{$mataLomba->id}}">{{$mataLomba->nama}}</option>
                        @endforeach
                    </select>
                    <small id="notification" class="form-text text-muted">Jika memilih Foto, link video boleh dikosongkan. Jika memilih Video, file foto boleh dikosongkan.</small>
                </div>
                <div class="mb-3">
                    <label for="upload_foto" class="form-label">File Foto</label>
                    <input type="file" class="form-control" id="upload_foto" name="upload_foto">
                </div>
                <div class="mb-3">
                    <label for="upload_video" class="form-label">Link Video</label>
                    <input type="text" class="form-control" id="upload_video" name="upload_video" placeholder="Masukkan link video">
                </div>
                <a href="{{ route('pembina.dashboard') }}" class="btn btn-secondary mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

     <div class="mt-4" style="font-size: 12px;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Upload Berkas Lomba</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File/Link Video</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pembina->lomba_foto_vidio))
                                @foreach($pembina->lomba_foto_vidio as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ basename($file->file) }}</td>
                                        <td>{{ $file->updated_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('lomba_foto_vidio.showFile', basename($file->file)) }}" class="btn btn-info btn-sm" target="_blank">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <form action="{{ route('lomba_foto_vidio.destroy', $file->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?')">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
