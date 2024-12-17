@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4" style="font-size: 11px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Detail Pembina</h6>
            </div>
            <div class="card-body">
                <div class="container-md">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $pembina->nama }}" style="font-size: 11px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kwartir_cabang">Kwartir Cabang</label>
                        <input type="text" class="form-control" id="kwartir_cabang" name="kwartir_cabang" value="{{ $pembina->kwartir_cabang }}" style="font-size: 11px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pangkalan">Pangkalan</label>
                        <input type="text" class="form-control" id="pangkalan" name="pangkalan" value="{{ $pembina->pangkalan }}" style="font-size: 11px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_gudep">Nama Gudep</label>
                        <input type="text" class="form-control" id="nama_gudep" name="nama_gudep" value="{{ $pembina->nama_gudep }}" style="font-size: 11px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pembina->tanggal_lahir }}" style="font-size: 11px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ $pembina->jenis_kelamin }}" style="font-size: 11px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pembina->no_hp }}" style="font-size: 11px;" readonly>
                    </div>
                    <!-- Tambahan Navigasi Kembali -->
                    <a href="{{ route('admin.pembina.index') }}" class="btn btn-secondary mt-3" style="font-size: 11px;" title="Kembali">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
