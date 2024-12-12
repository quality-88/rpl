<form name="frmInput" action="<?= url('/homerpl/pumb/pmbregistrasi/simpan'); ?>" method="POST"
    enctype="multipart/form-data">

    <input type="hidden" name="__Token" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__Url" class="form-control" value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=3'); ?>"
        required readonly>

    <input type="hidden" name="__Url_Success" class="form-control"
        value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=4'); ?>" required readonly>

    <input type="hidden" name="__Id" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__NoPeserta" class="form-control" value="<?= $__data_pmbregistrasi__->NoPeserta; ?>"
        required readonly>

    <input type="hidden" name="__pumb" class="form-control" value="3" required readonly>

    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Sumber Biaya
                    <small class="text-danger">*</small>
                </label>
                <select name="__SumberBiaya" class="form-control" required>
                    <?php 
                        @$__select_sumberbiaya = array(
                            'O' => 'Orang Tua',
                            'W' => 'Wali',
                            'S' => 'Sendiri',
                        );
                        if ( @$__data_pmbregistrasi__->SumberBiaya == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->SumberBiaya ."' selected>
                                        ". @$__data_pmbregistrasi__->SumberBiaya ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_sumberbiaya AS $data => $sumberbiaya ) :

                            if ( @$__data_pmbregistrasi__->SumberBiaya != @$sumberbiaya ) {
                                echo 
                                    "
                                        <option value='". @$sumberbiaya ."'>
                                            ". @$sumberbiaya ."
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
                    Nama Tempat Bekerja
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nama Tempat Bekerja" name="__NamaTempatKerja"
                    value="<?= isset($__data_pmbregistrasi__->NamaTempatKerja) ? $__data_pmbregistrasi__->NamaTempatKerja : $_SESSION['__Old__']['__NamaTempatKerja']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="text-black">
                    Alamat Tempat Kerja
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Alamat Tempat Kerja" name="__AlamatTempatKerja"
                    value="<?= isset($__data_pmbregistrasi__->AlamatKerja) ? $__data_pmbregistrasi__->AlamatKerja : $_SESSION['__Old__']['__AlamatTempatKerja']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Berat Badan (Kg)
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Berat Badan (Kg)" name="__BeratBadan"
                    value="<?= isset($__data_pmbregistrasi__->BeratBadan) ? $__data_pmbregistrasi__->BeratBadan : $_SESSION['__Old__']['__BeratBadan']; ?>"
                    onkeypress="return TextAngka(event)" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Tinggi Badan (Kg)
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Tinggi Badan (Kg)" name="__TinggiBadan"
                    value="<?= isset($__data_pmbregistrasi__->TinggiBadan) ? $__data_pmbregistrasi__->TinggiBadan : $_SESSION['__Old__']['__TinggiBadan']; ?>"
                    onkeypress="return TextAngka(event)" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Hobby
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Hobby" name="__Hobby"
                    value="<?= isset($__data_pmbregistrasi__->Hobi) ? $__data_pmbregistrasi__->Hobi : $_SESSION['__Old__']['__Hobby']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Ukuran Jaket
                    <small class="text-danger">*</small>
                </label>
                <select name="__UkuranJaket" class="form-control" required>
                    <?php 
                        @$__select_ukuranjaket = array(
                            'S' => 'S',
                            'M' => 'M',
                            'L' => 'L',
                            'XL' => 'XL',
                        );
                        if ( @$__data_pmbregistrasi__->UkuranJaket == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->UkuranJaket ."' selected>
                                        ". @$__data_pmbregistrasi__->UkuranJaket ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_ukuranjaket AS $data => $ukuranjaket ) :

                            if ( @$__data_pmbregistrasi__->UkuranJaket != @$data ) {
                                echo 
                                    "
                                        <option value='". @$ukuranjaket ."'>
                                            ". @$ukuranjaket ."
                                        </option>
                                    ";
                            }

                        endforeach;
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