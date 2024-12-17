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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mata_lomba as $index => $value)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->deskripsi}}</td>
                                <td>
                                    {{-- <a href="{{route('admin.mata-lomba.show', $value->id)}}" class="btn btn-info btn-sm " title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a> --}}
                                    <a href="{{route('admin.mata-lomba.edit', $value->id)}}" class="btn btn-warning btn-sm mx-3" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('admin.mata-lomba.destroy', $value->id)}}" method="POST" style="display:inline;">
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
@endsection
