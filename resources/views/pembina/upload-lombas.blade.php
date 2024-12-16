<style>
    .container {
        display: flex;
        justify-content: space-between;
        padding: 20px;
    }
    .left, .right {
        width: 48%;
    }
    .table-container, .form-container {
        margin-top: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    .download-button {
        background-color: #00bfff;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
    }
    .input-group {
        display: flex;
        align-items: center;
    }
    .input-group-text {
        background-color: #00bfff;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 0 5px 5px 0;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-control, .form-label, .input-group-text {
        width: 100%;
    }
</style>

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

    <div class="container">
        <div class="left">
            <h2>Dokumen Syarat Umum</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Dokumen</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Surat Pernyataan</td>
                            <td><a href="#" class="download-button">Download</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Surat Pernyataan</td>
                            <td><a href="#" class="download-button">Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right">
            <h2>Unggah Dokumen</h2>
            <div class="form-container">
                <form action="{{ route('lomba_foto_vidio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="mata_lomba_id" class="form-label">Pilih Mata Lomba</label>
                        <select class="form-control" id="mata_lomba_id" name="mata_lomba_id" required>
                            <option value="">Pilih Mata Lomba</option>
                            @foreach($mataLombas as $mataLomba)
                                <option value="{{$mataLomba->id}}" data-nama="{{$mataLomba->nama}}">{{$mataLomba->nama}}</option>
                            @endforeach
                        </select>
                        <small id="notification" class="form-text text-muted">Jika memilih Foto, link video boleh dikosongkan. Jika memilih Video, file foto boleh dikosongkan.</small>
                    </div>
                    <div id="upload_foto_div" style="display: none;">
                        <div class="mb-3">
                            <label for="upload_foto" class="form-label">File Foto</label>
                            <input type="file" class="form-control" id="upload_foto" name="upload_foto">
                        </div>
                    </div>
                    <div id="upload_video_div" style="display: none;">
                        <div class="mb-3">
                            <label for="upload_video" class="form-label">Link Video</label>
                            <input type="text" class="form-control" id="upload_video" name="upload_video" placeholder="Masukkan link video">
                        </div>
                    </div>
                    <a href="{{ route('pembina.dashboard') }}" class="btn btn-secondary mr-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
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

<script>
    document.getElementById('mata_lomba_id').addEventListener('change', function () {
        var fotoDiv = document.getElementById('upload_foto_div');
        var videoDiv = document.getElementById('upload_video_div');
        var selectedOption = this.options[this.selectedIndex].getAttribute('data-nama');
        
        if (selectedOption.toLowerCase().includes('foto')) {
            fotoDiv.style.display = 'block';
            videoDiv.style.display = 'none';
        } else if (selectedOption.toLowerCase().includes('video')) {
            fotoDiv.style.display = 'none';
            videoDiv.style.display = 'block';
        } else {
            fotoDiv.style.display = 'none';
            videoDiv.style.display = 'none';
        }
    });
</script>


