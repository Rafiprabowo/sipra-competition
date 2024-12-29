@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Pertanyaan</h1>

        <!-- Card Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pertanyaan</h6>
            </div>
            <div class="card-body">
                <form action="{{route('soal-tpk.store', $session->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">Pertanyaan</label>
                        <textarea name="question" id="question" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer_a">Opsi A</label>
                        <textarea name="answer_a" id="answer_a" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer_b">Opsi B</label>
                        <textarea name="answer_b" id="answer_b" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer_c">Opsi C</label>
                        <textarea name="answer_c" id="answer_c" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer_d">Opsi D</label>
                        <textarea name="answer_d" id="answer_d" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer_e">Opsi E</label>
                        <textarea name="answer_e" id="answer_e" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="correct_answer">Jawaban Benar</label>
                        <select name="correct_answer" id="correct_answer" class="form-control" required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="difficulty">Tingkat Kesulitan</label>
                        <select for="difficulty" id="difficulty" class="form-control" required>
                            <option value="">--Pilih--Tingkat Kesulitan</option>
                            <option value="{{\App\Enums\Difficulty::Easy->value}}">Mudah</option>
                            <option value="{{\App\Enums\Difficulty::Medium->value}}">Sedang</option>
                            <option value="{{\App\Enums\Difficulty::Hard->value}}">Sulit</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('sesi-soal.index', $session->id) }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
