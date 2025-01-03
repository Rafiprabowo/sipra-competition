@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">

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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Form Edit Juri</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('juri.update', $juri->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container-md">
                        <!-- Input Nama Juri -->
                        <div class="form-group">
                            <label for="nama">Nama Juri</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $juri->nama) }}" style="font-size: 11px;" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kwartir_cabang">Kwartir Cabang</label>
                            <input type="text" class="form-control @error('kwartir_cabang') is-invalid @enderror" id="kwartir_cabang" name="kwartir_cabang" value="{{ old('kwartir_cabang', $juri->kwartir_cabang) }}" style="font-size: 11px;" required>
                            @error('kwartir_cabang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pangkalan -->
                        <div class="form-group">
                            <label for="pangkalan">Pangkalan</label>
                            <input type="text" class="form-control @error('pangkalan') is-invalid @enderror"
                                   id="pangkalan" name="pangkalan" value="{{ old('pangkalan', $juri->pangkalan) }}" style="font-size: 11px;" required>
                            @error('pangkalan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $juri->tanggal_lahir) }}" style="font-size: 11px;" required>
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" style="font-size: 11px;" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $juri->no_hp) }}" style="font-size: 11px;" required>
                            @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $juri->alamat) }}" style="font-size: 11px;" required>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pengalaman_juri">Pengalaman Juri</label>
                            <input type="text" class="form-control @error('pengalaman_juri') is-invalid @enderror" id="pengalaman_juri" name="pengalaman_juri" value="{{ old('pengalaman_juri', $juri->pengalaman_juri) }}" style="font-size: 11px;" required>
                            @error('pengalaman_juri')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $juri->pekerjaan) }}" style="font-size: 11px;" required>
                            @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $juri->user->username) }}" style="font-size: 11px;" required>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" style="font-size: 11px;">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" style="font-size: 11px;">
                        </div>
                
                        <!-- Pilihan Mata Lomba -->
                        <div class="form-group">
                            <label for="mata_lomba_id">Mata Lomba</label>
                            <select class="form-control @error('mata_lomba_id') is-invalid @enderror" id="mata_lomba_id" name="mata_lomba_id" style="font-size: 11px;" required>
                                <option value="" disabled>Pilih Mata Lomba</option>
                                @foreach ($mataLombas as $mataLomba)
                                    <option value="{{ $mataLomba->id }}" {{ old('mata_lomba_id', $juri->mata_lomba_id) == $mataLomba->id ? 'selected' : '' }}>
                                        {{ $mataLomba->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_lomba_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary mr-2" style="font-size: 11px;" title="Update">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <a href="{{ route('juri.index') }}" class="btn btn-secondary ml-2" style="font-size: 11px;" title="Kembali">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
