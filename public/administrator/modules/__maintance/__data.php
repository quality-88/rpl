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
                    Maintance
                </a>
            </li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-Maintance">
                        <button type="button" class="accordion-button bg-primary text-white" data-bs-toggle="collapse"
                            data-bs-target="#accordion-Maintance" aria-expanded="true"
                            aria-controls="accordion-Maintance">
                            Maintance Data
                        </button>
                    </h2>
                    <div id="accordion-Maintance" class="accordion-collapse collapse show"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form name="frmInput" action="<?= $__routes_mod; ?>/simpan" method="POST"
                                enctype="multipart/form-data">

                                <input type="hidden" name="__Token" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>"
                                    required readonly>

                                <input type="hidden" name="__Id" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__maintace__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <?php if ( $__maintace__->Status == 'Y' ) { ?>

                                <input type="hidden" name="__Status" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . 'N' . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <?php } elseif ( $__maintace__->Status == 'N' ) { ?>

                                <input type="hidden" name="__Status" class="form-control"
                                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . 'Y' . '|\|' . time() , 221 , 5 ); ?>"
                                    required readonly>

                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="card-header">
                                            <h5 class="mb-1">
                                                Setting Maintance Aplikasi
                                            </h5>
                                            <p class="my-0 card-subtitle">
                                                Silahkan melakukan maintance aplikasi jika memiliki perubahan aplikasi.
                                            </p>
                                            <br>
                                            <div class="d-flex mb-4 align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/icons/brands/mailchimp.png"
                                                        alt="mailchimp" class="me-4" height="32">
                                                </div>
                                                <div
                                                    class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                    <div class="mb-sm-0 mb-2">
                                                        <h6 class="mb-0">
                                                            RPL
                                                        </h6>
                                                        <small>
                                                            Maintance Aplikasi
                                                        </small>
                                                    </div>
                                                    <div class="text-end">
                                                        <!-- <div class="form-check form-switch mb-0">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="<?= $__values; ?>" onchange="this.form.submit()"
                                                                name="__Status" <?= $__checked; ?>>
                                                        </div> -->
                                                        <?php if ( $__maintace__->Status == 'Y' ) { ?>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-warning"
                                                                data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                data-bs-placement="top" data-bs-html="true"
                                                                title="Maintance">
                                                                Maintance
                                                            </button>
                                                        </div>
                                                        <?php } elseif ( $__maintace__->Status == 'N' ) { ?>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary"
                                                                data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                data-bs-placement="top" data-bs-html="true"
                                                                title="Tidak Maintance">
                                                                Tidak Maintance
                                                            </button>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
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