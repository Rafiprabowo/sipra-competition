@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-10 mx-auto mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Peserta</h6>
            </div>
            <div class="card-body">
                <div class="container-md">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $peserta->nisn }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $peserta->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pangkalan">Pangkalan</label>
                        <input type="text" class="form-control" id="pangkalan" name="pangkalan" value="{{ $peserta->regu_pembina->pembina->pangkalan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="regu">Regu</label>
                        <input type="text" class="form-control" id="regu" name="regu" value="{{ $peserta->regu_pembina->nama_regu }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ $peserta->jenis_kelamin }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="mata_lomba">Mata Lomba</label>
                        <input type="text" class="form-control" id="mata_lomba" name="mata_Lomba" value="{{ $peserta->mata_lomba->nama }}" readonly>
                    </div>
                    <!-- Tambahan Navigasi Kembali -->
                    <a href="{{ route('admin.peserta.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
