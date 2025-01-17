@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
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
                        <select class="form-control" name="cbt_session_id" id="cbt_session_id" required>
                            <option value="" disabled selected>-- Pilih Sesi CBT --</option>
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
                        <select class="form-control" name="question_type" id="question_type" required>
                            <option value="" disabled selected>-- Pilih Jenis Soal --</option>
                            <option value="{{ \App\Enums\QuestionType::MORSE->value }}">Morse</option>
                            <option value="{{ \App\Enums\QuestionType::SEMAPHORE->value }}">Semaphore</option>
                            <option value="{{ \App\Enums\QuestionType::PK->value }}">Pengetahuan Kepramukaan</option>
                        </select>
                        @error('question_type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_bobot_nilai">Total Bobot Nilai (%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="total_bobot_nilai" id="total_bobot_nilai" value="{{ old('total_bobot_nilai', 0) }}" placeholder="Masukkan bobot nilai (%)">
                        </div>
                        @error('total_bobot_nilai')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Removed the 'question_count' field as it can be derived -->
                    <div class="form-group">
                        <label for="easy_question_count">Jumlah Soal Mudah</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="easy_question_count" id="easy_question_count" value="{{ old('easy_question_count', 0) }}" placeholder="Masukkan jumlah soal mudah">
                        </div>
                        @error('easy_question_count')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hard_question_count">Jumlah Soal Sulit</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="hard_question_count" id="hard_question_count" value="{{ old('hard_question_count', 0) }}" placeholder="Masukkan jumlah soal sulit">
                        </div>
                        @error('hard_question_count')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bobot_nilai_mudah">Bobot Nilai Mudah (%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="bobot_nilai_mudah" id="bobot_nilai_mudah" value="{{ old('bobot_nilai_mudah', 0) }}" placeholder="Masukkan bobot nilai mudah">
                        </div>
                        @error('bobot_nilai_mudah')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bobot_nilai_sulit">Bobot Nilai Sulit (%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="bobot_nilai_sulit" id="bobot_nilai_sulit" value="{{ old('bobot_nilai_sulit', 0) }}" placeholder="Masukkan bobot nilai sulit">
                        </div>
                        @error('bobot_nilai_sulit')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2" title="Reset">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" title="Simpan">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
