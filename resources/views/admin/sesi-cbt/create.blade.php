@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('h-script')
    <!-- Pickadate.js CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/compressed/themes/default.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/compressed/themes/default.date.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/compressed/themes/default.time.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container" style="font-size: 11px;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Sesi Computer Based Test</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('sesi-cbt.store') }}" method="POST">
                    @csrf
                
                    <div class="form-group">
                        <label for="nama">Nama Sesi</label>
                        <input type="text" class="form-control" id="nama" name="nama" style="font-size: 11px;" required>
                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="mata_lomba_id">Lomba Computer Based Test</label>
                        <select class="form-control" name="mata_lomba_id" id="mata_lomba_id" style="font-size: 11px;" required>
                            <option value="">--Pilih--</option>
                            @foreach ($mataLombas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('mata_lomba_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" id="waktu_mulai" name="waktu_mulai" style="font-size: 11px;" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                            </div>
                        </div>
                        @error('waktu_mulai')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="waktu_selesai">Waktu Selesai</label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" id="waktu_selesai" name="waktu_selesai" style="font-size: 11px;" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                            </div>
                        </div>
                        @error('waktu_selesai')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                
                
                    <div class="form-group">
                        <label for="jumlah_soal">Jumlah Soal</label>
                        <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal" style="font-size: 11px;" required>
                        @error('jumlah_soal')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" style="font-size: 11px;" required>
                            <option value="{{ \App\Enums\StatusSesiCbt::Draft->value }}">Ditutup</option>
                            <option value="{{ \App\Enums\StatusSesiCbt::Active->value }}">Dibuka</option>
                            <option value="{{ \App\Enums\StatusSesiCbt::Completed->value }}">Selesai</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="kode_akses">Kode Akses (opsional)</label>
                        <input type="text" class="form-control" id="kode_akses" name="kode_akses" style="font-size: 11px;">
                        @error('kode_akses')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="d-flex">
                        <a href="{{ route('sesi-cbt.index') }}" class="btn btn-secondary mr-2" style="font-size: 11px;" title="Kembali">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection

@section('script')
 <!-- jQuery -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <!-- Bootstrap JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
 <!-- Pickadate.js JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/compressed/picker.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/compressed/picker.date.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/compressed/picker.time.js"></script>
 <script>
    $(document).ready(function(){
        $('#waktu_mulai').pickatime({
            format: 'HH:i'
        });
        $('#waktu_selesai').pickatime({
            format: 'HH:i'
        });
    });
 </script>
@endsection
