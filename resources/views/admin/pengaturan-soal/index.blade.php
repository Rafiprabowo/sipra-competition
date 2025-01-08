@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Konfigurasi Soal</h6>
                <a href="{{ route('cbt-session-question-configurations.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Konfigurasi Soal
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($configurations->isEmpty())
                    <p class="text-center">Belum ada konfigurasi soal untuk sesi CBT ini.</p>
                @else
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sesi</th>
                                <th>Jenis Soal</th>
                                <th>Jumlah Soal Mudah</th>
                                <th>Jumlah Soal Sulit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($configurations as $index => $configuration)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $configuration->cbtSession->nama }}</td>
                                    <td>
                                        @switch($configuration->question_type)
                                            @case(\App\Enums\QuestionType::MORSE->value)
                                                Morse
                                                @break
                                            @case(\App\Enums\QuestionType::SEMAPHORE->value)
                                                Semaphore
                                                @break
                                            @case(\App\Enums\QuestionType::PK->value)
                                                Pengetahuan Kepramukaan
                                                @break
                                            @default
                                                N/A
                                        @endswitch
                                    </td>
                                    <td>{{ $configuration->easy_question_count }}</td>
                                    <td>{{ $configuration->hard_question_count }}</td>
                                    <td>
                                        <a href="{{ route('cbt-session-question-configurations.edit', $configuration->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('cbt-session-question-configurations.destroy', $configuration->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus konfigurasi soal ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
