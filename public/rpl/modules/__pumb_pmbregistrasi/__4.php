<?php 

    @$__session_kecamatan = $__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D, IdKabupaten FROM Kecamatan WHERE IdKecamatan = '". @$__data_pmbregistrasi__->IdKecamatanAsalSmu ."' ORDER BY IdKabupaten DESC ");
    @$__session_kabupaten = $__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D, IdPropinsi FROM Kabupaten WHERE IdKabupaten = '". @$__session_kecamatan->IdKabupaten ."' ORDER BY IdKabupaten DESC ");
    @$__session_provinsi = $__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". @$__session_kabupaten->IdPropinsi ."' ORDER BY IdPropinsi DESC ");

?>

<form name="frmInput" action="<?= url('/homerpl/pumb/pmbregistrasi/simpan'); ?>" method="POST"
    enctype="multipart/form-data">

    <input type="hidden" name="__Token" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__Url" class="form-control" value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=4'); ?>"
        required readonly>

    <input type="hidden" name="__Url_Success" class="form-control"
        value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=5'); ?>" required readonly>

    <input type="hidden" name="__Id" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__NoPeserta" class="form-control" value="<?= $__data_pmbregistrasi__->NoPeserta; ?>"
        required readonly>

    <input type="hidden" name="__pumb" class="form-control" value="4" required readonly>

    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Jenis SLTA
                    <small class="text-danger">*</small>
                </label>
                <select name="__AsalSmu" class="form-control" required>
                    <?php 
                        @$__select_jenisslta = array(
                            'SMU' => 'SMU',
                            'SMK' => 'SMK',
                            'MAN' => 'MAN',
                            'LAINNYA' => 'LAINNYA',
                        );
                        if ( @$__data_pmbregistrasi__->AsalSmu == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->AsalSmu ."' selected>
                                        ". @$__data_pmbregistrasi__->AsalSmu ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_jenisslta AS $data => $jenisslta ) :

                            if ( @$__data_pmbregistrasi__->AsalSmu != @$jenisslta ) {
                                echo 
                                    "
                                        <option value='". @$jenisslta ."'>
                                            ". @$jenisslta ."
                                        </option>
                                    ";
                            }

                        endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    NISN
                    <small class="text-danger">* Harus 10 Karakter</small>
                </label>
                <input type="text" class="form-control" placeholder="NISN" maxlength="10" name="__Nisn"
                    onkeypress="return TextAngka(event)"
                    value="<?= isset($__data_pmbregistrasi__->Nisn) ? $__data_pmbregistrasi__->Nisn : $_SESSION['__Old__']['__Nisn']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nama Sekolah
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nama Sekolah" name="__NamaSekolah"
                    value="<?= isset($__data_pmbregistrasi__->NamaSekolah) ? $__data_pmbregistrasi__->NamaSekolah : $_SESSION['__Old__']['__NamaSekolah']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Jurusan Sekolah SMU/SMK/MAN
                    <small class="text-danger">*</small>
                </label>
                <select name="__JurusanSekolah" class="form-control" required>
                    <?php 
                        @$__select_jurusansekolah = array(
                            'IPA' => 'IPA',
                            'IPS' => 'IPS',
                        );
                        if ( @$__data_pmbregistrasi__->JurusanSekolah == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->JurusanSekolah ."' selected>
                                        ". @$__data_pmbregistrasi__->JurusanSekolah ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_jurusansekolah AS $data => $jurusansekolah ) :

                            if ( @$__data_pmbregistrasi__->JurusanSekolah != @$jurusansekolah ) {
                                echo 
                                    "
                                        <option value='". @$jurusansekolah ."'>
                                            ". @$jurusansekolah ."
                                        </option>
                                    ";
                            }

                        endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nomor Ijazah
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nomor Ijazah" name="__NomorIjazah"
                    onkeypress="return TextAngka(event)"
                    value="<?= isset($__data_pmbregistrasi__->NoIjazah) ? $__data_pmbregistrasi__->NoIjazah : $_SESSION['__Old__']['__NoIjazah']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Jumlah Nilai SKHUN/NEM
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Jumlah Nilai SKHUN/NEM" name="__Nem"
                    onkeypress="return TextAngka(event)" maxlength="5"
                    value="<?= isset($__data_pmbregistrasi__->Nem) ? $__data_pmbregistrasi__->Nem : $_SESSION['__Old__']['__Nem']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="text-black">
                    Alamat Sekolah
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Alamat Sekolah" name="__AlamatSekolah"
                    value="<?= isset($__data_pmbregistrasi__->AlamatSekolah) ? $__data_pmbregistrasi__->AlamatSekolah : $_SESSION['__Old__']['__AlamatSekolah']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Provinsi Sekolah
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__ProvinsSekolah" required
                        id="selectProvinsiSekolah">
                        <?php 
                            if ( isset( $__session_provinsi->Id ) ) {

                                echo 
                                    "
                                        <option value='". @$__session_provinsi->Id ."' selected>
                                            ". @$__session_provinsi->D ."
                                        </option>
                                        <option value='' disabled>--- ##### ---</option>
                                    ";

                            } else {

                                echo "<option value='' selected disabled>--- Pilih Provinsi ---</option>";
                            
                            }

                            @$__provinsi = $__db->query(" SELECT IdPropinsi AS Id, Propinsi AS P FROM Propinsi ORDER BY IdPropinsi ASC ");
                                
                                foreach ( $__provinsi AS $data => $provinsi ) :

                                    echo 
                                        "
                                            <option value='". @$provinsi->Id ."'>
                                                ". @$provinsi->P ."
                                            </option>
                                        ";

                                endforeach;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Kabupaten Sekolah
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__KabupatenSekolah" required
                        id="selectKabupatenSekolah">

                        <?php 
                            if ( isset( $__session_kabupaten->Id ) ) {

                                echo 
                                    "
                                        <option value='". @$__session_kabupaten->Id ."' selected>
                                            ". @$__session_kabupaten->D ."
                                        </option>
                                        <option value='' disabled>--- ##### ---</option>
                                    ";

                            }
                        ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Kecamatan Sekolah
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__KecamatanSekolah" required
                        id="selectKecamatanSekolah">

                        <?php
                            if ( isset( $__session_kecamatan->Id ) ) {

                                echo 
                                    "
                                        <option value='". @$__session_kecamatan->Id ."' selected>
                                            ". @$__session_kecamatan->D ."
                                        </option>
                                        <option value='' disabled>--- ##### ---</option>
                                    ";

                            }
                        ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    ID Kecamatan Sekolah
                    <small class="text-danger">*</small>
                </label>
                <select class="form-control select2-kedua" name="__IdKecamatanSekolah" required
                    id="selectIdKecamatanSekolah">

                    <?php
                        if ( isset( $__session_kecamatan->Id ) ) {

                            echo 
                                "
                                    <option value='". @$__session_kecamatan->Id ."' selected>
                                        ". @$__session_kecamatan->Id ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";

                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-12 mb-2 float-right">
            <a href="<?= url('/homerpl/pumb/pmbregistrasi?pumb=2'); ?>" class="btn btn-danger">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                Selanjutnya
            </button>
        </div>
    </div>
</form>