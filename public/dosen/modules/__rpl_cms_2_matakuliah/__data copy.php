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
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-pills-justified-universitasasal"
                                                role="tabpanel">
                                                <div class="row g-6 mb-4">
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
                        class="accordion-collapse collapse <?= isset($_POST['__Filter_IdMk']) ? '' : 'show'; ?>"
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

                                                            if ( isset($_POST) AND $_POST['__Filter_IdMk'] == TRUE ) {
                                                        
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

                                                                echo 
                                                                    "
                                                                        <option value='". $__filter__['IdMk'] ."'>
                                                                            ". $__filter__['IdMk'] ." - ". $__filter__['Matakuliah'] ." (". $__filter__['Sks'] ." SKS) 
                                                                        </option>
                                                                    ";

                                                            endforeach;

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) { ?>
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

<?php if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) { ?>
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
                                            <!-- <th class="text-center"
                                                colspan="<?= $__data_hasilevaluasi__total__->Total; ?>" width="10%">
                                                Hasil Evaluasi Assesor
                                            </th> -->
                                            <th class="text-center" rowspan="2" width="20%">
                                                Hasil Evaluasi Assesor
                                            </th>
                                            <th class="text-center" colspan="2" width="25%">
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

                                                // foreach ( $__data_hasilevaluasi__ AS $data => $__hasilevaluasi__ ) :

                                                //     echo 
                                                //         "
                                                //             <th class='text-center'>
                                                //                 ". $__hasilevaluasi__->Singkatan ."
                                                //             </th>
                                                //         ";

                                                // endforeach;
                                                
                                            ?>
                                            <th class="text-center" width="10%">
                                                Nomor Dokumen
                                            </th>
                                            <th class="text-center" width="15%">
                                                Jenis Dokumen
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">

                                        <?php foreach ( $__data_cpmk__ AS $data => $__cpmk__ ) : ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor_cpmk__++; ?>
                                            </td>
                                            <td class="text-left">
                                                <?= $__cpmk__->C; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <select class="form-control select2-kedua" name="__Post_Profesiensi"
                                                        required>
                                                        <option value='' disabled selected>
                                                            -- Pilih Profesiensi --
                                                        </option>
                                                        <?php foreach ( $__data_profesiensi__ AS $data => $__profesiensi__ ) : ?>
                                                        <option value="<?= $__profesiensi__->Id; ?>">
                                                            <?= $__profesiensi__->Judul; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <select class="form-control select2-kedua" name="__Post_Profesiensi"
                                                        required>
                                                        <option value='' disabled selected>
                                                            -- Pilih Hasil Evaluasi --
                                                        </option>
                                                        <?php foreach ( $__data_hasilevaluasi__ AS $data => $__hasilevaluasi__ ) : ?>
                                                        <option value="<?= $__hasilevaluasi__->Id; ?>">
                                                            <?= $__hasilevaluasi__->Judul . ' - (' . $__hasilevaluasi__->Singkatan .')'; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="file" name="__File" class="form-control"
                                                        autocomplete="off" required>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <select class="form-control select2-kedua" name="__Post_FormatFile"
                                                        required>
                                                        <option value='' disabled selected>
                                                            -- Format File --
                                                        </option>
                                                        <?php foreach ( $__data_keterangandokumen__ AS $data => $__keterangandokumen__ ) : ?>
                                                        <option value="<?= $__keterangandokumen__->Id; ?>">
                                                            <?= $__keterangandokumen__->Format; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
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