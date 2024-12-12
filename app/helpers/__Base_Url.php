<?php


    if ( !function_exists('__Base_Url') ) {
        function __Base_Url() {

            return 'http://rpl.test/';

        }
    }

    if ( !function_exists('__Path') ) {
        function __Path() {

            return '';
            // return '/uq/rpl';

        }
    }

    if ( !function_exists('__Aplikasi') ) {
        function __Aplikasi() {

            return [
                'Aktif'     => 'Y',
                'Lokasi'    => 'Medan',
                'Kampus'    => 'UQM',
                'IdKampus'  => '0',
                'Nama'      => 'Jaka Tirta Samudra, S.Kom., M.Kom.',
                'Aplikasi'  => 'RPL',
                'Singkat'   => 'RPL',
                'Logo'      => __Base_Url() . 'resources/libary/logo/logo.png',
                'Instagram' => 'https://www.instagram.com/jakatirtasamudra/',
                'Kontak'    => 'https://api.whatsapp.com/send?phone=6282274748215&text=Hallo Jaka Tirta Samudra. Saya Ingin Diskusi Dengan Kamu',
                'Tujuan'    => 'RPL',
            ];

        }
    }

    



    