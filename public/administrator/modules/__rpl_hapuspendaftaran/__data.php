<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homeadmin'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/rpl_hapuspendaftaran'); ?>">
                    Hapus Mahasiswa
                </a>
            </li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Filter">
                        <button type="button" class="accordion-button bg-primary text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Filter" aria-expanded="true" aria-controls="accordion-Filter">
                            Filter Data
                        </button>
                    </h2>
                    <div id="accordion-Filter"
                        class="accordion-collapse collapse <?= isset($_POST['__BtnSubmit_Filter']) ? 'show' : ''; ?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form name="frmInput" action="" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control"
                                    value="<?= url('/homeadmin/rpl_hapuspendaftaran'); ?>" required readonly>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group my-lg-4">
                                                <label class="mb-2">
                                                    Pilih Tahun Ajaran
                                                </label>
                                                <select name="__Filter_Ta" class="form-control select2-kedua" required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Ta']) AND @$_POST['__Filter_Ta'] == TRUE ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Ta'] ."' selected>
                                                                        ". $_POST['__Filter_Ta'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Tahun Ajaran ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_ta__ AS $data => $__ta__ ) :

                                                            echo 
                                                                "
                                                                    <option value='". $__ta__->Datas ."'>
                                                                        ". $__ta__->Datas ."
                                                                    </option>
                                                                ";

                                                        endforeach;

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group my-lg-4">
                                                <label class="mb-2">
                                                    Pilih Semester
                                                </label>
                                                <select name="__Filter_Semester" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Semester']) AND @$_POST['__Filter_Semester'] == TRUE ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Semester'] ."' selected>
                                                                        ". $_POST['__Filter_Semester'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Semester ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_semester__ AS $data => $__semester__ ) :

                                                            echo 
                                                                "
                                                                    <option value='". $__semester__->Datas ."'>
                                                                        ". $__semester__->Datas ."
                                                                    </option>
                                                                ";

                                                        endforeach;

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group my-lg-4">
                                                <label class="mb-2">
                                                    Pilih Prodi
                                                </label>
                                                <select name="__Filter_Prodi" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Prodi']) AND @$_POST['__Filter_Prodi'] == TRUE ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Prodi'] ."' selected>
                                                                        ". $_POST['__Filter_Prodi'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Prodi ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_prodi__ AS $data => $__prodi__ ) :

                                                            echo 
                                                                "
                                                                    <option value='". $__prodi__->Datas ."'>
                                                                        ". $__prodi__->Datas ."
                                                                    </option>
                                                                ";

                                                        endforeach;

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-primary" name="__BtnSubmit_Filter"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title="Filter">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">
                    Review Data
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
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Berkas</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                        
                                            $__nomor__ = '1';
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 

                                                $__check_file__ = $__db->queryrow(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' ");

                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger __session_delete_data"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                    data-bs-placement="top" data-bs-html="true" title="Hapus"
                                                    __slugs="Apakah Yakin Untuk Hapus Data <?= $__record__->Nama; ?> Ini "
                                                    __url="<?= url('/homeadmin/rpl_hapuspendaftaran/hapus?__Id=' . $__record__->Id); ?>">
                                                    Hapus
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Id; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Nama; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Prodi; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Email . '<br>' . $__record__->Password; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( $__check_file__ == TRUE ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-primary'>
                                                                    Sudah Upload
                                                                </span>
                                                            ";
                                                    } else {
                                                        echo 
                                                            "
                                                                <span class='badge bg-danger'>
                                                                    Belum Upload
                                                                </span>
                                                            ";
                                                    }
                                                ?>
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