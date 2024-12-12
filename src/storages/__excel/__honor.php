<?php

    if ( $_GET['__Ta'] == FALSE OR $_GET['__Semester'] == FALSE OR $_GET['__Prodi'] == FALSE ) {
        header("Location: ". __Base_Url() . "");
        exit;
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Laporan Honor <?= $__helpers->TanggalIndonesia(date('d-m-Y')); ?>
    </title>
</head>

<body>
    <style type="text/css">
    body {
        font-family: sans-serif;
    }

    table {
        margin: 20px auto;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid #3c3c3c;
        padding: 3px 8px;
    }

    a {
        background: blue;
        color: #fff;
        padding: 8px 10px;
        text-decoration: none;
        border-radius: 2px;
    }
    </style>

    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan - ". $__helpers->TanggalIndonesia(date('d-m-Y')) .".xls");
    ?>

    <center>
        <h1>Laporan</h1>

        <table border="1">
            <tr>
                <th class="text-center" rowspan="2">Nomor</th>
                <th class="text-center" colspan="8">Nama Asseor</th>
            </tr>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center" colspan="7">Nama</th>
            </tr>

            <?php 
                foreach ( $__record_data__ AS $data => $__record__ ) : 
                    $__data_dosen__ = $__db->queryid(" SELECT TOP 1 IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record__->IdDosen ."' ORDER BY IdDosen DESC ");
                    
                    // Inisialisasi total honor
                    $__total_honor__ = 0;
                    $nomor_awal = 1;
            ?>

            <tr>
                <td class="text-center"><?= $__nomor__++; ?></td>
                <td class="text-center"><?= $__data_dosen__->IdDosen; ?></td>
                <td class="text-center" colspan="7"><?= $__data_dosen__->Nama; ?></td>
            </tr>

            <?php
                // Loop untuk mengambil data mahasiswa terkait dengan dosen
                for ( $i = 1; $i <= 3; $i++ ) {
                    $__assesor__ = $__db->query(" 
                        SELECT
                            A.Id_Rpl_Assesor, B.Id_Rpl_Sk, C.Id_Rpl_Pendaftaran,
                            C.Nama_Rpl_Pendaftaran AS Nama, C.Prodi_Rpl_Pendaftaran AS Prodi, C.Ta_Rpl_Pendaftaran AS Ta, C.Semester_Rpl_Pendaftaran AS Semester, C.Jenis_Rpl_Pendaftaran AS Jenis, C.TipeJenis_Rpl_Pendaftaran AS TipeJenis, B.Nomor_Rpl_Sk AS Nomor,
                            {$i} AS Assesor
                        FROM 
                            Tbl_Rpl_Assesor A 
                        JOIN 
                            Tbl_Rpl_Sk B ON A.Id_Rpl_Pendaftaran = B.Id_Rpl_Pendaftaran
                        JOIN 
                            Tbl_Rpl_Pendaftaran C ON B.Id_Rpl_Pendaftaran = C.Id_Rpl_Pendaftaran
                        WHERE 
                            A.As{$i}_Dosen_Rpl_Assesor = '". $__data_dosen__->IdDosen ."' AND A.Data = 'Y' AND A.Validasi_1_Rpl_Assesor = 'Y' AND A.Validasi_2_Rpl_Assesor = 'Y' AND A.Validasi_3_Rpl_Assesor = 'Y' AND B.Data = 'Y'
                            AND C.Prodi_Rpl_Pendaftaran = '". $_GET['__Prodi'] ."'
                        ORDER BY 
                            C.Nama_Rpl_Pendaftaran DESC
                    ");

                    foreach ( $__assesor__ AS $data => $__data__ ) :
                        $__data_sudahbayar__ = $__db->queryid(" SELECT Id_Rpl_BayarHonor AS Id, Nominal_Rpl_BayarHonor AS Nominal FROM Tbl_Rpl_BayarHonor WHERE Id_Rpl_Pendaftaran = '". $__data__->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Assesor = '". $__data__->Id_Rpl_Assesor ."' AND Id_Rpl_Sk = '". $__data__->Id_Rpl_Sk ."' AND Ta_Rpl_BayarHonor = '". $__data__->Ta ."' AND Semester_Rpl_BayarHonor = '". $__data__->Semester ."' AND Prodi_Rpl_BayarHonor = '". $__req_filter['Prodi'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' ");
                        
                        $__sudah_bayar__ = (isset($__data_sudahbayar__->Id) && $__data_sudahbayar__->Id) ? $__data_sudahbayar__->Nominal : 0;

                        $__data_biayakonversi__ = $__db->queryid(" 
                            SELECT TOP 1 Honor_Rpl_BiayaKonversi AS Honor
                            FROM Tbl_Rpl_BiayaKonversi
                            WHERE Ta_Rpl_BiayaKonversi = '". $__data__->Ta ."' AND Semester_Rpl_BiayaKonversi = '". $__data__->Semester ."' AND Tipe_Rpl_BiayaKonversi = '". $__data__->Jenis ."' ORDER BY Id_Rpl_BiayaKonversi ASC
                        ");

                        // Menambahkan honor
                        $__total_honor__ += (isset($__data_biayakonversi__->Honor) ? $__data_biayakonversi__->Honor : 0);
            ?>

            <tr>
                <td class="text-center"></td>
                <td class="text-center"><?= $nomor_awal++; ?></td>
                <td class="text-center"><?= $__data__->Nama; ?></td>
                <td class="text-center"><?= $__data__->Prodi; ?></td>
                <td class="text-center"><?= $__data__->Ta . '/' . $__data__->Semester; ?></td>
                <td class="text-center"><?= $__data__->Nomor; ?></td>
                <td class="text-center"><?= $__data__->Assesor . '<br>' . $__data__->TipeJenis; ?></td>
                <td class="text-center">
                    Rp.
                    <?= isset($__data_biayakonversi__->Honor) ? $__helpers->Uang( $__data_biayakonversi__->Honor + 0 ) : '0'; ?>
                </td>
                <td class="text-center">
                    <?= isset($__data_sudahbayar__->Id) ? 'Sudah Di Bayar' : 'Belum Di Bayar'; ?>
                </td>
            </tr>

            <?php endforeach; } $__total_honor_seluruh__ += $__total_honor__; ?>

            <tr>
                <td class="text-center" colspan="6">Total Honor Di Bayarkan</td>
                <td class="text-center" colspan="4">
                    <strong>Rp. <?= $__helpers->Uang($__total_honor__); ?></strong>
                </td>
            </tr>

            <?php endforeach; ?>

            <tr>
                <th class="text-center" colspan="6">
                    <h5>
                        Total Honor Wajib Di Keluarkan
                    </h5>
                </th>
                <th class="text-center" colspan="4">
                    <strong>
                        <h5>
                            Rp.
                            <?= isset($__total_honor_seluruh__) ? $__helpers->Uang( $__total_honor_seluruh__ + 0 ) : '0'; ?>
                        </h5>
                    </strong>
                </th>
            </tr>

        </table>
    </center>
</body>

</html>