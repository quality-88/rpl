<?php

    if ( $__content == '__home' ) {

        require_once __DIR__ . '/__home.php';

    } elseif ( $__content == '__informasi_file' ) {

        require_once __DIR__ . '/__informasi_file/__data.php';

    } elseif ( $__content == '__homedosen/rpl' ) {

        require_once __DIR__ . '/__rpl/__data.php';

    } elseif ( $__content == '__homedosen/rpl/2' ) {

        require_once __DIR__ . '/__rpl_2/__data.php';

    } elseif ( $__content == '__homedosen/rpl/3' ) {

        require_once __DIR__ . '/__rpl_3/__data.php';

    } elseif ( $__content == '__homedosen/rpl/4' ) {

        require_once __DIR__ . '/__rpl_4/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_1' ) {

        require_once __DIR__ . '/__rpl_cms/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2' ) {

        require_once __DIR__ . '/__rpl_cms_2/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah/upload' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_upload/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah/ubah' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_ubah/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_3' ) {

        require_once __DIR__ . '/__rpl_cms_3/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah_perolehan' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_perolehan/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah_perolehan_detail' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_perolehan_detail/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/konversi' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_perolehan_detail_konversi/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/konversi/upload' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_perolehan_detail_konversi_upload/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/konversi/upload/ubah' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_perolehan_detail_konversi_upload_ubah/__data.php';

    } elseif ( $__content == '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/nilai' ) {

        require_once __DIR__ . '/__rpl_cms_2_matakuliah_perolehan_detail_nilai/__data.php';

    } else {

        require_once __DIR__ . '/__error.php';

    }