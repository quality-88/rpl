<?php 

    @$__session_kecamatan = $__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D, IdKabupaten FROM Kecamatan WHERE IdKecamatan = '". @$__data_pmbregistrasi__->IdKecamatan ."' ORDER BY IdKabupaten DESC ");
    @$__session_kabupaten = $__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D, IdPropinsi FROM Kabupaten WHERE IdKabupaten = '". @$__session_kecamatan->IdKabupaten ."' ORDER BY IdKabupaten DESC ");
    @$__session_provinsi = $__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". @$__session_kabupaten->IdPropinsi ."' ORDER BY IdPropinsi DESC ");

?>


<form name="frmInput" action="<?= url('/homerpl/pumb/pmbregistrasi/simpan'); ?>" method="POST"
    enctype="multipart/form-data">

    <input type="hidden" name="__Token" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__Url" class="form-control" value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=2'); ?>"
        required readonly>

    <input type="hidden" name="__Url_Success" class="form-control"
        value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=3'); ?>" required readonly>

    <input type="hidden" name="__Id" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__NoPeserta" class="form-control" value="<?= $__data_pmbregistrasi__->NoPeserta; ?>"
        required readonly>

    <input type="hidden" name="__pumb" class="form-control" value="2" required readonly>

    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Alamat
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Alamat" name="__Alamat"
                    value="<?= $__authlogin__->Alamat; ?>" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Provinsi
                    <small class="text-danger">*</small>
                </label>
                <div class="select2-input">
                    <select class="form-control select2-kedua" name="__Provinsi" required id="selectProvinsiTinggal">
                        <?php 
                            if ( isset( $__session_provinsi->Id ) ) {

                                echo 
                                    "
                                        <option value='". $__session_provinsi->Id ."' selected>
                                            ". $__session_provinsi->D ."
                                        </option>
                                        <option value='' disabled>--- ##### ---</option>
                                    ";

                            }  else {

                                echo "<option value='' selected disabled>--- Pilih Provinsi ---</option>";
                            
                            }

                            $__filter_provinsi__ = $__db->query(" SELECT IdPropinsi AS Id, Propinsi AS P FROM Propinsi ORDER BY IdPropinsi ASC ");
                                
                                foreach ( $__filter_provinsi__ AS $data => $__provinsi__ ) :

                                    echo 
                                        "
                                            <option value='". $__provinsi__->Id ."'>
                                                ". $__provinsi__->P ."
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
                    <select class="form-control select2-kedua" name="__Kabupaten" required id="selectKabupatenTinggal">

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
                    <select class="form-control select2-kedua" name="__Kecamatan" required id="selectKecamatanTinggal">

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
                <select class="form-control select2-kedua" name="__IdKecamatan" required id="selectIdKecamatanTinggal">

                    <?php 
                        if ( isset( $__session_kecamatan->Id ) ) {

                            echo 
                                "
                                    <option value='". @$__session_kecamatan->Id ."' selected>
                                        ". @$__session_kecamatan->Id."
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
                <input type="text" class="form-control" placeholder="Kelurahan" name="__Kelurahan"
                    value="<?= isset($__data_pmbregistrasi__->Kelurahan) ? $__data_pmbregistrasi__->Kelurahan : $_SESSION['__Old__']['__Kelurahan']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-12 mb-2 float-right">
            <a href="<?= url('/homerpl/pumb/pmbregistrasi'); ?>" class="btn btn-danger">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                Selanjutnya
            </button>
        </div>
    </div>
</form>