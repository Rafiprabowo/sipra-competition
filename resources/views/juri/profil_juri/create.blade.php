@extends('layout')

@section('content')
    <h2>Tambah Juri</h2>
    <form action="{{ route('juri.profil_juri.store') }}" method="POST">
        @csrf
        @include('juri.profil_juri.partials.form')
        <button type="submit">Simpan</button>
    </form>
@endsection
