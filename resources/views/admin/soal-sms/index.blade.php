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
            <div class="d-flex">
                <!-- Tombol Import Excel -->
                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#importModal" style="font-size: 11px;" title="Import Excel">
                    <i class="fas fa-file-excel"></i>
                </button>
                <!-- Tombol Hapus Semua Soal -->
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAllModal" style="font-size: 11px;" style="font-size: 11px;" title="Hapus Soal">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
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
                                <td >
                                    <a href="{{route('sesi-soal.edit', ['session_id' => $session->id, 'id' => $question->id])}}" class="btn btn-warning btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$question->id}}" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <!-- Modal Import Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('soal-tpk.import', $session->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Soal dari Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel:</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Delete Confirmation Modals -->
        @foreach($session->tpk_questions as $question)
        <div class="modal fade" id="deleteModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$question->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('sesi-soal.delete', ['session_id' => $session->id, 'id' => $question->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{$question->id}}">Konfirmasi Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus soal ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Hapus Semua Soal -->
    <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('sesi-soal.delete-all', ['session_id' => $session->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllModalLabel">Konfirmasi Hapus Semua Soal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus semua soal untuk sesi ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Semua</button>
                    </div>
                </form>
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
