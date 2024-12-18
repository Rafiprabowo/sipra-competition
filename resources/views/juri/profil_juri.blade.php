@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
    <div class="container" style="font-size: 11px;">
        <form method="POST" action="{{ route('juri.profil_juri') }}">
            @csrf
            <h3 style="font-size: 11px;">Data Profil Juri :</h3>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" style="font-size: 11px;" name="nama" value="{{ $juri->nama ?? '' }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" style="font-size: 11px;" name="alamat" value="{{ $juri->alamat ?? '' }}">
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" style="font-size: 11px;" name="tanggal_lahir" value="{{ $juri->tanggal_lahir ?? '' }}">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" style="font-size: 11px;">
                    <option value="L" {{ (isset($juri->jenis_kelamin) && $juri->jenis_kelamin == 'L') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ (isset($juri->jenis_kelamin) && $juri->jenis_kelamin == 'P') ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor Handphone</label>
                <input type="text" class="form-control" id="no_hp" style="font-size: 11px;" name="no_hp" value="{{ $juri->no_hp ?? '' }}">
            </div>
            <div class="form-group">
                <label for="kwartir_cabang">Kwartir Cabang</label>
                <input type="text" class="form-control" id="kwartir_cabang" style="font-size: 11px;" name="kwartir_cabang" value="{{ $juri->kwartir_cabang ?? '' }}">
            </div>
            <div class="form-group">
                <label for="pangkalan">Nama Pangkalan</label>
                <input type="text" class="form-control" id="pangkalan" style="font-size: 11px;" name="pangkalan" value="{{ $juri->pangkalan ?? '' }}">
            </div>
            <div class="form-group">
                <label for="pengalaman_juri">Pengalaman Juri</label>
                <input type="text" class="form-control" id="pengalaman_juri" style="font-size: 11px;" name="pengalaman_juri" value="{{ $juri->pengalaman_juri ?? '' }}">
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" style="font-size: 11px;" name="pekerjaan" value="{{ $juri->pekerjaan ?? '' }}">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" style="font-size: 11px;" name="username" value="{{ old('username', $juri->user->username ?? '') }}" required>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" style="font-size: 11px;" name="password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" style="font-size: 11px;" name="password_confirmation">
            </div>    
            <div class="form-group">
                <label for="mata_lomba_id">Mata Lomba</label>
                <select class="form-control" id="mata_lomba_id" name="mata_lomba_id" style="font-size: 11px;">
                    @foreach($mataLombas as $mataLomba)
                        <option value="{{ $mataLomba->id }}" {{ (isset($juri->mata_lomba_id) && $juri->mata_lomba_id == $mataLomba->id) ? 'selected' : '' }}>
                            {{ $mataLomba->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                <i class="fas fa-save"></i>
            </button>
            <a href="{{ route('juri.dashboard') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
        </form>

        @if($juri->exists)
        <div class="mt-5">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $juri->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>{{ $juri->alamat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Lahir</strong></td>
                        <td>{{ $juri->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Kelamin</strong></td>
                        <td>{{ $juri->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nomor Handphone</strong></td>
                        <td>{{ $juri->no_hp }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kwartir Cabang</strong></td>
                        <td>{{ $juri->kwartir_cabang }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Pangkalan</strong></td>
                        <td>{{ $juri->pangkalan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pengalaman Juri</strong></td>
                        <td>{{ $juri->pengalaman_juri }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pekerjaan</strong></td>
                        <td>{{ $juri->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mata Lomba</strong></td>
                        <td>{{ $mataLombas->firstWhere('id', $juri->mata_lomba_id)->nama }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
@endsection
