<?php 

    @$__session_kecamatan = $__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D, IdKabupaten FROM Kecamatan WHERE IdKecamatan = '". @$__data_pmbregistrasi__->IdKecamatan ."' ORDER BY IdKabupaten DESC ");
    @$__session_kabupaten = $__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D, IdPropinsi FROM Kabupaten WHERE IdKabupaten = '". @$__session_kecamatan->IdKabupaten ."' ORDER BY IdKabupaten DESC ");
    @$__session_provinsi = $__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". @$__session_kabupaten->IdPropinsi ."' ORDER BY IdPropinsi DESC ");

    @$__session_kecamatan_sekolah = $__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D, IdKabupaten FROM Kecamatan WHERE IdKecamatan = '". @$__data_pmbregistrasi__->IdKecamatanAsalSmu ."' ORDER BY IdKabupaten DESC ");
    @$__session_kabupaten_sekolah = $__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D, IdPropinsi FROM Kabupaten WHERE IdKabupaten = '". @$__session_kecamatan_sekolah->IdKabupaten ."' ORDER BY IdKabupaten DESC ");
    @$__session_provinsi_sekolah = $__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". @$__session_kabupaten_sekolah->IdPropinsi ."' ORDER BY IdPropinsi DESC ");

    @$__session_kecamatan_ortu = $__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D, IdKabupaten FROM Kecamatan WHERE IdKecamatan = '". @$__data_pmbregistrasi__->IdKecamatanAsalSmu ."' ORDER BY IdKabupaten DESC ");
    @$__session_kabupaten_ortu = $__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D, IdPropinsi FROM Kabupaten WHERE IdKabupaten = '". @$__session_kecamatan_ortu->IdKabupaten ."' ORDER BY IdKabupaten DESC ");
    @$__session_provinsi_ortu = $__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". @$__session_kabupaten_ortu->IdPropinsi ."' ORDER BY IdPropinsi DESC ");

?>

