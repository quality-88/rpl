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
                    List Honor Assesor
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
                            <form name="frmInput" action="" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                    required readonly>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label>
                                                    Pilih Tahun Ajaran
                                                </label>
                                                <select name="__Ta" class="form-control select2-kedua" required>
                                                    <?php 
                                                        if ( isset($_POST['__Ta']) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Ta'] ."' selected>
                                                                        ". $_POST['__Ta'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- Pilih Tahun Ajaran ---
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
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label>
                                                    Pilih Semester
                                                </label>
                                                <select name="__Semester" class="form-control select2-kedua" required>
                                                    <?php 
                                                        if ( isset($_POST['__Semester']) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Semester'] ."' selected>
                                                                        ". $_POST['__Semester'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- Pilih Semester ---
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label>
                                                    Pilih Prodi
                                                </label>
                                                <select name="__Prodi" class="form-control select2-kedua" required>
                                                    <?php 
                                                        if ( isset($_POST['__Prodi']) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Prodi'] ."' selected>
                                                                        ". $_POST['__Prodi'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- Pilih Prodi ---
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
                                                                    <option value='". $__prodi__->Prodi ."'>
                                                                        ". $__prodi__->Prodi ."
                                                                    </option>
                                                                ";

                                                        endforeach;

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <div class="form-group">
                                            <button name="__BtnSubmit_Filter" type="submit" class="btn btn-primary"
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


<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">
                    Review Data
                    <hr>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">Nomor</th>
                                            <th class="text-center" colspan="4">Nama Asseor</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center" colspan="3">Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 

                                                $__data_dosen__ = $__db->queryid(" SELECT TOP 1 IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record__->IdDosen ."' ORDER BY IdDosen DESC ");
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__data_dosen__->IdDosen; ?>
                                            </td>
                                            <td class="text-center" colspan="3">
                                                <?= $__data_dosen__->Nama; ?>
                                            </td>
                                            <td colspan="5">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"></th>
                                                            <th class="text-center">Nomor</th>
                                                            <th class="text-center">Mahasiswa</th>
                                                            <th class="text-center">Nomor SK</th>
                                                            <th class="text-center">Tahun Ajaran</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            for ($i = 1; $i <= 3; $i++) {
                                                                $__assesor = $__db->query(" 
                                                                    SELECT
                                                                        C.Nama_Rpl_Pendaftaran AS Nama, 
                                                                        B.Nomor_Rpl_Sk AS Nomor,
                                                                        Ta_Rpl_Pendaftaran AS Ta, 
                                                                        Semester_Rpl_Pendaftaran AS Semester
                                                                    FROM 
                                                                        Tbl_Rpl_Assesor A 
                                                                    JOIN 
                                                                        Tbl_Rpl_Sk B ON A.Id_Rpl_Pendaftaran = B.Id_Rpl_Pendaftaran
                                                                    JOIN 
                                                                        Tbl_Rpl_Pendaftaran C ON B.Id_Rpl_Pendaftaran = C.Id_Rpl_Pendaftaran
                                                                    WHERE 
                                                                        A.As{$i}_Dosen_Rpl_Assesor = '". $__data_dosen__->IdDosen ."' 
                                                                        AND A.Data = 'Y' 
                                                                        AND A.Validasi_{$i}_Rpl_Assesor = 'Y'
                                                                        AND B.Data = 'Y'
                                                                    ORDER BY 
                                                                        C.Nama_Rpl_Pendaftaran DESC
                                                                ");

                                                                foreach ($__assesor as $data => $__data) :
                                                                    $nomor_awal++;
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"></td>
                                                            <td class="text-center"><?= $nomor_awal; ?></td>
                                                            <td class="text-center"><?= $__data->Nama; ?></td>
                                                            <td class="text-center"><?= $__data->Nomor; ?></td>
                                                            <td class="text-center">
                                                                <?= $__data->Ta . '/' . $__data->Semester; ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                        <?php } // end for loop ?>
                                                    </tbody>
                                                </table>
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