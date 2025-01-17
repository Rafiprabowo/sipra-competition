@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('simulasi-soal-sms.index') }}">SMS Questions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pertanyaan SMS</li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 style="font-size: 11px;">Edit Pertanyaan SMS</h5>
                <a href="{{ route('simulasi-soal-sms.index') }}" class="btn btn-secondary btn-sm" title="Back to List">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('simulasi-soal-sms.update', $simulasiSmsQuestion->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Jenis Simulasi soal -->
                    <div class="form-group">
                        <label for="type">Jenis</label>
                        <select name="type" id="type" class="form-control form-control-sm" required>
                            <option value="{{ \App\Enums\QuestionType::SEMAPHORE->value }}" 
                                    {{ old('type', $simulasiSmsQuestion->type) == \App\Enums\QuestionType::SEMAPHORE->value ? 'selected' : '' }}>
                                Semaphore
                            </option>
                            <option value="{{ \App\Enums\QuestionType::MORSE->value }}" 
                                    {{ old('type', $simulasiSmsQuestion->type) == \App\Enums\QuestionType::MORSE->value ? 'selected' : '' }}>
                                Morse
                            </option>
                        </select>
                        @error('type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kata -->
                    <div class="form-group">
                        <label for="word">Kata</label>
                        <input type="text" name="word" id="word" class="form-control form-control-sm" 
                               value="{{ old('word', $simulasiSmsQuestion->word) }}" required>
                        @error('word')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tingkat Kesulitan -->
                    <div class="form-group">
                        <label for="difficulty">Tingkat Kesulitan</label>
                        <select name="difficulty" id="difficulty" class="form-control form-control-sm" required>
                            <option value="mudah" {{ old('difficulty', $simulasiSmsQuestion->difficulty) == 'mudah' ? 'selected' : '' }}>Mudah</option>
                            <option value="sulit" {{ old('difficulty', $simulasiSmsQuestion->difficulty) == 'sulit' ? 'selected' : '' }}>Sulit</option>
                        </select>
                        @error('difficulty')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm" style="font-size: 11px;">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
