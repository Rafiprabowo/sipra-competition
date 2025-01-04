@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Penilaian Vidio</h2>
    <!-- Form Edit Penilaian -->
    <form action="{{ route('penilaian-vidio.update', $penilaian->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Peserta -->
        <div class="mb-4">
            <label class="form-label">Pembina</label>
            <input type="text" class="form-control" value="{{ $penilaian->pembina->nama }}" readonly>
        </div>

        <!-- Daftar kriteria nilai -->
        <h5 class="mt-4">Kriteria Nilai</h5>
        <div id="kriteria-container">
            @foreach($penilaian->nilai as $nilai)
            <div class="row align-items-center mb-3">
                <div class="col-md-4">
                    <label class="form-label">{{ $nilai->bobot_soal->kriteria_nilai }}</label>
                    <span>Nilai (0 - {{ $nilai->bobot_soal->bobot_soal }})</span>
                </div>
                <div class="col-md-3">
                    <input 
                        type="number" 
                        name="nilai[{{ $nilai->bobotSoal->id }}]" 
                        class="form-control" 
                        value="{{ $nilai->nilai ?? 0 }}" 
                        required 
                        min="0" 
                        max="{{ $nilai->bobotSoal->bobot_soal }}">
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol Submit -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
