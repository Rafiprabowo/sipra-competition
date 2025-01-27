{{-- Blade View: Edit Pertanyaan --}}
@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 12px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('simulasi-soal-tpk.index') }}">Bank Soal Simulasi Tes Pengetahuan Kepramukaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Soal</li>
            </ol>
        </nav>
        
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Soal</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('simulasi-soal-tpk.update', $simulasiTpkQuestion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="question_text">Pertanyaan</label>
                        <textarea name="question_text" id="question_text" class="form-control" rows="3" required>{{ $simulasiTpkQuestion->question_text }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="question_image">Gambar Pertanyaan</label>
                        <input type="file" name="question_image" id="question_image" class="form-control">
                        @if($simulasiTpkQuestion->question_image)
                            <img src="{{ Storage::url($simulasiTpkQuestion->question_image) }}" alt="{{ $simulasiTpkQuestion->question_text }}" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="answer_a">Opsi A</label>
                        <textarea name="answer_a" id="answer_a" class="form-control" rows="2" required>{{ $simulasiTpkQuestion->answer_a }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer_b">Opsi B</label>
                        <textarea name="answer_b" id="answer_b" class="form-control" rows="2" required>{{ $simulasiTpkQuestion->answer_b }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer_c">Opsi C</label>
                        <textarea name="answer_c" id="answer_c" class="form-control" rows="2" required>{{ $simulasiTpkQuestion->answer_c }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer_d">Opsi D</label>
                        <textarea name="answer_d" id="answer_d" class="form-control" rows="2" required>{{ $simulasiTpkQuestion->answer_d }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="correct_answer">Jawaban Benar</label>
                        <select name="correct_answer" id="correct_answer" class="form-control" required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="a" @if($simulasiTpkQuestion->correct_answer == 'a') selected @endif>A</option>
                            <option value="b" @if($simulasiTpkQuestion->correct_answer == 'b') selected @endif>B</option>
                            <option value="c" @if($simulasiTpkQuestion->correct_answer == 'c') selected @endif>C</option>
                            <option value="d" @if($simulasiTpkQuestion->correct_answer == 'd') selected @endif>D</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="difficulty">Tingkat Kesulitan</label>
                        <select name="difficulty" id="difficulty" class="form-control" required>
                            <option value="">-- Pilih Tingkat Kesulitan --</option>
                            <option value="LOW" @if($simulasiTpkQuestion->difficulty == 'LOW') selected @endif>Mudah</option>
                            <option value="MIDDLE" @if($simulasiTpkQuestion->difficulty == 'MIDDLE') selected @endif>Sulit</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" title="Ubah">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('soal-tpk.index') }}" class="btn btn-secondary" title="Batal">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip(); // Inisialisasi Tooltip
        });
    </script>
@endsection
