@extends('layouts.template')

@section('content')
<div class="container" style="font-size: 11px;">
    <h2 style="font-size: 11px;">Edit Profile</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" style="font-size: 11px;" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $user->nama_lengkap }}" style="font-size: 11px;" required>
        </div>
        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" style="font-size: 11px;">
        </div>
        <div class="form-group">
            <label for="no_hp">Phone Number</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" style="font-size: 11px;">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password" style="font-size: 11px;">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" style="font-size: 11px;">
        </div>
        <div class="form-group">
            <label for="foto_profil">Profile Picture</label>
            <input type="file" class="form-control" id="foto_profil" name="foto_profil" style="font-size: 11px;">
        </div>
        <button type="submit" class="btn btn-primary mr-2" style="font-size: 11px;" title="Update">
            <i class="fas fa-sync-alt"></i>
        </button>
        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
            <i class="fas fa-arrow-left"></i>
        </a>
    </form>
</div>
@endsection
