<form name="frmInput" action="<?= url('/homerpl/pumb/pmbregistrasi/simpan'); ?>" method="POST"
    enctype="multipart/form-data">

    <input type="hidden" name="__Token" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__Url" class="form-control" value="<?= url('/homerpl/pumb/pmbregistrasi'); ?>" required
        readonly>

    <input type="hidden" name="__Url_Success" class="form-control"
        value="<?= url('/homerpl/pumb/pmbregistrasi?pumb=2'); ?>" required readonly>

    <input type="hidden" name="__Id" class="form-control"
        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
        required readonly>

    <input type="hidden" name="__NoPeserta" class="form-control" value="<?= $__data_pmbregistrasi__->NoPeserta; ?>"
        required readonly>

    <input type="hidden" name="__pumb" class="form-control" value="1" required readonly>

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
                <input type="text" class="form-control" placeholder="Tahun Ajaran" name="__TahunAjaran"
                    value="<?= $__authlogin__->Ta . '/' . $__authlogin__->Semester; ?>" autocomplete="off" required
                    readonly>
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
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Nama Lengkap
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nama Lengkap" name="__NamaLengkap"
                    value="<?= isset($__authlogin__->Nama) ? $__authlogin__->Nama : $_SESSION['__Old__']['__NamaLengkap']; ?>"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Jenis Kelamin
                    <small class="text-danger">*</small>
                </label>
                <select name="__JenisKelamin" class="form-control" required>
                    <?php 
                        if ( isset($__authlogin__->JenisKelamin) ) {

                            $__get_jeniskelamin__ = $__authlogin__->JenisKelamin == 'LK' ? 'LAKI - LAKI' : 'PEREMPUAN';

                            echo 
                                "
                                    <option value='". $__authlogin__->JenisKelamin ."' selected>
                                        ". $__get_jeniskelamin__ ."
                                    </option>
                                    <option value='' disabled>
                                        --- ##### ---
                                    </option>
                                ";

                        } else {

                            echo 
                                "
                                    <option value='' disabled>
                                        --- Pilih Jenis Kelamin ---
                                    </option>
                                ";

                        }

                        foreach ( $__filter_jeniskelamin__ AS $data => $__jeniskelamin__ ) :

                            if ( $__authlogin__->JenisKelamin != $data ) {

                                echo 
                                    "
                                        <option value='". $data ."'>
                                            ". $__jeniskelamin__ ."
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
                    Status Menikah
                    <small class="text-danger">*</small>
                </label>
                <select name="__StatusMenikah" class="form-control" required>
                    <?php 
                        @$__select_statusmenikah = array(
                            'S' => 'Belum Menikah',
                            'M' => 'Menikah',
                            'C' => 'Duda/Janda',
                        );
                        if ( @$__data_pmbregistrasi__->Status == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->Status ."' selected>
                                        ". @$__data_pmbregistrasi__->Status ."
                                    </option>
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        foreach ( $__select_statusmenikah AS $data => $statusmenikah ) :

                            if ( @$__data_pmbregistrasi__->Status != @$statusmenikah ) {
                                echo 
                                    "
                                        <option value='". @$statusmenikah ."'>
                                            ". @$statusmenikah ."
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
                    Tempat Lahir
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Tempat Lahir" name="__TempatLahir"
                    value="<?= isset($__authlogin__->TempatLahir) ? $__authlogin__->TempatLahir : $_SESSION['__Old__']['__TempatLahir']; ?>"
                    required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Tanggal Lahir
                    <small class="text-danger">*</small>
                </label>
                <input type="date" class="form-control" placeholder="Tanggal Lahir" name="__TglLahir"
                    value="<?= isset($__authlogin__->TglLahir) ? date('Y-m-d', strtotime($__authlogin__->TglLahir)) : $_SESSION['__Old__']['TglLahir']; ?>"
                    required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-black">
                    Agama
                    <small class="text-danger">*</small>
                </label>
                <select name="__Agama" class="form-control" required>
                    <?php 
                        if ( @$__data_pmbregistrasi__->Agama == TRUE ) {
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->Agama ."' selected>
                                        ". @$__data_pmbregistrasi__->Agama ."
                                    </option>]
                                    <option value='' disabled>--- ##### ---</option>
                                ";
                        }

                        @$__select_agama = $this->__db->query(" SELECT IdPrimary AS Id, Agama, Keterangan FROM Agama ORDER BY IdPrimary ASC ");

                        foreach ( $__select_agama AS $data => $agama ) :

                            if ( @$__data_pmbregistrasi__->Agama != @$agama->Keterangan ) {
                                echo 
                                    "
                                        <option value='". @$agama->Keterangan ."'>
                                            ". @$agama->Keterangan ."
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
                    Warga Negara
                    <small class="text-danger">*</small>
                </label>
                <select name="__WargaNegara" class="form-control" required>
                    <?php 
                        @$__select_warganegara = array(
                            'WNI' => 'Warga Negara Indonesia',
                            'WNA' => 'Warga Negara Asing',
                        );
                        if ( @$__data_pmbregistrasi__->WargaNegara == TRUE ) {
                            if ( @$__data_pmbregistrasi__->WargaNegara == 'WNI' ) {
                                @$__get_warganegara = 'Warga Negara Indonesia';
                            } elseif ( @$__data_pmbregistrasi__->WargaNegara == 'WNA' ) {
                                @$__get_warganegara = 'Warga Negara Asing';
                            } else {
                                @$__get_warganegara = '';
                            }
                            echo 
                                "
                                    <option value='". @$__data_pmbregistrasi__->WargaNegara ."' selected>
                                        ". @$__get_warganegara ."
                                    </option>
                                ";
                        }

                        foreach ( $__select_warganegara AS $data => $warganegara ) :

                            if ( @$__data_pmbregistrasi__->WargaNegara != @$data ) {
                                echo 
                                    "
                                        <option value='". @$data ."'>
                                            ". @$warganegara ."
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
                    Nomor Handphone
                    <small class="text-danger">*</small>
                </label>
                <input type="text" class="form-control" placeholder="Nomor Handphone" name="__NoTlp"
                    value="<?= isset($__authlogin__->NoHp) ? $__authlogin__->NoHp : $_SESSION['__Old__']['__NoTlp']; ?>"
                    onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required>
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
                    onkeypress="return TextAngka(event)" maxlength="13" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-12 mb-2 float-right">
            <button type="submit" class="btn btn-primary">
                Selanjutnya
            </button>
        </div>
    </div>
</form>