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
        'format' => 'A4-L', 
        'orientation' => 'L' 
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


        $konten =
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
                        </thead>
                    </table>
                    <hr>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th style="font-size: 16px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    Lampiran Surat Keputusan Rektor
                                </strong>
                            </th>
                        </tr>
                    </table>
                    <br>
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
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tempat, Tanggal Lahir
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__helpers->HurufAwalBesar( $__data_calon_rpl->TempatLahir ) .', '. $__helpers->Tanggal( $__data_calon_rpl->TglLahir ) .'
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Fakultas
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__helpers->HurufAwalBesar( $__data_calon_rpl->IdFakultas ) .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Prodi
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__universitas->__Konversi_Prodi(['Prodi' => $__data_calon_rpl->Prodi]) .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Angkatan
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__data_calon_rpl->Ta .'/'. $__data_calon_rpl->Semester .' - '. $__helpers->__Semester( $__data_calon_rpl->Semester ) .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__1_label .'
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__1_isi .'
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__2_label .'
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="75%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                '. $__2_isi .'
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
        $mpdf -> WriteHTML ( $konten );
        $mpdf -> AddPage();



        $konten1 =
        '
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th style="font-size: 26px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    <u>
                                        Daftar Nilai Asesmen RPL 
                                    </u>
                                </strong>
                            </th>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th width="6%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" rowspan="2">
                                    No
                                </th>
                                <th width="35%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="3">
                                    Mata Kuliah Kurikulum 
                                    <br>
                                    '. $__helpers->HurufAwalBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                </th>
                                <th width="39%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="4">
                                    Mata Kuliah Asal
                                </th>
                                <th width="30%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="3">
                                    Mata Kuliah Yang Harus Di Tempuh
                                    <br>
                                    Berdasarkan Kurikulum
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:6px;">
                                    Kode MK
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    Nama Mata Kuliah
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    SKS
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    Kode MK
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    Nama Mata Kuliah
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    SKS
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    Nilai
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    Kode MK
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    Nama Mata Kuliah
                                </th>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    SKS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
        ';

                            foreach ( $__data_prodimk AS $data => $__prodimk__ ) :

                                $__data_matakuliah = $__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $__prodimk__->IdMk ."' ORDER BY IdMk DESC ");

                                // $__data_mk_transfer = $__db->queryid(" SELECT TOP 1 IdMk_Asal_Rpl_Assesor_2 AS IdMk, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah, Sks_Asal_Rpl_Assesor_2 AS Sks FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $__data_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_calon_rpl->Id ."' AND IdMk_Pilih_Rpl_Assesor_2 = '". $__data_matakuliah->IdMk ."' GROUP BY IdMk_Asal_Rpl_Assesor_2, Matakuliah_Asal_Rpl_Assesor_2, Sks_Asal_Rpl_Assesor_2 ORDER BY IdMk_Asal_Rpl_Assesor_2 DESC ");
                                $__data_mk_transfer = $__db->queryid(" SELECT TOP 1 IdMk_Pilih_Rpl_Assesor_2 AS IdMk, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah, Sks_Pilih_Rpl_Assesor_2 AS Sks FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $__data_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_calon_rpl->Id ."' AND IdMk_Pilih_Rpl_Assesor_2 = '". $__data_matakuliah->IdMk ."' GROUP BY IdMk_Pilih_Rpl_Assesor_2, Matakuliah_Pilih_Rpl_Assesor_2, Sks_Pilih_Rpl_Assesor_2 ORDER BY IdMk_Pilih_Rpl_Assesor_2 DESC ");


                                $__data_mk_perolehan = $__db->queryid(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf FROM Tbl_Rpl_Perolehan WHERE Ta_Rpl_Perolehan = '". $__data_calon_rpl->Ta ."' AND Semester_Rpl_Perolehan = '". $__data_calon_rpl->Semester ."' AND Prodi_Rpl_Perolehan = '". $__data_calon_rpl->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__data_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_calon_rpl->Id ."' AND IdMk_Rpl_Perolehan = '". $__data_matakuliah->IdMk ."' ORDER BY Id_Rpl_Perolehan DESC ");

                                if ( isset($__data_mk_transfer->IdMk) == TRUE AND $__data_mk_transfer->IdMk ) {

                                    $__idmk_asal__          = $__data_mk_transfer->IdMk;
                                    $__matakuliah_asal__    = $__data_mk_transfer->Matakuliah;
                                    $__sks_asal__           = $__data_mk_transfer->Sks;

                                } elseif ( isset($__data_mk_perolehan->IdMk) == TRUE AND $__data_mk_perolehan->IdMk ) {

                                    $__idmk_asal__          = $__data_mk_perolehan->IdMk;
                                    $__matakuliah_asal__    = $__data_mk_perolehan->Matakuliah;
                                    $__sks_asal__           = $__data_mk_perolehan->Sks;

                                } else {

                                    $__idmk_asal__          = '';
                                    $__matakuliah_asal__    = '';
                                    $__sks_asal__           = '';

                                }

                                if ( isset($__data_mk_transfer->IdMk) == TRUE AND $__data_mk_transfer->IdMk ) {

                                    $__tempuh_idmk      = '';
                                    $__tempuh_namamk    = '';
                                    $__tempuh_sks       = '';
                                    
                                } elseif ( isset($__data_mk_perolehan->IdMk) == TRUE AND $__data_mk_perolehan->IdMk ) {

                                    $__tempuh_idmk      = '';
                                    $__tempuh_namamk    = '';
                                    $__tempuh_sks       = '';

                                } else {

                                    $__tempuh_idmk      = $__data_matakuliah->IdMk;
                                    $__tempuh_namamk    = $__data_matakuliah->Matakuliah;
                                    $__tempuh_sks       = $__data_matakuliah->Sks;

                                    $__total_sks_wajib  += $__tempuh_sks;

                                }


                                $__total_sks_pt     += $__prodimk__->Sks;
                                $__total_sks_asal   += $__data_mk_transfer->Sks + $__data_mk_perolehan->Sks;

        $konten1 .=
        '

                            <tr>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__nomor_prodi_mk++ .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__data_matakuliah->IdMk .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__data_matakuliah->Matakuliah .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__data_matakuliah->Sks .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__idmk_asal__ .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__matakuliah_asal__ .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__sks_asal__ .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__tempuh_idmk .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__tempuh_namamk .'
                                </td>
                                <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                    '. $__tempuh_sks .'
                                </td>
                            </tr>
        ';

                            endforeach;

        $konten1 .=
        '
                        </tbody>
                        <tbody>
                            <tr>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="3">
                                    Jumlah SKS Kampus
                                </th>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    '. $__total_sks_pt .'
                                </th>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="2">
                                    Jumlah SKS PT Asal
                                </th>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    '. $__total_sks_asal .'
                                </th>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    
                                </th>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="2">
                                    Jumlah SKS Wajib Diambil
                                </th>
                                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    '. $__total_sks_wajib .'
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
        $mpdf -> WriteHTML ( $konten1 );

        


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