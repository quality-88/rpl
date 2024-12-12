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
        'format' => 'A4-P', 
        'orientation' => 'P' 
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
                    <img src="'. $__kop_surat .'">
                    <hr>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <th style="font-size: 24px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    YAYASAN BUKIT BARISAN SIMALEM
                                    <br>
                                    '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                </strong>
                            </th>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th width="100%" style="font-size: 16px; font-family: Times New Roman; text-align: center; padding-top:0px; padding-bottom:0px;">
                                    Nomor : '. $__helpers->FormatAwalNol( $__data_pembayaran__->Id ) .'.'. date('dmY') .'.'. $__data_pembayaran__->Ta .'/'. $__data_pembayaran__->Semester .'
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="100%" style="font-size: 20px; font-family: Times New Roman; text-align: center; padding-top:15px; padding-bottom:5px;">
                                    <strong>
                                        <u>
                                            BUKTI TANDA TERIMA
                                        </u>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
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
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Nomor Peserta
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->FormatAwalNol( $__data_pembayaran__->Id ) .'.'. $__data_pembayaran__->Ta .'/'. $__data_pembayaran__->Semester .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Nama Peserta
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__data_pembayaran__->Nama ) .'
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
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tujaun Pembayaran
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_pembayaran__->Tujuan .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Bank Pembayaran
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_pembayaran__->Bank .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tahun Ajaran
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__data_pembayaran__->Ta .'/'. $__data_pembayaran__->Semester .' - '. $__helpers->__Semester( $__data_pembayaran__->Semester ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Kampus
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->HurufBesar( $__universitas->__Detail_Universitas()['Nama'] ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Di Bayar Melalui
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    TRANSFER ONLINE
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Tanggal Di Bayar
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__helpers->TanggalWaktu( $__data_pembayaran__->TglBayar ) .'
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                Status Bayar
                            </td>
                            <td width="5%" style="font-size: 16px; font-family: Times New Roman; text-align: right; padding-top:4px; padding-bottom:4px;">
                                :
                            </td>
                            <td width="65%" style="font-size: 16px; font-family: Times New Roman; text-align: left; padding-top:4px; padding-bottom:4px;">
                                <strong>
                                    '. $__statusbayar__ .'
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


    }


    // $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf -> WriteHTML ( $konten,\Mpdf\HTMLParserMode::HTML_BODY );
    // $mpdf -> WriteHTML ( $konten );


    $title_pdf = 'Berita Acara | ' . $__authlogin__->Nama;
    $mpdf -> SetTitle( $title_pdf );

    // $mpdf -> SetAuthor( $title_pdf );

    // $mpdf -> Output('Sertifikat.pdf',\Mpdf\Output\Destination::DOWNLOAD);

    $title_download = $__authlogin__->Nama . ' - ' . date('YmdHis') . '.pdf';
    $mpdf -> Output ( $title_download , "I" );
    //print $konten;

    exit;
    // ########################### START REPORT ########################### //