@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
    <div class="col-sm-10 mx-auto mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Penilaian Karikatur</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('penilaian-karikatur.store') }}" method="POST">
                    @csrf

                    @if($mata_lomba)
                        <input type="hidden" name="mata_lomba_id" value="{{ $mata_lomba->id }}">
                    @else
                        <p>Mata lomba "karikatur" tidak ditemukan.</p>
                    @endif

                    <input type="hidden" name="juri_id" value="{{ $juris->id }}">

                    <div class="form-group">
                        <label for="peserta_id">Peserta</label>
                        <select class="form-control" id="peserta_id" name="peserta_id" required>
                            <option value="">Pilih Peserta</option>
                            @foreach($pesertas as $peserta)
                                <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="orisinalitas">Orisinalitas (0 - 30)</label>
                        <input type="number" class="form-control" id="orisinalitas" name="orisinalitas" min="0" max="30" required>
                        <small class="text-muted">Skala: 0 - 30</small>
                    </div>

                    <div class="form-group">
                        <label for="kesesuaian_tema">Kesesuaian Tema (0 - 25)</label>
                        <input type="number" class="form-control" id="kesesuaian_tema" name="kesesuaian_tema" min="0" max="25" required>
                        <small class="text-muted">Skala: 0 - 25</small>
                    </div>

                    <div class="form-group">
                        <label for="kreativitas">Kreativitas (0 - 20)</label>
                        <input type="number" class="form-control" id="kreativitas" name="kreativitas" min="0" max="20" required>
                        <small class="text-muted">Skala: 0 - 20</small>
                    </div>

                    <div class="form-group">
                        <label for="pesan_yang_disampaikan">Pesan yang Disampaikan (0 - 15)</label>
                        <input type="number" class="form-control" id="pesan_yang_disampaikan" name="pesan_yang_disampaikan" min="0" max="15" required>
                        <small class="text-muted">Skala: 0 - 15</small>
                    </div>

                    <div class="form-group">
                        <label for="teknik">Teknik (0 - 10)</label>
                        <input type="number" class="form-control" id="teknik" name="teknik" min="0" max="10" required>
                        <small class="text-muted">Skala: 0 - 10</small>
                    </div>

                    <button type="submit" class="btn btn-success">Kirim Penilaian</button>
                </form>
            </div>
        </div>
    </div>
@endsection
