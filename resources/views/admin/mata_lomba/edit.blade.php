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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Edit Mata Lomba</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mata-lomba.update', $mataLomba->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
                        <!-- Input Nama -->
                        <div class="form-group">
                            <label for="nama">Nama Mata Lomba</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mataLomba->nama) }}" style="font-size: 11px;" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">--Pilih Kategori--</option>
                                <option value="cbt" {{($mataLomba->kategori == 'cbt') ? 'selected' : ''}}>Computer Based Test</option>
                                <option value="non-cbt" {{($mataLomba->kategori == 'non-cbt') ? 'selected' : ''}}>Non Computer Based Test</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', $mataLomba->jumlah_peserta) }}" style="font-size: 11px;" required>
                            @error('jumlah_peserta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group"> 
                            <label for="ditujukan">Ditujukan</label> 
                            <select class="form-control @error('ditujukan') is-invalid @enderror" id="ditujukan" name="ditujukan" style="font-size: 11px;" required> 
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
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" style="font-size: 11px;" required>{{ old('deskripsi', $mataLomba->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary mr-2" style="font-size: 11px;" title="Update">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <a href="{{ route('admin.mata-lomba.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
