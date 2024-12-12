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
                    List Biaya Konversi
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
                            <form name="frmInput" action="<?= $__routes_mod; ?>/simpan" method="POST"
                                enctype="multipart/form-data">

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
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                        <div class="form-group">
                                            <label>
                                                Biaya Konversi
                                            </label>
                                            <input type="text" name="__Biaya" class="form-control" autocomplete="off"
                                                placeholder="Biaya" maxlength="7" onkeypress="return TextAngka(event)"
                                                value="<?= isset($_SESSION['__Old__']['__Biaya']) ? $_SESSION['__Old__']['__Biaya'] : ''; ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                        <div class="form-group">
                                            <label>
                                                Tipe Biaya
                                            </label>
                                            <select name="__Tipe" class="form-control" required>
                                                <option value="" selected disabled>
                                                    --- Pilih Tipe Biaya ---
                                                </option>
                                                <option value="T">Transfer</option>
                                                <option value="TP">Perolehan</option>
                                            </select>
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
                                <table id="myTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Biaya</th>
                                            <th class="text-center">Tipe</th>
                                            <th class="text-center">Kampus</th>
                                            <th class="text-center">Honor Assesor</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php foreach ( $__record__data__ AS $data => $__record__ ) : ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= @$__record__['Nomor']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= $__routes_mod; ?>/ubah?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record__['Id'] . '|\|' . time() , 221 , 5 ); ?>"
                                                    class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="Ubah">
                                                    Ubah
                                                </a>
                                                <a href="<?= $__routes_mod; ?>/honorassesor?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__record__['Id'] . '|\|' . time() , 221 , 5 ); ?>"
                                                    class="btn btn-sm btn-info" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="Honor Assesor">
                                                    Honor Assesor
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['TahunAjaran']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Biaya']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['Tipe'] == 'T' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-info'>
                                                                    Transfer
                                                                </span>
                                                            ";
                                                    } elseif ( @$__record__['Tipe'] == 'TP' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-primary'>
                                                                    Perolehan
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
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['Kampus'] == 'UQM' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-primary'>
                                                                    Medan
                                                                </span>
                                                            ";
                                                    } elseif ( @$__record__['Kampus'] == 'UQB' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-danger'>
                                                                    Berastagi
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
                                            <td class="text-center">
                                                <?= @$__record__['Honor']; ?>
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