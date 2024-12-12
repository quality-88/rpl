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
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center" colspan="2">Mahasiswa RPL</th>
                                            <th class="text-center">Nomor SK</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ( $__record__data__ AS $data => $__record__ ) : ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= @$__record__['Nomor']; ?>
                                            </td>
                                            <td class="text-center" colspan="2">
                                                <?= @$__record__['Mahasiswa_Rpl']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Nomor_Sk']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Ta']; ?>/<?= @$__record__['Semester']; ?>
                                                <br>
                                                <?= $__helpers->__Semester( @$__record__['Semester'] ); ?>
                                            </td>
                                            <td>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th class="text-center">Assesor</th>
                                                        <th class="text-center">ID Assesor</th>
                                                        <th class="text-center">Nama Assesor</th>
                                                        <th class="text-center">Honor</th>
                                                        <th class="text-center">Pembayaran</th>
                                                    </tr>
                                                    <?php 
                                                        $__assesor__ = $__db->queryid(" 
                                                            SELECT TOP 1 
                                                                Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As2_Dosen_Rpl_Assesor AS D_2, As3_Dosen_Rpl_Assesor AS D_3
                                                            FROM 
                                                                Tbl_Rpl_Assesor 
                                                            ORDER BY 
                                                                Id_Rpl_Assesor 
                                                            DESC 
                                                        ");

                                                        $dosen_ids = [$__assesor__->D_1, $__assesor__->D_2, $__assesor__->D_3];
                                                        $dosen_data = [];

                                                        foreach ($dosen_ids as $id) {
                                                            if ($id) {
                                                                $dosen_data[] = $__db->queryid("SELECT IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '$id' ORDER BY IdDosen DESC");

                                                                $__data_biayakonversi__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, User_Rpl_BiayaKonversi AS Users, Log_Rpl_BiayaKonversi AS Logs, Kampus, Data AS Datas, Tipe_Rpl_BiayaKonversi AS Tipe, Honor_Rpl_BiayaKonversi AS Honor FROM Tbl_Rpl_BiayaKonversi WHERE Ta_Rpl_BiayaKonversi = '". $__record__['Ta'] ."' AND Semester_Rpl_BiayaKonversi = '". $__record__['Semester'] ."' AND Tipe_Rpl_BiayaKonversi = '". $__record__['Jenis'] ."' ORDER BY Id_Rpl_BiayaKonversi ASC ");
                                                                
                                                            } else {
                                                                $dosen_data[] = (object) ['IdDosen' => '-', 'Nama' => '-'];
                                                            }
                                                        }
                                                    ?>
                                                    <?php foreach ( $dosen_data as $index => $dosen ) : ?>
                                                    <tr>
                                                        <td class="text-center">

                                                        </td>
                                                        <td class="text-center">
                                                            <?= $index + 1; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $dosen->IdDosen; ?>
                                                            <br>
                                                            <?= $dosen->Nama; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= isset($__data_biayakonversi__->Honor) ? $__helpers->Uang( $__data_biayakonversi__->Honor + 0 ) : '0'; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= isset($__data_biayakonversi__->Honor) ? $__helpers->Uang( $__data_biayakonversi__->Honor + 0 ) : '0'; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= isset($__data_biayakonversi__->Honor) ? $__helpers->Uang( $__data_biayakonversi__->Honor + 0 ) : '0'; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </thead>
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