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
                    List Asseor
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
                                        Tahun Ajaran
                                    </label>
                                    <input name="__Ta" class="form-control" autocomplete="off" placeholder="Ta"
                                        value="<?= isset($_SESSION['__Old__']['__Ta']) ? $_SESSION['__Old__']['__Ta'] : $__record_data__->Ta; ?>"
                                        required readonly>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Ta']) ? $_SESSION['__Form_Notifikasi__']['__Ta'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Semester
                                    </label>
                                    <input name="__Semester" class="form-control" autocomplete="off"
                                        placeholder="Semester"
                                        value="<?= isset($_SESSION['__Old__']['__Semester']) ? $_SESSION['__Old__']['__Semester'] : $__record_data__->Semester; ?>"
                                        required readonly>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Semester']) ? $_SESSION['__Form_Notifikasi__']['__Semester'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Assesor
                                    </label>
                                    <input name="__Assesor" class="form-control" autocomplete="off"
                                        placeholder="Assesor"
                                        value="<?= isset($_SESSION['__Old__']['__Assesor']) ? $_SESSION['__Old__']['__Assesor'] : $__data_dosen__->Id . ' - ' . $__data_dosen__->Nama; ?>"
                                        required readonly>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Assesor']) ? $_SESSION['__Form_Notifikasi__']['__Assesor'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <div class="form-group">
                                    <label class="mb-2">
                                        Prodi
                                    </label>
                                    <input name="__Prodi" class="form-control" autocomplete="off" placeholder="Prodi"
                                        value="<?= isset($_SESSION['__Old__']['__Prodi']) ? $_SESSION['__Old__']['__Prodi'] : $__record_data__->Prodi; ?>"
                                        required readonly>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Prodi']) ? $_SESSION['__Form_Notifikasi__']['__Prodi'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="select2-input">
                                    <div class="form-group">
                                        <label>
                                            Pilih Kuota
                                        </label>
                                        <select name="__Kuota" class="form-control select2-kedua" required>
                                            <?php 
                                                echo 
                                                    "
                                                        <option value='". $__record_data__->Kuota ."' selected>
                                                            ". $__record_data__->Kuota ."
                                                        </option>
                                                        <option value='' disabled>
                                                            --- Pilih Kuota ---
                                                        </option>
                                                    ";

                                                for ( $x = 1; $x <= $__filter_kuota__; $x++ ) :

                                                    // if ( $__record_data__->Kuota > $x ) {

                                                        echo 
                                                            "
                                                                <option value='". $x ."'>
                                                                    ". $x ."
                                                                </option>
                                                            ";

                                                    // }

                                                endfor;

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="form-group">
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