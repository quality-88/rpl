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
                    Nomor Dokumen
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
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Kode
                                    </label>
                                    <input name="__Kode" class="form-control" autocomplete="off" placeholder="Kode"
                                        value="<?= isset($_SESSION['__Old__']['__Kode']) ? $_SESSION['__Old__']['__Kode'] : $__record_data__->Kode; ?>"
                                        required>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Kode']) ? $_SESSION['__Form_Notifikasi__']['__Kode'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Nama
                                    </label>
                                    <input name="__Nama" class="form-control" autocomplete="off" placeholder="Nama"
                                        value="<?= isset($_SESSION['__Old__']['__Nama']) ? $_SESSION['__Old__']['__Nama'] : $__record_data__->Nama; ?>"
                                        required>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Nama']) ? $_SESSION['__Form_Notifikasi__']['__Nama'] : ''; ?>
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