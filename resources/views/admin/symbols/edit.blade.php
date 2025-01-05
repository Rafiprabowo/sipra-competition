@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('symbols.index') }}">Simbol</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Simbol</li>
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
                <h5 style="font-size: 11px;">Edit Simbol</h5>
                <a href="{{ route('symbols.index') }}" class="btn btn-secondary" style="font-size: 11px;" title="Back to List">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('symbols.update', $symbol->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="letter">Huruf</label>
                        <input type="text" name="letter" id="letter" class="form-control form-control-sm" value="{{ old('letter', strtoupper($symbol->letter)) }}" maxlength="1" required>
                        @error('letter')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Jenis</label>
                        <select name="type" id="type" class="form-control form-control-sm" required>
                            <option value="{{ \App\Enums\SymbolType::Semaphore->value }}" 
                                    {{ old('type', $symbol->type ?? '') == \App\Enums\SymbolType::Semaphore->value ? 'selected' : '' }}>
                                Semaphore
                            </option>
                            <option value="{{ \App\Enums\SymbolType::Morse->value }}" 
                                    {{ old('type', $symbol->type ?? '') == \App\Enums\SymbolType::Morse->value ? 'selected' : '' }}>
                                Morse
                            </option>
                        </select>                        
                        @error('type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Huruf</label>
                        <input type="file" name="image" id="image" class="form-control form-control-sm" accept="image/*">
                        <small>Current Image: 
                            @if ($symbol->image)
                                <img src="{{ asset('storage/'.$symbol->image) }}" alt="Current Image" class="img-thumbnail" width="100">
                            @else
                                No Image
                            @endif
                        </small>
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning btn-sm" style="font-size: 11px;">Update Symbol</button>
                </form>
            </div>
        </div>
    </div>
@endsection
