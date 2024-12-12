<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= $__routes; ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>">
                    Berkas
                </a>
            </li>
        </ol>
    </nav>
</div>
<div class="container-xxl">
    <div class="row">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="nav-align-top mb-6">
                <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>" class="nav-link active">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Berkas Penting
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                    <?php if ( $__authlogin__->Jenis == 'TP' ) { ?>
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>/2" class="nav-link">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-buildings bx-sm me-1_5 align-text-bottom"></i>
                                Berkas Pendukung
                            </span>
                            <i class="bx bx-buildings bx-sm d-sm-none"></i>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="row g-6 mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <p>
                                    Pengisian <code>File Pendukung</code>.
                                    <br>
                                    <strong class="text-danger">
                                        Format PDF, Ukuran Maksimal 2 MB
                                    </strong>
                                </p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <form name="frmInput" action="<?= $__routes_mod; ?>/ktp" method="POST"
                                    enctype="multipart/form-data">

                                    <input type="hidden" name="__Token" class="form-control"
                                        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                        required readonly>

                                    <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                        required readonly>

                                    <input type="hidden" name="__Url_Success" class="form-control"
                                        value="<?= $__routes_mod; ?>" required readonly>

                                    <input type="hidden" name="__Id" class="form-control"
                                        value="<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>" required
                                        readonly>

                                    <label>
                                        KTP
                                    </label>
                                    <input type="file" name="__Ktp" class="form-control mb-lg-4" required
                                        onchange="this.form.submit()">
                                    <?php 
                                        if ( isset($__authlogin__->FileKtp) ) {
                                            echo 
                                                "
                                                    <a href='". $__url_file . $__authlogin__->FileKtp ."' target='_Blank'>
                                                        $__authlogin__->FileKtp
                                                    </a>
                                                ";
                                        }
                                    ?>
                                    <hr>
                                </form>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <form name="frmInput" action="<?= $__routes_mod; ?>/kk" method="POST"
                                    enctype="multipart/form-data">

                                    <input type="hidden" name="__Token" class="form-control"
                                        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                        required readonly>

                                    <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                        required readonly>

                                    <input type="hidden" name="__Url_Success" class="form-control"
                                        value="<?= $__routes_mod; ?>" required readonly>

                                    <input type="hidden" name="__Id" class="form-control"
                                        value="<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>" required
                                        readonly>

                                    <label>
                                        Ijazah
                                    </label>
                                    <input type="file" name="__Kk" class="form-control mb-lg-4" required
                                        onchange="this.form.submit()">
                                    <?php 
                                        if ( isset($__authlogin__->FileKk) ) {
                                            echo 
                                                "
                                                    <a href='". $__url_file . $__authlogin__->FileKk ."' target='_Blank'>
                                                        $__authlogin__->FileKk
                                                    </a>
                                                ";
                                        }
                                    ?>
                                    <hr>
                                </form>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <form name="frmInput" action="<?= $__routes_mod; ?>/nilai" method="POST"
                                    enctype="multipart/form-data">

                                    <input type="hidden" name="__Token" class="form-control"
                                        value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                        required readonly>

                                    <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                        required readonly>

                                    <input type="hidden" name="__Url_Success" class="form-control"
                                        value="<?= $__routes_mod; ?>" required readonly>

                                    <input type="hidden" name="__Id" class="form-control"
                                        value="<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>" required
                                        readonly>

                                    <label>
                                        Transkip Nilai
                                    </label>
                                    <input type="file" name="__Nilai" class="form-control mb-lg-4" required
                                        onchange="this.form.submit()">
                                    <?php 
                                        if ( isset($__authlogin__->FileNilai) ) {
                                            echo 
                                                "
                                                    <a href='". $__url_file . $__authlogin__->FileNilai ."' target='_Blank'>
                                                        $__authlogin__->FileNilai
                                                    </a>
                                                ";
                                        }
                                    ?>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>