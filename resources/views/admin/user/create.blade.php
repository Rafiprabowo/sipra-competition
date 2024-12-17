@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4" style="font-size: 11px;">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Tambah User</h6></div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST"> @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" style="font-size: 11px;" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" style="font-size: 11px;" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Jenis Akun</label>
                        <select
                            class="form-control" id="role" name="role" style="font-size: 11px;" required>
                            <option value="admin">Admin</option>
                            <option value="pembina">Pembina</option>
                            <option value="peserta">Peserta</option>
                            <option value="juri">Juri</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                            <i class="fas fa-save"></i>
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
