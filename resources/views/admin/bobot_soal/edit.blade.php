@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-2">
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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Edit Bobot Soal</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bobot-soal.update', $bobotSoal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
                        <!-- Input Nama Mata Lomba -->
                        <div class="form-group">
                            <label for="mata_lomba_id">Nama Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" style="font-size: 11px;" required>
                                <option value="">Pilih Mata Lomba</option>
                                @foreach ($mata_lomba as $mataLomba)
                                    <option value="{{ $mataLomba->id }}" {{ $bobotSoal->mata_lomba_id == $mataLomba->id ? 'selected' : '' }}>{{ $mataLomba->nama }}</option>
                                @endforeach
                            </select>
                            @error('mata_lomba_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Kriteria Nilai -->
                        <div class="form-group">
                            <label for="kriteria_nilai">Kriteria Nilai</label>
                            <input type="text" class="form-control @error('kriteria_nilai') is-invalid @enderror" id="kriteria_nilai" name="kriteria_nilai" value="{{ old('kriteria_nilai', $bobotSoal->kriteria_nilai) }}" style="font-size: 11px;" required>
                            @error('kriteria_nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Bobot Soal -->
                        <div class="form-group">
                            <label for="bobot_soal">Bobot Soal</label>
                            <input type="number" class="form-control @error('bobot_soal') is-invalid @enderror" id="bobot_soal" name="bobot_soal" value="{{ old('bobot_soal', $bobotSoal->bobot_soal) }}" style="font-size: 11px;" required>
                            @error('bobot_soal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Update">
                                <i class="fas fa-save"></i> Update
                            </button> 
                            <a href="{{ route('admin.bobot-soal.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
