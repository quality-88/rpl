<?php @require_once dirname(__DIR__) . '/layout/__header.php'; ?>

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">

                    <?php require_once dirname(dirname(__DIR__)) . '/partials/__notifikasi.php'; ?>

                    <h4 class="mb-2">
                        Selamat Datang ! 👋
                    </h4>
                    <p class="mb-4">
                        Silahkan login terlebih dahulu.
                    </p>
                    <form name="frmInput" action="<?= url('/login/proses'); ?>" method="POST"
                        enctype="multipart/form-data" class="mb-3">

                        <input type="hidden" name="__Token" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>
                            <input type="email" class="form-control" name="__Email" placeholder="Email Kamu"
                                value="<?= isset($_SESSION['__Old_Data']['__Email']) ? @$_SESSION['__Old_Data']['__Email'] : ''; ?>"
                                autocomplete="off" autofocus required>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">
                                    Password
                                </label>
                                <a href="<?= url('/lupapassword'); ?>">
                                    <small>
                                        Lupa Email?
                                    </small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" name="__Password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" id="ShowPassword" value="" autofocus required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" onclick="myFunction()">
                                <label class="form-check-label" for="remember-me">
                                    Tampil Password
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Login
                            </button>
                            <a href="<?= url('/logindosen'); ?>" class="btn btn-danger d-grid w-100 mt-lg-2">
                                Login Dosen
                            </a>
                        </div>
                    </form>
                    <p class="text-center">
                        <span>
                            Kembali Kehalaman
                        </span>
                        <br>
                        <a href="<?= $__universitas->__Url_Universitas()['Pmb']; ?>">
                            <span>
                                Penerimaan Mahasiswa Baru
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php @require_once dirname(__DIR__) . '/layout/__footer.php'; ?>