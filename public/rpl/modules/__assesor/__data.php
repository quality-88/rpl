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
                    Assesor
                </a>
            </li>
        </ol>
    </nav>
</div>

<?php if ( $__dosen_assesor_1 == FALSE OR $__dosen_assesor_2 == FALSE OR $__dosen_assesor_3 == FALSE ) { ?>
<div class="container-xxl">
    <div class="row">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="alert alert-danger" role="alert">
                <h3>
                    <strong>
                        Informasi !
                    </strong>
                </h3>
                <h4>
                    Mohon Maaf Assesor Belum Terisi Semua, Harap Melapor Ke Pusat Informasi !
                </h4>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="container-xxl">
    <div class="row">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="nav-align-top mb-6">
                <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                    <li class="nav-item mb-1 mb-sm-0">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-Assesor1"
                            aria-controls="navs-pills-justified-Assesor1" aria-selected="true">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Assesor 1
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </button>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-Assesor2"
                            aria-controls="navs-pills-justified-Assesor2" aria-selected="false">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-buildings bx-sm me-1_5 align-text-bottom"></i>
                                Assesor 2
                            </span>
                            <i class="bx bx-buildings bx-sm d-sm-none"></i>
                        </button>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-Assesor3"
                            aria-controls="navs-pills-justified-Assesor3" aria-selected="false">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-crown bx-sm me-1_5 align-text-bottom"></i>
                                Assesor 3
                            </span>
                            <i class="bx bx-crown bx-sm d-sm-none"></i>
                        </button>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-SuratKeterangan"
                            aria-controls="navs-pills-justified-SuratKeterangan" aria-selected="false">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bxs-file-archive bx-sm me-1_5 align-text-bottom"></i>
                                Surat Keterangan
                            </span>
                            <i class="bx bxs-file-archive bx-sm d-sm-none"></i>
                        </button>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-HapusAssesor"
                            aria-controls="navs-pills-justified-HapusAssesor" aria-selected="false">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bxs-user bx-sm me-1_5 align-text-bottom"></i>
                                Penghapus Assesor
                            </span>
                            <i class="bx bxs-user bx-sm d-sm-none"></i>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-Assesor1" role="tabpanel">
                        <div class="row g-6 mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <?php if ( isset($__dosen_assesor_1->Hp) AND $__dosen_assesor_1->Hp == TRUE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="https://api.whatsapp.com/send?phone=<?= $__dosen_assesor_1->Hp; ?>&text=Mohon Berikan Kepada Penilaian Saya Ya, Terimakasih"
                                        target="_Blank" class=" btn btn-sm btn-success my-2" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Konfirasi">
                                        <i class="bx bxl-whatsapp"></i>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if ( isset($__dosen_assesor_1->Telepon) AND $__dosen_assesor_1->Telepon == TRUE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="https://api.whatsapp.com/send?phone=<?= $__dosen_assesor_1->Telepon; ?>&text=Mohon Berikan Kepada Penilaian Saya Ya, Terimakasih"
                                        target="_Blank" class=" btn btn-sm btn-warning my-2" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Konfirasi">
                                        <i class="tf-icons bx bx-phone"></i>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    ID Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_1->Id; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nama Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_1->Nama; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Hp/Wa Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_1->Hp; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Email Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__dosen_assesor_1->EmailDosen . ' - ' . $__dosen_assesor_1->EmailPribadi; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tangga Memilih Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__helpers->TanggalWaktu( $__record_assesor->Daftar_1 ); ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tangga Auto Hapus Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__helpers->TanggalWaktu( $__record_assesor->Hapus_1 ); ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label class="form-label">
                                    Progress Assesor
                                </label>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $__progress_1; ?>%;"
                                        aria-valuenow="<?= $__progress_1; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $__progress_1; ?>%</div>
                                </div>
                            </div>
                        </div>

                        <?php if ( @$__progress_1 == '100' ) { ?>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4>
                                    Matakuliah Konversi
                                </h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center">ID Matakuliah</th>
                                                <th class="text-center">Nama Matakuliah</th>
                                                <th class="text-center">SKS</th>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Tahun Ajaran</th>
                                                <th class="text-center">Prodi</th>
                                                <th class="text-center">Histori</th>
                                            </tr>
                                        </thead>
                                        <tbody class=" table-border-bottom-0">

                                            <?php 
                                                
                                                foreach ( $__record_data_detail_1__ AS $data => $__record_1__ ) : 
                                                    
                                                    $__total_sks_1__ += $__record_1__->Sks;
                                                
                                            ?>

                                            <tr>
                                                <td class="text-center">
                                                    <?= $__nomor_1__++; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__record_1__->IdMk; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__record_1__->Matakuliah; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__record_1__->Sks; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__record_1__->Nilai; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__record_1__->Ta; ?>/<?= $__record_1__->Semester; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__record_1__->Prodi; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $__helpers->TanggalWaktu( $__record_1__->Logs ); ?>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                        <tbody class=" table-border-bottom-0">
                                            <tr>
                                                <td class="text-center" colspan="3">
                                                    <strong>
                                                        Total SKS
                                                    </strong>
                                                </td>
                                                <td class="text-center">
                                                    <strong>
                                                        <?= $__total_sks_1__; ?>
                                                    </strong>
                                                </td>
                                                <td class="text-center" colspan="4"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-Assesor2" role="tabpanel">
                        <div class="row g-6 mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <?php if ( isset($__dosen_assesor_2->Hp) AND $__dosen_assesor_2->Hp == TRUE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="https://api.whatsapp.com/send?phone=<?= $__dosen_assesor_2->Hp; ?>&text=Mohon Berikan Kepada Penilaian Saya Ya, Terimakasih"
                                        target="_Blank" class=" btn btn-sm btn-success my-2" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Konfirasi">
                                        <i class="bx bxl-whatsapp"></i>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if ( isset($__dosen_assesor_2->Telepon) AND $__dosen_assesor_2->Telepon == TRUE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="https://api.whatsapp.com/send?phone=<?= $__dosen_assesor_2->Telepon; ?>&text=Mohon Berikan Kepada Penilaian Saya Ya, Terimakasih"
                                        target="_Blank" class=" btn btn-sm btn-warning my-2" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Konfirasi">
                                        <i class="tf-icons bx bx-phone"></i>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    ID Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_2->Id; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nama Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_2->Nama; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Hp/Wa Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_2->Hp; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Email Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__dosen_assesor_2->EmailDosen . ' - ' . $__dosen_assesor_2->EmailPribadi; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tangga Memilih Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__helpers->TanggalWaktu( $__record_assesor->Daftar_2 ); ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tangga Auto Hapus Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__helpers->TanggalWaktu( $__record_assesor->Hapus_2 ); ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label class="form-label">
                                    Progress Assesor
                                </label>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $__progress_2; ?>%;"
                                        aria-valuenow="<?= $__progress_2; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $__progress_2; ?>%</div>
                                </div>
                            </div>
                        </div>

                        <?php if ( @$__progress_2 == '100' ) { ?>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4>
                                    Matakuliah Perolehan Konversi
                                </h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center" colspan="3">Judul</th>
                                                <th class="text-center" colspan="3">File</th>
                                            </tr>
                                        </thead>
                                        <tbody class=" table-border-bottom-0">

                                            <?php 
                                                
                                                foreach ( $__calon_rpl_berkas__ AS $data => $__record_2__ ) : 
                                                    
                                            ?>

                                            <tr>
                                                <td class="text-center">
                                                    <?= $__nomor_2__++; ?>
                                                </td>
                                                <td class="text-center" colspan="3">
                                                    <?= $__record_2__->Judul; ?>
                                                </td>
                                                <td class="text-center" colspan="3">
                                                    <a href="<?= $__url_file_penunjang . $__record_2__->Files; ?>"
                                                        target="_Blank" data-bs-toggle="tooltip" data-bs-offset="0,8"
                                                        data-bs-placement="top" data-bs-html="true" title="File">
                                                        <?= $__record_2__->Files; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th class="text-center">Nomor</th>
                                                        <th class="text-center">ID Matakuliah</th>
                                                        <th class="text-center">Nama Matakuliah</th>
                                                        <th class="text-center">SKS</th>
                                                        <th class="text-center">Nilai</th>
                                                        <th class="text-center">Huruf</th>
                                                    </tr>
                                                    <?php 
                                                        
                                                        $__nomor_mk_perolehan__ = '1';
                                                        $__total_sks_2__ = '0';
                                                        
                                                        $__data_mk_perolehan = $this->__db->query(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_assesor->D_2 ."' AND Ta_Rpl_Perolehan = '". $__authlogin__->Ta ."' AND Semester_Rpl_Perolehan = '". $__authlogin__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__authlogin__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__record_2__->Id ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                                                            foreach ( $__data_mk_perolehan AS $data => $__record_mk__ ) : 

                                                                $__total_sks_2__ += $__record_mk__->Sks;

                                                    ?>
                                                    <tr>
                                                        <td class="text-center">

                                                        </td>
                                                        <td class="text-center">
                                                            <?= $__nomor_mk_perolehan__++; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $__record_mk__->IdMk; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $__record_mk__->Matakuliah; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $__record_mk__->Sks; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $__record_mk__->Nilai; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $__record_mk__->Huruf; ?>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>

                                                    <tr>
                                                        <td class="text-center" colspan="4">
                                                            <strong>
                                                                Total SKS
                                                            </strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong>
                                                                <?= $__total_sks_2__; ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center" colspan="2"></td>
                                                    </tr>

                                                </thead>
                                            </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-Assesor3" role="tabpanel">
                        <div class="row g-6 mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <?php if ( isset($__dosen_assesor_3->Hp) AND $__dosen_assesor_3->Hp == TRUE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="https://api.whatsapp.com/send?phone=<?= $__dosen_assesor_3->Hp; ?>&text=Mohon Berikan Kepada Penilaian Saya Ya, Terimakasih"
                                        target="_Blank" class=" btn btn-sm btn-success my-2" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Konfirasi">
                                        <i class="bx bxl-whatsapp"></i>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if ( isset($__dosen_assesor_3->Telepon) AND $__dosen_assesor_3->Telepon == TRUE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="https://api.whatsapp.com/send?phone=<?= $__dosen_assesor_3->Telepon; ?>&text=Mohon Berikan Kepada Penilaian Saya Ya, Terimakasih"
                                        target="_Blank" class=" btn btn-sm btn-warning my-2" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="Konfirasi">
                                        <i class="tf-icons bx bx-phone"></i>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    ID Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_3->Id; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nama Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_3->Nama; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Hp/Wa Assesor
                                </label>
                                <input class="form-control" type="text" value="<?= $__dosen_assesor_3->Hp; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Email Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__dosen_assesor_3->EmailDosen . ' - ' . $__dosen_assesor_3->EmailPribadi; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tangga Memilih Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__helpers->TanggalWaktu( $__record_assesor->Daftar_3 ); ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tangga Auto Hapus Assesor
                                </label>
                                <input class="form-control" type="text"
                                    value="<?= $__helpers->TanggalWaktu( $__record_assesor->Hapus_3 ); ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label class="form-label">
                                    Progress Assesor
                                </label>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $__progress_3; ?>%;"
                                        aria-valuenow="<?= $__progress_3; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $__progress_3; ?>%</div>
                                </div>
                            </div>
                        </div>

                        <?php if ( @$__progress_3 == '100' ) { ?>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4>
                                    Berita Acara
                                </h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row g-6 mb-4">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-lg-4">
                                        <div class="form-group">
                                            <center>
                                                <img src="<?= __Base_Url(); ?>src/storages/__beritaacara/<?= $__record_data_detail_3__->Files; ?>"
                                                    alt="" class="img-thumbnail img-thumbnail">
                                            </center>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <label class="form-label">
                                            Tanggal Berita Acara
                                        </label>
                                        <input class="form-control" type="text"
                                            value="<?= isset($_SESSION['__Old__']['__Tgl']) ? $_SESSION['__Old__']['__Tgl'] : $__helpers->TanggalWaktu( $__record_data_detail_3__->Tgl ); ?>"
                                            name="__Tgl" placeholder="Tanggal Berita Acara" autocomplete="off" autofocus
                                            required readonly>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label">
                                            Waktu Berita Acara
                                        </label>
                                        <input class="form-control" type="text"
                                            value="<?= isset($_SESSION['__Old__']['__Waktu']) ? $_SESSION['__Old__']['__Waktu'] : date('h:i'); ?>"
                                            name="__Waktu" placeholder="Waktu Berita Acara" autocomplete="off" autofocus
                                            required readonly>
                                    </div> -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <label class="form-label">
                                            Judul Berita Acara
                                        </label>
                                        <input class="form-control" type="text"
                                            value="<?= isset($_SESSION['__Old__']['__Judul']) ? $_SESSION['__Old__']['__Judul'] : $__record_data_detail_3__->Judul; ?>"
                                            name="__Judul" placeholder="Judul Berita Acara" autocomplete="off"
                                            oninput="this.value = this.value.toUpperCase()" autofocus required
                                            <?= $__record_data__->S_3 == 'N' ? '' : 'readonly'; ?>>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <label class="form-label">
                                            Keterangan Berita Acara
                                        </label>
                                        <br>
                                        <?= htmlspecialchars_decode($__record_data_detail_3__->Keterangan); ?>
                                    </div>
                                    <?php if ( $__record_data__->S_3 == 'N' ) { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <label class="form-label">
                                            Upload Bukti Berita Acara
                                        </label>
                                        <br>
                                        <small class="text-danger">
                                            Format File <strong>JPG, JPEG, PNG</strong>
                                            <br>
                                            Ukuran File Maksimal 2 MB
                                        </small>
                                        <input type="file" name="__File" class="form-control" autocomplete="off">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-SuratKeterangan" role="tabpanel">
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                ID Assesor 1
                            </label>
                            <div class="col-sm-10">
                                : <strong><?= $__dosen_assesor_1->Id; ?></strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                Nama Assesor 1
                            </label>
                            <div class="col-sm-10">
                                : <strong><?= $__dosen_assesor_1->Nama; ?></strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                Tanggal Validasi
                            </label>
                            <div class="col-sm-10">
                                :
                                <strong><?= $__record_assesor->Validasi_1 === 'Y' ? $__helpers->TanggalWaktu( $__record_assesor->Tgl_1 ) : 'Belum Selesai'; ?></strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                ID Assesor 2
                            </label>
                            <div class="col-sm-10">
                                : <strong><?= $__dosen_assesor_2->Id; ?></strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                Nama Assesor 2
                            </label>
                            <div class="col-sm-10">
                                : <strong><?= $__dosen_assesor_2->Nama; ?></strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                Tanggal Validasi
                            </label>
                            <div class="col-sm-10">
                                :
                                <strong><?= $__record_assesor->Validasi_2 === 'Y' ? $__helpers->TanggalWaktu( $__record_assesor->Tgl_2 ) : 'Belum Selesai'; ?></strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                ID Assesor 3
                            </label>
                            <div class="col-sm-10">
                                : <strong><?= $__dosen_assesor_3->Id; ?></strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                Nama Assesor 3
                            </label>
                            <div class="col-sm-10">
                                : <strong><?= $__dosen_assesor_3->Nama; ?></strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2">
                                Tanggal Validasi
                            </label>
                            <div class="col-sm-10">
                                :
                                <strong><?= $__record_assesor->Validasi_3 === 'Y' ? $__helpers->TanggalWaktu( $__record_assesor->Tgl_3 ) : 'Belum Selesai'; ?></strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label class="form-label">
                                    Progress Selesai RPL
                                </label>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $__progress_sk; ?>%;"
                                        aria-valuenow="<?= $__progress_sk; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $__progress_sk; ?>%</div>
                                </div>
                            </div>
                        </div>
                        <?php if ( $__record_assesor->Validasi_1 == 'Y' AND $__record_assesor->Validasi_2 == 'Y' AND $__record_assesor->Validasi_3 == 'Y' ) { ?>
                        <hr>
                        <div class="row mb-4">
                            <div class="d-grid gap-2 col-lg-12 mx-auto">
                                <a href="<?= $__routes_mod; ?>/pdf?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_sk_rpl->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    target="_Blank" class="btn btn-md btn-primary btn-block" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="Download Surat Keterangan">
                                    <?= $__data_sk_rpl->Nomor; ?>
                                </a>
                                <hr>
                                <a href="<?= $__routes_mod; ?>/pdf_lampiran?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_sk_rpl->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    target="_Blank" class="btn btn-md btn-info btn-block" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="Download Surat Keterangan Lampiran">
                                    Lampiran
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-HapusAssesor" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center" id="table2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center">ID Assesor</th>
                                                <th class="text-center">Nama Assesor</th>
                                                <th class="text-center">Assesor</th>
                                                <th class="text-center">Tanggal Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                                $__nomor_assesor__ = '1';

                                                    foreach ( $__data_hapusassesor__ AS $data => $__assesor__ ) :

                                                        $__data_dosen__ = $__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__assesor__->IdDosen ."' ORDER BY IdDosen DESC ");

                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $__nomor_assesor__++; ?>
                                                </td>
                                                <td>
                                                    <?= $__data_dosen__->Id; ?>
                                                </td>
                                                <td>
                                                    <?= $__data_dosen__->Nama; ?>
                                                </td>
                                                <td>
                                                    <?= $__assesor__->Assesor; ?>
                                                </td>
                                                <td>
                                                    <?= $__helpers->TanggalWaktu( $__assesor__->TglHapus ); ?>
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
</div>