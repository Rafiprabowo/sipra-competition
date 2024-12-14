@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-8">
        <h1 class="h3 mb-4 text-gray-800">Tambah User</h1>
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6></div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST"> @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Jenis Akun</label>
                        <select
                            class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="pembina">Pembina</option>
                            <option value="peserta">Peserta</option>
                            <option value="juri">Juri</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-start mt-5">
                        <button type="submit" class="btn btn-primary">Tambah User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
