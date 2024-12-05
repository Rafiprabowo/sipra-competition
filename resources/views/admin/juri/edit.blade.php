@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-md-6 mx-auto">
        <h1 class="h3 mb-4 text-gray-800">Edit Juri</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Juri</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('juri.update', $juri->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
                        <!-- Input Nama Juri -->
                        <div class="form-group">
                            <label for="nama">Nama Juri</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $juri->nama) }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilihan Mata Lomba -->
                        <div class="form-group">
                            <label for="mata_lomba_id">Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" required>
                                <option value="" disabled>Pilih Mata Lomba</option>
                                @foreach ($mataLombas as $mataLomba)
                                    <option value="{{ $mataLomba->id }}" {{ old('mata_lomba_id', $juri->mata_lomba_id) == $mataLomba->id ? 'selected' : '' }}>
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
                            <a href="{{ route('juri.index') }}" class="btn btn-secondary mr-3">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
