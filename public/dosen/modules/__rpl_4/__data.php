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
                    RPL
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
                    <div id="accordion-Filter" class="accordion-collapse collapse <?= isset($__ta) ? 'show' : ''; ?>"
                        data-bs-parent="#accordionExample">
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
                                                        if ( isset($__ta) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $__ta ."' selected>
                                                                        ". $__ta ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ##### ---
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
                                                        if ( isset($__semester) ) {

                                                            echo 
                                                                "
                                                                    <option value='". $__semester ."' selected>
                                                                        ". $__semester ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ##### ---
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
                                        <div class="form-group">
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


<?php if ( isset( $__ta ) && isset( $__semester ) ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-0">
            <div class="nav-align-top mb-6">
                <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>?__Ta=<?= $__ta; ?>&__Semester=<?= $__semester; ?>"
                            class="nav-link" aria-selected="true">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Assesor 1
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>/2?__Ta=<?= $__ta; ?>&__Semester=<?= $__semester; ?>"
                            class="nav-link" aria-selected="true">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Assesor 2
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>/3?__Ta=<?= $__ta; ?>&__Semester=<?= $__semester; ?>"
                            class="nav-link" aria-selected="true">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Assesor 3
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>/4?__Ta=<?= $__ta; ?>&__Semester=<?= $__semester; ?>"
                            class="nav-link active" aria-selected="true">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Validasi Akhir
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-assesor3" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" rowspan="2">Nomor</th>
                                        <th class="text-center" rowspan="2">Surat Keterangan</th>
                                        <th class="text-center" rowspan="2">Honor</th>
                                        <th class="text-center" colspan="3">Calon RPL</th>
                                        <th class="text-center" colspan="4">Assesor 1</th>
                                        <th class="text-center" colspan="4">Assesor 2</th>
                                        <th class="text-center" colspan="4">Assesor 3</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Tipe</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Dosen</th>
                                        <th class="text-center">Validasi</th>
                                        <th class="text-center">Tanggal Validasi</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Dosen</th>
                                        <th class="text-center">Validasi</th>
                                        <th class="text-center">Tanggal Validasi</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Dosen</th>
                                        <th class="text-center">Validasi</th>
                                        <th class="text-center">Tanggal Validasi</th>
                                    </tr>
                                </thead>
                                <tbody class=" table-border-bottom-0">

                                    <?php 
                                    
                                        foreach ( $__record_data_assesor_4__ AS $data => $__record_assesor_4__ ) : 

                                            // $__data_sudahbayar__ = $__db->queryid(" SELECT Id_Rpl_BayarHonor AS Id, Nominal_Rpl_BayarHonor AS Nominal, Id_Rpl_Pendaftaran, Id_Rpl_Assesor, Id_Rpl_Sk, IdDosen, Ta_Rpl_BayarHonor AS Ta, Semester_Rpl_BayarHonor AS Semester, Prodi_Rpl_BayarHonor AS Prodi FROM Tbl_Rpl_BayarHonor WHERE Id_Rpl_Pendaftaran = '". $__record_assesor_4__['Id_Rpl_Pendaftaran'] ."' AND Id_Rpl_Assesor = '". $__record_assesor_4__['Id_Rpl_Assesor'] ."' AND Id_Rpl_Sk = '". $__data__->Id_Rpl_Sk ."' AND IdDosen = '". $__authlogin__->Id ."' AND Ta_Rpl_BayarHonor = '". $_GET['__Ta'] ."' AND Semester_Rpl_BayarHonor = '". $_GET['__Semester'] ."' AND Prodi_Rpl_BayarHonor = '". $__record_assesor_4__['Rpl_Prodi'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' ORDER BY Id_Rpl_BayarHonor DESC ");
                                            
                                            $__data_sudahbayar__ = $__db->queryid(" SELECT TOP 1 Id_Rpl_BayarHonor AS Id, Nominal_Rpl_BayarHonor AS Nominal, Id_Rpl_Pendaftaran, Id_Rpl_Assesor, Id_Rpl_Sk, IdDosen, Ta_Rpl_BayarHonor AS Ta, Semester_Rpl_BayarHonor AS Semester, Prodi_Rpl_BayarHonor AS Prodi FROM Tbl_Rpl_BayarHonor WHERE Id_Rpl_Pendaftaran = '". $__record_assesor_4__['Id_Rpl_Pendaftaran'] ."' AND Id_Rpl_Assesor = '". $__record_assesor_4__['Id'] ."' AND IdDosen = '". $__authlogin__->Id ."' AND Ta_Rpl_BayarHonor = '". $_GET['__Ta'] ."' AND Semester_Rpl_BayarHonor = '". $_GET['__Semester'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' ORDER BY Id_Rpl_BayarHonor DESC ");
                                        
                                    ?>

                                    <tr>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['Nomor']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ( $__record_assesor_4__['Sk_Id'] == TRUE AND $__record_assesor_4__['Sk_Nomor'] == TRUE AND $__record_assesor_4__['Sk_Tgl'] == TRUE ) { ?>
                                            <a href="<?= $__routes_mod; ?>/pdf?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_assesor_4__['Sk_Id'] . '|\|' . time() , 221 , 5 ); ?>"
                                                target="_Blank" class="btn btn-md btn-primary" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="Download Surat Keterangan">
                                                <?= $__record_assesor_4__['Sk_Nomor']; ?>
                                            </a>
                                            <hr>
                                            <a href="<?= $__routes_mod; ?>/pdf_lampiran?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_assesor_4__['Sk_Id'] . '|\|' . time() , 221 , 5 ); ?>"
                                                target="_Blank" class="btn btn-md btn-info" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="Download Surat Keterangan Lampiran">
                                                Lampiran
                                            </a>
                                            <?php } else { ?>
                                            <div>
                                                <span class="badge bg-danger">
                                                    Kunci
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= isset($__data_sudahbayar__->Nominal) ? 'Rp. ' . $__helpers->Uang( $__data_sudahbayar__->Nominal + 0 ) : '<span class="badge bg-danger">Belum</span>'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['Rpl_Nama']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['Rpl_Prodi']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['Rpl_TipeJenis']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ( $__record_assesor_4__['1_Status'] == 'Y' AND $__record_assesor_4__['2_Status'] == 'Y' AND $__record_assesor_4__['3_Status'] == 'Y' AND $__authlogin__->Id == $__record_assesor_4__['1_IdDosen'] ) { ?>
                                            <div>
                                                <?php if ( $__record_assesor_4__['1_Selesai'] == 'Y' ) { ?>
                                                <span class="badge bg-primary">
                                                    Selesai
                                                </span>
                                                <?php } else { ?>
                                                <a href="#" class="btn btn-md btn-info __session_data_validasi"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                    data-bs-placement="top" data-bs-html="true" title="Validasi"
                                                    __slugs="Apakah Yakin Untuk Validasi Akhir Ini ?"
                                                    __url="<?= $__routes_mod; ?>/4/validasi?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_assesor_4__['Id'] . '|\|' . time() , 221 , 5 ); ?>&__Check=1&__Req=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $_GET['__Ta'] . '/' . $_GET['__Semester'] . '|\|' . time() , 221 , 5 ); ?>">
                                                    Validasi
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php } else { ?>
                                            <div>
                                                <span class="badge bg-danger">
                                                    Kunci
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['1_IdDosen']; ?>
                                            <br>
                                            <?= $__record_assesor_4__['1_NamaDosen']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['1_Validasi']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['1_Tgl']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ( $__record_assesor_4__['1_Status'] == 'Y' AND $__record_assesor_4__['2_Status'] == 'Y' AND $__record_assesor_4__['3_Status'] == 'Y' AND $__authlogin__->Id == $__record_assesor_4__['2_IdDosen'] ) { ?>
                                            <div>
                                                <?php if ( $__record_assesor_4__['2_Selesai'] == 'Y' ) { ?>
                                                <span class="badge bg-primary">
                                                    Selesai
                                                </span>
                                                <?php } else { ?>
                                                <div>
                                                    <?php if ( $__record_assesor_4__['1_Selesai'] == 'Y' ) { ?>
                                                    <a href="#" class="btn btn-md btn-info __session_data_validasi"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title="Validasi"
                                                        __slugs="Apakah Yakin Untuk Validasi Akhir Ini ?"
                                                        __url="<?= $__routes_mod; ?>/4/validasi?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_assesor_4__['Id'] . '|\|' . time() , 221 , 5 ); ?>&__Check=2&__Req=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $_GET['__Ta'] . '/' . $_GET['__Semester'] . '|\|' . time() , 221 , 5 ); ?>">
                                                        Validasi
                                                    </a>
                                                    <?php } else { ?>
                                                    <span class="badge bg-warning">
                                                        Belum Validasi <br> Assesor 1
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php } else { ?>
                                            <div>
                                                <span class="badge bg-danger">
                                                    Kunci
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['2_IdDosen']; ?>
                                            <br>
                                            <?= $__record_assesor_4__['2_NamaDosen']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['2_Validasi']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['2_Tgl']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ( $__record_assesor_4__['1_Status'] == 'Y' AND $__record_assesor_4__['2_Status'] == 'Y' AND $__record_assesor_4__['3_Status'] == 'Y' AND $__authlogin__->Id == $__record_assesor_4__['3_IdDosen'] ) { ?>
                                            <div>
                                                <?php if ( $__record_assesor_4__['3_Selesai'] == 'Y' ) { ?>
                                                <span class="badge bg-primary">
                                                    Selesai
                                                </span>
                                                <?php } else { ?>
                                                <div>
                                                    <?php if ( $__record_assesor_4__['2_Selesai'] == 'Y' ) { ?>
                                                    <a href="#" class="btn btn-md btn-info __session_data_validasi"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title="Validasi"
                                                        __slugs="Apakah Yakin Untuk Validasi Akhir Ini ?"
                                                        __url="<?= $__routes_mod; ?>/4/validasi?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_assesor_4__['Id'] . '|\|' . time() , 221 , 5 ); ?>&__Check=3&__Req=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $_GET['__Ta'] . '/' . $_GET['__Semester'] . '|\|' . time() , 221 , 5 ); ?>">
                                                        Validasi
                                                    </a>
                                                    <?php } else { ?>
                                                    <span class="badge bg-warning">
                                                        Belum Validasi <br> Assesor 2
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php } else { ?>
                                            <div>
                                                <span class="badge bg-danger">
                                                    Kunci
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['3_IdDosen']; ?>
                                            <br>
                                            <?= $__record_assesor_4__['3_NamaDosen']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['3_Validasi']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_4__['3_Tgl']; ?>
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
<?php } ?>