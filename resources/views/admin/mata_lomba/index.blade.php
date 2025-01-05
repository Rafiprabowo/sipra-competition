@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Data Mata Lomba</h6>
                <a href="{{route('admin.mata-lomba.create')}}" class="btn btn-primary btn-md" style="font-size: 11px;" title="Tambah">
                    <i class="fas fa-plus"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jumlah Peserta</th>
                            <th>Ditujukan</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mata_lomba as $index => $value)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->kategori}}</td>
                                <td>{{$value->jumlah_peserta}}</td>
                                <td>
                                    @if ($value->ditujukan == 0)
                                        Peserta
                                    @elseif ($value->ditujukan == 1)
                                        Pembina
                                    @else
                                        Unknown
                                    @endif
                                </td>                                
                                <td>{{$value->deskripsi}}</td>
                                <td>
                                    <a href="{{route('admin.mata-lomba.edit', $value->id)}}" class="btn btn-warning btn-sm mx-3" title="Ubah" style="font-size: 11px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('admin.mata-lomba.destroy', $value->id)}}" method="POST" style="display:inline;" style="font-size: 11px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger  btn-sm" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
