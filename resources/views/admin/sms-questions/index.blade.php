@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">SMS Questions</li>
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
                <h5 style="font-size: 11px;">SMS Questions List</h5>
                <a href="{{ route('sms-questions.create') }}" class="btn btn-primary btn-sm" style="font-size: 11px;">
                    Add New Question
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm" id="smsQuestionsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Word</th>
                            <th>Type</th>
                            <th>CBT Session</th>
                            <th>Symbol Images</th>
                            <th>Actions</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($smsQuestions as $smsQuestion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $smsQuestion->word }}</td>
                                <td>{{ $smsQuestion->type == \App\Enums\SymbolType::Semaphore->value ? 'Semaphore' : 'Morse' }}</td>
                                <td>{{ $smsQuestion->cbtSession ? $smsQuestion->cbtSession->nama : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-start">
                                        @foreach ($smsQuestion->symbols as $symbol) 
                                            <div class="symbol-container text-center" style="margin-right: 10px; margin-bottom: 5px;">
                                                <img src="{{ Storage::url($symbol->image) }}" alt="{{ $symbol->letter }}" class="symbol-image">
                                                <div>{{ $symbol->letter }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    {{-- Edit and Delete actions (if needed) --}}
                                    <a href="{{ route('sms-questions.edit', $smsQuestion->id) }}" class="btn btn-sm btn-warning mr-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sms-questions.destroy', $smsQuestion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this question?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('h-script')
    <style>
        .symbol-image {
            width: auto;  /* Set the width as needed */
            height: 50px; /* Maintain aspect ratio */
            object-fit: contain; /* Prevent image from stretching */
        }

        .symbol-container {
            text-align: center;
        }

        .d-flex {
            flex-wrap: wrap;
            justify-content: flex-start;
        }
    </style>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#smsQuestionsTable').DataTable({
            "paging": true,       // Enable pagination
            "searching": true,    // Enable searching
            "ordering": true,     // Enable sorting
            "info": true,         // Display information
            "autoWidth": false    // Disable automatic column width adjustment
        });
    });
</script>
@endsection
