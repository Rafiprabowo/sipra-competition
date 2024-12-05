@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-8 mx-auto">
        <h1 class="h3 mb-4 text-gray-800">Edit Peserta</h1>
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif

        <!-- Notifikasi peringatan untuk perubahan NISN -->
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-circle"></i> <strong>Perhatian!</strong>
            Mengubah NISN akan merubah username yang ada pada data pengguna.
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Form Edit Peserta</h6></div>
            <div class="card-body">
                <form action="{{ route('data-peserta.update', $peserta->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Data Peserta -->
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn', $peserta->nisn) }}" required>
                        @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $peserta->nama) }}" required>
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pangkalan">Pangkalan</label>
                        <input type="text" class="form-control @error('pangkalan') is-invalid @enderror" id="pangkalan" name="pangkalan" value="{{ old('pangkalan', $peserta->pangkalan) }}" required>
                        @error('pangkalan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="regu">Regu</label>
                        <input type="text" class="form-control @error('regu') is-invalid @enderror" id="regu" name="regu" value="{{ old('regu', $peserta->regu) }}" required>
                        @error('regu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="laki-laki" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mata Lomba -->
                    <div class="form-group mt-4">
                        <label for="mata_lomba_id">Mata Lomba</label>
                        <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" required>
                            <option value="" selected>Pilih Mata Lomba</option>
                            @foreach ($mataLombas as $mataLomba)
                                <option value="{{ $mataLomba->id }}" {{ old('mata_lomba_id', $peserta->mata_lomba_id) == $mataLomba->id ? 'selected' : '' }}>
                                    {{ $mataLomba->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mata_lomba_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-start mt-5">
                        <button type="submit" class="btn btn-primary mr-3">Update Peserta</button>
                        <a href="{{ route('data-peserta.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
