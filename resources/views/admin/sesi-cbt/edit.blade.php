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
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Sesi Computer Based Test</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('sesi-cbt.update', $session->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="mata_lomba_id">Lomba Computer Based Test</label>
                        <select class="form-control" name="mata_lomba_id" id="mata_lomba_id" required>
                            <option value="">--Pilih--</option>
                            @foreach ($mataLombas as $item)
                                <option value="{{ $item->id }}" @if($item->id == $session->mata_lomba_id) selected @endif>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('mata_lomba_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Sesi</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $session->nama }}" required>
                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" id="waktu_mulai" name="waktu_mulai" value="{{ \Carbon\Carbon::parse($session->waktu_mulai)->format('H:i') }}" required>
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
                            <input type="text" class="form-control timepicker" id="waktu_selesai" name="waktu_selesai" value="{{ \Carbon\Carbon::parse($session->waktu_selesai)->format('H:i') }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                            </div>
                        </div>
                        @error('waktu_selesai')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="{{ \App\Enums\StatusSesiCbt::Draft->value }}" @if($session->status == \App\Enums\StatusSesiCbt::Draft->value) selected @endif>Ditutup</option>
                            <option value="{{ \App\Enums\StatusSesiCbt::Active->value }}" @if($session->status == \App\Enums\StatusSesiCbt::Active->value) selected @endif>Dibuka</option>
                            <option value="{{ \App\Enums\StatusSesiCbt::Completed->value }}" @if($session->status == \App\Enums\StatusSesiCbt::Completed->value) selected @endif>Selesai</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex ">
                        <a href="{{ route('sesi-cbt.index') }}" class="btn btn-secondary mr-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync-alt"></i> Update
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
            format: 'H:i'
        });
        $('#waktu_selesai').pickatime({
            format: 'H:i'
        });
    });
</script>

@endsection
