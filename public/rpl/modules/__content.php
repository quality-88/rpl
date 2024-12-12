<?php

    if ( $__content == '__home' ) {

        require_once __DIR__ . '/__home.php';

    } elseif ( $__content == '__informasi_file' ) {

        require_once __DIR__ . '/__informasi_file/__data.php';

    }  elseif ( $__content == '__rpl' ) {

        require_once __DIR__ . '/__rpl/__data.php';

    }  elseif ( $__content == '__pembayarankonversi' ) {

        require_once __DIR__ . '/__pembayarankonversi/__data.php';

    }  elseif ( $__content == '__pembayarankonversi/cekpembayaran' ) {

        require_once __DIR__ . '/__pembayarankonversi_cekpembayaran/__data.php';

    }  elseif ( $__content == '__pembayarankonversi/suksespembayaran' ) {

        require_once __DIR__ . '/__pembayarankonversi_suksespembayaran/__data.php';

    }  elseif ( $__content == '__assesor' ) {

        require_once __DIR__ . '/__assesor/__data.php';

    }  elseif ( $__content == '__ubah/berkas' ) {

        require_once __DIR__ . '/__berkas/__data.php';

    }  elseif ( $__content == '__ubah/berkas/2' ) {

        require_once __DIR__ . '/__berkas_2/__data.php';

    }  elseif ( $__content == '__pumb' ) {

        require_once __DIR__ . '/__pumb/__data.php';

    }  elseif ( $__content == '__pumb_pembayaran' ) {

        require_once __DIR__ . '/__pumb_pembayaran/__data.php';

    }  elseif ( $__content == '__pumb_npm' ) {

        require_once __DIR__ . '/__pumb_npm/__data.php';

    }  elseif ( $__content == '__pumb_pmbregistrasi' ) {

        require_once __DIR__ . '/__pumb_pmbregistrasi/__data.php';

    }  elseif ( $__content == '__pumb_cicilan' ) {

        require_once __DIR__ . '/__pumb_cicilan/__data.php';

    } else {

        require_once __DIR__ . '/__error.php';

    }