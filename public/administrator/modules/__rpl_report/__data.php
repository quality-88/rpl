<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homeadmin'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/rpl_report'); ?>">
                    Report Mahasiswa
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
                                    value="<?= url('/homeadmin/rpl_report'); ?>" required readonly>

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
                                                    Pilih Keterangan
                                                </label>
                                                <select name="__Filter_Keterangan" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Keterangan']) AND @$_POST['__Filter_Keterangan'] == TRUE ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Keterangan'] ."' selected>
                                                                        ". $_POST['__Filter_Keterangan'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Keterangan ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_keterangan__ AS $data => $__keterangan__ ) :

                                                            echo 
                                                                "
                                                                    <option value='". $__keterangan__ ."'>
                                                                        ". $__keterangan__ ."
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
                    <hr>
                    <a href="<?= url('/homeadmin/rpl_report/excel'); ?>?__Ta=<?= $_POST['__Filter_Ta']; ?>&__Semester=<?= $_POST['__Filter_Semester']; ?>&__Keterangan=<?= $_POST['__Filter_Keterangan']; ?>"
                        target="_Blank" class="btn btn-md btn-success btn-block" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="PDF">
                        EXCEL
                    </a>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <?php if ( $__req_filter['Keterangan'] == 'Selesai PUMB RPL' ) { ?>
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">NPM Mahasiswa</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">User Login</th>
                                            <th class="text-center">Jenis RPL</th>
                                            <th class="text-center">Jumlah SKS</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                        
                                            $__nomor__ = '1';
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 

                                                $__get_sks_transfer__ = 0; 
                                                $__get_sks_peroleh__ = 0;  
                                                $__sks_transfer__ = 0;
                                                $__sks_peroleh__ = 0;  

                                                $__datas_sks_transfer__ = $this->__db->query(" SELECT IdMk_Pilih_Rpl_Assesor_2 AS IdMk FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' GROUP BY IdMk_Pilih_Rpl_Assesor_2 ");

                                                    foreach ( $__datas_sks_transfer__ AS $data => $__d_sks_transfer__ )  {
                                                        
                                                        $__data_sks_transfer__ = $this->__db->queryid(" SELECT TOP 1 Sks_Pilih_Rpl_Assesor_2 AS Sks FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' AND IdMk_Pilih_Rpl_Assesor_2 = '". $__d_sks_transfer__->IdMk ."' ");

                                                        $__sks_transfer__ += $__data_sks_transfer__->Sks;

                                                    }

                                                $__datas_sks_peroleh__ = $this->__db->query(" SELECT IdMk_Rpl_Perolehan AS IdMk FROM Tbl_Rpl_Perolehan WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' GROUP BY IdMk_Rpl_Perolehan ");

                                                    foreach ( $__datas_sks_peroleh__ AS $data => $__d_sks_peroleh__ )  {
                                                        
                                                        $__data_sks_peroleh__ = $this->__db->queryid(" SELECT TOP 1 Sks_Rpl_Perolehan AS Sks FROM Tbl_Rpl_Perolehan WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' AND IdMk_Rpl_Perolehan = '". $__d_sks_peroleh__->IdMk ."' ");

                                                        $__sks_peroleh__ += $__data_sks_peroleh__->Sks;

                                                    }

                                                $__get_sks_transfer__ = $__sks_transfer__ ?? 0; 
                                                $__get_sks_peroleh__ = $__sks_peroleh__ ?? 0;

                                                if ( isset($__record__->Npm) AND $__record__->Npm == TRUE ) {

                                                    $__data_pmbregistrasi__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama, EmailRegis AS Email, PassEmail AS Pass FROM PmbRegistrasi WHERE Ta = '". $__record__->Ta ."' AND Npm = '". $__record__->Npm ."' ORDER BY Npm DESC ");
                                                
                                                } else {

                                                    $__data_pmbregistrasi__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama, EmailRegis AS Email, PassEmail AS Pass FROM PmbRegistrasi WHERE Ta = '". $__record__->Ta ."' AND NoPeserta = '". $__record__->Nomor ."' ORDER BY Npm DESC ");

                                                }

                                                    $__npm__ = $__data_pmbregistrasi__->Npm;    
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ( $__npm__ == TRUE ) { ?>
                                                <?= $__data_pmbregistrasi__->Npm . '<br>' . $__data_pmbregistrasi__->Pass; ?>
                                                <?php } else { ?>
                                                <span class='badge bg-danger'>
                                                    -
                                                </span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Prodi; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= url('/homeadmin/rpl_report/detail?__Id=' . $__helpers->SecretEncrypt($__record__->Id)); ?>"
                                                    target="_Blank">
                                                    <?= $__record__->Nama; ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Email . '<br>' . $__record__->Password; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->TipeJenis; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__get_sks_transfer__ + $__get_sks_peroleh__; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( $__npm__ == TRUE ) {
                                                        echo  
                                                            "
                                                                <span class='badge bg-info'>
                                                                    Sudah PUMB
                                                                </span>
                                                            ";
                                                    } else {
                                                        echo  
                                                            "
                                                                <span class='badge bg-danger'>
                                                                    Belum Bayar PUMB
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
                        <?php } elseif ( $__req_filter['Keterangan'] == 'Proses PRL' ) { ?>
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">User Login</th>
                                            <th class="text-center">Jenis RPL</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                        
                                            $__nomor__ = '1';
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 
                                                
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Prodi; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= url('/homeadmin/rpl_report/detail?__Id=' . $__helpers->SecretEncrypt($__record__->Id)); ?>"
                                                    target="_Blank">
                                                    <?= $__record__->Nama; ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Email . '<br>' . $__record__->Password; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->TipeJenis; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__req_filter['Keterangan']; ?>
                                            </td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } elseif ( $__req_filter['Keterangan'] == 'Belum Bayar Konversi' ) { ?>
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">User Login</th>
                                            <th class="text-center">Jenis RPL</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                        
                                            $__nomor__ = '1';
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 
                                                
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Prodi; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Nama; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Email . '<br>' . $__record__->Password; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->TipeJenis; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__req_filter['Keterangan']; ?>
                                            </td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>