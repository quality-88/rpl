<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homerpl'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homerpl/pumb'); ?>">
                    PUMB
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homerpl/pumb/pmbregistrasi'); ?>">
                    Data PMB Registrasi
                </a>
            </li>
        </ol>
    </nav>
</div>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Formulir PMB Registrasi
                    </h4>
                    <p>
                        Silahkan Mengisi Data
                        <code>Lengkap Penerimaan Mahasiswa Baru RPL Tahun Ajaran <?= @$__authlogin__->Ta; ?>/<?= @$__authlogin__->Ta + 1; ?></code>.
                        <br>
                        Harap Mengisi Dengan Benar Karena Data Ini Akan Di Pakai Untuk Data Kamu.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-2">
            <div class="card">
                <div class="card-body">

                    <?php
                    
                        if ( !isset($_GET['pumb']) ) {

                            $__active_1__ = 'active';
                        
                        } elseif ( $_GET['pumb'] == '2' ) {

                            $__active_2__ = 'active';

                        } elseif ( $_GET['pumb'] == '3' ) {

                            $__active_3__ = 'active';
                        } elseif ( $_GET['pumb'] == '4' ) {

                        $__active_4__ = 'active';

                        } elseif ( $_GET['pumb'] == '5' ) {

                            $__active_5__ = 'active';

                        } elseif ( $_GET['pumb'] == '6' ) {

                            $__active_6__ = 'active';

                        }
                    
                    ?>


                    <div class="row">
                        <div class="col-lg-12 mb-lg-4">
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item">
                                    <a class="nav-link <?= $__active_1__; ?>" href="#">
                                        Data Diri
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $__active_2__; ?>" href="#">
                                        Alamat Diri
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $__active_3__; ?>" href="#">
                                        Keterangan Diri
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $__active_4__; ?>">
                                        Asal Sekolah
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $__active_5__; ?>" href="#">
                                        Orang Tua
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $__active_6__; ?>" href="#">
                                        Selesai
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php 
                    
                        if ( !isset($_GET['pumb']) ) {

                            require_once __DIR__ . '/__1.php';
                        
                        } elseif ( $_GET['pumb'] == '2' ) {

                            require_once __DIR__ . '/__2.php';

                        } elseif ( $_GET['pumb'] == '3' ) {

                            require_once __DIR__ . '/__3.php';

                        } elseif ( $_GET['pumb'] == '4' ) {

                            require_once __DIR__ . '/__4.php';

                        } elseif ( $_GET['pumb'] == '5' ) {

                            require_once __DIR__ . '/__5.php';

                        } elseif ( $_GET['pumb'] == '6' ) {

                            require_once __DIR__ . '/__6.php';

                        }
                    
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>