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
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Tambah">
                        <button type="button" class="accordion-button bg-primary text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Tambah" aria-expanded="true" aria-controls="accordion-Tambah">
                            Tambah Data
                        </button>
                    </h2>
                    <div id="accordion-Tambah" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form name="frmInput" action="<?= $__routes_mod; ?>/simpan" method="POST"
                                enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                    required readonly>

                                <input type="hidden" name="__Id" class="form-control" value="<?= $_GET['__Id']; ?>"
                                    required readonly>

                                <div class="form-group my-lg-4">
                                    <label class="mb-2">
                                        Judul
                                    </label>
                                    <input name="__Judul" class="form-control" autocomplete="off" placeholder="Judul"
                                        value="<?= isset($_SESSION['__Old__']['__Judul']) ? $_SESSION['__Old__']['__Judul'] : ''; ?>"
                                        required>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Judul']) ? $_SESSION['__Form_Notifikasi__']['__Judul'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group my-lg-4">
                                    <label class="mb-2">
                                        Isi Uraian
                                    </label>
                                    <textarea name="__Isi" class="ckeditor" id="ckedtor" autocomplete="off"
                                        minlength="25">
                                        <?= isset($_SESSION['__Old__']['__Isi']) ? $_SESSION['__Old__']['__Isi'] : ''; ?>
                                    </textarea>
                                    <div>
                                        <small class="text-danger">
                                            <?= isset($_SESSION['__Form_Notifikasi__']['__Isi']) ? $_SESSION['__Form_Notifikasi__']['__Isi'] : ''; ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Simpan">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ( isset($__record_data__) AND @$__record_data__ == TRUE ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-md mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">
                    Review Data
                    <hr>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Isi</th>
                                            <th class="text-center">Histori</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                            
                                            @$__nomor = '1';

                                                foreach ( $__record_data__ AS $data => $__record__ ) : 
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor++; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= $__routes_mod; ?>/ubah?__Id=<?= $_GET['__Id']; ?>&__Id2=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                                    class="btn btn-sm btn-success my-2" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="Ubah">
                                                    Ubah
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Judul; ?>
                                            </td>
                                            <td class="text-left">
                                                <?= htmlspecialchars_decode( $__record__->Isi ); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__helpers->TanggalWaktu( $__record__->Logs ); ?>
                                            </td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>