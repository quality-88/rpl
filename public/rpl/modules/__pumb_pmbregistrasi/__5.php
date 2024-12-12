<?php 

    @$__session_kecamatan = $__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D, IdKabupaten FROM Kecamatan WHERE IdKecamatan = '". @$__data_pmbregistrasi__->IdKecamatanOrtu ."' ORDER BY IdKabupaten DESC ");
    @$__session_kabupaten = $__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D, IdPropinsi FROM Kabupaten WHERE IdKabupaten = '". @$__session_kecamatan->IdKabupaten ."' ORDER BY IdKabupaten DESC ");
    @$__session_provinsi = $__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". @$__session_kabupaten->IdPropinsi ."' ORDER BY IdPropinsi DESC ");

?>

<form name="frmInput" action="<?= url('/homerpl/pumb/pmbregistrasi/simpan'); ?>" method="POST"
    enctype="multipart/form-data">

    <input type="hidden" name="__Token" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__Url" class="form-control" value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=5'); ?>"
        required readonly>

    <input type="hidden" name="__Url_Success" class="form-control"
        value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=6'); ?>" required readonly>

    <input type="hidden" name="__Id" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__NoPeserta" class="form-control" value="<?= $__data_pmbregistrasi__->NoPeserta; ?>"
        required readonly>

    <input type="hidden" name="__pumb" class="form-control" value="5" required readonly>

    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nama Ayah
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nama Ayah" name="__NamaAyah"
                    value="<?= isset($__data_pmbregistrasi__->NamaAyah) ? $__data_pmbregistrasi__->NamaAyah : $_SESSION['__Old__']['__NamaAyah']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nama Ibu
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nama Ibu" name="__NamaIbu"
                    value="<?= isset($__data_pmbregistrasi__->NamaIbu) ? $__data_pmbregistrasi__->NamaIbu : $_SESSION['__Old__']['__NamaIbu']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nomor Ayah
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nomor Ayah" name="__NoAyah"
                    value="<?= isset($__data_pmbregistrasi__->NoAyah) ? $__data_pmbregistrasi__->NoAyah : $_SESSION['__Old__']['__NoAyah']; ?>"
                    onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nomor Ibu
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nomor Ibu" name="__NoIbu"
                    value="<?= isset($__data_pmbregistrasi__->NoIbu) ? $__data_pmbregistrasi__->NoIbu : $_SESSION['__Old__']['__NoIbu']; ?>"
                    onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="text-black">
                    Alamat
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Alamat" name="__AlamatOrtu"
                    value="<?= isset($__data_pmbregistrasi__->AlamatOrtu) ? $__data_pmbregistrasi__->AlamatOrtu : $_SESSION['__Old__']['__AlamatOrtu']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Provinsi
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__ProvinsOrtu" required id="selectProvinsiOrtu">
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
                    Kabupaten
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__KabupatenOrtu" required id="selectKabupatenOrtu">

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
                    Kecamatan
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__KecamatanOrtu" required id="selectKecamatanOrtu">

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
                    ID Kecamatan
                    <small class="text-danger">*</small>
                </label>
                <select class="form-control select2-kedua" name="__IdKecamatanOrtu" required id="selectIdKecamatanOrtu">

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
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Kelurahan
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Kelurahan" name="__KelurahanOrtu"
                    value="<?= isset($__data_pmbregistrasi__->KelurahanOrtu) ? $__data_pmbregistrasi__->KelurahanOrtu : $_SESSION['__Old__']['__KelurahanOrtu']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Pekerjaan Orang Tua
                    <small class="text-danger">*</small>
                </label>
                <select name="__PekerjaanOrtu" class="form-control" required>
                    <?php 
                        @$__select_pekerjaan_ortu = array(
                            '1' => 'PNS',
                            '2' => 'TNI',
                            '3' => 'Pegawai Swasta',
                            '4' => 'Petani',
                            '5' => 'Kepolisian',
                            '6' => 'Wirawasta',
                            '7' => 'Lainnya',
                        );
                        if ( @$__data_pmbregistrasi__->PekerjaanOrtu == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->PekerjaanOrtu ."' selected>
                                        ". @$__data_pmbregistrasi__->PekerjaanOrtu ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_pekerjaan_ortu AS $data => $pekerjaan_ortu ) :

                            if ( @$__data_pmbregistrasi__->PekerjaanOrtu != @$pekerjaan_ortu ) {
                                echo 
                                    "
                                        <option value='". @$pekerjaan_ortu ."'>
                                            ". @$pekerjaan_ortu ."
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
                    Penghasilan Orang Tua
                    <small class="text-danger">*</small>
                </label>
                <select name="__PenghasilanOrtu" class="form-control" required>
                    <?php 
                        @$__select_penghasilan_ortu = array(
                            '1' => '< Rp. 1.000.000,-',
                            '2' => 'Rp. 1.000.000,- s/d Rp. 2.000.000,-',
                            '3' => 'Rp. 2.000.000,- s/d Rp. 5.000.000,-',
                            '4' => '> Rp. 5.000.000,-',
                        );
                        if ( @$__data_pmbregistrasi__->PenghasilanOrtu == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->PenghasilanOrtu ."' selected>
                                        ". @$__data_pmbregistrasi__->PenghasilanOrtu ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_penghasilan_ortu AS $data => $penghasilan_ortu ) :

                            if ( @$__data_pmbregistrasi__->PenghasilanOrtu != @$penghasilan_ortu ) {
                                echo 
                                    "
                                        <option value='". @$penghasilan_ortu ."'>
                                            ". @$penghasilan_ortu ."
                                        </option>
                                    ";
                            }

                        endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-12 mb-2 float-right">
            <a href="<?= url('/homerpl/pumb/pmbregistrasi?pumb=4'); ?>" class="btn btn-danger">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                Selanjutnya
            </button>
        </div>
    </div>
</form>