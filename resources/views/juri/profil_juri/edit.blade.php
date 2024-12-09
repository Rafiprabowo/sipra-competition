@extends('layout')

@section('content')
    <h2>Edit Juri</h2>
    <form action="{{ route('juri.profil_juri.update', $juri) }}" method="POST">
        @csrf
        @method('PUT')
        @include('juri.profil_juri.partials.form')
        <button type="submit">Perbarui</button>
    </form>
@endsection
