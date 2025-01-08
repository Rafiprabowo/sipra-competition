@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
<div class="container-fluid" style="font-size: 11px;">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sesi-cbt.index') }}">Sesi Computer Based Test</a></li>
            <li class="breadcrumb-item active" aria-current="page">Soal {{ $session->nama }}</li>
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
            <h5 style="font-size: 11px;">Soal {{$session->nama}} Computer Based Test</h5>
    
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe</th>
                            <th>Kata</th>
                            <th>Gambar</th>
                            <th>Tingkat Kesulitan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($session->smsQuestions as $question)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $question->type }}</td>
                                <td>{{ $question->word }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-start">
                                        @foreach ($question->symbols as $symbol) 
                                            <div class="symbol-container text-center" style="margin-right: 10px; margin-bottom: 5px; width: 80px;">
                                                <img src="{{ Storage::url($symbol->image) }}" alt="{{ $symbol->letter }}" class="symbol-image" style="width: 100%; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                                                <div style="font-size: 10px; margin-top: 5px;">{{ $symbol->letter }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $question->difficulty }}</td>
                          
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection

@section('script')
<script>
    $(function(){
        $('#dataTable').DataTable();
    });
</script>
@endsection
