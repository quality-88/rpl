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
                    List Matakuliah
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
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="select2-input">
                                            <div class="form-group my-lg-4">
                                                <label class="mb-2">
                                                    Pilih Kurikulum
                                                </label>
                                                <select name="__Filter_Kurikulum" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Kurikulum']) AND @$_POST['__Filter_Kurikulum'] == TRUE ) {

                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Kurikulum'] ."' selected>
                                                                        ". $_POST['__Filter_Kurikulum'] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Kurikulum ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_kurikulum__ AS $data => $__kurikulum__ ) :

                                                            echo 
                                                                "
                                                                    <option value='". $__kurikulum__->Datas ."'>
                                                                        ". $__kurikulum__->Datas ."
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
                                                    Pilih Kampus
                                                </label>
                                                <select name="__Filter_Kampus" class="form-control select2-kedua"
                                                    required>
                                                    <?php 
                                                        if ( isset($_POST['__Filter_Kampus']) AND @$_POST['__Filter_Kampus'] == TRUE ) {
                                                            
                                                            echo 
                                                                "
                                                                    <option value='". $_POST['__Filter_Kampus'] ."' selected>
                                                                        ". $__explode_kampus[0] ." - ". $__explode_kampus[1] ."
                                                                    </option>
                                                                    <option value='' disabled>
                                                                        --- ### ---
                                                                    </option>
                                                                ";

                                                        } else {

                                                            echo 
                                                                "
                                                                    <option value='' selected disabled>
                                                                        --- Pilih Kampus ---
                                                                    </option>
                                                                ";

                                                        }

                                                        foreach ( $__filter_kampus__ AS $data => $__kampus__ ) :

                                                            echo 
                                                                "
                                                                    <option value='". $__kampus__->Id ."~||~". $__kampus__->Datas ."'>
                                                                        ". $__kampus__->Id ." - ". $__kampus__->Datas ."
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
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
            <div class="card">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">
                                            <?= isset($__total_sks) ? $__total_sks : '0'; ?>
                                        </h4>
                                        <p class="mb-0">
                                            Total SKS
                                        </p>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">
                                            <?= isset($__total_matakuliah) ? $__total_matakuliah : '0'; ?>
                                        </h4>
                                        <p class="mb-0">
                                            Total Matakuliah
                                        </p>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">
                                            <?= isset($__total_minsem) ? $__total_minsem : '0'; ?>
                                        </h4>
                                        <p class="mb-0">
                                            Semester Awal
                                        </p>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">
                                            <?= isset($__total_maxmin) ? $__total_maxmin : '0'; ?>
                                        </h4>
                                        <p class="mb-0">
                                            Semester Akhir
                                        </p>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">
                                            <?= isset($__total_minsks) ? $__total_minsks : '0'; ?>
                                        </h4>
                                        <p class="mb-0">
                                            SKS Terendah
                                        </p>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">
                                            <?= isset($__total_maxsks) ? $__total_maxsks : '0'; ?>
                                        </h4>
                                        <p class="mb-0">
                                            SKS Tertinggi
                                        </p>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                            <th class="text-center">ID Matakuliah</th>
                                            <th class="text-center">Nama Matakuliah</th>
                                            <th class="text-center">SKS</th>
                                            <th class="text-center">Ta</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">MK RPL</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php foreach ( $__record__data__ AS $data => $__record__ ) : ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= @$__record__['Nomor']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['IdMk']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Matakuliah']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Sks']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Ta']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$__record__['Semester']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ( @$__record__['Rpl'] == 'Y' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-primary'>
                                                                    RPL
                                                                </span>
                                                            ";
                                                    } elseif ( @$__record__['Rpl'] == 'N' ) {
                                                        echo 
                                                            "
                                                                <span class='badge bg-label-danger'>
                                                                    Tidak RPL
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