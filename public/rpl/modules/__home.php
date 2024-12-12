<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            Selamat Datang,
                            <strong>
                                <?= $__authlogin__->Nama; ?>
                            </strong> !
                        </h5>
                        <p class="mb-4">
                            Hak Akses Sebagai <span class="fw-bold"><?= $__authlogin__->Level; ?></span>.
                        </p>

                        <a href="<?= url('/homerpl/pembayarankonversi'); ?>" class="btn btn-lg btn-outline-danger me-3"
                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Pembayaran Biaya Konversi">
                            Pembayaran Biaya Konversi
                        </a>
                        <?php if ( @$__sukses_pembayaran__ == TRUE ) { ?>
                        <a href="<?= url('/homerpl/assesor'); ?>" class="btn btn-lg btn-primary"
                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Lihat Assesor">
                            Lihat Assesor
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/illustrations/man-with-laptop-light.png"
                            height="140" alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card col-lg-12 mb-4 order-0">
            <div class="card-body">
                <div class="d-grid gap-2 col-lg-12 mx-auto mb-lg-4">
                    <a href="<?= url('/homerpl/sk_mendaftar_pdf'); ?>?__Id=<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>"
                        target="_Blank" class="btn btn-lg btn-success" data-bs-toggle="tooltip" data-bs-offset="0,4"
                        data-bs-placement="top" data-bs-html="true" title="Download Surat Keterangan Mendaftar">
                        Download Surat Keterangan Mendaftar
                    </a>
                </div>

                <?php if ( @$__check_assesor_1__ == FALSE ) { ?>
                <!-- <div class="d-grid gap-2 col-lg-12 mx-auto">
                    <a href="<?= $__routes; ?>/berkas" class="btn btn-md btn-block btn-info" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Lengkapi Data Berkas Pendukung">
                        Lengkapi Data Berkas Pendukung
                    </a>
                </div> -->
                <div class="d-grid gap-2 col-lg-12 mx-auto">
                    <a href="<?= $__universitas->__Url_Universitas()['Pmb']; ?>/__berkas_rpl?__Id=<?= $__authlogin__->NoRegistrasi; ?>"
                        target="_Blank" class="btn btn-md btn-block btn-info" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Lengkapi Data Berkas Pendukung">
                        Lengkapi Data Berkas Pendukung
                    </a>
                </div>
                <hr>
                <?php } ?>
                <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                    <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/avatars/1.png" alt="user-avatar"
                        class="d-block w-px-100 h-px-100 rounded me-3" id="uploadedAvatar">
                    <div class="button-wrapper me-3">
                        <div>
                            Download File Pendukung
                        </div>
                        <a href="<?= $__url_file . $__authlogin__->FileKtp; ?>" class="btn btn-primary me-3 my-2"
                            target="_Blank">
                            <span class="d-none d-sm-block">
                                KTP
                            </span>
                        </a>
                        <a href="<?= $__url_file . $__authlogin__->FileKk; ?>" class="btn btn-info me-3 my-2"
                            target="_Blank">
                            <span class="d-none d-sm-block">
                                Ijazah
                            </span>
                        </a>
                        <a href="<?= $__url_file . $__authlogin__->FileNilai; ?>" class="btn btn-warning me-3 my-2"
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
                Kamu masih dapat mengubahkan data
                <strong>Pribadi Kamu</strong> sebelum
                <strong class="text-danger">Assesor Menyelesaikan Tugasnya</strong> !
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
                            <?= $__authlogin__->TipePt === 'KULIAH' ? 'Universitas Asal' : 'Sekolah Asal' ?>
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
                            value="<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>" required readonly>

                        <div class="row g-6 mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Tanggal Daftar
                                </label>
                                <input class="form-control" type="text" value="<?= $__authlogin__->TglDaftar; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="text" value="<?= $__authlogin__->Email; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nama
                                </label>
                                <input name="__Nama" class="form-control" type="text"
                                    oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    value="<?= $__authlogin__->Nama; ?>" autofocus required
                                    <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Jenis Kelamin
                                </label>
                                <select name="__JenisKelamin" class="form-control" autofocus required>
                                    <?php 
                                        if ( isset($__authlogin__->JenisKelamin) ) {

                                            $__get_jeniskelamin__ = $__authlogin__->JenisKelamin == 'LK' ? 'LAKI - LAKI' : 'PEREMPUAN';

                                            echo 
                                                "
                                                    <option value='". $__authlogin__->JenisKelamin ."' selected>
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

                                                if ( $__authlogin__->JenisKelamin != $data ) {

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
                                            value="<?= $__authlogin__->TempatLahir; ?>" autofocus required
                                            <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-6">
                                        <input name="__TglLahir" class="form-control" type="date"
                                            value="<?= date('Y-m-d', strtotime($__authlogin__->TglLahir) ); ?>"
                                            autofocus required
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
                                    value="<?= $__authlogin__->Alamat; ?>" autofocus required
                                    <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Hp
                                </label>
                                <input name="__Hp" class="form-control" type="text" value="<?= $__authlogin__->NoHp; ?>"
                                    maxlength="15" onkeypress="return TextAngka(event)" autocomplete="off" autofocus
                                    required <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Nomor Wa
                                </label>
                                <input name="__Wa" class="form-control" type="text" value="<?= $__authlogin__->NoWa; ?>"
                                    maxlength="15" onkeypress="return TextAngka(event)" autocomplete="off" autofocus
                                    required <?php if ( @$__check_assesor_1__ == TRUE ) { echo 'readonly'; }; ?>>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Pekerjaan
                                </label>
                                <input class="form-control" type="text" value="<?= $__authlogin__->Bekerja; ?>"
                                    autofocus required readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="form-label">
                                    Lama Pekerjaan
                                </label>
                                <input class="form-control" type="text" value="<?= $__authlogin__->LamaBekerja; ?>"
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
                        <?php if ( isset($__authlogin__->TipePt) AND $__authlogin__->TipePt == TRUE AND $__authlogin__->TipePt == 'KULIAH' ) { ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Perguruan Tinggi Asal
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__authlogin__->IdPtAsal; ?> - <?= $__authlogin__->NamaPtAsal; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Prodi Asal
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__authlogin__->IdProdiAsal; ?> - <?= $__authlogin__->NamaProdiAsal; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <label class="form-label">
                                Jenjang Akhir Pendidikan
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->JenjangAkhir; ?>"
                                autofocus required readonly>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Jenjang Akhir Pendidikan
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->JenjangAkhir; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Sekolah Asal
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->Sekolah; ?>" autofocus
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
                                value="<?= $__authlogin__->Ta; ?>/<?= $__authlogin__->Semester; ?> - <?= $__authlogin__->Semester == '1' ? 'Ganjil' : 'Genap'; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Kurikulum
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->Kurikulum; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Gelombang
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->Gelombang; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                ID Kampus
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__authlogin__->IdKampus; ?> - <?= $__authlogin__->NamaKampus; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Fakultas
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__authlogin__->NamaFakultas; ?> - <?= $__authlogin__->IdFakultas; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Prodi
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->Prodi; ?>" autofocus
                                required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Jam Perkuliahan
                            </label>
                            <input class="form-control" type="text" value="<?= $__authlogin__->JamPerkuliahan; ?>"
                                autofocus required readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label class="form-label">
                                Referensi
                            </label>
                            <input class="form-control" type="text"
                                value="<?= $__authlogin__->Referensi; ?> - <?= $__authlogin__->NamaReferensi; ?>"
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

                                            foreach ( $__authlogin_berkas__ AS $data => $__record__ ) : 
                                        
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
                                            <?= $__authlogin__->Bekerja === 'BEKERJA' ? $__authlogin__->LamaBekerja : 'TIDAK BEKERJA'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__authlogin__->JenjangAkhir; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__total_berkas_pendukung->Total; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__authlogin__->Studi . ' Semester'; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__authlogin__->TipeJenis; ?>
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