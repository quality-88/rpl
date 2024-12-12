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
        $__default_nama     = $__data_dekan->Nidn . '_' .$__data_dekan->Nama;  
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
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse; padding-top:0px; padding-bottom:0px;">
                        <tr>
                            <th width="100%" style="font-size: 40px; font-family: Times New Roman; text-align: center; padding-top:0px; padding-bottom:5px;">
                                <img src="'. $__kop_kampus .'" width="100%" style="text-align: center; padding-top:0px; padding-bottom:0px;">
                            </th>
                        </tr>
                    </table>
                    <hr>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="font-size: 18px; font-family: Times New Roman; text-align: center;">
                                    <strong>
                                        KETERANGAN CALON MAHASISWA
                                    </strong>
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-family: Times New Roman; text-align: center;">
                                    <strong>
                                        Nomor : '. $__data_sk_keterangan_rpl__->Nomor .'
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="100%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Yang bertanda tangan di bawah ini menerangakan bahwa :
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Nama
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_calon_rpl->Nama .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Tempat / Tgl Lahir
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_calon_rpl->TempatLahir .', '. $__helpers->TanggalIndonesia(date('d-m-Y', strtotime($__data_calon_rpl->TglLahir))) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Jenis Kelamin
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__jeniskelamin__ .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Alamat
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_calon_rpl->Alamat .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Jenjang Akhir
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_calon_rpl->JenjangAkhir .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Fakultas
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_calon_rpl->IdFakultas .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Program Studi
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__universitas->__Konversi_Prodi(['Prodi' => $__data_calon_rpl->Prodi]) ) .'
                                </strong>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="100%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Adalah benar Calon Mahasiswa <strong>'. $__universitas->__Detail_Universitas()['Nama'] .'</strong> jalur program Rekognisi Pembelajaran Lampau (RPL) Tahun Akademik <strong>'. $__data_calon_rpl->Ta .'/'. $__data_calon_rpl->Semester .' - '. $__helpers->__Semester( $__data_calon_rpl->Semester ) .'</strong> dan saat ini sedang proses Penilaian Rekognisi oleh Asesor untuk pengakuan hasil belajar.
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td width="100%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Nomor Pokok Mahasiswa (NPM) akan diterbitkan setelah Penilaian Rekognisi diputuskan dan divalidasi oleh Asesor.
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td width="100%" style="font-size: 14px; font-family: Times New Roman; text-align: justify; padding-top:4px; padding-bottom:4px;">
                                Demikian surat keterangan ini diperbuat untuk dapat dipergunakan sebagaimana mestinya.
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Ditetapkan di
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. __Aplikasi()['Lokasi'] .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="20%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Pada Tanggal
                            </td>
                            <td width="5%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->TanggalIndonesia( date('d-m-Y', strtotime( $__data_sk_keterangan_rpl__->Tgl )) ) .'
                                </strong>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 14px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Dekan '. $__helpers->HurufAwalBesar( $__data_dekan->Fakultas) .',
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="45%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <img src='. $__url_path .' style="width: 100px; height: 100px;">
                                <br>
                                <br>
                                <u>
                                    <b>
                                        '. $__data_dekan->Nama .' 
                                    </b>
                                </u>
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="55%" style="font-size: 14px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                NIDN. '. $__data_dekan->Nidn .' 
                            </td>
                        </tr>
                    </table>
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
                                Tim Pengelola RPL '. $__universitas->__Detail_Universitas()['Nama'] .';
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                2.
                            </td>
                            <td width="95%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Pertinggal
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ';
        $mpdf -> SetHTMLFooter('
            <body>
                <hr>
                <table width="100%" style="vertical-align: bottom; font-family: serif; 
                    font-size: 8pt; color: #000000; font-weight: bold; font-style: normal;">
                    <tr>
                        <td width="100%">
                            Surat ini Menggunakan Tanda Tangan Elektronik dan Sah tanpa Stempel
                        </td>
                    </tr>
                </table>
            </body>
        ');
        $mpdf -> WriteHTML ( $konten1 );

        
    }


    $title_pdf = 'SURAT KETERANGAN';
    $mpdf -> SetTitle( $title_pdf );

    // $mpdf -> SetAuthor( $title_pdf );
    // $mpdf -> Output('Sertifikat.pdf',\Mpdf\Output\Destination::DOWNLOAD);

    $title_download = '__' . date('dmY') . '_' . rand(0,999999) . '_' . substr($__data_sk_keterangan_rpl__->Nomor,0,4) . '.pdf';
    $mpdf -> Output ( $title_download , "I" );
    
        $path = '../../Berkas/' . __Aplikasi()['Kampus'] . "/" . __Aplikasi()['Tujuan'] . "/";
        if (!is_dir($path)) {
            mkdir($path, 0755, true); 
        }

        if ( !file_exists($path . $title_download) ) {

            if ( $__data_folderfile__->Id == FALSE ) {

                $__query = $this->FolderFile_Simpan([
                    'IdUser'        => $__data_calon_rpl->Id,
                    'NamaUser'      => $__data_calon_rpl->Nama,
                    'Status'        => 'CALON MAHASISWA',
                    'Nomor'         => $__data_sk_keterangan_rpl__->Nomor,
                    'Download'      => __Aplikasi()['Folder'] . 'Berkas/' . __Aplikasi()['Kampus'] . "/" . __Aplikasi()['Tujuan'] . "/" . $title_download,
                    'Url'           => __Aplikasi()['Folder'],
                    'Folder'        => 'Berkas/' . __Aplikasi()['Kampus'] . "/" . __Aplikasi()['Tujuan'] . "/",
                    'Keterangan'    => $title_pdf,
                    'Aplikasi'      => __Aplikasi()['Aplikasi'],
                    'Tgl'           => date('Y-m-d H:i:s'),
                    'Kampus'        => __Aplikasi()['Kampus'],
                ]);

                $mpdf->Output($path . $title_download, 'F');
                readfile($path . $title_download);

            }

        }

    exit;
    // ########################### START REPORT ########################### //