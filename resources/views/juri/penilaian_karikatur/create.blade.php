@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Form Penilaian Karikatur</h2>

    <!-- Filter -->
    <div class="mb-4">
        <!-- Filter Pangkalan -->
        <div class="mb-3">
            <label for="filter-pangkalan" class="form-label">Filter Pangkalan</label>
            <select id="filter-pangkalan" class="form-control">
                <option value="">-- Pilih Pangkalan --</option>
                @foreach($pangkalans as $pangkalan)
                    <option value="{{ $pangkalan->id }}">{{ $pangkalan->pangkalan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filter Nama Regu -->
        <div class="mb-3">
            <label for="filter-nama-regu" class="form-label">Filter Nama Regu</label>
            <select id="filter-nama-regu" class="form-control" disabled>
                <option value="">-- Pilih Nama Regu --</option>
            </select>
        </div>

        <!-- Filter Peserta -->
        <div class="mb-3">
            <label for="filter-peserta" class="form-label">Filter Peserta</label>
            <select id="filter-peserta" class="form-control" disabled>
                <option value="">-- Pilih Peserta --</option>
            </select>
        </div>
    </div>

    <!-- Form Penilaian -->
    <form action="{{ route('penilaian-karikatur.store') }}" method="POST">
        @csrf

        <!-- Daftar kriteria nilai -->
        <h5 class="mt-4">Kriteria Nilai</h5>
        <div id="kriteria-container">
            @foreach($bobot_soals as $bobot)
            <div class="row align-items-center mb-3">
                <div class="col-md-4">
                    <label class="form-label">{{ $bobot->kriteria_nilai }}</label>
                </div>
                <div class="col-md-3">
                    <input type="number" name="nilai[{{ $bobot->id }}]" class="form-control" placeholder="Masukkan Nilai" required>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol Submit -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterPangkalan = document.getElementById('filter-pangkalan');
        const filterNamaRegu = document.getElementById('filter-nama-regu');
        const filterPeserta = document.getElementById('filter-peserta');
    
        filterPangkalan.addEventListener('change', function () {
            const pangkalanId = this.value;
    
            // Reset Nama Regu dan Peserta
            filterNamaRegu.innerHTML = '<option value="">-- Pilih Nama Regu --</option>';
            filterPeserta.innerHTML = '<option value="">-- Pilih Peserta --</option>';
            filterNamaRegu.disabled = false;
            filterPeserta.disabled = false;
    
            if (pangkalanId) {
                // Panggil server untuk memuat Nama Regu berdasarkan Pangkalan
                fetch(`/filter-nama-regu?pangkalan_id=${pangkalanId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach(regu => {
                                const option = document.createElement('option');
                                option.value = regu.id;
                                option.textContent = regu.nama_regu;
                                filterNamaRegu.appendChild(option);
                            });
                            filterNamaRegu.disabled = false; // Aktifkan dropdown Nama Regu
                        }
                    })
                    .catch(error => console.error('Error fetching Nama Regu:', error));
            }
        });
    
        filterNamaRegu.addEventListener('change', function () {
            const reguPembinaId = this.value;
    
            // Reset Peserta
            filterPeserta.innerHTML = '<option value="">-- Pilih Peserta --</option>';
            filterPeserta.disabled = true;
    
            if (reguPembinaId) {
                // Panggil server untuk memuat Peserta berdasarkan Nama Regu
                fetch(`/filter-peserta?regu_pembina_id=${reguPembinaId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach(peserta => {
                                const option = document.createElement('option');
                                option.value = peserta.id;
                                option.textContent = peserta.nama;
                                filterPeserta.appendChild(option);
                            });
                            filterPeserta.disabled = false; // Aktifkan dropdown Peserta
                        }
                    })
                    .catch(error => console.error('Error fetching Peserta:', error));
            }
        });
    });
</script>    

@endsection
