@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection
@section('content')
<div id="content" class="container-fluid mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="container-fluid mt-4">
        <div class="card-body ">
            @if(isset($pembina) && $pembina->exists)
                <form id="pembinaForm" action="{{ route('pembina.update', $pembina->id) }}" method="post">
                    @method('PUT')
                    @else
                        <form id="pembinaForm" action="{{ route('pembina.store') }}" method="post">
                            @endif
                            @csrf
                            <div class="card  mb-4">
                                <div class="card-header bg-info text-white">Input Data Pembina</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama">Nama <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control"
                                                aria-describedby="namaHelp"
                                                placeholder="Masukkan nama pembina"
                                                value="{{old('nama', $pembina['nama'] ?? '')}}"
                                                required>
                                            <small id="namaHelp" class="form-text text-muted">Contoh:
                                                Hanif</small>
                                            @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="alamat">Alamat <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="alamat" name="alamat"
                                                class="form-control"
                                                placeholder="Masukkan alamat pembina"
                                                value="{{old('alamat', $pembina['alamat'] ?? '')}}"
                                                aria-describedby="alamatHelp" required>
                                            <small id="alamatHelp" class="form-text text-muted">Contoh:
                                                Jl.
                                                Soekarno
                                                Hatta No.9, Jatimulyo, Kec. Lowokwaru</small>
                                            @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tanggal_lahir">Tanggal Lahir <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                                class="form-control"
                                                value="{{old('tanggal_lahir', $pembina['tanggal_lahir'] ?? '')}}"
                                                required>
                                            @error('tanggal_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="jenis_kelamin">Jenis Kelamin <span
                                                    class="text-danger">*</span></label>
                                            <select name="jenis_kelamin" id="jenis_kelamin"
                                                    class="form-control"
                                                    required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option
                                                    value="L"{{ (old('jenis_kelamin', $pembina['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option
                                                    value="P"{{ (old('jenis_kelamin', $pembina['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="no_hp">Nomor Handphone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="no_hp" name="no_hp"
                                                class="form-control"
                                                placeholder="Nomor handphone"
                                                aria-describedby="no_hpHelp"
                                                value="{{old('no_hp', $pembina['no_hp'] ?? '')}}"
                                                required>
                                            <small id="no_hpHelp" class="form-text text-muted">Contoh:
                                                081946777222</small>
                                            @error('no_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="kwartir_cabang">Kwartir Cabang <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="kwartir_cabang" name="kwartir_cabang"
                                                class="form-control"
                                                aria-describedby="kwartir_cabangHelp"
                                                placeholder="Masukkan kwartir cabang"
                                                value="{{old('kwartir_cabang', $pembina['kwartir_cabang'] ?? '')}}"
                                                required>
                                            <small id="kwartir_cabangHelp" class="form-text text-muted">Contoh:
                                                Kwartir xyz</small>
                                            @error('kwartir_cabang')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pangkalan">Nama Pangkalan</label>
                                            <input type="text" id="pangkalan" name="pangkalan"
                                                class="form-control"
                                                placeholder="Masukkan nama pangkalan"
                                                aria-describedby="pangkalanHelp"
                                                value="{{old('pangkalan', $pembina['pangkalan'] ?? '') }}"
                                                required>
                                            <small id="pangkalanHelp" class="form-text text-muted">Contoh:
                                                SMPN
                                                4
                                                Malang</small>
                                            @error('pangkalan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_gudep">Nama Gudep</label>
                                            <input type="text" id="nama_gudep" name="nama_gudep"
                                                class="form-control"
                                                placeholder="Masukkan nama gudep"
                                                aria-describedby="nama_gudepHelp"
                                                value="{{old('nama_gudep', $pembina['nama_gudep'] ?? '' )}}"
                                                required>
                                            <small id="nama_gudepHelp"
                                                class="form-text text-muted"></small>
                                            @error('nama_gudep')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pengalaman_pembina">Pengalaman Pembina</label>
                                            <input type="text" id="pengalaman_pembina"
                                                name="pengalaman_pembina"
                                                class="form-control"
                                                placeholder="Masukkan pengalaman pembina"
                                                value="{{old('pengalaman_pembina', $pembina['pengalaman_pembina'] ?? '')}} "
                                                aria-describedby="pengalaman_pembinaHelp">
                                            <small class="form-text text-muted">Jika belum ada, maka isi
                                                belum
                                                ada</small>
                                            @error('pengalaman_pembina')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" id="pekerjaan" name="pekerjaan"
                                                class="form-control"
                                                placeholder="Masukkan pekerjaan"
                                                value="{{old('pekerjaan', $pembina['pekerjaan'] ?? '' ) }}"
                                                aria-describedby="pekerjaanHelp">
                                            <small class="form-text text-muted">Jika tidak ada, bisa
                                                dikosongkan</small>
                                            @error('pekerjaan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @if(isset($pembina))
                                    <input type="hidden" name="pembina_id" value="{{ $pembina->id }}">
                                    <button type="button" class="btn btn-success mb-3"
                                            data-toggle="modal"
                                            data-target="#pembinaModal">
                                        <i class="fas fa-edit mr-1"></i> Simpan Perubahan
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#pembinaModal">
                                        <i class="fas fa-save mr-1"></i> Simpan Pembina
                                    </button>
                                @endif
                            </div>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="pembinaModal" tabindex="-1" role="dialog"
                                aria-labelledby="confirmModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">
                                                Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin data yang dimasukkan sudah benar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" form="pembinaForm"
                                                    class="btn btn-primary">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                        @if(isset($pembina))
                            <div class="card w-auto mt-4">
                                <div class="card-header bg-info text-white">Data Pembina</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>{{ $pembina->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>{{ $pembina->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>{{ $pembina->tanggal_lahir }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>{{ $pembina->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Handphone</td>
                                                <td>{{ $pembina->no_hp }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kwartir Cabang</td>
                                                <td>{{ $pembina->kwartir_cabang }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Pangkalan</td>
                                                <td>{{ $pembina->pangkalan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Gudep</td>
                                                <td>{{ $pembina->nama_gudep }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pengalaman Pembina</td>
                                                <td>{{ $pembina->pengalaman_pembina }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan</td>
                                                <td>{{ $pembina->pekerjaan }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
            @endif
        </div>
    </div>
</div>
@endsection
