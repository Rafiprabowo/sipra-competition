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
                <li class="breadcrumb-item active" aria-current="page">Edit SMS Question</li>
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
                <h5 style="font-size: 11px;">Edit SMS Question</h5>
                <a href="{{ route('sms-questions.index') }}" class="btn btn-secondary" style="font-size: 11px;" title="Back to List">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('sms-questions.update', $smsQuestion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="word">Word</label>
                        <input type="text" name="word" id="word" class="form-control form-control-sm" value="{{ old('word', $smsQuestion->word) }}" required>
                        @error('word')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control form-control-sm" required>
                            <option value="{{ \App\Enums\SymbolType::Semaphore->value }}" 
                                    {{ old('type', $smsQuestion->type) == \App\Enums\SymbolType::Semaphore->value ? 'selected' : '' }}>
                                Semaphore
                            </option>
                            <option value="{{ \App\Enums\SymbolType::Morse->value }}" 
                                    {{ old('type', $smsQuestion->type) == \App\Enums\SymbolType::Morse->value ? 'selected' : '' }}>
                                Morse
                            </option>
                        </select>
                        @error('type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cbt_session_id">CBT Session</label>
                        <select name="cbt_session_id" id="cbt_session_id" class="form-control form-control-sm">
                            <option value="">Select CBT Session (optional)</option>
                            @foreach($cbtSessions as $cbtSession)
                                <option value="{{ $cbtSession->id }}" 
                                    {{ old('cbt_session_id', $smsQuestion->cbt_session_id) == $cbtSession->id ? 'selected' : '' }}>
                                    {{ $cbtSession->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('cbt_session_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm" style="font-size: 11px;">Update SMS Question</button>
                </form>
            </div>
        </div>
    </div>
@endsection
