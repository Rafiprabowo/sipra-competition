@extends('layout')

@section('content')
    <h2>Data Juri</h2>
    <a href="{{ route('juri.profil_juri.create') }}">Tambah Juri</a>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kwartir Cabang</th>
                <th>Pangkalan</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Pengalaman Juri</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($juris as $juri)
                <tr>
                    <td>{{ $juri->nama }}</td>
                    <td>{{ $juri->kwartir_cabang }}</td>
                    <td>{{ $juri->pangkalan }}</td>
                    <td>{{ $juri->tanggal_lahir }}</td>
                    <td>{{ $juri->jenis_kelamin }}</td>
                    <td>{{ $juri->alamat }}</td>
                    <td>{{ $juri->no_hp }}</td>
                    <td>{{ $juri->pengalaman_juri }}</td>
                    <td>{{ $juri->pekerjaan }}</td>
                    <td>
                        <a href="{{ route('juri.profil_juri.edit', $juri) }}">Edit</a>
                        <form action="{{ route('juri.profil_juri.destroy', $juri) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
