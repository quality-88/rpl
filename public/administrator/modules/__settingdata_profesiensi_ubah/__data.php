<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= $__routes; ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/settingdata_evaluasidiri'); ?>">
                    Evaluasi Diri
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>?__Id=<?= $_GET['__Id']; ?>">
                    Profesiensi
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>/ubah?__Id=<?= $_GET['__Id']; ?>&__Id2=<?= $_GET['__Id2']; ?>">
                    Ubah
                </a>
            </li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3>
                <?= $__record_data_evaluasidiri__->Judul; ?>
            </h3>
        </div>
    </div>
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
                            value="<?= $__routes_mod; ?>/ubah?__Id=<?= $_GET['__Id']; ?>&__Id2=<?= $_GET['__Id2']; ?>"
                            required readonly>

                        <input type="hidden" name="__Url_Success" class="form-control"
                            value="<?= $__routes_mod; ?>?__Id=<?= $_GET['__Id']; ?>" required readonly>

                        <input type="hidden" name="__Id" class="form-control" value="<?= $_GET['__Id']; ?>" required
                            readonly>

                        <input type="hidden" name="__Id2" class="form-control" value="<?= $_GET['__Id2']; ?>" required
                            readonly>

                        <div class="form-group my-lg-4">
                            <label class="mb-2">
                                Judul
                            </label>
                            <input name="__Judul" class="form-control" autocomplete="off" placeholder="Judul"
                                value="<?= isset($_SESSION['__Old__']['__Judul']) ? $_SESSION['__Old__']['__Judul'] : @$__record_data__->Judul; ?>"
                                required>
                        </div>
                        <div class="form-group my-lg-4">
                            <label class="mb-2">
                                Isi Uraian
                            </label>
                            <textarea name="__Isi" class="ckeditor" id="ckedtor" autocomplete="off" minlength="25">
                                <?= isset($_SESSION['__Old__']['__Isi']) ? $_SESSION['__Old__']['__Isi'] : htmlspecialchars_decode( @$__record_data__->Isi ); ?>
                            </textarea>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                data-bs-placement="top" data-bs-html="true" title="Simpan">
                                Simpan
                            </button>
                            <a href="<?= $__routes_mod; ?>?__Id=<?= $_GET['__Id']; ?>" class="btn btn-danger"
                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                data-bs-html="true" title="Kembali">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>