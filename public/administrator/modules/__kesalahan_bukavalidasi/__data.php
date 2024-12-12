<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homeadmin'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/kesalahan_bukavalidasi'); ?>">
                    Kesalahan Buka Validasi
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
                                    value="<?= url('/homeadmin/kesalahan_bukavalidasi'); ?>" required readonly>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label class="mb-2">
                                                    Pilih Dosen
                                                </label>
                                                <select name="__Filter_Dosen" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Dosen']) AND @$_POST['__Filter_Dosen'] == TRUE ) {

                                                            $__get_data_dosen__ = $__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $_POST['__Filter_Dosen'] ."' ORDER BY IdDosen DESC ");
                                                            
                                                            echo 
                                                                "
                                                                    <option value='". $__get_data_dosen__->Id ."' selected>
                                                                        ". $__get_data_dosen__->Id ." - ". $__get_data_dosen__->Nama ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Dosen ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_dosen__ AS $data => $__dosen__ ) :

                                                            $__data_dosen__ = $__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__dosen__->IdDosen ."' ORDER BY IdDosen DESC ");

                                                            echo 
                                                                "
                                                                    <option value='". $__data_dosen__->Id ."'>
                                                                        ". $__data_dosen__->Id ." - ". $__data_dosen__->Nama ."
                                                                    </option>
                                                                ";

                                                        endforeach;

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label class="mb-2">
                                                    Pilih Assesor
                                                </label>
                                                <select name="__Filter_Assesor" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Assesor']) ) {
                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Assesor'] ."' selected>
                                                                        ". $_POST['__Filter_Assesor'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";
                                                        } else {
                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Assesor ---
                                                                    </option>
                                                                ";
                                                        }
                                                            echo 
                                                                "
                                                                    <option value='2'>
                                                                        2
                                                                    </option>
                                                                ";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-lg-4">
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
                                            <th class="text-center">ID Assesor</th>
                                            <th class="text-center">Nama Dosen</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                        
                                            $__nomor__ = '1';
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 

                                                $__data_dosen__ = $__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record__->Dosen_2 ."' ORDER BY IdDosen DESC ");

                                                $__data_rpl_mahasiswa__ = $__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran AS Id, Nama_Rpl_Pendaftaran AS Nama FROM Tbl_Rpl_Pendaftaran WHERE Id_Rpl_Pendaftaran = '". $__record__->Id_Rpl_Pendaftaran ."' ORDER BY Id_Rpl_Pendaftaran DESC ");

                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger __session_delete_data"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                    data-bs-placement="top" data-bs-html="true" title="Hapus"
                                                    __slugs="Apakah Yakin Untuk Buka Data Validasi Dari Assesor <?= $__data_dosen__->Id . ' - ' . $__data_dosen__->Nama; ?> Ini "
                                                    __url="<?= url('/homeadmin/kesalahan_bukavalidasi/buka?__IdAssesor=' . $__secret_key->Encrypt( date('sHis') . '|\|' . $__record__->Id . '|\|' . time() , 221 , 5 ) . '&__Assesor=' . $__req_filter['Assesor']); ?>">
                                                    Buka
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Id; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_dosen__->Id . '<br>' . $__data_dosen__->Nama; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_rpl_mahasiswa__->Id . '<br>' . $__data_rpl_mahasiswa__->Nama; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__req_filter['Prodi']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__req_filter['Ta'] . '/' . $__req_filter['Semester']; ?>
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