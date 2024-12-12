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
                    List Pendaftaran
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

                                <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                    required readonly>

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
                    <hr>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">Nomor</th>
                                            <th class="text-center" rowspan="2">Pendaftaran</th>
                                            <th class="text-center" rowspan="2">Assesment</th>
                                            <!-- <th class="text-center" rowspan="2">Aksi</th> -->
                                            <th class="text-center" colspan="9">Assesor</th>
                                            <th class="text-center" colspan="6">Calon Mahasiswa RPL</th>
                                            <th class="text-center" colspan="3">Pendidikan Terakhir Asal</th>
                                            <th class="text-center" colspan="3">Pendidikan Terakhir Sekarang</th>
                                            <th class="text-center" colspan="3">File Pendukung</th>
                                            <th class="text-center" rowspan="2">Status</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Nama Assesor 1</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tgl Hapus</th>
                                            <th class="text-center">Nama Assesor 2</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tgl Hapus</th>
                                            <th class="text-center">Nama Assesor 3</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tgl Hapus</th>
                                            <th class="text-center">Tanggal Daftar</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Gelombang</th>
                                            <th class="text-center">Jenjang</th>
                                            <th class="text-center">Perguruan Tinggi</th>
                                            <th class="text-center">Program Studi</th>
                                            <th class="text-center">Kampus</th>
                                            <th class="text-center">Fakultas</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">KTP</th>
                                            <th class="text-center">KK</th>
                                            <th class="text-center">Transkip</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                        
                                            foreach ( $__record__data__ AS $data => $__record__ ) : 

                                                $__data_sk__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Sk AS Id, Ta_Rpl_Sk AS Ta, Semester_Rpl_Sk AS Semester, Nomor_Rpl_Sk AS Nomor, TglBuat_Rpl_Sk AS Tgl, User_Rpl_Sk AS Users, Log_Rpl_Sk AS Logs, Idkampus, Kampus, Data AS Datas, Id_Rpl_Pendaftaran, Id_Rpl_Assesor FROM Tbl_Rpl_Sk WHERE Id_Rpl_Pendaftaran = '". $__record__['Id'] ."' AND Id_Rpl_Assesor = '". $__record__['Id_Rpl_Asseosr'] ."' ORDER BY Id_Rpl_Sk DESC ");
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= @$__record__['Nomor']; ?>
                                            </td>
                                            <!-- <td class="text-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#__Modal_<?= @$__record__->Id; ?>">
                                                    Detail
                                                </button>
                                                <div class="modal fade" id="__Modal_<?= @$__record__->Id; ?>" data-bs-backdrop="static" tabindex="-1">
                                                    <div class="modal-dialog">
                                                    <form class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="backDropModalTitle">
                                                                Informasi
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12 col-xl-12 col-md-12 col-sm-12">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </td> -->
                                            <td class="text-center">
                                                <?= $__record__['Npm']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ( $__data_sk__->Id == TRUE AND $__data_sk__->Id_Rpl_Pendaftaran == $__record__['Id'] ) { ?>
                                                <a href="<?= $__routes_mod; ?>/pdf?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_sk__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                                    target="_Blank" class="btn btn-md btn-primary"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                    data-bs-placement="top" data-bs-html="true"
                                                    title="Download Surat Keterangan">
                                                    <?= $__data_sk__->Nomor; ?>
                                                </a>
                                                <?php } else { ?>
                                                <span class="badge bg-danger">
                                                    Belum Selesai
                                                </span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['D_1']; ?>
                                                <br>
                                                <?= @$__record__['N_1']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['S_1'] == 'Y' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-primary'>
                                                                    Selesai
                                                                </span>
                                                            ";
                                                    } else {
                                                        echo 
                                                            "
                                                                <span class='badge bg-danger'>
                                                                    Belum Selesai
                                                                </span>
                                                            ";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['H_1']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['D_2']; ?>
                                                <br>
                                                <?= @$__record__['N_2']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['S_2'] == 'Y' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-primary'>
                                                                    Selesai
                                                                </span>
                                                            ";
                                                    } else {
                                                        echo 
                                                            "
                                                                <span class='badge bg-danger'>
                                                                    Belum Selesai
                                                                </span>
                                                            ";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if ( @$__record__['S_1'] == 'Y' ) {
                                                        echo @$__record__['H_2']; 
                                                    } else {
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['D_3']; ?>
                                                <br>
                                                <?= @$__record__['N_3']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['S_3'] == 'Y' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-primary'>
                                                                    Selesai
                                                                </span>
                                                            ";
                                                    } else {
                                                        echo 
                                                            "
                                                                <span class='badge bg-danger'>
                                                                    Belum Selesai
                                                                </span>
                                                            ";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if ( @$__record__['S_1'] == 'Y' AND @$__record__['S_2'] == 'Y' ) {
                                                        echo @$__record__['H_3']; 
                                                    } else {
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['TglDaftar']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['TipeJenis']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Email']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Nama']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['TahunAjaran']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Gelombang']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Jenjang_Asal']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['PT_Asal']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Prodi_Asal']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Kampus']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Fakultas']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Prodi']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ( isset($__record__['Ktp']) ) { ?>
                                                <a href="<?= $__base_file; ?><?= @$__record__['Ktp']; ?>"
                                                    class="btn btn-sm btn-primary" target="_Blank"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,8"
                                                    data-bs-placement="top" data-bs-html="true" title="File">
                                                    Lihat
                                                </a>
                                                <?php } else { ?>
                                                <span class="badge bg-label-danger">
                                                    Belum Upload
                                                </span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ( isset($__record__['Kk']) ) { ?>
                                                <a href="<?= $__base_file; ?><?= @$__record__['Kk']; ?>"
                                                    class="btn btn-sm btn-info" target="_Blank" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,8" data-bs-placement="top" data-bs-html="true"
                                                    title="File">
                                                    Lihat
                                                </a>
                                                <?php } else { ?>
                                                <span class="badge bg-label-danger">
                                                    Belum Upload
                                                </span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ( isset($__record__['Nilai']) ) { ?>
                                                <a href="<?= $__base_file; ?><?= @$__record__['Nilai']; ?>"
                                                    class="btn btn-sm btn-warning" target="_Blank"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,8"
                                                    data-bs-placement="top" data-bs-html="true" title="File">
                                                    Lihat
                                                </a>
                                                <?php } else { ?>
                                                <span class="badge bg-label-danger">
                                                    Belum Upload
                                                </span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['Selesai'] == 'Y' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-primary'>
                                                                    Selesai <br><br> Bayar Konversi
                                                                </span>
                                                            ";
                                                    } elseif ( @$__record__['Selesai'] == 'N' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-danger'>
                                                                    Belum Selesai <br><br> Bayar Konversi
                                                                </span>
                                                            ";
                                                    } else {   
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-warning'>
                                                                    Tidak Ada Kondisi
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