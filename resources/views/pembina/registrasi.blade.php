@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.pembina')
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

                  @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs navbar-light" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link" id="data-pembina-tab" data-toggle="tab" href="#data-pembina" role="tab"
                   aria-controls="data-pembina" aria-selected="true">Data Pembina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="data-regu-tab" data-toggle="tab" href="#data-regu" role="tab" aria-controls="data-regu"
                   aria-selected="false">Regu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="data-peserta-tab" data-toggle="tab" href="#data-peserta" role="tab"
                   aria-controls="data-peserta" aria-selected="false">Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="data-dokumen-tab" data-toggle="tab" href="#data-dokumen" role="tab"
                   aria-controls="data-dokumen"
                   aria-selected="false">Upload Berkas</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Data Pembina -->
            <div class="tab-pane fade show active" id="data-pembina" role="tabpanel" aria-labelledby="data-pembina-tab">
                <div class="container-fluid mt-4">
                    <div class="card-body ">
                       @if(!isset($pembina->finalisasi))
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
                                                        <label for="pangkalan">Nama Pangkalan <span
                                                                class="text-danger">*</span></label>
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
                                                        <label for="nama_gudep">Nama Gudep <span
                                                                class="text-danger">*</span></label>
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
                                                               value="{{old('pengalaman_pembina', $pembina->pengalaman_pembina ?? '')}}"
                                                               aria-describedby="pengalaman_pembinaHelp">
                                                        <small class="form-text text-muted"></small>
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
                                                        <small class="form-text text-muted"></small>
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

                                @if(isset($pembina) && $pembina->exists)
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

                                @else
                                    @if(isset($pembina) && $pembina->exists)
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
                        @endif
                    </div>
                </div>

            </div>

            <!-- Tab Regu -->
            <div class="tab-pane fade" id="data-regu" role="tabpanel" aria-labelledby="data-regu-tab">
                <div class="container-fluid mt-4">
                    <!-- Pemberitahuan Jika Pembina Belum Input Data -->
                    @if(!isset($pembina))
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Harap input data pembina terlebih dahulu.
                        </div>
                    @endif


                    <!-- Form Input Data Regu -->
                    @if(isset($pembina))
                        @if($pembina->regu->count() < 2 || isset($reguToEdit))
                            <form
                                action="{{isset($reguToEdit) ? route('regu.update', $reguToEdit->id) : route('regu.store')}}"
                                id="formRegu" method="post">
                                @if(isset($reguToEdit))
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="card mb-4">
                                    <div class="card-header bg-info text-white">Input Data Regu</div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="nama_regu">Nama Regu</label>
                                            <input type="text" id="nama_regu" name="nama_regu" class="form-control"
                                                   placeholder="Masukkan nama regu"
                                                   value="{{ old('nama_regu', $reguToEdit->nama_regu ?? '') }}"
                                                   required>
                                            @error('nama_regu')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kategori">Kategori</label>
                                            <select id="kategori" name="kategori" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                <option
                                                    value="PA" {{ old('kategori', $reguToEdit->kategori ?? '') == 'PA' ? 'selected' : '' }}>
                                                    PA
                                                </option>
                                                <option
                                                    value="PI" {{ old('kategori', $reguToEdit->kategori ?? '') == 'PI' ? 'selected' : '' }}>
                                                    PI
                                                </option>
                                            </select>
                                            @error('kategori')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pembina_id">Nama Pembina</label>
                                            <select id="pembina_id" name="pembina_id" class="form-control">
                                                <option value="{{$pembina->id}}" selected>{{$pembina->nama}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#confirmModal">
                                            <i class="fas fa-save mr-1"></i> {{isset($reguToEdit) ? 'Simpan Perubahan' : 'Simpan Regu'}}
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal Konfirmasi -->
                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                                     aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin data yang dimasukkan sudah benar?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-save mr-1"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif

                    <!-- Tabel Data Regu -->
                    @if(isset($regus) && $regus->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">Data Regu</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="reguTable" class="table table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Nama Regu</th>
                                            <th>Kategori</th>
                                            <th>Nama Pembina</th>
                                               @if(!isset($pembina->finalisasi))
                                                <th>Aksi</th>
                                                    @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($regus as $regu)
                                            <tr>
                                                <td>{{ $regu->nama_regu }}</td>
                                                <td>{{ $regu->kategori }}</td>
                                                <td>{{ $regu->pembina->nama}}</td>
                                               @if(!isset($pembina->finalisasi))
                                                <td>
                                                    <a href="{{ route('registrasi.form', ['edit_regu_id' => $regu->id]) }}"
                                                       class="btn btn-success btn-sm mr-3   ">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <form action="{{ route('regu.destroy', $regu->id) }}" method="POST"
                                                          style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus regu ini?')">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Pemberitahuan Jika Kategori Regu Belum Lengkap -->

                </div>
            </div>


            <!-- Tab Peserta -->
            <div class="tab-pane fade" id="data-peserta" role="tabpanel" aria-labelledby="data-peserta-tab">
                <div class="container-fluid mt-4">
                    <!-- Pemberitahuan Jika Pembina atau Regu Belum Input Data -->
                    @if(!isset($pembina) || !isset($regus) || $regus->isEmpty())
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Harap input data pembina & regu terlebih dahulu.
                        </div>
                    @endif
                    @if(!isset($pembina->finalisasi))
                    <!-- Form Input atau Edit Data Peserta -->
                    @if(isset($pembina) && !$regus->isEmpty())
                        <form
                            action="{{ isset($pesertaToEdit) ? route('peserta.update', $pesertaToEdit->id) : route('peserta.store') }}"
                            id="formPeserta" method="post">
                            @csrf
                            @if(isset($pesertaToEdit))
                                @method('PUT')
                            @endif
                            <input type="hidden" name="pembina_id" value="{{ $pembina->id }}">
                            <div class="card mb-4">
                                <div
                                    class="card-header bg-info text-white">{{ isset($pesertaToEdit) ? 'Edit Data Peserta' : 'Input Data Peserta' }}</div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="nisn">NISN</label>
                                        <input type="text" id="nisn" name="nisn" class="form-control"
                                               placeholder="Masukkan NISN peserta"
                                               value="{{ old('nisn', $pesertaToEdit->nisn ?? '') }}" required>
                                        @error('nisn')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama Peserta</label>
                                        <input type="text" id="nama_peserta" name="nama" class="form-control"
                                               placeholder="Masukkan nama peserta"
                                               value="{{ old('nama', $pesertaToEdit->nama ?? '') }}" required>
                                        @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                            <option value="">Jenis Kelamin</option>
                                            <option value="L" {{old('jenis_kelamin', $pesertaToEdit->jenis_kelamin ?? '') == "L" ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{old('jenis_kelamin', $pesertaToEdit->jenis_kelamin ?? '') == "P" ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="regu_pembina">Pilih Regu</label>
                                        <select id="regu_pembina_id" name="regu_pembina_id" class="form-control"
                                                required>
                                            <option value="">Pilih Regu</option>
                                            @foreach($regus as $regu)
                                                <option
                                                    value="{{ $regu->id }}" {{ old('regu_pembina_id', $pesertaToEdit->regu_pembina_id ?? '') == $regu->id ? 'selected' : '' }}>
                                                    {{ $regu->nama_regu}} [{{$regu->kategori}}]
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('regu_pembina_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="mata_lomba">Mata Lomba</label>
                                        <select id="mata_lomba_id" name="mata_lomba_id" class="form-control" required>
                                            <option value="">Pilih Nama Mata Lomba</option>
                                            @foreach($mataLombas as $mataLomba)
                                                <option
                                                    value="{{$mataLomba->id}}" {{ old('mata_lomba_id', $pesertaToEdit->mata_lomba_id ?? '') == $mataLomba->id ? 'selected' : '' }}>
                                                    {{$mataLomba->nama}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mata_lomba_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#pesertaModal">
                                        <i class="fas fa-save mr-1"></i> {{ isset($pesertaToEdit) ? 'Simpan Perubahan' : 'Simpan Peserta' }}
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="pesertaModal" tabindex="-1" role="dialog"
                                 aria-labelledby="pesertaModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pesertaModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin data yang dimasukkan sudah benar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-save mr-1"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    @endif
                    <!-- Tabel Data Peserta -->
                    @if(isset($pesertas) && $pesertas->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">Data Peserta</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="pesertaTable" class="table table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama Peserta</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Regu</th>
                                            <th>Lomba</th>
                                             @if(!isset($pembina->finalisasi))
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pesertas as $index => $peserta)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $peserta->nisn }}</td>
                                                <td>{{ $peserta->nama }}</td>
                                                <th>{{$peserta->jenis_kelamin}}</th>
                                                <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                                                <td>{{ $peserta->mata_lomba->nama}}</td>
                                               @if(!isset($pembina->finalisasi))
                                                <td>
                                                    <a href="{{ route('registrasi.form', ['edit_peserta_id' => $peserta->id]) }}"
                                                       class="btn btn-success btn-sm mr-2">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <form action="{{ route('peserta.destroy', $peserta->id) }}"
                                                          method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>


            <!-- Tab Upload berkas -->
            <div class="tab-pane fade" id="data-dokumen" role="tabpanel" aria-labelledby="data-dokumen-tab">
                <div class="container-fluid mt-4">
                    <!-- Pemberitahuan Jika Pembina atau Regu Belum Input Data -->
                    @if(!isset($pembina))
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Harap lengkapi data pembina, regu, dan peserta terlebih dahulu
                        </div>
                    @else

                    <div class="card mt-4">
                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                            <h5>Dokumen Syarat Umum</h5>
                            <!-- Tombol Finalisasi Pendaftaran -->
                            @if(!isset($pembina->finalisasi))
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#finalizeModal" {{ !isset($pembina) ? 'disabled' : '' }}>
                                    Finalisasi Pendaftaran
                                </button>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Tabel Data Dokumen -->
                                <div class="col-md-12 mb-5">
                                    <table class="table table-bordered" id="templateTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dokumen</th>
                                                <th>Tipe</th>
                                                <th>Unduh Template</th>
                                                <th>File Dokumen</th>
                                                <th>Status Dokumen</th>
                                                <th>Keterangan Dokumen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($templates as $template)
                    @if($template->upload_dokumen->isEmpty())
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $template->nama }}</td>
                            <td>{{ $template->tipe }}</td>
                            <td>
                                <a href="{{ route('downloadTemplate', $template->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-download"></i> Unduh
                                </a>
                            </td>
                            <td colspan="3">
                                <span class="badge badge-secondary">Belum Unggah Dokumen</span>
                            </td>
                        </tr>
                    @else
                        @foreach($template->upload_dokumen as $uploadDokumen)
                            @php
                                $statusDokumen = $uploadDokumen->status;
                                $statusDokumenLabel = $statusDokumen === 1 ? 'badge-success' : ($statusDokumen === 0 ? 'badge-danger' : 'badge-warning');
                                $statusDokumenText = $statusDokumen === 1 ? 'Tervalidasi' : ($statusDokumen === 0 ? 'Tidak Tervalidasi' : 'Menunggu Verifikasi');
                            @endphp
                            <tr>
                                <td>{{ $loop->parent->iteration }}</td>
                                <td>{{ $template->nama }}</td>
                                <td>{{ $template->tipe }}</td>
                                <td>
                                    <a href="{{ route('downloadTemplate', $template->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-download"></i> Unduh
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('viewFile', basename($uploadDokumen->file)) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-file"></i> Lihat
                                    </a>
                                </td>
                                <td>
                                    <span class="badge {{ $statusDokumenLabel }}">{{ $statusDokumenText }}</span>
                                    <br>
                                    <small class="text-muted">Diunggah pada: {{ $uploadDokumen->updated_at->format('d-m-Y H:i') }}</small>
                                </td>
                                <td>{{ $uploadDokumen->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <!-- Form Unggah Dokumen -->
                                @if(!isset($pembina->finalisasi) || (isset($pembina->finalisasi) && $pembina->finalisasi->status === 0))
                                    <div class="col-md-12">
                                        <h5 class="font-weight-bold text-black-50 lead">Unggah Dokumen</h5>
                                        <hr class="mb-4">
                                        <form id="uploadForm" action="{{ route('upload_dokumen.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="template_dokumen_id">Jenis Dokumen</label>
                                                <select class="form-control" id="template_dokumen_id" name="template_dokumen_id" required>
                                                    <option value="" disabled selected>Pilih jenis dokumen</option>
                                                    @foreach($templates as $template)
                                                        <option value="{{ $template->id }}">{{ $template->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="file">Unggah Dokumen</label>
                                                <input type="file" class="form-control-file" id="file" name="file" required>
                                                <small class="form-text text-muted">Silahkan pilih file dokumen yang sesuai. Ukuran maksimal file 2 MB.</small>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Unggah</button>
                                        </form>
                                    </div>
                                @else

                                @endif

                                <!-- Modal Konfirmasi Finalisasi Pendaftaran -->
                                <div class="modal fade" id="finalizeModal" tabindex="-1" role="dialog" aria-labelledby="finalizeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="finalizeModalLabel">Konfirmasi Finalisasi Pendaftaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin finalisasi pendaftaran?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('finalisasi') }}" method="post">
                                                    @csrf
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Finalisasi</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>



            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Save and Load Active Tab -->
    <script>
        $(document).ready(function () {
            // Load active tab from localStorage
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }

            // Save active tab to localStorage
            $('#myTab a').on('click', function (e) {
                e.preventDefault();
                let tabName = $(this).attr('href');
                localStorage.setItem('activeTab', tabName);
                $(this).tab('show');
            });

            $('#pesertaTable').DataTable()
            $('#reguTable').DataTable()
            $('#documentTable').DataTable();

        });
    </script>
@endsection



