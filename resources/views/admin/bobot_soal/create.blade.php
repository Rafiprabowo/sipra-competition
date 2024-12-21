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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Tambah Bobot Soal</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bobot-soal.storeTemporary') }}" method="POST">
                    @csrf
                    <div class="container-md">
                        <!-- Input Nama -->
                        <div class="form-group">
                            <label for="mata_lomba_id">Nama Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" style="font-size: 11px;" required>
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
                            <input type="text" class="form-control @error('kriteria_nilai') is-invalid @enderror" id="kriteria_nilai" name="kriteria_nilai" value="{{ old('kriteria_nilai') }}" style="font-size: 11px;" required>
                            @error('kriteria_nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="bobot_soal">Bobot Soal</label>
                            <input type="number" class="form-control @error('bobot_soal') is-invalid @enderror" id="bobot_soal" name="bobot_soal" value="{{ old('bobot_soal') }}" style="font-size: 11px;" required>
                            @error('bobot_soal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                        

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Save Sementara">
                                <i class="fas fa-save"></i>
                            </button> 
                            <a href="{{ route('admin.bobot-soal.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (!empty($temporaryData))
            <div class="card shadow mb-4" style="font-size: 11px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Lihat Form Tambah Bobot</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="font-size: 11px;">
                        <thead>
                            <tr>
                                <th>Nama Mata Lomba</th>
                                <th>Kriteria Nilai</th>
                                <th>Bobot</th>
                                {{-- <th>Total Bobot</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temporaryData as $index => $data)
                                <tr>
                                    <td>{{ $mata_lomba->firstWhere('id', $data['mata_lomba_id'])->nama ?? 'N/A' }}</td>
                                    <td>{{ $data['kriteria_nilai'] }}</td>
                                    <td>{{ $data['bobot_soal'] }}</td>
                                    {{-- <td>{{ $data['total_bobot'] ?? 'N/A' }}</td> --}}
                                    <td>
                                        <form action="{{ route('admin.bobot-soal.removeTemporary', $index) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="font-size: 11px;" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"><strong>Total Bobot</strong></td>
                                <td colspan="2">{{ array_sum(array_column($temporaryData, 'bobot_soal')) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <form action="{{ route('admin.bobot-soal.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" style="font-size: 11px;" title="Simpan Database">
                            <i class="fas fa-save"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
