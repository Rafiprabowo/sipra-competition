@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-md-6 mx-auto">
        <h1 class="h3 mb-4 text-gray-800">Edit Pembina</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Pembina</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pembina.update', $pembina->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama', $pembina->nama) }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pangkalan -->
                        <div class="form-group">
                            <label for="pangkalan">Pangkalan</label>
                            <input type="text" class="form-control @error('pangkalan') is-invalid @enderror"
                                   id="pangkalan" name="pangkalan" value="{{ old('pangkalan', $pembina->pangkalan) }}" required>
                            @error('pangkalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-start mt-5">
                            <button type="submit" class="btn btn-primary mr-3">Update Pembina</button>
                            <a href="{{ route('admin.pembina.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
