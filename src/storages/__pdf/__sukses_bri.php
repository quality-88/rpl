<?php


    // ###################### BASE MPDF ###################### //
    require_once dirname(dirname(dirname(__DIR__))) . '/resources/assets/mpdf/vendor/autoload.php';
    // ###################### BASE MPDF ###################### //
    
    if ( $_GET['__Id'] == FALSE OR $__data_pembayaran__->Id == FALSE ) {
    
        header("Location: ". __Base_Url() . "");
        exit;
    
    }

    // ########################### START REPORT ########################### //
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4-L', 
        'orientation' => 'L' 
    ]);


    if ( $__data_pembayaran__->Id == FALSE ) {

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


        $konten =
        '
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="65%" style="font-size: 24px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    YAYASAN BUKIT BARISAN SIMALEM
                                </strong>
                            </td>
                            <td width="10%" style="font-size: 24px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    No. : '. $__helpers->FormatAwalNol( $__data_pembayaran__->Id ) .'.'. date('dmY') .'.'. $__data_pembayaran__->Ta .'/'. $__data_pembayaran__->Semester .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="65%" style="font-size: 24px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                </strong>
                            </td>
                            <td width="10%" style="font-size: 24px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th style="font-size: 24px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    <u>
                                        BUKTI TANDA TERIMA
                                    </u>
                                </strong>
                            </th>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th width="100%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:0px; padding-bottom:4px;">
                                <u>
                                    <b>
                                        Telah Diterima Dari
                                    </b>
                                </u>
                            </th>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Nama
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__authlogin__->Nama ) .'
                                </strong>
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Nomor
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__authlogin__->Nomor .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Fakultas
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__authlogin__->IdFakultas .'
                                </strong>
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Program Studi
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="35%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__universitas->__Konversi_Prodi(['Prodi' => $__authlogin__->Prodi]) ) .'
                                </strong>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th width="100%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:0px; padding-bottom:4px;">
                                <u>
                                    <b>
                                        Untuk Pembayaran
                                    </b>
                                </u>
                            </th>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tahun Ajaran
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_pembayaran__->Ta .'/'. $__data_pembayaran__->Semester .' - '. $__helpers->__Semester( $__data_pembayaran__->Semester ) .'
                                </strong>
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Lokasi
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Dibayar Melalui
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_pembayaran__->Bank .'
                                </strong>
                            </td>
                            <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tgl Bayar
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->TanggalWaktu( $__data_pembayaran__->TglBayar ) .'
                                </strong>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    <strong>
                                        Nomor
                                    </strong>
                                </th>
                                <th width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    <strong>
                                        Nomor <br> Pembayaran
                                    </strong>
                                </th>
                                <th width="50%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    <strong>
                                        Keterangan
                                    </strong>
                                </th>
                                <th width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:8px; padding-bottom:8px;">
                                    <strong>
                                        Jumlah
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="10%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    <strong>
                                        1
                                    </strong>
                                </td>
                                <td width="25%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    <strong>
                                        '. $__data_pembayaran__->BrivaNo . $__data_pembayaran__->CustCode .'
                                    </strong>
                                </td>
                                <td width="50%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    <strong>
                                        '. $__data_pembayaran__->Keterangan .'
                                    </strong>
                                </td>
                                <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    <strong>
                                        Rp. '. $__helpers->Uang( $__data_pembayaran__->Amount ) .'
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td width="85%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;" colspan="3">
                                    <strong>
                                        Total Bayar
                                    </strong>
                                </td>
                                <td width="15%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:10px; padding-bottom:10px;">
                                    <strong>
                                        Rp. '. $__helpers->Uang( $__data_pembayaran__->Amount ) .'
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="34%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Keterangan
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                <u>
                                    '. __Aplikasi()['Lokasi'] . ', '. $__helpers->TanggalIndonesia( date('d-m-Y') ) .'
                                </u>
                            </td>
                        </tr>
                        <tr>
                            <td width="34%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Bukti Pembayaran Elektronik Ini Sah
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                Yang Menerima
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                Yang Menyerahkan
                            </td>
                        </tr>
                        <tr>
                            <td width="34%" style="font-size: 12px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                dan Di Harapkan Di Simpan Dengan Baik.
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td width="34%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__data_pembayaran__->Nama ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="34%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                _____________________________
                            </td>
                            <td width="33%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;">
                                _____________________________
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ';


        @$mpdf -> SetHTMLFooter('
            <body>
                <table width="100%" style="vertical-align: bottom; font-family: serif; 
                    font-size: 8pt; color: #000000; font-weight: bold; font-style: normal;">
                    <tr>
                        <td width="33%">
                            Halaman
                        </td>
                        <td width="33%" align="center">
                            {PAGENO}/{nbpg}
                        </td>
                        <td width="33%" style="text-align: right;">
                            
                        </td>
                    </tr>
                </table>
            </body>
        ');


    }


    // $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf -> WriteHTML ( $konten,\Mpdf\HTMLParserMode::HTML_BODY );
    // $mpdf -> WriteHTML ( $konten );


    $title_pdf = 'PEMBAYARAN | ' . $__authlogin__->Nama;
    $mpdf -> SetTitle( $title_pdf );

    // $mpdf -> SetAuthor( $title_pdf );

    // $mpdf -> Output('Sertifikat.pdf',\Mpdf\Output\Destination::DOWNLOAD);

    $title_download = $__authlogin__->Nama . ' - ' . date('YmdHis') . '.pdf';
    $mpdf -> Output ( $title_download , "I" );
    //print $konten;

    exit;
    // ########################### START REPORT ########################### //