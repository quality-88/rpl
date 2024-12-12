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
                    Keterangan Dokumen
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>/ubah?__Id=<?= $_GET['__Id']; ?>">
                    Ubah
                </a>
            </li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Data Ubah
                </h5>
                <div class="card-body">
                    <form name="frmInput" action="<?= $__routes_mod; ?>/ubah/simpan" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="__Token" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <input type="hidden" name="__Url" class="form-control"
                            value="<?= $__routes_mod; ?>/ubah?__Id=<?= $_GET['__Id']; ?>" required readonly>

                        <input type="hidden" name="__Url_Success" class="form-control" value="<?= $__routes_mod; ?>"
                            required readonly>

                        <input type="hidden" name="__Id" class="form-control" value="<?= @$_GET['__Id']; ?>" required
                            readonly>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Judul
                                    </label>
                                    <input name="__Judul" class="form-control" autocomplete="off" placeholder="Judul"
                                        value="<?= isset($_SESSION['__Old__']['__Judul']) ? $_SESSION['__Old__']['__Judul'] : $__record_data__->Judul; ?>"
                                        required>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Judul']) ? $_SESSION['__Form_Notifikasi__']['__Judul'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12  mb-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Format File
                                    </label>
                                    <select name="__Format" class="form-control" required>
                                        <?php 
                                            if ( isset($__record_data__->Format) ) {

                                                echo 
                                                    "
                                                        <option value='". $__record_data__->Format ."' selected>
                                                            ". $__record_data__->Format ."
                                                        </option>
                                                        <option disabled>
                                                            --- Pilih Format File ---
                                                        </option>
                                                    ";

                                            } elseif ( isset($_SESSION['__Old__']['__Format']) ) {

                                                echo 
                                                    "
                                                        <option value='". $_SESSION['__Old__']['__Format'] ."' selected>
                                                            ". $_SESSION['__Old__']['__Format'] ."
                                                        </option>
                                                        <option disabled>
                                                            --- Pilih Format File ---
                                                        </option>
                                                    ";

                                            } else {

                                                echo 
                                                    "
                                                        <option selected disabled>
                                                            --- Pilih Format File ---
                                                        </option>
                                                    ";

                                            }

                                            foreach ( $__filter_formatfile__ AS $data => $__formatfile__ ) :

                                                echo 
                                                    "
                                                        <option value='". $__formatfile__ ."'>
                                                            ". $__formatfile__ ."
                                                        </option>
                                                    ";

                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Ukuran File <strong class="text-danger">MB</strong>
                                    </label>
                                    <input type="text" name="__Ukuran" class="form-control" autocomplete="off"
                                        placeholder="Ukuran" maxlength="2" onkeypress="return TextAngka(event)"
                                        value="<?= isset($_SESSION['__Old__']['__Ukuran']) ? $_SESSION['__Old__']['__Ukuran'] :  $__record_data__->Ukuran; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Isi Pengantar
                                    </label>
                                    <textarea name="__Isi" class="ckeditor" id="ckedtor" autocomplete="off"
                                        minlength="25">
                                                <?= isset($_SESSION['__Old__']['__Isi']) ? $_SESSION['__Old__']['__Isi'] :  $__record_data__->Isi; ?>
                                            </textarea>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Isi']) ? $_SESSION['__Form_Notifikasi__']['__Isi'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Simpan">
                                        Simpan
                                    </button>
                                    <a href="<?= $__routes_mod; ?>" class="btn btn-danger" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Kembali">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>