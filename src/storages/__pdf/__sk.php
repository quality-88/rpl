<?php


    // ###################### BASE MPDF ###################### //
    require_once dirname(dirname(dirname(__DIR__))) . '/resources/assets/mpdf/vendor/autoload.php';
    // ###################### BASE MPDF ###################### //

    // ###################### BASE MPDF ###################### //
    require_once dirname(dirname(dirname(__DIR__))) . '/resources/barcode/phpqrcode/qrlib.php';
    // ###################### BASE MPDF ###################### //
    
    if ( $_GET['__Id'] == FALSE OR $__data_calon_rpl->Id == FALSE ) {
    
        header("Location: ". __Base_Url() . "");
        exit;
    
    }

    // ########################### START REPORT ########################### //
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4-P', 
        'orientation' => 'P' 
    ]);


    if ( $__data_calon_rpl->Id == FALSE ) {

        $konten =
        '
            <body>
                <div style="font-size: 30px; font-family: Times New Roman; color:#000000; margin-top: 5px; margin-center; text-decoration: underline; text-align: center;">
                    <strong>
                        Mohon Maaf Data Laporan <br> Tidak Tersedia
                    </strong>
                </div>
            </body>
        ';

    } else {


        // ############# SESSION CREATE BARCODE REKTOR ############# //
        $__default_nama     = $__data_rektor->Nidn . '_' .$__data_rektor->Nama;  
        $__tempdirs         = "./src/storages/__barcode/";
        $__filename         = str_replace(" ","_",$__default_nama).'.png'; 
        $__path             = $__tempdirs . $__filename; 
        $__url_path         = $__tempdirs . $__filename; 
        $__quality          = 'H';
        $__ukuran           = '5';
        $__padding          = '1';
            if ( !file_exists( $__path ) ) { 
                QRcode::png( $__default_nama, $__path, $__quality, $__ukuran, $__padding ); 
            }
        // ############# SESSION CREATE BARCODE REKTOR ############# //


        $konten1 =
        '
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="font-size: 24px; font-family: Times New Roman; text-align: center;">
                                    <img src="'. $__logo_kampus .'" width="20%" style="text-align: center; padding-top:0px; padding-bottom:0px;">
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 24px; font-family: Times New Roman; text-align: center;">
                                    <strong>
                                        KEPUTUSAN
                                        <br>
                                        REKTOR '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                    </strong>
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 16px; font-family: Times New Roman; text-align: center;">
                                    <strong>
                                        Nomor : '. $__data_sk_rpl->Nomor .'
                                        <br>
                                        Tentang
                                        <br>
                                        REKOGNISI CAPAIAN PEMBELAJARAN HASIL ASESMEN RPL
                                        <br>
                                        PROGRAM REKOGNISI PEMBELAJARAN LAMPAU 
                                        <br> 
                                        PROGRAM STUDI '. $__helpers->HurufBesar( $__universitas->__Konversi_Prodi(['Prodi' => $__data_calon_rpl->Prodi]) ) .'
                                        <br>
                                        '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .' TAHUN AKADEMIK '. $__data_sk_rpl->Ta .'/'. $__data_sk_rpl->Ta + 1 .'
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <hr>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th style="font-size: 16px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    REKTOR '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                </strong>
                            </th>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <b>
                                    Menimbang
                                </b>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                (a)
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Bahwa berdasarkan hasil pelaksanaan asesmen RPL pada Program Studi '. $__universitas->__Konversi_Prodi(['Prodi' => $__data_calon_rpl->Prodi]) .' '. $__universitas->__Detail_Universitas()['Nama'] .', yang dilaksanakan oleh Pengelola RPL pada tanggal '. $__helpers->Tanggal( $__data_calon_rpl->TglDaftar  ).' sampai dengan '. $__helpers->Tanggal( $__data_sk_rpl->Tgl ) .' dalam rangka penerimaan mahasiswa baru melalui program Rekognisi Pembelajaran Lampau Tahun Akademik '. $__data_sk_rpl->Ta .'/'. $__data_sk_rpl->Ta + 1 .'.
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <b>
                                    Mengingat
                                </b>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                1
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Undang-Undang Republik Indonesia Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional;
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;"></td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                2
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Undang-undang Republik Indonesia Nomor 12 tahun 2012 tentang Pendidikan Tinggi;
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;"></td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                3
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Peraturan Menteri Pendidikan dan Kebudayaan Nomor 3 tahun 2020 tentang Standar Nasional Pendidikan Tinggi;
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;"></td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                4
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Peraturan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi Nomor 41 tahun 2021 tentang Rekognisi Pembelajaran Lampau;
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;"></td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                5
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Keputusan Direktur Jenderal Pendidikan Tinggi, Riset dan Teknologi Nomor 162/E/KPT/2022 tentang Petunjuk Teknis Penyelenggaraan Rekognisi Pembelajaran Lampau pada Perguruan Tinggi yang menyelenggarakan pendidikan akademik;
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;"></td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                6
                            </td>
                            <td width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Surat Keputusan Rektor '. $__universitas->__Detail_Universitas()['Nama'] .' Nomor 4520/SK/REK/UQ/VIII/2024 tentang Pedoman Program Rekognisi Pembelajaran Lampau (RPL) '. $__universitas->__Detail_Universitas()['Nama'] .'.
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ';
        $mpdf -> SetHTMLFooter('
            <body>
                <table width="100%" style="vertical-align: bottom; font-family: serif; 
                    font-size: 8pt; color: #000000; font-weight: bold; font-style: normal;">
                    <tr>
                        <td width="33%">
                            Page
                        </td>
                        <td width="33%" align="center">
                            {PAGENO}/{nbpg}
                        </td>
                        <td width="33%" style="text-align: right;">
                            {DATE d F Y}    
                        </td>
                    </tr>
                </table>
            </body>
        ');
        $mpdf -> WriteHTML ( $konten1 );
        $mpdf -> AddPage();



        $konten2 =
        '
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th style="font-size: 16px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    M E M U T U S K A N
                                </strong>
                            </th>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <b>
                                    Menetapkan
                                </b>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <b>
                                    Pertama
                                </b>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Menetapkan daftar nama calon yang terdapat pada lajur 2 lampiran surat keputusan ini, telah lulus asesmen RPL dan direkognisi capaian pembelajaran formal, nonformal, informal dan/atau pengalaman kerja yang diperoleh sebelumnya setara dengan daftar mata kuliah beserta jumlah sksnya pada program studi '. $__universitas->__Konversi_Prodi(['Prodi' => $__data_calon_rpl->Prodi]) .', yang terdapat pada lajur 3 dan 4 lampiran surat keputusan ini.
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <b>
                                    Kedua
                                </b>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Calon mahasiswa sebagaimana dimaksud dalam Diktum Kesatu diwajibkan melakukan registrasi untuk mengikuti pendidikan selanjutnya dan dibebaskan dari menempuh kuliah untuk daftar mata kuliah sebagaimana yang disebutkan pada Diktum Kesatu tersebut diatas.
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <b>
                                    Ketiga
                                </b>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Keputusan ini mulai berlaku sejak tanggal ditetapkan.
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Ditetapkan di
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. __Aplikasi()['Lokasi'] .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Pada Tanggal
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->Tanggal( $__data_sk_rpl->Tgl ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <u>
                                    Rektor,
                                </u>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <img src='. $__url_path .' style="width: 100px; height: 100px;">
                                <br>
                                <br>
                                <u>
                                    <b>
                                        '. $__data_rektor->Nama .' 
                                    </b>
                                </u>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                NIDN. '. $__data_rektor->Nidn .' 
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="10%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <u>
                                    <b>
                                        Tebusan :
                                    </b>
                                </u>
                            </td>
                            <td width="90%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="5%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                1.
                            </td>
                            <td width="95%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Yth. Yayasan Bukit Barisan Simalem;
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                2.
                            </td>
                            <td width="95%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Yth. Pejabat Struktural di Lingkungan '. __Aplikasi()['Kampus'] .';
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                3.
                            </td>
                            <td width="95%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Pertinggal.
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ';
        $mpdf -> SetHTMLFooter('
            <body>
                <table width="100%" style="vertical-align: bottom; font-family: serif; 
                    font-size: 8pt; color: #000000; font-weight: bold; font-style: normal;">
                    <tr>
                        <td width="33%">
                            Page
                        </td>
                        <td width="33%" align="center">
                            {PAGENO}/{nbpg}
                        </td>
                        <td width="33%" style="text-align: right;">
                            {DATE d F Y}    
                        </td>
                    </tr>
                </table>
            </body>
        ');
        $mpdf -> WriteHTML ( $konten2 );
        $mpdf -> AddPage();



        $konten3 =
        '
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="100%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Lampiran Surat Keputusan Rektor 
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Nomor
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__data_sk_rpl->Nomor .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tentang
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Rekognisi Capaian Pembelajaran Hasil Asesmen RPL Program Rekognisi Pembelajaran Lampau Program Studi '. $__universitas->__Konversi_Prodi(['Prodi' => $__data_calon_rpl->Prodi]) .' '. $__universitas->__Detail_Universitas()['Nama'] .' Tahun Akademik '. $__data_sk_rpl->Ta .'/'. $__data_sk_rpl->Ta + 1 .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tanggal
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                '. $__helpers->Tanggal( $__data_sk_rpl->Tgl ) .'
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Nama
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__helpers->HurufAwalBesar( $__data_calon_rpl->Nama ) .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                No. Registrasi
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__data_calon_rpl->Nomor .'
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th width="6%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    No
                                </th>
                                <th width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    Kode Mata Kuliah
                                </th>
                                <th width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    Nama Mata Kuliah
                                </th>
                                <th width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    Jumlah SKS
                                </th>
                                <th width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    Nilai
                                </th>
                                <th width="14%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    Asal CP
                                    <br>
                                    (Transfer / Perolehan)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
        ';

                            foreach ( $__data_mk_transfer AS $data => $__mk_trasnfer__ ) :

                                $__total_sks += $__mk_trasnfer__->Sks_Asal;

                                // $__data_nilai_mk__ = $__db->queryid(" SELECT Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $__mk_trasnfer__->Id_Rpl_Assesor ."' AND Id_Rpl_Pendaftaran = '". $__mk_trasnfer__->Id_Rpl_Pendaftaran ."' AND IdMk_Rpl_Assesor_1 = '". $__mk_trasnfer__->IdMk_Asal ."' AND Id_Rpl_Assesor_1 = '". $__mk_trasnfer__->Id_Rpl_Assesor_1 ."' ORDER BY IdMk_Rpl_Assesor_1 DESC ");
                                $__data_nilai_mk__ = $__db->queryid(" SELECT Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $__mk_trasnfer__->Id_Rpl_Assesor ."' AND Id_Rpl_Pendaftaran = '". $__mk_trasnfer__->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Assesor_1 = '". $__mk_trasnfer__->Id_Rpl_Assesor_1 ."' ORDER BY IdMk_Rpl_Assesor_1 DESC ");

        $konten3 .=
        '

                            <tr>
                                <td width="6%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__nomor_mk_transfer++ .'
                                </td>
                                <td width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_trasnfer__->IdMk_Asal .'
                                </td>
                                <td width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_trasnfer__->Matakuliah_Asal .'
                                </td>
                                <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_trasnfer__->Sks_Asal .'
                                </td>
                                <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__data_nilai_mk__->Huruf .'
                                </td>
                                <td width="14%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    Transfer
                                </td>
                            </tr>
        ';

                            endforeach;

                            
                            foreach ( $__data_mk_perolehan AS $data => $__mk_perolehan__ ) :

                                if ( isset($__mk_perolehan__->Huruf) && $__mk_perolehan__->Huruf == TRUE ) {

                                    $__total_sks_perolehan += $__mk_perolehan__->Sks;

        $konten3 .=
        '   
                            <tr>
                                <td width="6%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__nomor_mk_transfer++ .'
                                </td>
                                <td width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_perolehan__->IdMk .'
                                </td>
                                <td width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_perolehan__->Matakuliah .'
                                </td>
                                <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_perolehan__->Sks .'
                                </td>
                                <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__mk_perolehan__->Huruf .'
                                </td>
                                <td width="14%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    Perolehan
                                </td>
                            </tr>
        ';

                                }
                                
                            endforeach;

        $konten3 .=
        '
                        </tbody>
                        <tbody>
                            <tr>
                                <th width="70%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="3">
                                    Jumlah SKS
                                </th>
                                <th width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    '. $__total_sks + $__total_sks_perolehan .'
                                </th>
                                <th width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="2">
                                    
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Ditetapkan di
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. __Aplikasi()['Lokasi'] .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Pada Tanggal
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->Tanggal( $__data_sk_rpl->Tgl ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <u>
                                    Rektor,
                                </u>
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <img src='. $__url_path .' style="width: 100px; height: 100px;">
                                <br>
                                <br>
                                <u>
                                    <b>
                                        '. $__data_rektor->Nama .' 
                                    </b>
                                </u>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                NIDN. '. $__data_rektor->Nidn .' 
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ';
        $mpdf -> SetHTMLFooter('
            <body>
                <table width="100%" style="vertical-align: bottom; font-family: serif; 
                    font-size: 8pt; color: #000000; font-weight: bold; font-style: normal;">
                    <tr>
                        <td width="33%">
                            Page
                        </td>
                        <td width="33%" align="center">
                            {PAGENO}/{nbpg}
                        </td>
                        <td width="33%" style="text-align: right;">
                            {DATE d F Y}    
                        </td>
                    </tr>
                </table>
            </body>
        ');
        $mpdf -> WriteHTML ( $konten3 );
        


    }


    // $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    // $mpdf -> WriteHTML ( $konten,\Mpdf\HTMLParserMode::HTML_BODY );
    // $mpdf -> WriteHTML ( $konten );


    $title_pdf = 'Surat Keterangan | ' . $__data_calon_rpl->Nama;
    $mpdf -> SetTitle( $title_pdf );

    // $mpdf -> SetAuthor( $title_pdf );

    // $mpdf -> Output('Sertifikat.pdf',\Mpdf\Output\Destination::DOWNLOAD);

    $title_download = $__data_calon_rpl->Nama . ' - ' . date('YmdHis') . '.pdf';
    $mpdf -> Output ( $title_download , "I" );
    //print $konten;

    exit;
    // ########################### START REPORT ########################### //