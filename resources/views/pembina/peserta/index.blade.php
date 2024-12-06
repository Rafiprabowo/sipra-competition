@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection

@section('content')
    <div class="col-sm-10 mx-auto mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
                <div class="d-flex align-items-center">
                    <form action="{{ route('peserta.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block mr-3 ">
                        @csrf
                        <div class="form-group mb-2 d-flex align-items-center">
                            <label for="file" class="sr-only">Pilih File Excel:</label>
                            <input type="file" name="file" id="file" class="form-control-file" style="display: none;" required>
                            <label for="file" class="btn btn-secondary mb-0 mr-2">
                                <i class="fas fa-file-upload"></i> Choose File
                            </label>
                            <button type="submit" class="btn btn-primary mb-0 ml-2">
                                <i class="fas fa-file-import"></i> Import
                            </button>
                        </div>
                    </form>
                    <a href="{{route('data-peserta.create')}}" class="btn btn-primary btn-md mb-2" style="width: 150px;">Tambah Peserta</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nisn</th>
                            <th>Nama</th>
                            <th>Pangkalan</th>
                            <th>Regu</th>
                            <th>Jenis Kelamin</th>
                            <th>Mata Lomba</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($peserta as $index => $value)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$value->nisn}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->pangkalan}}</td>
                                <td>{{$value->regu}}</td>
                                <td>{{$value->jenis_kelamin}}</td>
                                <td>{{$value->mata_lomba->nama}}</td>
                                <td>
                                    <a href="{{route('data-peserta.show', $value->id)}}" class="btn btn-info btn-sm" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('data-peserta.edit', $value->id)}}" class="btn btn-warning btn-sm mx-3" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('data-peserta.destroy', $value->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8" class="text-center">
                                <i class="fas fa-info-circle text-warning"></i> <strong>Pemberitahuan:</strong> Peserta login menggunakan username (NISN) dan password yang otomatis dibuat berdasarkan NISN. Pastikan untuk menjaga kerahasiaan data login Anda.
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
