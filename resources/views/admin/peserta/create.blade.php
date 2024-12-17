@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-8">
        <h1 class="h3 mb-4 text-gray-800">Tambah Peserta</h1>
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4" style="font-size: 11px;">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Form Tambah Peserta</h6></div>
            <div class="card-body">
                <form action="{{ route('admin.peserta.store') }}" method="POST"> @csrf
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="pangkalan">Pangkalan</label>
                        <input type="text" class="form-control" id="pangkalan" name="pangkalan" required>
                    </div>
                    <div class="form-group">
                        <label for="regu">Regu</label>
                        <input type="text" class="form-control" id="regu" name="regu" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select
                            class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-start mt-5">
                        <button type="submit" class="btn btn-primary">Tambah Peserta</button>
                        <a href="{{ route('admin.peserta.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
