@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sms-questions.index') }}">SMS Questions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pertanyaan SMS</li>
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
                <h5 style="font-size: 11px;">Tambah Pertanyaan SMS</h5>
                <a href="{{ route('sms-questions.index') }}" class="btn btn-secondary btn-sm" title="Back to List">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('sms-questions.store') }}" method="POST">
                    @csrf

                      <!-- Sesi CBT -->
                      <div class="form-group">
                        <label for="cbt_session_id">Sesi CBT</label>
                        <select name="cbt_session_id" id="cbt_session_id" class="form-control form-control-sm">
                            <option value="">Pilih Sesi CBT </option>
                            @foreach($cbtSessions as $cbtSession)
                                <option value="{{ $cbtSession->id }}" 
                                    {{ old('cbt_session_id') == $cbtSession->id ? 'selected' : '' }}>
                                    {{ $cbtSession->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('cbt_session_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                      <!-- Jenis Soal -->
                      <div class="form-group">
                        <label for="type">Jenis</label>
                        <select name="type" id="type" class="form-control form-control-sm" required>
                            <option value="{{ \App\Enums\QuestionType::SEMAPHORE->value }}" 
                                    {{ old('type') == \App\Enums\QuestionType::SEMAPHORE->value ? 'selected' : '' }}>
                                Semaphore
                            </option>
                            <option value="{{ \App\Enums\QuestionType::MORSE->value }}" 
                                    {{ old('type') == \App\Enums\QuestionType::MORSE->value ? 'selected' : '' }}>
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
                        <input type="text" name="word" id="word" class="form-control form-control-sm" value="{{ old('word') }}" required>
                        @error('word')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                  
                    <!-- Tingkat Kesulitan -->
                    <div class="form-group">
                        <label for="difficulty">Tingkat Kesulitan</label>
                        <select name="difficulty" id="difficulty" class="form-control form-control-sm" required>
                            <option value="mudah" {{ old('difficulty') == 'mudah' ? 'selected' : '' }}>Mudah</option>
                            <option value="sulit" {{ old('difficulty') == 'sulit' ? 'selected' : '' }}>Sulit</option>
                        </select>
                        @error('difficulty')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                  

                    <button type="submit" class="btn btn-primary btn-sm" style="font-size: 11px;">Simpan Pertanyaan SMS</button>
                </form>
            </div>
        </div>
    </div>
@endsection
