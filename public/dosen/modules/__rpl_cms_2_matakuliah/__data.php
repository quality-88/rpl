<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= $__routes; ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a
                    href="<?= $__routes_mod; ?>/2?__Ta=<?= $__record_data__->Ta_2; ?>&__Semester=<?= $__record_data__->Semester_2; ?>">
                    RPL
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>/cms_2?__Id=<?= $_GET['__Id']; ?>">
                    Assesor 2
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a
                    href="<?= $__routes_mod; ?>/cms_2/matakuliah?__Id=<?= $_GET['__Id']; ?>&__Id1=<?= $_GET['__Id1']; ?>&__IdMk=<?= $_GET['__IdMk']; ?>">
                    Matakuliah
                </a>
            </li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <h3 class="alert-heading d-flex align-items-center">
                    Informasi !
                </h3>
                <p class="mb-0">
                    Silahkan tambahkan data KRS Konversi dari calon mahasiswa RPL berdasarkan kecocokan dari Matakuliah
                    !
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            <hr>
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Lihat">
                        <button type="button" class="accordion-button bg-primary text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Lihat" aria-expanded="true" aria-controls="accordion-Lihat">
                            Lihat Data
                        </button>
                    </h2>
                    <div id="accordion-Lihat" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mt-lg-4">
                                <div class="col-12">
                                    <div
                                        class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                        <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/avatars/1.png"
                                            alt="user-avatar" class="d-block w-px-100 h-px-100 rounded me-3"
                                            id="uploadedAvatar">
                                        <div class="button-wrapper me-3">
                                            <div>
                                                Download File Pendukung
                                            </div>
                                            <a href="<?= $__url_file . $__calon_rpl__->FileKtp; ?>"
                                                class="btn btn-primary me-3 my-2" target="_Blank">
                                                <span class="d-none d-sm-block">
                                                    KTP
                                                </span>
                                            </a>
                                            <a href="<?= $__url_file . $__calon_rpl__->FileKk; ?>"
                                                class="btn btn-info me-3 my-2" target="_Blank">
                                                <span class="d-none d-sm-block">
                                                    Ijazah
                                                </span>
                                            </a>
                                            <a href="<?= $__url_file . $__calon_rpl__->FileNilai; ?>"
                                                class="btn btn-warning me-3 my-2" target="_Blank">
                                                <span class="d-none d-sm-block">
                                                    Transkip Nilai
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-lg-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="nav-align-top mb-6">
                                        <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                                            <li class="nav-item mb-1 mb-sm-0">
                                                <button type="button" class="nav-link active" role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-justified-biodatadiri"
                                                    aria-controls="navs-pills-justified-biodatadiri"
                                                    aria-selected="true">
                                                    <span class="d-none d-sm-block">
                                                        <i
                                                            class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                                        Biodata Diri
                                                    </span>
                                                    <i class="bx bx-user bx-sm d-sm-none"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item mb-1 mb-sm-0">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-justified-universitasasal"
                                                    aria-controls="navs-pills-justified-universitasasal"
                                                    aria-selected="false">
                                                    <span class="d-none d-sm-block">
                                                        <i
                                                            class="tf-icons bx bx-buildings bx-sm me-1_5 align-text-bottom"></i>
                                                        Universitas Asal
                                                    </span>
                                                    <i class="bx bx-buildings bx-sm d-sm-none"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item mb-1 mb-sm-0">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-justified-universitaspilihan"
                                                    aria-controls="navs-pills-justified-universitaspilihan"
                                                    aria-selected="false">
                                                    <span class="d-none d-sm-block">
                                                        <i
                                                            class="tf-icons bx bx-message-square bx-sm me-1_5 align-text-bottom"></i>
                                                        Universitas Pilihan
                                                    </span>
                                                    <i class="bx bx-message-square bx-sm d-sm-none"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item mb-1 mb-sm-0">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-justified-filepenunjang"
                                                    aria-controls="navs-pills-justified-filepenunjang"
                                                    aria-selected="false">
                                                    <span class="d-none d-sm-block">
                                                        <i
                                                            class="tf-icons bx bx-crown bx-sm me-1_5 align-text-bottom"></i>
                                                        Berkas Pendukung
                                                    </span>
                                                    <i class="bx bx-crown bx-sm d-sm-none"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item mb-1 mb-sm-0">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-justified-masastudi"
                                                    aria-controls="navs-pills-justified-masastudi"
                                                    aria-selected="false">
                                                    <span class="d-none d-sm-block">
                                                        <i
                                                            class="tf-icons bx bx-cog bx-sm me-1_5 align-text-bottom"></i>
                                                        Masa Studi
                                                    </span>
                                                    <i class="bx bx-cog bx-sm d-sm-none"></i>
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-pills-justified-biodatadiri"
                                                role="tabpanel">
                                                <div class="row g-6 mb-4">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Tanggal Daftar
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->TglDaftar; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Email
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Email; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Nama
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Nama; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Jenis Kelamin
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->JenisKelamin == 'LK' ? 'Laki - Laki' : 'Perempuan'; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Tempat, Tanggal Lahir
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->TempatLahir; ?>, <?= $__helpers->DataTanggal( $__calon_rpl__->TglLahir ); ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Alamat
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Alamat; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Nomor Hp
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->NoHp; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Nomor Wa
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->NoWa; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Pekerjaan
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Bekerja; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Lama Pekerjaan
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->LamaBekerja; ?>" autofocus
                                                            required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-pills-justified-universitasasal"
                                                role="tabpanel">
                                                <div class="row g-6 mb-4">
                                                    <?php if ( isset($__calon_rpl__->TipePt) AND $__calon_rpl__->TipePt == TRUE AND $__calon_rpl__->TipePt == 'KULIAH' ) { ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Perguruan Tinggi Asal
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->IdPtAsal; ?> - <?= $__calon_rpl__->NamaPtAsal; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Prodi Asal
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->IdProdiAsal; ?> - <?= $__calon_rpl__->NamaProdiAsal; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Jenjang Akhir Pendidikan
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->JenjangAkhir; ?>" autofocus
                                                            required readonly>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Jenjang Akhir Pendidikan
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->JenjangAkhir; ?>" autofocus
                                                            required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Sekolah Asal
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Sekolah; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-pills-justified-universitaspilihan"
                                                role="tabpanel">
                                                <div class="row g-6 mb-4">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Tahun Ajaran
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Ta; ?>/<?= $__calon_rpl__->Semester; ?> - <?= $__calon_rpl__->Semester == '1' ? 'Ganjil' : 'Genap'; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Kurikulum
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Kurikulum; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Gelombang
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Gelombang; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            ID Kampus
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->IdKampus; ?> - <?= $__calon_rpl__->NamaKampus; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Fakultas
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->NamaFakultas; ?> - <?= $__calon_rpl__->IdFakultas; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Prodi
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Prodi; ?>" autofocus required
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Jam Perkuliahan
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->JamPerkuliahan; ?>" autofocus
                                                            required readonly>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                        <label class="form-label">
                                                            Referensi
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            value="<?= $__calon_rpl__->Referensi; ?> - <?= $__calon_rpl__->NamaReferensi; ?>"
                                                            autofocus required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-pills-justified-filepenunjang"
                                                role="tabpanel">
                                                <div class="row g-6 mb-4">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">Nomor</th>
                                                                    <th class="text-center">Judul</th>
                                                                    <th class="text-center">File</th>
                                                                    <th class="text-center">Format</th>
                                                                    <th class="text-center">Histori</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class=" table-border-bottom-0">

                                                                <?php 
                                                                    
                                                                    @$__nomor = '1';

                                                                        foreach ( $__calon_rpl_berkas__ AS $data => $__record__ ) : 
                                                                    
                                                                ?>

                                                                <tr>
                                                                    <td class="text-center">
                                                                        <?= $__nomor++; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__record__->Judul; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="<?= $__url_file_penunjang . $__record__->Files; ?>"
                                                                            target="_Blank" data-bs-toggle="tooltip"
                                                                            data-bs-offset="0,8" data-bs-placement="top"
                                                                            data-bs-html="true" title="File">
                                                                            <?= $__record__->Files; ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__record__->Format; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__helpers->TanggalWaktu( $__record__->Logs ); ?>
                                                                    </td>
                                                                </tr>

                                                                <?php endforeach; ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-pills-justified-masastudi"
                                                role="tabpanel">
                                                <div class="row g-6 mb-4">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">Pengalaman Bekerja</th>
                                                                    <th class="text-center">Pendidikan Formal</th>
                                                                    <th class="text-center">Dokumen Pendukung</th>
                                                                    <th class="text-center">Sisa Masa Studi</th>
                                                                    <th class="text-center">Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class=" table-border-bottom-0">
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <?= $__calon_rpl__->Bekerja === 'BEKERJA' ? $__calon_rpl__->LamaBekerja : 'TIDAK BEKERJA'; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__calon_rpl__->JenjangAkhir; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__total_berkas_pendukung; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__calon_rpl__->Studi . ' Semester'; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $__calon_rpl__->TipeJenis; ?>
                                                                    </td>
                                                                </tr>
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
                </div>
            </div>
            <div class="accordion mt-lg-2" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Filter">
                        <button type="button" class="accordion-button bg-danger text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Filter" aria-expanded="true" aria-controls="accordion-Filter">
                            Filter Matakuliah Konversi
                        </button>
                    </h2>
                    <div id="accordion-Filter"
                        class="accordion-collapse collapse <?= isset($_POST['__Filter_IdMk']) || isset($__data_filter_assesor_2->Id) ? '' : 'show'; ?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mt-lg-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form name="frmInput" action="" method="POST" enctype="multipart/form-data">

                                        <input type="hidden" name="__Token" class="form-control"
                                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                            required readonly>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                <h5 class="text-center">
                                                    MATA KULIAH RPL KONVERSI
                                                    <br>
                                                    <strong class="mt-lg-2">
                                                        <?= $__record_data_detail__->IdMk; ?> -
                                                        <?= $__record_data_detail__->Matakuliah; ?> -
                                                        <?= $__record_data_detail__->Sks; ?> SKS
                                                    </strong>
                                                </h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                <div class="form-group">
                                                    <label>
                                                        Pilih Matakuliah Yang Cocok Dikonversikan
                                                    </label>
                                                    <select name="__Filter_IdMk" class="form-control select2-kedua"
                                                        required>
                                                        <?php 

                                                            if ( isset($_POST) AND $_POST['__Filter_IdMk'] == TRUE || isset($__data_filter_assesor_2->Id) ) {
                                                        
                                                                echo 
                                                                    "
                                                                        <option value='". $__filter_data_matakuliah__->IdMk ."' selected>
                                                                            ". $__filter_data_matakuliah__->IdMk ." - ". $__filter_data_matakuliah__->Matakuliah ." (". $__filter_data_matakuliah__->Sks ." SKS) 
                                                                        </option>
                                                                        <option value='' disabled>
                                                                            --- ##### ---
                                                                        </option>
                                                                    ";

                                                            } else {
                                                                
                                                                echo 
                                                                    "
                                                                        <option value='' selected disabled>
                                                                            --- Pilih Matakuliah Yang Cocok Dikonversikan ---
                                                                        </option>
                                                                    ";

                                                            }

                                                            foreach ( $__record__data__filter__ AS $data => $__filter__ ) :

                                                                $__record_data_assesor_2__ = $this->__db->queryid(" SELECT TOP 1 IdMk_Pilih_Rpl_Assesor_2 AS IdMk FROM Tbl_Rpl_Assesor_2 WHERE IdMk_Pilih_Rpl_Assesor_2 = '". $__filter__['IdMk'] ."' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND IdDosen_Rpl_Assesor_2 = '". $__record_data__->D_2 ."' AND Ta_Rpl_Assesor_2 = '". $__record_data__->Ta_2 ."' AND Semester_Rpl_Assesor_2 = '". $__record_data__->Semester_2 ."' AND Prodi_Rpl_Assesor_2 = '". $__record_data__->Prodi_2 ."' ORDER BY IdMk_Pilih_Rpl_Assesor_2 DESC ");

                                                                if ( !isset($__record_data_assesor_2__->IdMk) AND $__record_data_assesor_2__->IdMk != $__filter__['IdMk'] ) {

                                                                    echo 
                                                                        "
                                                                            <option value='". $__filter__['IdMk'] ."'>
                                                                                ". $__filter__['IdMk'] ." - ". $__filter__['Matakuliah'] ." (". $__filter__['Sks'] ." SKS) 
                                                                            </option>
                                                                        ";

                                                                }

                                                            endforeach;

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php if ( !isset($__data_filter_assesor_2->Id) AND $__data_filter_assesor_2->Id == FALSE ) { ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"
                                                        name="__BtnSubmit_Filter" data-bs-toggle="tooltip"
                                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                        title="Filter">
                                                        Filter
                                                    </button>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' || isset($__data_filter_assesor_2->Id) ) { ?>
            <div class="accordion mt-lg-2" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-EvaluasiDiri">
                        <button type="button" class="accordion-button bg-warning text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-EvaluasiDiri" aria-expanded="true"
                            aria-controls="accordion-EvaluasiDiri">
                            Lihat Formulir Evaluasi Diri Data
                        </button>
                    </h2>
                    <div id="accordion-EvaluasiDiri" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row g-6 mb-4">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <h3 class="text-center my-lg-2">
                                        <?= $__data_evaluasidiri__->Judul; ?>
                                    </h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Nama Perguruan Tinggi
                                    </label>
                                    <input class="form-control" type="text"
                                        value="<?= $__universitas->__Detail_Universitas()['Nama']; ?>" autofocus
                                        required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Nama Program Studi
                                    </label>
                                    <input class="form-control" type="text"
                                        value="<?= $__universitas->__Konversi_Prodi(['Prodi' => $__calon_rpl__->Prodi]); ?>"
                                        autofocus required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Nama Calon RPL
                                    </label>
                                    <input class="form-control" type="text" value="<?= $__calon_rpl__->Nama; ?>"
                                        autofocus required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Tempat, Tanggal Lahir
                                    </label>
                                    <input class="form-control" type="text"
                                        value="<?= $__calon_rpl__->TempatLahir; ?>, <?= $__helpers->DataTanggal( $__calon_rpl__->TglLahir ); ?>"
                                        autofocus required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Alamat Email
                                    </label>
                                    <input class="form-control" type="text" value="<?= $__calon_rpl__->Email; ?>"
                                        autofocus required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Nomor Hp/Wa
                                    </label>
                                    <input class="form-control" type="text"
                                        value="<?= $__calon_rpl__->NoHp; ?> / <?= $__calon_rpl__->NoWa; ?>" autofocus
                                        required readonly>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <label class="form-label">
                                        Nama Matakuliah
                                    </label>
                                    <input class="form-control" type="text"
                                        value="<?= $__record_data_detail__->IdMk; ?> - <?= $__record_data_detail__->Matakuliah; ?>"
                                        autofocus required readonly>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <p>
                                        <?= htmlspecialchars_decode( $__data_evaluasidiri__->Isi ); ?>
                                    </p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Profesiensi / Kemampuan</th>
                                                    <th class="text-center">Uraian</th>
                                                </tr>
                                            </thead>
                                            <tbody class=" table-border-bottom-0">

                                                <?php foreach ( $__data_profesiensi__ AS $data => $__profesiensi__ ) : ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?= $__profesiensi__->Judul; ?>
                                                    </td>
                                                    <td class="text-left">
                                                        <?= htmlspecialchars_decode( $__profesiensi__->Isi ); ?>
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
            <div class="accordion mt-lg-2" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Portofolio">
                        <button type="button" class="accordion-button bg-info text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Portofolio" aria-expanded="true"
                            aria-controls="accordion-Portofolio">
                            Lihat Portofolio / Bukti
                        </button>
                    </h2>
                    <div id="accordion-Portofolio" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row g-6 mb-4">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <h3 class="text-center my-lg-2">
                                        Bukti (Portofolio)
                                    </h3>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <p>
                                        Bukti (portofolio) untuk mendukung klaim calon atas pernyataan kriteria capaian
                                        pembelajaran mata kuliah atau modul pembelajaran yang dilampirkan calon pada
                                        saat mengajukan lamaran yang akan di verifikasi oleh Asesor sesuai prinsip
                                        bukti, yaitu,
                                        <br>
                                        <?php 
                                            foreach ( $__data_hasilevaluasi__ AS $data => $__hasilevaluasi__ ) :

                                                echo $__hasilevaluasi__->Judul . ' <strong>(' . $__hasilevaluasi__->Singkatan . ')</strong>, ';

                                            endforeach;
                                        ?>
                                        yaitu:
                                        <br>
                                        <?php 
                                            foreach ( $__data_hasilevaluasi__ AS $data => $__hasilevaluasi__ ) :

                                                echo 
                                                    "
                                                        <ul>
                                                            <li>
                                                                ". $__hasilevaluasi__->Judul ." ". htmlspecialchars_decode( $__hasilevaluasi__->Isi ) ."
                                                            </li>
                                                        </ul>
                                                    ";

                                            endforeach;
                                        ?>
                                    </p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <div class="table-responsive">
                                        <p>
                                            Bukti yang dapat digunakan untuk mendukung klaim saudara atau pencapaian
                                            profesiensi yang baik dan atau sangat baik tersebut antara lain:
                                        </p>
                                        <table class="table table-striped table-hover table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Dokumen</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center">Format Upload</th>
                                                </tr>
                                            </thead>
                                            <tbody class=" table-border-bottom-0">

                                                <?php foreach ( $__data_keterangandokumen__ AS $data => $__keterangandokumen__ ) : ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?= $__keterangandokumen__->Judul; ?>
                                                    </td>
                                                    <td class="text-left">
                                                        <?= htmlspecialchars_decode( $__keterangandokumen__->Isi ); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $__keterangandokumen__->Format; ?>
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
        </div>
    </div>
</div>

<?php if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' || isset($__data_filter_assesor_2->Id) ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-md mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header text-center">
                    MATA KULIAH RPL KONVERSI
                    <br>
                    <strong class="mt-lg-2">
                        <?= $__record_data_detail__->IdMk; ?> - <?= $__record_data_detail__->Matakuliah; ?> -
                        <?= $__record_data_detail__->Sks; ?> SKS
                    </strong>
                    <hr>
                    <div class="text-danger">
                        MATA KULIAH YANG DIPILIH
                        <br>
                        <strong class="mt-lg-2">
                            <?= $__filter_data_matakuliah__->IdMk; ?> - <?= $__filter_data_matakuliah__->Matakuliah; ?>
                            -
                            <?= $__filter_data_matakuliah__->Sks; ?> SKS
                        </strong>
                    </div>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <p>
                                <?= htmlspecialchars_decode($__data_evaluasidiri__->Keterangan); ?>
                            </p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2" width="5%">
                                                No
                                            </th>
                                            <th class="text-center" rowspan="2" width="5%">
                                                Aksi
                                            </th>
                                            <th class="text-center" rowspan="2" width="30%">
                                                Kemampuan Akhir Yang Diharapkan / Capaian Pembelajaran Mata Kuliah
                                            </th>
                                            <!-- <th class="text-center"
                                                colspan="<?= $__data_profesiensi__total__->Total; ?>" width="10%">
                                                Profesiensi Pengetahuan dan Keterampilan Saat Ini
                                            </th> -->
                                            <th class="text-center" rowspan="2" width="20%">
                                                Profesiensi Pengetahuan dan Keterampilan Saat Ini
                                            </th>
                                            <th class="text-center"
                                                colspan="<?= $__data_hasilevaluasi__total__->Total; ?>" width="10%">
                                                Hasil Evaluasi Assesor
                                            </th>
                                            <!-- <th class="text-center" rowspan="2" width="20%">
                                                Hasil Evaluasi Assesor
                                            </th> -->
                                            <th class="text-center" colspan="2" width="20%">
                                                Bukti Yang Disampaikan
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php 
                                            
                                                // foreach ( $__data_profesiensi__ AS $data => $__profesiensi__ ) :

                                                //     echo 
                                                //         "
                                                //             <th class='text-center'>
                                                //                 ". $__profesiensi__->Judul ."
                                                //             </th>
                                                //         ";
                                        
                                                // endforeach; 

                                                foreach ( $__data_hasilevaluasi__ AS $data => $__hasilevaluasi__ ) :

                                                    echo 
                                                        "
                                                            <th class='text-center'>
                                                                ". $__hasilevaluasi__->Singkatan ."
                                                            </th>
                                                        ";

                                                endforeach;
                                                
                                            ?>
                                            <th class="text-center">
                                                Nomor Dokumen
                                            </th>
                                            <th class="text-center">
                                                Jenis Dokumen
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">

                                        <?php 
                                        
                                            foreach ( $__data_cpmk__ AS $data => $__cpmk__ ) : 

                                                $__record_data_assesor_2__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor_2 AS Id, IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Pilih, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Pilih, Sks_Pilih_Rpl_Assesor_2 AS Sks_Pilih, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen, File_Rpl_Assesor_2 AS Files, Judul_Rpl_Assesor_2 AS Judul, Format_Rpl_Assesor_2 AS Format, Slugs_Rpl_Assesor_2 AS Slugs, User_Rpl_Assesor_2 AS Users, Log_Rpl_Assesor_2 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2 AS IdDosen, Ta_Rpl_Assesor_2 AS Ta, Semester_Rpl_Assesor_2 AS Semester, Prodi_Rpl_Assesor_2 AS Prodi, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE IdMk_Asal_Rpl_Assesor_2 = '". $__record_data_detail__->IdMk ."' AND IdMk_Pilih_Rpl_Assesor_2 = '". $__filter_data_matakuliah__->IdMk ."' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND IdDosen_Rpl_Assesor_2 = '". $__record_data__->D_2 ."' AND Ta_Rpl_Assesor_2 = '". $__record_data__->Ta_2 ."' AND Semester_Rpl_Assesor_2 = '". $__record_data__->Semester_2 ."' AND Prodi_Rpl_Assesor_2 = '". $__record_data__->Prodi_2 ."' AND Id_Rpl_Assesor_1 = '". $__record_data_detail__->Id ."' AND Id_Cpmk = '". $__cpmk__->Id ."' ORDER BY Id_Rpl_Assesor_2 DESC ");

                                                if ( isset($__record_data_assesor_2__->Id) AND $__record_data_assesor_2__->Id == TRUE ) {

                                                    $__data_profesiensi_detail__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_Profesiensi AS Id, Judul_Rpl_Cms_Profesiensi AS Judul, Isi_Rpl_Cms_Profesiensi AS Isi, User_Rpl_Cms_Profesiensi AS Users, Log_Rpl_Cms_Profesiensi AS Logs, Kampus, Data AS Datas, Id_Rpl_Cms_EvaluasiDiri FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_Profesiensi = '". $__record_data_assesor_2__->Id_Rpl_Cms_Profesiensi ."' ORDER BY Id_Rpl_Cms_Profesiensi ASC  ");

                                                    $__data_nomordokumen_detail__ = $this->__db->query(" SELECT Id_Rpl_Assesor_2_NomorDokumen AS Id, Id_Rpl_Cms_NomorDokumen AS Id_Nomor, Kode_Rpl_Cms_NomorDokumen AS Kode_Nomor, Nama_Rpl_Cms_NomorDokumen AS Nama_Nomor, Id_Rpl_Assesor_1, Id_Rpl_Assesor_2 FROM Tbl_Rpl_Assesor_2_NomorDokumen WHERE Id_Rpl_Assesor_1 = '". $__record_data_assesor_2__->Id_Rpl_Assesor_1 ."' AND Id_Rpl_Assesor_2  = '". $__record_data_assesor_2__->Id ."' ORDER BY Kode_Rpl_Cms_NomorDokumen ASC ");

                                                } 
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor_cpmk__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ( $__record_data_assesor_2__->Id == FALSE ) { ?>
                                                <div>
                                                    <a href="<?= $__routes_mod; ?>/cms_2/matakuliah/upload?__Id=<?= $_GET['__Id']; ?>&__Id1=<?= $_GET['__Id1']; ?>&__IdMk=<?= $_GET['__IdMk']; ?>&__IdMkCpmk=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__filter_data_matakuliah__->IdMk . '|\|' . time() , 221 , 5 ); ?>&__IdCpmk=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__cpmk__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                                        class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                        title="Upload Berkas">
                                                        Upload
                                                    </a>
                                                </div>
                                                <?php } else { ?>
                                                <div>
                                                    <a href="<?= $__routes_mod; ?>/cms_2/matakuliah/ubah?__Id=<?= $_GET['__Id']; ?>&__Id1=<?= $_GET['__Id1']; ?>&__IdMk=<?= $_GET['__IdMk']; ?>&__IdMkCpmk=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__filter_data_matakuliah__->IdMk . '|\|' . time() , 221 , 5 ); ?>&__IdCpmk=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__cpmk__->Id . '|\|' . time() , 221 , 5 ); ?>&__Id2=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_data_assesor_2__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                                        class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                        title="Ubah Berkas">
                                                        Ubah
                                                    </a>
                                                </div>
                                                <?php } ?>
                                            </td>
                                            <td class="text-left">
                                                <?= $__cpmk__->C; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if ( isset($__data_profesiensi_detail__->Id) AND $__data_profesiensi_detail__->Id == TRUE AND $__data_profesiensi_detail__->Id == $__record_data_assesor_2__->Id_Rpl_Cms_Profesiensi ) {

                                                        echo $__data_profesiensi_detail__->Judul;

                                                    } else {

                                                        echo 
                                                            "
                                                                -
                                                            ";

                                                    }
                                                ?>
                                            </td>
                                            <?php 
                                                foreach ( $__data_hasilevaluasi__ AS $data => $__hasilevaluasi__ ) :

                                                    $__record_data_assesor_2__hasilevaluasi__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_2_HasilEvaluasi AS Id, Id_Rpl_Cms_HasilEvaluasiAsesor, Id_Rpl_Assesor_1, Id_Rpl_Assesor_2 FROM Tbl_Rpl_Assesor_2_HasilEvaluasi WHERE Id_Rpl_Cms_HasilEvaluasiAsesor = '". $__hasilevaluasi__->Id ."' AND Id_Rpl_Assesor_1 = '". $__record_data_assesor_2__->Id_Rpl_Assesor_1 ."' AND Id_Rpl_Assesor_2 = '". $__record_data_assesor_2__->Id ."' ");

                                                        if ( isset($__record_data_assesor_2__hasilevaluasi__) AND $__record_data_assesor_2__hasilevaluasi__ == TRUE ) {

                                                            $__check_hasilevaluasiassesor = '<strong><span class="tf-icons bx bx-check bx-28px text-success"></span></strong>';
                                                            
                                                        } else {

                                                            $__check_hasilevaluasiassesor = '';

                                                        }

                                                    echo 
                                                        "
                                                            <td class='text-center'>
                                                                ". $__check_hasilevaluasiassesor ."
                                                            </td>
                                                        ";

                                                endforeach;
                                            ?>
                                            <td class="text-center">
                                                <?php 
                                                    if ( isset($__record_data_assesor_2__->Id) AND $__record_data_assesor_2__->Id == TRUE ) { 

                                                        foreach ( $__data_nomordokumen_detail__ AS $data => $__nomordokumen ) :

                                                            echo $__nomordokumen->Kode_Nomor . '<br>';

                                                        endforeach;

                                                    } else {

                                                        echo "-";

                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( isset($__record_data_assesor_2__->Id) AND $__record_data_assesor_2__->Id == TRUE ) { 

                                                        foreach ( $__data_nomordokumen_detail__ AS $data => $__nomordokumen ) :

                                                            echo $__nomordokumen->Nama_Nomor . '<br>';

                                                        endforeach;

                                                    } else {

                                                        echo "-";

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