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
                    File
                </a>
            </li>
        </ol>
    </nav>
</div>


<?php if ( isset($__record_data__) AND @$__record_data__ == TRUE ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-md mb-4 mb-md-0">
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
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">File</th>
                                            <th class="text-center">Histori</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" table-border-bottom-0">

                                        <?php 
                                            
                                            @$__nomor = '1';

                                                foreach ( $__record_data__ AS $data => $__record__ ) : 
                                            
                                        ?>

                                        <tr>
                                            <td class="text-center">
                                                <?= $__nomor++; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $__record__->Judul; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= $__base_file . $__record__->Files; ?>" target="_Blank"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,8"
                                                    data-bs-placement="top" data-bs-html="true" title="File">
                                                    <?= $__record__->Files; ?>
                                                </a>
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
<?php } ?>