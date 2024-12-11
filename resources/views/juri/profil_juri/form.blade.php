<div>
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" value="{{ old('nama', $juri->nama ?? '') }}" required>
</div>

<div>
    <label for="kwartir_cabang">Kwartir Cabang</label>
    <input type="text" id="kwartir_cabang" name="kwartir_cabang" value="{{ old('kwartir_cabang', $juri->kwartir_cabang ?? '') }}" required>
</div>

<div>
    <label for="pangkalan">Pangkalan</label>
    <input type="text" id="pangkalan" name="pangkalan" value="{{ old('pangkalan', $juri->pangkalan ?? '') }}" required>
</div>

<div>
    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $juri->tanggal_lahir ?? '') }}" required>
</div>

<div>
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin" required>
        <option value="Laki-Laki" {{ (old('jenis_kelamin', $juri->jenis_kelamin ?? '') == 'Laki-Laki') ? 'selected' : '' }}>Laki-Laki</option>
        <option value="Perempuan" {{ (old('jenis_kelamin', $juri->jenis_kelamin ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>

<div>
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" required>{{ old('alamat', $juri->alamat ?? '') }}</textarea>
</div>

<div>
    <label for="no_hp">No HP</label>
    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $juri->no_hp ?? '') }}" required>
</div>

<div>
    <label for="pengalaman_juri">Pengalaman Juri</label>
    <textarea id="pengalaman_juri" name="pengalaman_juri" required>{{ old('pengalaman_juri', $juri->pengalaman_juri ?? '') }}</textarea>
</div>

<div>
    <label for="pekerjaan">Pekerjaan</label>
    <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $juri->pekerjaan ?? '') }}" required>
</div>

<div>
    <label for="mata_lomba_id">Mata Lomba</label>
    {{-- <input type="text"[_{{{CITATION{{{_1{](https://github.com/Cosnavel/webmasters-learn-apis/tree/45ba1a1ba10227eb374b18dadfae2334cfbf7f66/database%2Fmigrations%2F2020_11_12_182606_create_people_table.php)[_{{{CITATION{{{_2{](https://github.com/icarojobs/laravel-clean-architecture/tree/868d3108fe06b137a7e98e0c0863f2d53acc596f/database%2Fmigrations%2F2014_10_12_100000_create_password_resets_table.php) --}}