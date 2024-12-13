@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-2">
        <h1 class="h3 mb-4 text-gray-800">Tambah Bobot Soal</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Bobot Soal</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bobot-soal.store') }}" method="POST">
                    @csrf
                    <div class="container-md">
                        <!-- Input Nama -->
                        <div class="form-group">
                            <label for="mata_lomba_id">Nama Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" required>
                                <option value="">Pilih Mata Lomba</option>
                                @foreach ($mata_lomba as $mataLomba)
                                    <option value="{{ $mataLomba->id }}" {{ old('mata_lomba_id') == $mataLomba->id ? 'selected' : '' }}>{{ $mataLomba->nama }}</option>
                                @endforeach
                            </select>
                            @error('mata_lomba_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="kriteria_nilai">Kriteria Nilai</label>
                            <input type="text" class="form-control @error('kriteria_nilai') is-invalid @enderror" id="kriteria_nilai" name="kriteria_nilai" value="{{ old('kriteria_nilai') }}" required>
                            @error('kriteria_nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="bobot_soal">Bobot Soal</label>
                            <input type="number" class="form-control @error('bobot_soal') is-invalid @enderror" id="bobot_soal" name="bobot_soal" value="{{ old('bobot_soal') }}" required>
                            @error('bobot_soal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                        

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.bobot-soal.index') }}" class="btn btn-secondary mr-3">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">Tambah Bobot Soal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
