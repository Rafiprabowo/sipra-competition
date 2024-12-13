@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4">
        <h1 class="h3 mb-4 text-gray-800">Tambah Juri</h1>

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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Juri</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('juri.store') }}" method="POST">
                    @csrf
                    <div class="container-md">
                        <!-- Input Nama Juri -->
                        <div class="form-group">
                            <label for="nama">Nama Juri</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kwartir_cabang">Kwartir Cabang</label>
                            <input type="text" class="form-control @error('kwartir_cabang') is-invalid @enderror" id="kwartir_cabang" name="kwartir_cabang" value="{{ old('kwartir_cabang') }}" required>
                            @error('kwartir_cabang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pangkalan">Pangkalan</label>
                            <input type="text" class="form-control @error('pangkalan') is-invalid @enderror" id="pangkalan" name="pangkalan" value="{{ old('pangkalan') }}" required>
                            @error('pangkalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" required>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilihan Mata Lomba -->
                        <div class="form-group">
                            <label for="mata_lomba_id">Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" required>
                                <option value="" selected>Pilih Mata Lomba</option>
                                @foreach ($mataLombas as $mataLomba)
                                    <option value="{{ $mataLomba->id }}" {{ old('mata_lomba_id') == $mataLomba->id ? 'selected' : '' }}>
                                        {{ $mataLomba->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_lomba_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn btn-primary">Tambah Juri</button>
                            <a href="{{ route('juri.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
