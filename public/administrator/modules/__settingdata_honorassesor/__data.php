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
                                                        
                                                        } elseif ( isset($_GET['__Ta']) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_GET['__Ta'] ."' selected>
                                                                        ". $_GET['__Ta'] ."
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

                                                        } elseif ( isset($_GET['__Semester']) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_GET['__Semester'] ."' selected>
                                                                        ". $_GET['__Semester'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- Pilih Tahun Ajaran ---
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

                                                        } elseif ( isset($_GET['__Prodi']) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_GET['__Prodi'] ."' selected>
                                                                        ". $_GET['__Prodi'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- Pilih Tahun Ajaran ---
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


<?php if ( isset($_POST['__BtnSubmit_Filter']) OR $_GET['__Ta'] == TRUE AND $_GET['__Semester'] == TRUE AND $_GET['__Prodi'] == TRUE ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">
                    Review Data
                    <hr>
                    <a href="<?= $__routes_mod; ?>/pdf?__Ta=<?= $_POST['__Ta']; ?>&__Semester=<?= $_POST['__Semester']; ?>&__Prodi=<?= $_POST['__Prodi']; ?>"
                        target="_Blank" class="btn btn-md btn-danger btn-block" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="PDF">
                        PDF
                    </a>
                    <a href="<?= url('/homeadmin/settingdata_honorassesor/excel'); ?>?__Ta=<?= $_POST['__Ta']; ?>&__Semester=<?= $_POST['__Semester']; ?>&__Prodi=<?= $_POST['__Prodi']; ?>"
                        target="_Blank" class="btn btn-md btn-success btn-block" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="PDF">
                        EXCEL
                    </a>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <form name="frmInput" action="<?= $__routes_mod; ?>/simpan" method="POST"
                                enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control"
                                    value="<?= $__routes_mod; ?>?__Ta=<?= $__req_filter['Ta']; ?>&__Semester=<?= $__req_filter['Semester']; ?>&__Prodi=<?= $__req_filter['Prodi']; ?>"
                                    required readonly>

                                <input type="hidden" name="__Ta" class="form-control"
                                    value="<?= $__req_filter['Ta']; ?>" required readonly>

                                <input type="hidden" name="__Semester" class="form-control"
                                    value="<?= $__req_filter['Semester']; ?>" required readonly>

                                <input type="hidden" name="__Prodi" class="form-control"
                                    value="<?= $__req_filter['Prodi']; ?>" required readonly>

                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2">Nomor</th>
                                                <th class="text-center" colspan="8">Nama Asseor</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center" colspan="6">Nama</th>
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
                                                <td class="text-center" colspan="6">
                                                    <?= $__data_dosen__->Nama; ?>
                                                </td>
                                                <td>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center">Mahasiswa</th>
                                                            <th class="text-center">Prodi</th>
                                                            <th class="text-center">Tahun Ajaran</th>
                                                            <th class="text-center">Nomor SK</th>
                                                            <th class="text-center">Assesor</th>
                                                            <th class="text-center">Honor</th>
                                                            <th class="text-center">Bayar</th>
                                                        </tr>
                                                        <?php 
                                                            $nomor_awal = '0';
                                                            $__total_honor__ = '0';
                                                            
                                                            for ( $i = 1; $i <= 3; $i++ ) {
                                                                
                                                                $__assesor__ = $__db->query(" 
                                                                    SELECT
                                                                        A.Id_Rpl_Assesor, B.Id_Rpl_Sk, C.Id_Rpl_Pendaftaran,
                                                                        C.Nama_Rpl_Pendaftaran AS Nama, C.Prodi_Rpl_Pendaftaran AS Prodi, C.Kurikulum_Rpl_Pendaftaran AS Kurikulum, C.Ta_Rpl_Pendaftaran AS Ta, C.Semester_Rpl_Pendaftaran AS Semester, C.Jenis_Rpl_Pendaftaran AS Jenis, C.TipeJenis_Rpl_Pendaftaran AS TipeJenis, B.Nomor_Rpl_Sk AS Nomor,
                                                                        {$i} AS Assesor
                                                                    FROM 
                                                                        Tbl_Rpl_Assesor A 
                                                                    JOIN 
                                                                        Tbl_Rpl_Sk B ON A.Id_Rpl_Pendaftaran = B.Id_Rpl_Pendaftaran
                                                                    JOIN 
                                                                        Tbl_Rpl_Pendaftaran C ON B.Id_Rpl_Pendaftaran = C.Id_Rpl_Pendaftaran
                                                                    WHERE 
                                                                        A.As{$i}_Dosen_Rpl_Assesor = '". $__data_dosen__->IdDosen ."' AND A.Data = 'Y' AND A.Validasi_1_Rpl_Assesor = 'Y' AND A.Validasi_2_Rpl_Assesor = 'Y' AND A.Validasi_3_Rpl_Assesor = 'Y' AND B.Data = 'Y'
                                                                        AND C.Prodi_Rpl_Pendaftaran = '". $__req_filter['Prodi'] ."'
                                                                    ORDER BY 
                                                                        C.Nama_Rpl_Pendaftaran
                                                                    DESC 
                                                                ");

                                                                foreach ( $__assesor__ AS $data => $__data__ ) :

                                                                    $__data_sudahbayar__ = $__db->queryid(" SELECT Id_Rpl_BayarHonor AS Id, Nominal_Rpl_BayarHonor AS Nominal, Id_Rpl_Pendaftaran, Id_Rpl_Assesor, Id_Rpl_Sk, IdDosen, Ta_Rpl_BayarHonor AS Ta, Semester_Rpl_BayarHonor AS Semester, Prodi_Rpl_BayarHonor AS Prodi FROM Tbl_Rpl_BayarHonor WHERE Id_Rpl_Pendaftaran = '". $__data__->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Assesor = '". $__data__->Id_Rpl_Assesor ."' AND Id_Rpl_Sk = '". $__data__->Id_Rpl_Sk ."' AND IdDosen = '". $__data_dosen__->IdDosen ."' AND Ta_Rpl_BayarHonor = '". $__data__->Ta ."' AND Semester_Rpl_BayarHonor = '". $__data__->Semester ."' AND Prodi_Rpl_BayarHonor = '". $__req_filter['Prodi'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' ");

                                                                    if ( @$__data_sudahbayar__->Id == FALSE ) {

                                                                        $__data_biayakonversi__ = $__db->queryid(" SELECT TOP 1 Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, User_Rpl_BiayaKonversi AS Users, Log_Rpl_BiayaKonversi AS Logs, Kampus, Data AS Datas, Tipe_Rpl_BiayaKonversi AS Tipe, Honor_Rpl_BiayaKonversi AS Honor FROM Tbl_Rpl_BiayaKonversi WHERE Ta_Rpl_BiayaKonversi = '". $__data__->Ta ."' AND Semester_Rpl_BiayaKonversi = '". $__data__->Semester ."' AND Tipe_Rpl_BiayaKonversi = '". $__data__->Jenis ."' ORDER BY Id_Rpl_BiayaKonversi ASC ");

                                                                    }

                                                                    // if ( @$__data_sudahbayar__->Id == TRUE AND @$__data_sudahbayar__->Id_Rpl_Pendaftaran == $__data__->Id_Rpl_Pendaftaran AND @$__data_sudahbayar__->Id_Rpl_Assesor == $__data__->Id_Rpl_Assesor AND @$__data_sudahbayar__->Id_Rpl_Sk == $__data__->Id_Rpl_Sk AND @$__data_sudahbayar__->IdDosen == $__data_dosen__->IdDosen AND @$__data_sudahbayar__->Ta == $__data__->Ta AND @$__data_sudahbayar__->Semester == $__data__->Semester AND @$__data_sudahbayar__->Prodi == $__req_filter['Prodi'] ) {

                                                                    //     $__sudah_bayar__ = $__data_sudahbayar__->Nominal;

                                                                    // } else {

                                                                    //     $__sudah_bayar__ = '0';

                                                                    // }

                                                                    // $nomor_awal++;

                                                                    // $__total_honor__ += $__data_biayakonversi__->Honor - $__sudah_bayar__;

                                                                    $__sudah_bayar__ = (isset($__data_sudahbayar__->Id) && $__data_sudahbayar__->Id) ? $__data_sudahbayar__->Nominal : 0;

                                                                    $nomor_awal++;
                                                                    if ( @$__data_biayakonversi__->Honor == TRUE AND @$__data_biayakonversi__->Honor > '0' ) {
                                                                        $__total_honor__ += $__data_biayakonversi__->Honor;
                                                                    } else {
                                                                        $__total_honor__ += '0';
                                                                    }
                                                                    // $__total_honor__ += (isset($__data_biayakonversi__->Honor) ? $__data_biayakonversi__->Honor : 0) - $__sudah_bayar__;
                                                                    
                                                        ?>
                                                        <tr>
                                                            <td class="text-center">

                                                            </td>
                                                            <td class="text-center">
                                                                <?= $nomor_awal; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $__data__->Nama; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $__data__->Prodi; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $__data__->Ta . '/' . $__data__->Semester; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $__data__->Nomor; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $__data__->Assesor . '<br>' . $__data__->TipeJenis; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                Rp.
                                                                <?= isset($__data_biayakonversi__->Honor) ? $__helpers->Uang( $__data_biayakonversi__->Honor + 0 ) : '0'; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ( @$__data_sudahbayar__->Id == TRUE ) { ?>
                                                                <span class="badge bg-success">
                                                                    Sudah Di Bayar
                                                                </span>
                                                                <?php } else { ?>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="__Check[]"
                                                                        value="<?= $__data__->Id_Rpl_Pendaftaran . '-' . $__data__->Id_Rpl_Assesor . '-' . $__data__->Id_Rpl_Sk . '-' . $__data_dosen__->IdDosen . '-' . $__data_biayakonversi__->Honor; ?>">
                                                                    <label class="form-check-label">
                                                                        Bayar
                                                                    </label>
                                                                </div>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; } $__total_honor_seluruh__ += $__total_honor__; ?>
                                                        <tr>
                                                            <td class="text-center bg-primary text-white" colspan="6">
                                                                Total Honor Di Bayarkan
                                                            </td>
                                                            <td class="text-center bg-danger text-white" colspan="4">
                                                                <strong>
                                                                    Rp.
                                                                    <?= isset($__total_honor__) ? $__helpers->Uang( $__total_honor__ + 0 ) : '0'; ?>
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th class="text-center bg-warning" colspan="6">
                                                    <h5 class="text-white">
                                                        Total Honor Wajib Di Keluarkan
                                                    </h5>
                                                </th>
                                                <th class="text-center bg-danger" colspan="4">
                                                    <strong>
                                                        <h5 class="text-white">
                                                            Rp.
                                                            <?= isset($__total_honor_seluruh__) ? $__helpers->Uang( $__total_honor_seluruh__ + 0 ) : '0'; ?>
                                                        </h5>
                                                    </strong>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <hr>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
                                        data-bs-target="#__Modal_Simpan__">
                                        Simpan
                                    </button>
                                    <div class="modal fade" id="__Modal_Simpan__" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">
                                                        Informasi
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Apakah Anda Yakin Untuk Melakukan Validasi Sudah Di Bayarkan Honor
                                                    Dosen
                                                    Ini ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title="Simpan">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </div>
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
<?php } ?>