<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homeadmin'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homeadmin/settingdata_diskonfull'); ?>">
                    Diskon Full
                </a>
            </li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Tambah">
                        <button type="button" class="accordion-button bg-primary text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Tambah" aria-expanded="true" aria-controls="accordion-Tambah">
                            Tambah Data
                        </button>
                    </h2>
                    <div id="accordion-Tambah" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form name="frmInput" action="<?= url('/homeadmin/settingdata_diskonfull/simpan'); ?>"
                                method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control"
                                    value="<?= url('/homeadmin/settingdata_diskonfull'); ?>" required readonly>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label>
                                                    Pilih Tahun Ajaran
                                                </label>
                                                <select name="__Ta" class="form-control select2-kedua" required>
                                                    <?php 
                                                        echo 
                                                            "
                                                                <option value='' selected disabled>
                                                                    --- Pilih Tahun Ajaran ---
                                                                </option>
                                                            ";

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
                                                        echo 
                                                            "
                                                                <option value='' selected disabled>
                                                                    --- Pilih Semester ---
                                                                </option>
                                                            ";

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
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label>
                                                    Tanggal Awal
                                                </label>
                                                <input type="date" class="form-control" name="__TglAwal" required
                                                    value="<?= isset($_SESSION['__Old__']['__TglAwal']) ? $_SESSION['__Old__']['__TglAwal'] : date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                        <div class="select2-input">
                                            <div class="form-group">
                                                <label>
                                                    Tanggal Akhir
                                                </label>
                                                <input type="date" class="form-control" name="__TglAkhir" required
                                                    value="<?= isset($_SESSION['__Old__']['__TglAkhir']) ? $_SESSION['__Old__']['__TglAkhir'] : date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <div class="form-group">
                                            <label>
                                                Nominal Diskon
                                            </label>
                                            <input type="text" name="__Nominal" class="form-control" autocomplete="off"
                                                placeholder="Nominal Diskon" maxlength="7"
                                                onkeypress="return TextAngka(event)"
                                                value="<?= isset($_SESSION['__Old__']['__Nominal']) ? $_SESSION['__Old__']['__Nominal'] : ''; ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="Simpan">
                                                Simpan
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
                                <table id="myTable" class="table table-striped table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Tanggal Awal</th>
                                            <th class="text-center">Tanggal Akhir</th>
                                            <th class="text-center">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                            
                                            foreach ( $__record_data__ AS $data => $__record__ ) : 
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor__++; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= url('/homeadmin/settingdata_diskonfull/ubah?__Id=' . @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record__->Id . '|\|' . time() , 221 , 5 )); ?>"
                                                    class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="Ubah">
                                                    Ubah
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__helpers->Tanggal($__record__->TglAwal); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__helpers->Tanggal($__record__->TglAkhir); ?>
                                            </td>
                                            <td class="text-center">
                                                Rp.
                                                <?= $__helpers->Uang(isset($__record__->Nominal) ? $__record__->Nominal : '0'); ?>
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