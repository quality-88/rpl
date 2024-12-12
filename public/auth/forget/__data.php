<?php @require_once dirname(__DIR__) . '/layout/__header.php'; ?>

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">

                    <?php @require_once dirname(dirname(__DIR__)) . '/partials/__notifikasi.php'; ?>

                    <h4 class="mb-2">
                        Lupa Password ! 👋
                    </h4>
                    <p class="mb-4">
                        Silahkan masukkan email kamu terlebih dahulu.
                    </p>
                    <form name="frmInput" action="<?= url('/lupapassword/simpan'); ?>" method="POST"
                        enctype="multipart/form-data" class="mb-3">

                        <input type="hidden" name="__Token" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <input type="hidden" name="__Url" class="form-control" value="<?= url('/lupapassword'); ?>"
                            required readonly>

                        <input type="hidden" name="__Url_Success" class="form-control" value="<?= url('/login'); ?>"
                            required readonly>

                        <div class="mb-3">
                            <label class="form-label">
                                Email
                            </label>
                            <input type="email" class="form-control" name="__Email" placeholder="Email"
                                autocomplete="off" autofocus
                                value="<?= @$_SESSION['__Old__']['__Email'] ? @$_SESSION['__Old__']['__Email'] : ''; ?>"
                                required>
                            <div class="text-danger">
                                <?= @$_SESSION['__Post_Notifikasi__']['__Email']; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Reset Email
                            </button>
                        </div>
                    </form>
                    <p class="text-center">
                        <span>
                            Sudah Memiliki Akun?
                        </span>
                        <a href="<?= url('/login'); ?>">
                            <span>
                                Login
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php @require_once dirname(__DIR__) . '/layout/__footer.php'; ?>