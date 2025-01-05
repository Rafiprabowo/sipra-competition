@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid mt-4" style="font-size: 11px;">
        <div class="card">
            <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                <h5 style="font-size: 11px;">Daftar Template Dokumen</h5>
                <!-- Tombol Tambah Dokumen -->
                <a href="{{ route('dokumen.create') }}" class="btn btn-primary" style="font-size: 11px;" title="Tambah">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="dokumenTable" class="table table-bordered" style="text-align: center">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dokumens as $doc)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $doc->nama }}</td>
                                <td>{{ $doc->tipe }}</td>

                                <td>
                                    <a href="{{ route('downloadTemplate', $doc->id) }}" class="btn btn-info btn-sm mr-2" title="Unduh" style="font-size: 11px;">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <a href="{{ route('dokumen.edit', $doc->id) }}" class="btn btn-warning btn-sm mr-2" style="font-size: 11px;" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dokumen.destroy', $doc->id) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin?')" style="font-size: 11px;" title="Hapus">
                                            <i class="fa fa-trash"></i>
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
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#dokumenTable').DataTable();
        });
    </script>
@endsection
