{{-- Blade View: Edit Pertanyaan --}}
@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800" style="font-size: 11px;">Edit Pertanyaan</h1>

        <!-- Card Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Pertanyaan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('sesi-soal.update', ['id' => $tpk_question->id, 'session_id' => $session->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="question_text">Pertanyaan</label>
                        <textarea name="question_text" id="question_text" class="form-control" rows="3" style="font-size: 11px;" required>{{ $tpk_question->question_text }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="question_image">Gambar Pertanyaan</label>
                        <input type="file" name="question_image" id="question_image" class="form-control" style="font-size: 11px;">
                        @if($tpk_question->question_image)
                            <img src="{{ Storage::url($tpk_question->question_image) }}" alt="Question Image" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="answer_a">Opsi A</label>
                        <textarea name="answer_a" id="answer_a" class="form-control" rows="2" style="font-size: 11px;" required>{{ $tpk_question->answer_a }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer_b">Opsi B</label>
                        <textarea name="answer_b" id="answer_b" class="form-control" rows="2" style="font-size: 11px;" required>{{ $tpk_question->answer_b }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer_c">Opsi C</label>
                        <textarea name="answer_c" id="answer_c" class="form-control" rows="2" style="font-size: 11px;" required>{{ $tpk_question->answer_c }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer_d">Opsi D</label>
                        <textarea name="answer_d" id="answer_d" class="form-control" rows="2" style="font-size: 11px;" required>{{ $tpk_question->answer_d }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="correct_answer">Jawaban Benar</label>
                        <select name="correct_answer" id="correct_answer" class="form-control" style="font-size: 11px;" required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="a" @if($tpk_question->correct_answer == 'a') selected @endif>A</option>
                            <option value="b" @if($tpk_question->correct_answer == 'b') selected @endif>B</option>
                            <option value="c" @if($tpk_question->correct_answer == 'c') selected @endif>C</option>
                            <option value="d" @if($tpk_question->correct_answer == 'd') selected @endif>D</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="difficulty">Tingkat Kesulitan</label>
                        <select name="difficulty" id="difficulty" class="form-control" style="font-size: 11px;" required>
                            <option value="">-- Pilih Tingkat Kesulitan --</option>
                            <option value="LOW" @if($tpk_question->difficulty == 'LOW') selected @endif>Mudah</option>
                            <option value="MIDDLE" @if($tpk_question->difficulty == 'MIDDLE') selected @endif>Sulit</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Ubah"></button>
                    <a href="{{ route('sesi-soal.index', $session->id) }}" class="btn btn-secondary" style="font-size: 11px;" title="Batal">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection