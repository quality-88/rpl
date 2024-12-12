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
</div>
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
                                            <!-- <th class="text-center">Ta</th> -->
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
                                            <!-- <td class="text-center">
                                                <?= @$__record__['Ta']; ?>
                                            </td> -->
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