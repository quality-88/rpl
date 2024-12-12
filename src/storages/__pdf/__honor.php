<?php

// ###################### BASE MPDF ###################### //
require_once dirname(dirname(dirname(__DIR__))) . '/resources/assets/mpdf/vendor/autoload.php';
// ###################### BASE MPDF ###################### //

// ###################### BASE MPDF ###################### //
require_once dirname(dirname(dirname(__DIR__))) . '/resources/barcode/phpqrcode/qrlib.php';
// ###################### BASE MPDF ###################### //

// Check if required parameters are provided
if (empty($_GET['__Ta']) || empty($_GET['__Semester']) || empty($_GET['__Prodi'])) {
    header("Location: " . __Base_Url());
    exit;
}

$ta = $_GET['__Ta'];
$semester = $_GET['__Semester'];
$prodi = $_GET['__Prodi'];

// ########################### START REPORT ########################### //
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4-P', 
    'orientation' => 'P',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 5,
    'margin_footer' => 5
]);

// If no data, display message
if (empty($__record_data__)) {
    $konten = '
        <body>
            <div style="font-size: 30px; font-family: Times New Roman; color:#000000; margin-top: 5px; text-align: center;">
                <strong>
                    Mohon Maaf Data Laporan <br> Tidak Tersedia
                </strong>
            </div>
        </body>
    ';
} else {
    // Content for the report
    $konten = '
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
                <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="font-size: 14px; font-family: Times New Roman; text-align: center;">
                                <strong>
                                    ' . $__helpers->HurufBesar($this->__universitas->__Detail_Universitas()['Nama']) . '
                                    <br> HONOR DOSEN ASSESOR RPL
                                    <br> FAKULTAS ' . $__helpers->HurufBesar($__universitas->__Konversi_Fakultas(['Prodi' => $prodi])) . '
                                    <br> PRODI ' . $__helpers->HurufBesar($__universitas->__Konversi_Prodi(['Prodi' => $prodi])) . '
                                    <br> ' . __Aplikasi()['Lokasi'] . ', ' . $__helpers->UbahHariInggris(date('l')) . ' ' . $__helpers->TanggalIndonesia(date('d-m-Y')) . '
                                    <br> Tahun Ajaran ' . $ta . '/' . $semester . ' - ' . $__helpers->__Semester($semester) . '
                                </strong>
                            </th>
                        </tr>
                    </thead>
                </table>
                <br>
                <table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th width="6%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                                No
                            </th>
                            <th width="94%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;" colspan="5">
                                Assesor
                            </th>
                        </tr>
                    </thead>
                    <tbody>';

    $total_honor = 0;
    foreach ($__record_data__ as $data => $__record__) {

        // Fetch Dosen data
        $__data_dosen__ = $__db->queryid("SELECT TOP 1 IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '" . $__record__->IdDosen . "' ORDER BY IdDosen DESC");

        $__total_honor__ = 0;
        
        $konten .= '
            <tr>
                <th width="6%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                    '. $__nomor__++ .'
                </th>
                <th width="94%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;" colspan="5">
                    ' . $__data_dosen__->IdDosen . ' - ' . $__data_dosen__->Nama . '
                </th>
            </tr>
            <tr>
                <td width="6%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;"></td>
                <td width="38%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">Mahasiswa</td>
                <td width="10%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">Assesor</td>
                <td width="23%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">Honor</td>
                <td width="23%" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">Keterangan</td>
            </tr>';

        for ($i = 1; $i <= 3; $i++) {
            $__assesor__ = $__db->query("
                SELECT
                    A.Id_Rpl_Assesor, B.Id_Rpl_Sk, C.Id_Rpl_Pendaftaran,
                    C.Nama_Rpl_Pendaftaran AS Nama, C.Prodi_Rpl_Pendaftaran AS Prodi, C.Kurikulum_Rpl_Pendaftaran AS Kurikulum, C.Ta_Rpl_Pendaftaran AS Ta, C.Semester_Rpl_Pendaftaran AS Semester, C.Jenis_Rpl_Pendaftaran AS Jenis, C.TipeJenis_Rpl_Pendaftaran AS TipeJenis, B.Nomor_Rpl_Sk AS Nomor,
                    ". $i ." AS Assesor
                FROM 
                    Tbl_Rpl_Assesor A 
                JOIN 
                    Tbl_Rpl_Sk B ON A.Id_Rpl_Pendaftaran = B.Id_Rpl_Pendaftaran
                JOIN 
                    Tbl_Rpl_Pendaftaran C ON B.Id_Rpl_Pendaftaran = C.Id_Rpl_Pendaftaran
                WHERE 
                    A.As" . $i . "_Dosen_Rpl_Assesor = '" . $__data_dosen__->IdDosen . "' 
                    AND A.Data = 'Y' 
                    AND A.Validasi_1_Rpl_Assesor = 'Y' 
                    AND A.Validasi_2_Rpl_Assesor = 'Y' 
                    AND A.Validasi_3_Rpl_Assesor = 'Y' 
                    AND B.Data = 'Y'
                    AND C.Prodi_Rpl_Pendaftaran = '". $_GET['__Prodi'] ."'
                ORDER BY C.Nama_Rpl_Pendaftaran DESC
            ");

            foreach ($__assesor__ as $__data__) {

                $__data_sudahbayar__ = $__db->queryid(" SELECT Id_Rpl_BayarHonor AS Id, Nominal_Rpl_BayarHonor AS Nominal, Id_Rpl_Pendaftaran, Id_Rpl_Assesor, Id_Rpl_Sk, IdDosen, Ta_Rpl_BayarHonor AS Ta, Semester_Rpl_BayarHonor AS Semester, Prodi_Rpl_BayarHonor AS Prodi FROM Tbl_Rpl_BayarHonor WHERE Id_Rpl_Pendaftaran = '". $__data__->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Assesor = '". $__data__->Id_Rpl_Assesor ."' AND Id_Rpl_Sk = '". $__data__->Id_Rpl_Sk ."' AND IdDosen = '". $__data_dosen__->IdDosen ."' AND Ta_Rpl_BayarHonor = '". $__data__->Ta ."' AND Semester_Rpl_BayarHonor = '". $__data__->Semester ."' AND Prodi_Rpl_BayarHonor = '". $_GET['__Prodi'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' ");

                $__sudah_bayar__ = (isset($__data_sudahbayar__->Id) && $__data_sudahbayar__->Id) ? $__data_sudahbayar__->Nominal : 0;

                $__data_biayakonversi__ = $__db->queryid(" 
                    SELECT TOP 1 Honor_Rpl_BiayaKonversi AS Honor
                    FROM Tbl_Rpl_BiayaKonversi
                    WHERE Ta_Rpl_BiayaKonversi = '". $__data__->Ta ."' AND Semester_Rpl_BiayaKonversi = '". $__data__->Semester ."' AND Tipe_Rpl_BiayaKonversi = '". $__data__->Jenis ."' ORDER BY Id_Rpl_BiayaKonversi ASC
                ");

                $__honor__ = isset($__data_biayakonversi__->Honor) ? $__helpers->Uang( $__data_biayakonversi__->Honor + 0 ) : '0';
                $__sudah_bayar__ = isset($__data_sudahbayar__->Id) ? 'Sudah Di Bayar' : 'Belum Di Bayar';

                // Menambahkan honor
                $__total_honor__ += (isset($__data_biayakonversi__->Honor) ? $__data_biayakonversi__->Honor : 0);

                $konten .= '
                    <tr>
                        <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;"></td>
                        <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                            ' . $__data__->Nama . '
                        </td>
                        <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                            ' . $__data__->Assesor . '
                        </td>
                        <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                            Rp. ' . $__honor__ . '
                        </td>
                        <td style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                            ' . $__sudah_bayar__ . '
                        </td>
                    </tr>';
            }
        } $__total_honor_seluruh__ += $__total_honor__;

    $konten .= '

            <tr>
                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;" colspan="3">
                    Total Honor Di Bayarkan
                </th>
                <th style="font-size: 12px; font-family: Times New Roman; text-align: center; padding-top:4px; padding-bottom:4px;" colspan="2">
                    <strong>
                        Rp. '. $__helpers->Uang($__total_honor__) .'
                    </strong>
                </th>
            </tr>
    ';

    } 

    // Total Honor
    $konten .= '
                <tr>
                    <th colspan="3" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                        Total Honor Wajib Di Keluarkan
                    </th>
                    <th colspan="2" style="font-size: 12px; font-family: Times New Roman; text-align: center; padding: 4px;">
                        <strong>Rp. ' . $__helpers->Uang($__total_honor_seluruh__) . '</strong>
                    </th>
                </tr>
            </tbody>
        </table>
    </body>
</html>';

    // Set footer for the PDF
    $mpdf->SetHTMLFooter('
        <body>
            <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold;">
                <tr>
                    <td width="33%" align="left">Halaman</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" align="right">' . __Aplikasi()['Lokasi'] . ', {DATE d/m/Y}</td>
                </tr>
            </table>
        </body>
    ');

    // Output the PDF
    $mpdf->WriteHTML($konten, \Mpdf\HTMLParserMode::HTML_BODY);

    $title_pdf = 'HONOR DOSEN | ' . $__helpers->HurufBesar($__authlogin__->Nama);
    $mpdf->SetTitle($title_pdf);
    $mpdf->Output(rand(0, 99999) . ' - ' . date('YmdHis') . '.pdf', "I");

    exit;
}
?>