<div class="row">
    <div class="col-md-12 mb-2">
        <div class="accordion" id="accordionExample">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="heading-Biodata">
                    <button type="button" class="accordion-button bg-primary text-white" data-bs-toggle="collapse"
                        data-bs-target="#accordion-Biodata" aria-expanded="true" aria-controls="accordion-Biodata">
                        Biodata Diri
                    </button>
                </h2>
                <div id="accordion-Biodata" class="accordion-collapse collapse <?= isset($__ta) ? 'show' : ''; ?>"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Email
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Email" name="__Email"
                                        value="<?= $__authlogin__->Email; ?>" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Tahun Ajaran
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Tahun Ajaran"
                                        name="__TahunAjaran"
                                        value="<?= $__authlogin__->Ta . '/' . $__authlogin__->Semester; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        NIK
                                        <small class="text-danger">* Harus 16 Karakter</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="NIK" name="__Nik"
                                        onkeypress="return TextAngka(event)" maxlength="16"
                                        value="<?= isset($__data_pmbregistrasi__->Nik) ? $__data_pmbregistrasi__->Nik : $_SESSION['__Old__']['__Nik']; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nama Lengkap
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                        name="__NamaLengkap"
                                        value="<?= isset($__authlogin__->Nama) ? $__authlogin__->Nama : $_SESSION['__Old__']['__NamaLengkap']; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Jenis Kelamin
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                        name="__NamaLengkap"
                                        value="<?= $__authlogin__->JenisKelamin == 'LK' ? 'LAKI - LAKI' : 'PEREMPUAN'; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Status Menikah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                        name="__NamaLengkap" value="<?= $__data_pmbregistrasi__->Status; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Tempat Lahir
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Tempat Lahir"
                                        name="__TempatLahir"
                                        value="<?= isset($__authlogin__->TempatLahir) ? $__authlogin__->TempatLahir : $_SESSION['__Old__']['__TempatLahir']; ?>"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Tanggal Lahir
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="date" class="form-control" placeholder="Tanggal Lahir"
                                        name="__TglLahir"
                                        value="<?= isset($__authlogin__->TglLahir) ? date('Y-m-d', strtotime($__authlogin__->TglLahir)) : $_SESSION['__Old__']['TglLahir']; ?>"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Agama
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                        name="__NamaLengkap" value="<?= $__data_pmbregistrasi__->Agama; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Warga Negara
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                        name="__NamaLengkap" value="<?= $__data_pmbregistrasi__->WargaNegara; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nomor Handphone
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nomor Handphone" name="__NoTlp"
                                        value="<?= isset($__authlogin__->NoHp) ? $__authlogin__->NoHp : $_SESSION['__Old__']['__NoTlp']; ?>"
                                        onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nomor Whastapp
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nomor Whastapp" name="__NoWa"
                                        value="<?= isset($__authlogin__->NoWa) ? $__authlogin__->NoWa : $_SESSION['__Old__']['__NoWa']; ?>"
                                        onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Alamat
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__authlogin__->Alamat; ?>" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Provinsi
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__session_provinsi->D; ?>" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kabupaten
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__session_kabupaten->D; ?>" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kecamatan
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__session_kecamatan->D; ?>" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kelurahan
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Kelurahan" name="__Kelurahan"
                                        value="<?= $__data_pmbregistrasi__->Kelurahan; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Sumber Biaya
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__data_pmbregistrasi__->SumberBiaya; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nama Tempat Bekerja
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Tempat Bekerja"
                                        name="__NamaTempatKerja"
                                        value="<?= $__data_pmbregistrasi__->NamaTempatKerja; ?>" autocomplete="off"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-black">
                                        Alamat Tempat Kerja
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat Tempat Kerja"
                                        name="__AlamatTempatKerja" value="<?= $__data_pmbregistrasi__->AlamatKerja; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Berat Badan (Kg)
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Berat Badan (Kg)"
                                        name="__BeratBadan" value="<?= $__data_pmbregistrasi__->BeratBadan; ?>"
                                        onkeypress="return TextAngka(event)" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Tinggi Badan (Kg)
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Tinggi Badan (Kg)"
                                        name="__TinggiBadan" value="<?= $__data_pmbregistrasi__->TinggiBadan; ?>"
                                        onkeypress="return TextAngka(event)" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Hobby
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Hobby" name="__Hobby"
                                        value="<?= $__data_pmbregistrasi__->Hobi; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Ukuran Jaket
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Hobby" name="__Hobby"
                                        value="<?= $__data_pmbregistrasi__->UkuranJaket; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2">
        <div class="accordion" id="accordionExample">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="heading-AsalSekolah">
                    <button type="button" class="accordion-button bg-success text-white" data-bs-toggle="collapse"
                        data-bs-target="#accordion-AsalSekolah" aria-expanded="true"
                        aria-controls="accordion-AsalSekolah">
                        Asal Sekolah
                    </button>
                </h2>
                <div id="accordion-AsalSekolah" class="accordion-collapse collapse <?= isset($__ta) ? 'show' : ''; ?>"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Jenis SLTA
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__data_pmbregistrasi__->AsalSmu; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        NISN
                                        <small class="text-danger">* Harus 10 Karakter</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="NISN" maxlength="10"
                                        name="__Nisn" onkeypress="return TextAngka(event)"
                                        value="<?= $__data_pmbregistrasi__->Nisn; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nama Sekolah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Sekolah"
                                        name="__NamaSekolah" value="<?= $__data_pmbregistrasi__->NamaSekolah; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Jurusan Sekolah SMU/SMK/MAN
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                                        value="<?= $__data_pmbregistrasi__->JurusanSekolah; ?>" autocomplete="off"
                                        required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nomor Ijazah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nomor Ijazah"
                                        name="__NomorIjazah" onkeypress="return TextAngka(event)"
                                        value="<?= $__data_pmbregistrasi__->NoIjazah; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Jumlah Nilai SKHUN/NEM
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Jumlah Nilai SKHUN/NEM"
                                        name="__Nem" onkeypress="return TextAngka(event)" maxlength="5"
                                        value="<?= $__data_pmbregistrasi__->Nem; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-black">
                                        Alamat Sekolah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat Sekolah"
                                        name="__AlamatSekolah" value="<?= $__data_pmbregistrasi__->AlamatSekolah; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Provinsi Sekolah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat Sekolah"
                                        name="__AlamatSekolah" value="<?= $__session_provinsi_sekolah->D; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kabupaten Sekolah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat Sekolah"
                                        name="__AlamatSekolah" value="<?= $__session_kabupaten_sekolah->D; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kecamatan Sekolah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat Sekolah"
                                        name="__AlamatSekolah" value="<?= $__session_kecamatan_sekolah->D; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2">
        <div class="accordion" id="accordionExample">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="heading-OrangTua">
                    <button type="button" class="accordion-button bg-warning text-white" data-bs-toggle="collapse"
                        data-bs-target="#accordion-OrangTua" aria-expanded="true" aria-controls="accordion-OrangTua">
                        Orang Tua
                    </button>
                </h2>
                <div id="accordion-OrangTua" class="accordion-collapse collapse <?= isset($__ta) ? 'show' : ''; ?>"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nama Ayah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Ayah" name="__NamaAyah"
                                        value="<?= $__data_pmbregistrasi__->NamaAyah; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nama Ibu
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nama Ibu" name="__NamaIbu"
                                        value="<?= $__data_pmbregistrasi__->NamaIbu; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nomor Ayah
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nomor Ayah" name="__NoAyah"
                                        value="<?= $__data_pmbregistrasi__->NoAyah; ?>"
                                        onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Nomor Ibu
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Nomor Ibu" name="__NoIbu"
                                        value="<?= $__data_pmbregistrasi__->NoIbu; ?>"
                                        onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-black">
                                        Alamat
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="__AlamatOrtu"
                                        value="<?= $__data_pmbregistrasi__->AlamatOrtu; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Provinsi
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat " name="__Alamat"
                                        value="<?= $__session_provinsi_ortu->D; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kabupaten
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat " name="__Alamat"
                                        value="<?= $__session_kabupaten_ortu->D; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kecamatan
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Alamat " name="__Alamat"
                                        value="<?= $__session_kecamatan_ortu->D; ?>" autocomplete="off" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Kelurahan
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Kelurahan"
                                        name="__KelurahanOrtu"
                                        value="<?= isset($__data_pmbregistrasi__->KelurahanOrtu) ? $__data_pmbregistrasi__->KelurahanOrtu : $_SESSION['__Old__']['__KelurahanOrtu']; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Pekerjaan Orang Tua
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Kelurahan"
                                        name="__KelurahanOrtu" value="<?= $__data_pmbregistrasi__->PekerjaanOrtu; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-black">
                                        Penghasilan Orang Tua
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Kelurahan"
                                        name="__KelurahanOrtu" value="<?= $__data_pmbregistrasi__->PenghasilanOrtu; ?>"
                                        autocomplete="off" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2 float-right">
        <form name="frmInput" action="<?= url('/homerpl/pumb/pmbregistrasi/simpan'); ?>" method="POST"
            enctype="multipart/form-data">

            <input type="hidden" name="__Token" class="form-control"
                value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                required readonly>

            <input type="hidden" name="__Url" class="form-control"
                value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=6'); ?>" required readonly>

            <input type="hidden" name="__Url_Success" class="form-control" value="<?= url('/homerpl/pumb'); ?>" required
                readonly>

            <input type="hidden" name="__Id" class="form-control"
                value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
                required readonly>

            <input type="hidden" name="__NoPeserta" class="form-control"
                value="<?= $__data_pmbregistrasi__->NoPeserta; ?>" required readonly>

            <input type="hidden" name="__pumb" class="form-control" value="6" required readonly>

            <a href="<?= url('/homerpl/pumb/pmbregistrasi?pumb=5'); ?>" class="btn btn-danger">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                Pembayaran
            </button>
        </form>
    </div>
</div>