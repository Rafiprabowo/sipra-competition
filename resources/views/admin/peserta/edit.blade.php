@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-10 mx-auto mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Peserta</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.peserta.update', $peserta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
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
                            <input type="text" class="form-control @error('pangkalan') is-invalid @enderror" id="pangkalan" name="pangkalan" value="{{ old('pangkalan', $peserta->regu_pembina->pembina->pangkalan) }}" required>
                            @error('pangkalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="regu">Regu</label>
                            <input type="text" class="form-control @error('regu') is-invalid @enderror" id="regu" name="regu" value="{{ old('regu', $peserta->regu_pembina->nama_regu) }}" required>
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
                        <div class="form-group">
                            <label for="mata_lomba_id">Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id">
                                <option value="">-- Pilih Mata Lomba --</option>
                                @foreach ($mata_lomba as $lomba)
                                    <option value="{{ $lomba->id }}"
                                        {{ old('mata_lomba_id', $peserta->mata_lomba_id) == $lomba->id ? 'selected' : '' }}>
                                        {{ $lomba->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_lomba_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-start mt-5">
                            <button type="submit" class="btn btn-primary mr-3">Update Peserta</button>
                            <a href="{{ route('admin.peserta.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
