@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-2">
        <h1 class="h3 mb-4 text-gray-800">Edit Mata Lomba</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Mata Lomba</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mata-lomba.update', $mataLomba->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
                        <!-- Input Nama -->
                        <div class="form-group">
                            <label for="nama">Nama Mata Lomba</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mataLomba->nama) }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', $mataLomba->jumlah_peserta) }}" required>
                            @error('jumlah_peserta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group"> 
                            <label for="ditujukan">Ditujukan</label> 
                            <select class="form-control @error('ditujukan') is-invalid @enderror" id="ditujukan" name="ditujukan" required> 
                                <option value="0" {{ old('ditujukan', $mataLomba->ditujukan) == '0' ? 'selected' : '' }}>Peserta</option> 
                                <option value="1" {{ old('ditujukan', $mataLomba->ditujukan) == '1' ? 'selected' : '' }}>Pembina</option> 
                            </select> 
                            @error('ditujukan') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror 
                        </div>

                        <!-- Input Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $mataLomba->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.mata-lomba.index') }}" class="btn btn-secondary mr-3">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">Update Mata Lomba</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
