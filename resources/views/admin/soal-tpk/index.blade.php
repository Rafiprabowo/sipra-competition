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
                                <th>Gambar</th>
                                <th>Pertanyaan</th>
                                <th>Opsi A</th>
                                <th>Opsi B</th>
                                <th>Opsi C</th>
                                <th>Opsi D</th>
                                <th>Kunci Jawaban</th>
                                <th>Tingkat Kesulitan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($session->tpk_questions as $question)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if($question->question_image)
                                            <img src="{{ Storage::url($question->question_image) }}" alt="Question Image" width="50">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$question->question_text}}</td>
                                    <td>{{$question->answer_a}}</td>
                                    <td>{{$question->answer_b}}</td>
                                    <td>{{$question->answer_c}}</td>
                                    <td>{{$question->answer_d}}</td>
                                    <td>{{$question->correct_answer}}</td>
                                    <td>
                                        @if($question->difficulty == 'LOW')
                                            Mudah
                                        @elseif($question->difficulty == 'MIDDLE')
                                            Sulit                            
                                        @endif
                                    </td>
                                  
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
        })
    </script>
@endsection

                        