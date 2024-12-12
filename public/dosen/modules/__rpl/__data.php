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
                            class="nav-link active" aria-selected="true">
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
                            class="nav-link" aria-selected="true">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Validasi Akhir
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-assesor1" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nomor</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Info <br> Assesor</th>
                                        <th class="text-center">Mahasiswa</th>
                                        <th class="text-center">ID Dosen</th>
                                        <th class="text-center">Nama Dosen</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Progres</th>
                                        <th class="text-center">Tanggal Daftar</th>
                                        <th class="text-center">Tanggal Hapus</th>
                                        <th class="text-center">Tahun Ajaran</th>
                                        <th class="text-center">Prodi</th>
                                    </tr>
                                </thead>
                                <tbody class=" table-border-bottom-0">

                                    <?php 
                                    
                                        foreach ( $__record_data_assesor_1__ AS $data => $__record_assesor_1__ ) : 

                                            $__mahasiswa__ = $__db->queryid(" SELECT Id_Rpl_Pendaftaran AS Id, Nama_Rpl_Pendaftaran AS Nama, Prodi_Rpl_Pendaftaran AS Prodi FROM Tbl_Rpl_Pendaftaran WHERE Id_Rpl_Pendaftaran = '". $__record_assesor_1__['Id_Rpl_Pendaftaran'] ."' ORDER BY Id_Rpl_Pendaftaran DESC ");
                                            
                                            if ( $__record_assesor_1__['Cek_Status'] == 'Y' ) {

                                                if ( date('Y-m-d H:i:s') > $__record_assesor_1__['TglHapus'] AND $__record_assesor_1__['Cek_Status'] == 'Y' ) {

                                                    echo 'asdas';

                                                }

                                            }
                                        
                                    ?>

                                    <tr>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['Nomor']; ?>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <?php if ( date('Y-m-d H:i:s', strtotime($__record_assesor_1__['TglHapus_1'])) > date('Y-m-d H:i:s') OR $__record_assesor_1__['Cek_Status'] == 'Y' ) { ?>
                                                <a href="<?= $__routes_mod; ?>/cms_1?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_assesor_1__['Id'] . '|\|' . time() , 221 , 5 ); ?>"
                                                    class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="Input KRS Konversi">
                                                    Input <br> KRS Konversi
                                                </a>
                                                <?php } else {?>
                                                <span class="badge bg-label-danger">
                                                    Tolak
                                                </span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php if ( isset($__record_assesor_1__['Hp']) AND $__record_assesor_1__['Hp'] == TRUE ) { ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?= $__record_assesor_1__['Hp']; ?>&text=Mohon Di Nilai Pada Tahap Selanjutnya, Terimakasih"
                                                target="_Blank" class=" btn btn-sm btn-success my-2"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title="Konfirasi">
                                                <i class="bx bxl-whatsapp"></i>
                                            </a>
                                            <?php } ?>
                                            <?php if ( isset($__record_assesor_1__['Telepon']) AND $__record_assesor_1__['Telepon'] == TRUE ) { ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?= $__record_assesor_1__['Telepon']; ?>&text=Mohon Di Nilai Pada Tahap Selanjutnya, Terimakasih"
                                                target="_Blank" class=" btn btn-sm btn-warning my-2"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title="Konfirasi">
                                                <i class="tf-icons bx bx-phone"></i>
                                            </a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__mahasiswa__->Nama; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['IdDosen']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['NamaDosen']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['Status']; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="progress" style="height: 26px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                    role="progressbar"
                                                    style="width: <?= $__record_assesor_1__['Progres'] ?>%;"
                                                    aria-valuenow="<?= $__record_assesor_1__['Progres'] ?>"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <?= $__record_assesor_1__['Progres'] ?>%</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['TglDaftar']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['TglHapus']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['Ta']; ?>/<?= $__record_assesor_1__['Semester']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record_assesor_1__['Prodi']; ?>
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