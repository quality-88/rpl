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
                    href="<?= $__routes_mod; ?>/3?__Ta=<?= $__record_data__->Ta_3; ?>&__Semester=<?= $__record_data__->Semester_3; ?>">
                    RPL
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>/cms_3?__Id=<?= $_GET['__Id']; ?>">
                    Assesor 3
                </a>
            </li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php if ( $__record_data__->S_3 == 'N' ) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <h3 class="alert-heading d-flex align-items-center">
                    Informasi !
                </h3>
                <p class="mb-0">
                    Silahkan tambahkan data KRS Konversi dari calon mahasiswa RPL !
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            <?php } else { ?>
            <div class="alert alert-primary alert-dismissible" role="alert">
                <h3 class="alert-heading d-flex align-items-center">
                    Informasi !
                </h3>
                <p class="mb-0">
                    Telah Memvalidasikan data KRS Konversi dari calon mahasiswa RPL !
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
            <?php } ?>
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
        </div>
    </div>
</div>


<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-md mb-4 mb-md-0">
            <div class="card">
                <h5 class="card-header">
                    Review Data
                    <hr>
                    <?php if ( $__record_data__->S_3 == 'N' AND $__data_assesor_3->Id == TRUE ) { ?>
                    <a href="#" class="btn btn-lg btn-info __session_data_assesor3" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Validasi"
                        __slugs="Apakah Yakin Untuk Validasi Data Seluruh Dari Inputan KRS Konversi Ini ?"
                        __url="<?= $__routes_mod; ?>/cms_3/validasi?__Id=<?= $_GET['__Id']; ?>&__Id1=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__calon_rpl__->Id . '|\|' . time() , 221 , 5 ); ?>&__As3=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_data__->D_3 . '|\|' . time() , 221 , 5 ); ?>">
                        Validasi
                    </a>
                    <?php } ?>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <form name="frmInput" action="<?= $__routes_mod; ?>/cms_3/simpan" method="POST"
                                enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control"
                                    value="<?= $__routes_mod; ?>/cms_3?__Id=<?= $_GET['__Id']; ?>" required readonly>

                                <input type="hidden" name="__Url_Success" class="form-control"
                                    value="<?= $__routes_mod; ?>/cms_3?__Id=<?= $_GET['__Id']; ?>" required readonly>

                                <input type="hidden" name="__IdAssesor" class="form-control"
                                    value="<?= $_GET['__Id']; ?>" required readonly>

                                <input type="hidden" name="__IdRplPendaftaran" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__calon_rpl__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__IdDosenAssesor" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record_data__->D_3 . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>


                                <?php if ( isset($__data_assesor_3->Id) AND $__data_assesor_3->Id == TRUE ) { ?>

                                <input type="hidden" name="__IdAssesor_3" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_assesor_3->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__IdAssesor_3_File" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_assesor_3->Files . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <?php } ?>


                                <div class="row">
                                    <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <p>
                                            Silahkan menyelesaikan data berita acara pada hasil wawancara dengan Assesor
                                            dan juga calon RPL !
                                        </p>
                                        <hr>
                                        <div class="row g-6 mb-4">
                                            <?php if ( isset($__data_assesor_3->Id) AND $__data_assesor_3->Id == TRUE ) { ?>
                                            <div
                                                class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-lg-4">
                                                <div class="form-group">
                                                    <center>
                                                        <img src="<?= __Base_Url(); ?>src/storages/__beritaacara/<?= $__data_assesor_3->Files; ?>"
                                                            alt="" class="img-thumbnail img-thumbnail">
                                                    </center>
                                                </div>
                                                <hr>
                                            </div>
                                            <?php } ?>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                <label class="form-label">
                                                    Tanggal Berita Acara
                                                </label>
                                                <input class="form-control" type="date"
                                                    value="<?= isset($_SESSION['__Old__']['__Tgl']) ? $_SESSION['__Old__']['__Tgl'] : date('Y-m-d'); ?>"
                                                    name="__Tgl" placeholder="Tanggal Berita Acara" autocomplete="off"
                                                    autofocus required readonly>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                <label class="form-label">
                                                    Waktu Berita Acara
                                                </label>
                                                <input class="form-control" type="text"
                                                    value="<?= isset($_SESSION['__Old__']['__Waktu']) ? $_SESSION['__Old__']['__Waktu'] : date('h:i'); ?>"
                                                    name="__Waktu" placeholder="Waktu Berita Acara" autocomplete="off"
                                                    autofocus required readonly>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                <label class="form-label">
                                                    Judul Berita Acara
                                                </label>
                                                <input class="form-control" type="text"
                                                    value="<?= isset($_SESSION['__Old__']['__Judul']) ? $_SESSION['__Old__']['__Judul'] : $__data_assesor_3->Judul; ?>"
                                                    name="__Judul" placeholder="Judul Berita Acara" autocomplete="off"
                                                    oninput="this.value = this.value.toUpperCase()" autofocus required
                                                    <?= $__record_data__->S_3 == 'N' ? '' : 'readonly'; ?>>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                <label class="form-label">
                                                    Keterangan Berita Acara
                                                </label>
                                                <textarea name="__Keterangan" class="ckeditor" id="ckedtor"
                                                    autocomplete="off" minlength="25"
                                                    <?= $__record_data__->S_3 == 'N' ? '' : 'readonly'; ?>>
                                                    <?= isset($_SESSION['__Old__']['__Keterangan']) ? $_SESSION['__Old__']['__Keterangan'] : htmlspecialchars_decode($__data_assesor_3->Keterangan); ?>
                                                </textarea>
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
                                                <input type="file" name="__File" class="form-control"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                <div class="form-group">
                                                    <div class="d-grid gap-2 col-lg-12 mx-auto">
                                                        <button type="submit" class="btn btn-primary"
                                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                            data-bs-placement="top" data-bs-html="true" title="Simpan">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
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