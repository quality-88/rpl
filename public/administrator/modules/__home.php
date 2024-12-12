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

                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                            Badges</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/illustrations/man-with-laptop-light.png"
                            height="140" alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 order-1 mb-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                        <div class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/icons/unicons/wallet.png"
                                    alt="User">
                            </div>
                            <div>
                                <p class="mb-0">
                                    Tahun Pendaftaran <strong><?= date('Y'); ?></strong>
                                    <br>
                                    Bulan <strong><?= date('F'); ?></strong>
                                </p>
                            </div>
                        </div>
                        <div id="incomeChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>