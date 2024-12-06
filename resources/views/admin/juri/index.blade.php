@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-10 mx-auto mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Nama Juri</h6>
                <a href="{{route('juri.create')}}" class="btn btn-primary btn-md">Tambah Juri</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Juri</th>
                            <th>Mata Lomba</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($juri as $index => $value)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->mata_lomba->nama}}</td>
                                <td>
                                    <a href="{{route('juri.show', $value->id)}}" class="btn btn-info btn-sm " title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('juri.edit', $value->id)}}" class="btn btn-warning btn-sm mx-3" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('juri.destroy', $value->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger  btn-sm" title="Delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
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
