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
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/rpl_report/detail?__Id=' . $_GET['__Id']); ?>">
                    Detail
                </a>
            </li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card col-lg-12 mb-4 order-0">
            <div class="card-body">
                <!-- <div class="d-grid gap-2 col-lg-12 mx-auto mb-lg-4">
                    <a href="<?= url('/homerpl/sk_mendaftar_pdf'); ?>?__Id=<?= $__helpers->SecretEncrypt( $__data_rpl__->Id ); ?>"
                        target="_Blank" class="btn btn-lg btn-success" data-bs-toggle="tooltip" data-bs-offset="0,4"
                        data-bs-placement="top" data-bs-html="true" title="Download Surat Keterangan Mendaftar">
                        Download Surat Keterangan Mendaftar
                    </a>
                </div> -->
                <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                    <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/avatars/1.png" alt="user-avatar"
                        class="d-block w-px-100 h-px-100 rounded me-3" id="uploadedAvatar">
                    <div class="button-wrapper me-3">
                        <div>
                            Download File Pendukung
                        </div>
                        <a href="<?= $__url_file . $__data_rpl__->FileKtp; ?>" class="btn btn-primary me-3 my-2"
                            target="_Blank">
                            <span class="d-none d-sm-block">
                                KTP
                            </span>
                        </a>
                        <a href="<?= $__url_file . $__data_rpl__->FileKk; ?>" class="btn btn-info me-3 my-2"
                            target="_Blank">
                            <span class="d-none d-sm-block">
                                Ijazah
                            </span>
                        </a>
                        <a href="<?= $__url_file . $__data_rpl__->FileNilai; ?>" class="btn btn-warning me-3 my-2"
                            target="_Blank">
                            <span class="d-none d-sm-block">
                                Transkip Nilai
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-primary alert-dismissible" role="alert">
            <h4 class="alert-heading d-flex align-items-center mb-1">
                Informasi
            </h4>
            <p class="mb-0">
                Beirkut Ini Data Lengkap Dari
                <strong class="text-danger">Mahasiswa RPL</strong> !
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="nav-align-top mb-6">
            <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-biodatadiri"
                        aria-controls="navs-pills-justified-biodatadiri" aria-selected="true">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                            Biodata Diri
                        </span>
                        <i class="bx bx-user bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-universitasasal"
                        aria-controls="navs-pills-justified-universitasasal" aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-buildings bx-sm me-1_5 align-text-bottom"></i>
                            <?= $__data_rpl__->TipePt === 'KULIAH' ? 'Universitas Asal' : 'Sekolah Asal' ?>
                        </span>
                        <i class="bx bx-buildings bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-universitaspilihan"
                        aria-controls="navs-pills-justified-universitaspilihan" aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-message-square bx-sm me-1_5 align-text-bottom"></i>
                            Universitas Pilihan
                        </span>
                        <i class="bx bx-message-square bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-filepenunjang"
                        aria-controls="navs-pills-justified-filepenunjang" aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-crown bx-sm me-1_5 align-text-bottom"></i>
                            Berkas Pendukung
                        </span>
                        <i class="bx bx-crown bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-masastudi" aria-controls="navs-pills-justified-masastudi"
                        aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-cog bx-sm me-1_5 align-text-bottom"></i>
                            Masa Studi
                        </span>
                        <i class="bx bx-cog bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-matakuliah"
                        aria-controls="navs-pills-justified-matakuliah" aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-book bx-sm me-1_5 align-text-bottom"></i>
                            Matakuliah Konversi
                        </span>
                        <i class="bx bx-book bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-perolehan" aria-controls="navs-pills-justified-perolehan"
                        aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-file bx-sm me-1_5 align-text-bottom"></i>
                            Matakuliah Perolehan
                        </span>
                        <i class="bx bx-file bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-keterangan"
                        aria-controls="navs-pills-justified-keterangan" aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-check bx-sm me-1_5 align-text-bottom"></i>
                            Surat Keterangan
                        </span>
                        <i class="bx bx-check bx-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-bukti"
                        aria-controls="navs-pills-justified-bukti" aria-selected="false">
                        <span class="d-none d-sm-block">
                            <i class="tf-icons bx bx-check bx-sm me-1_5 align-text-bottom"></i>
                            Bukti Pengajaran
                        </span>
                        <i class="bx bx-book-open bx-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-biodatadiri" role="tabpanel">
                    <form name="frmInput" action="<?= $__routes; ?>/biodatadiri" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="__Token" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <input type="hidden" name="__Url" class="form-control" value="<?= $__routes; ?>" required
                            readonly>

                        <input type="hidden" name="__Id" class="form-control"
                            value="<?= $__helpers->SecretEncrypt( $__data_rpl__->Id ); ?>" required readonly>

                        <div class="row g-6 mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tanggal Daftar
                                </label>
                                <input class="form-control" type="text" value="<?= $__data_rpl__->TglDaftar; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="text" value="<?= $__data_rpl__->Email; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nama
                                </label>
                                <input name="__Nama" class="form-control" type="text"
                                    oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    value="<?= $__data_rpl__->Nama; ?>" autofocus required
                                    <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Jenis Kelamin
                                </label>
                                <select name="__JenisKelamin" class="form-control" autofocus required>
                                    <?php 
                                        if ( isset($__data_rpl__->JenisKelamin) ) {

                                            $__get_jeniskelamin__ = $__data_rpl__->JenisKelamin == 'LK' ? 'LAKI - LAKI' : 'PEREMPUAN';

                                            echo 
                                                "
                                                    <option value='". $__data_rpl__->JenisKelamin ."' selected>
                                                        ". $__get_jeniskelamin__ ."
                                                    </option>
                                                    <option value='' disabled>
                                                        --- ##### ---
                                                    </option>
                                                ";

                                        } else {

                                            echo 
                                                "
                                                    <option value='' disabled>
                                                        --- Pilih Jenis Kelamin ---
                                                    </option>
                                                ";

                                        }

                                        if ( @$__check_assesor_1__ == FALSE ) {

                                            foreach ( $__filter_jeniskelamin__ AS $data => $__jeniskelamin__ ) :

                                                if ( $__data_rpl__->JenisKelamin != $data ) {

                                                    echo 
                                                        "
                                                            <option value='". $data ."'>
                                                                ". $__jeniskelamin__ ."
                                                            </option>
                                                        ";

                                                }

                                            endforeach;

                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tempat, Tanggal Lahir
                                </label>
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-6">
                                        <input name="__Tempat" class="form-control" type="text"
                                            oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                            value="<?= $__data_rpl__->TempatLahir; ?>" autofocus required
                                            <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-6">
                                        <input name="__TglLahir" class="form-control" type="date"
                                            value="<?= date('Y-m-d', strtotime($__data_rpl__->TglLahir) ); ?>" autofocus
                                            required
                                            <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Alamat
                                </label>
                                <input name="__Alamat" class="form-control" type="text"
                                    oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    value="<?= $__data_rpl__->Alamat; ?>" autofocus required
                                    <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Hp
                                </label>
                                <input name="__Hp" class="form-control" type="text" value="<?= $__data_rpl__->NoHp; ?>"
                                    maxlength="15" onkeypress="return TextAngka(event)" autocomplete="off" autofocus
                                    required <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Wa
                                </label>
                                <input name="__Wa" class="form-control" type="text" value="<?= $__data_rpl__->NoWa; ?>"
                                    maxlength="15" onkeypress="return TextAngka(event)" autocomplete="off" autofocus
                                    required <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Pekerjaan
                                </label>
                                <input class="form-control" type="text" value="<?= $__data_rpl__->Bekerja; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Lama Pekerjaan
                                </label>
                                <input class="form-control" type="text" value="<?= $__data_rpl__->LamaBekerja; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
                                <?php if ( @$__check_assesor_1__ == FALSE ) { ?>
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <button type="button" class="btn btn-md btn-block btn-success"
                                        data-bs-toggle="modal" data-bs-target="#__Modal_BiodataDiri__">
                                        Ubah Data
                                    </button>
                                    <div class="modal fade" id="__Modal_BiodataDiri__" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">
                                                        Informasi
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Apakah kamu sudah yakin untuk mengubahkan data pribadi kamu ?
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
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-universitasasal" role="tabpanel">
                    <div class="row g-6 mb-4">
                        <?php if ( isset($__data_rpl__->TipePt) AND $__data_rpl__->TipePt == TRUE AND $__data_rpl__->TipePt == 'KULIAH' ) { ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Perguruan Tinggi Asal
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__data_rpl__->IdPtAsal; ?> - <?= $__data_rpl__->NamaPtAsal; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Prodi Asal
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__data_rpl__->IdProdiAsal; ?> - <?= $__data_rpl__->NamaProdiAsal; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <label class="form-label">
                                Jenjang Akhir Pendidikan
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->JenjangAkhir; ?>"
                                autofocus required readonly>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Jenjang Akhir Pendidikan
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->JenjangAkhir; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Sekolah Asal
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->Sekolah; ?>" autofocus
                                required readonly>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-universitaspilihan" role="tabpanel">
                    <div class="row g-6 mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Tahun Ajaran
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__data_rpl__->Ta; ?>/<?= $__data_rpl__->Semester; ?> - <?= $__data_rpl__->Semester == '1' ? 'Ganjil' : 'Genap'; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Kurikulum
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->Kurikulum; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Gelombang
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->Gelombang; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                ID Kampus
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__data_rpl__->IdKampus; ?> - <?= $__data_rpl__->NamaKampus; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Fakultas
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__data_rpl__->NamaFakultas; ?> - <?= $__data_rpl__->IdFakultas; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Prodi
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->Prodi; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Jam Perkuliahan
                            </label>
                            <input class="form-control" type="text" value="<?= $__data_rpl__->JamPerkuliahan; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Referensi
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__data_rpl__->Referensi; ?> - <?= $__data_rpl__->NamaReferensi; ?>"
                                autofocus required readonly>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-filepenunjang" role="tabpanel">
                    <div class="row g-6 mb-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="width:100%">
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

                                            foreach ( $__data_rpl_berkas__ AS $data => $__record__ ) : 
                                        
                                    ?>

                                    <tr>
                                        <td class="text-center">
                                            <?= $__nomor++; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__record__->Judul; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= $__url_file_penunjang . $__record__->Files; ?>" target="_Blank"
                                                data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top"
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
                <div class="tab-pane fade" id="navs-pills-justified-masastudi" role="tabpanel">
                    <div class="row g-6 mb-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="width:100%">
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
                                            <?= $__data_rpl__->Bekerja === 'BEKERJA' ? $__data_rpl__->LamaBekerja : 'TIDAK BEKERJA'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__data_rpl__->JenjangAkhir; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__total_berkas_pendukung->Total; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__data_rpl__->Studi . ' Semester'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__data_rpl__->TipeJenis; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-matakuliah" role="tabpanel">
                    <div class="row g-6 mb-4">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-perolehan" role="tabpanel">
                    <div class="row g-6 mb-4">
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
                                                        
                                                        $__data_mk_perolehan = $this->__db->query(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE Ta_Rpl_Perolehan = '". $__data_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__data_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__data_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__record_2__->Id ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

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
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-keterangan" role="tabpanel">
                    <div class="row g-6 mb-4">
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
                        <!-- <hr>
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
                        </div> -->
                        <?php if ( $__record_assesor->Validasi_1 == 'Y' AND $__record_assesor->Validasi_2 == 'Y' AND $__record_assesor->Validasi_3 == 'Y' ) { ?>
                        <hr>
                        <div class="row mb-4">
                            <div class="d-grid gap-2 col-lg-12 mx-auto">
                                <a href="<?= url('/homeadmin/rpl_report/detail/pdf'); ?>?__Id=<?= $_GET['__Id']; ?>&__IdSk=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_sk_rpl->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    target="_Blank" class="btn btn-md btn-primary btn-block" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="Download Surat Keterangan">
                                    <?= $__data_sk_rpl->Nomor; ?>
                                </a>
                                <hr>
                                <a href="<?= url('/homeadmin/rpl_report/detail/pdf_lampiran'); ?>?__Id=<?= $_GET['__Id']; ?>&__IdSk=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_sk_rpl->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    target="_Blank" class="btn btn-md btn-info btn-block" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="Download Surat Keterangan Lampiran">
                                    Lampiran
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-bukti" role="tabpanel">
                    <div class="row g-6 mb-4">
                    <div class="row">
                        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>