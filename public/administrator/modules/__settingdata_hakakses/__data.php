<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homeadmin'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/hakakses'); ?>">
                    Hak Akses
                </a>
            </li>
        </ol>
    </nav>
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
                            <form name="frmInput" action="<?= url('/homeadmin/hakakses/simpan'); ?>" method="POST"
                                enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control"
                                    value="<?= url('/homeadmin/hakakses'); ?>" required readonly>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="select2-input">
                                        <div class="form-group my-lg-4">
                                            <label class="mb-2">
                                                Pilih User Hak Akses
                                            </label>
                                            <select name="__User" class="form-control select2-kedua" required>
                                                <?php 
                                                    echo 
                                                        "
                                                            <option value='' selected disabled>
                                                                ---  Pilih User Hak Akses ---
                                                            </option>
                                                        ";

                                                    foreach ( $__filter_user__ AS $data => $__user__ ) :

                                                        echo 
                                                            "
                                                                <option value='". $__user__->Id ."-||-". $__user__->Divisi ."'>
                                                                    ". $__user__->Nama ." - ". $__user__->Divisi ."
                                                                </option>
                                                            ";

                                                    endforeach;

                                                ?>
                                            </select>
                                        </div>
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
                                            <th class="text-center">ID User</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Password</th>
                                            <th class="text-center">Divisi</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                            
                                            @$__nomor = '1';

                                                foreach ( $__record_data__ AS $data => $__record__ ) : 

                                                    $__data_detail__ = $__db->queryid(" SELECT TOP 1 Id, Keterangan AS Nama, Divisi, UserId, Password FROM InventoryId WHERE Aktif = 'Y' AND UserId <> '' AND Divisi <> '' AND Id = '". $__record__->IdUser ."' ORDER BY Keterangan ASC ");
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor++; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger __session_delete_data"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                    data-bs-placement="top" data-bs-html="true" title="Hapus"
                                                    __slugs="Apakah Yakin Untuk Hapus Data <?= $__record__->Judul; ?> Ini ?"
                                                    __url="<?= url('/homeadmin/hakakses/hapus'); ?>?__Id=<?= $__record__->Id; ?>">
                                                    Hapus
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_detail__->Id; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_detail__->Nama; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_detail__->UserId; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_detail__->Password; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_detail__->Divisi; ?>
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