<?php @require_once __DIR__ . '/partials/__header.php'; ?>


<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <?php @require_once __DIR__ . '/partials/__sidebar.php'; ?>

        <div class="layout-page">

            <?php @require_once __DIR__ . '/partials/__navbar.php'; ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    <?php 
                    
                        @require_once __DIR__ . '/partials/__notifikasi.php'; 

                        @require_once __DIR__ . '/modules/__content.php'; 
                        
                    ?>

                </div>
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                            document.write(new Date().getFullYear());
                            </script>
                            -
                            <a href="<?= $__universitas->__Detail_Universitas()['Nama']; ?>" target="_blank"
                                class="footer-link fw-bolder">
                                <?= $__universitas->__Detail_Universitas()['Nama']; ?>
                            </a>
                        </div>
                        <div>
                            <a href="<?= $__universitas->__Detail_Universitas()['Nama']; ?>" class="footer-link me-4">
                                <?= $__universitas->__Detail_Universitas()['Nama']; ?>
                            </a>
                        </div>
                    </div>
                </footer>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<div class="buy-now">
    <a href="<?= $__universitas->__Sosmed_Universitas()['Whastapp']; ?>" target="_blank"
        class="btn btn-danger btn-buy-now">
        Kontak
    </a>
</div>

<div class="modal fade" id="__Modal-Session-Logout" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="frmInput" action="<?= url('/logout'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">
                        Informasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Apakah Kamu Yakin Untuk Keluar Dari Aplikasi <?= __Aplikasi()['Aplikasi']; ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php @require_once __DIR__ . '/partials/__footer.php'; ?>