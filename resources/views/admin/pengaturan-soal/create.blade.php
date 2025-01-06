@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid">   
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Konfigurasi Soal</h6>
                <a href="{{ route('cbt-session-question-configurations.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('cbt-session-question-configurations.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="cbt_session_id">Sesi CBT</label>
                        <select class="form-control" name="cbt_session_id" id="cbt_session_id" style="font-size: 11px;" required>
                            <option value="">--Pilih Sesi CBT--</option>
                            @foreach ($cbtSessions as $session)
                                <option value="{{ $session->id }}">{{ $session->nama }}</option>
                            @endforeach
                        </select>
                        @error('cbt_session_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="question_type">Jenis Soal</label>
                        <select class="form-control" name="question_type" id="question_type" style="font-size: 11px;" required>
                            <option value="{{ \App\Enums\QuestionType::MORSE->value }}">Morse</option>
                            <option value="{{ \App\Enums\QuestionType::SEMAPHORE->value }}">Semaphore</option>
                            <option value="{{ \App\Enums\QuestionType::PK->value }}">Pengetahuan Kepramukaan</option>
                        </select>
                        @error('question_type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="question_count">Jumlah Soal</label>
                        <input type="number" class="form-control" name="question_count" id="question_count" value="{{ old('question_count') }}" style="font-size: 11px;" required>
                        @error('question_count')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
