@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" >
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
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

        <div class="card shadow mb-4" style="font-size: 11px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Tambah Pembina</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pembina.store') }}" method="POST">
                    @csrf
                    <div class="container-md">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" style="font-size: 11px;" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kwartir_cabang">Kwartir Cabang</label>
                            <input type="text" class="form-control @error('kwartir_cabang') is-invalid @enderror" id="kwartir_cabang" name="kwartir_cabang" value="{{ old('kwartir_cabang') }}" style="font-size: 11px;" required>
                            @error('kwartir_cabang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pangkalan">Pangkalan</label>
                            <input type="text" class="form-control @error('pangkalan') is-invalid @enderror" id="pangkalan" name="pangkalan" value="{{ old('pangkalan') }}" style="font-size: 11px;" required>
                            @error('pangkalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_gudep">Nama Gudep</label>
                            <input type="text" class="form-control @error('nama_gudep') is-invalid @enderror" id="nama_gudep" name="nama_gudep" value="{{ old('nama_gudep') }}" style="font-size: 11px;" required>
                            @error('nama_gudep')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" style="font-size: 11px;" required>
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" style="font-size: 11px;" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" style="font-size: 11px;" required>
                            @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                                <i class="fas fa-save"></i>
                            </button>                            
                            <a href="{{ route('admin.pembina.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
