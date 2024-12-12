<?php

    if ( $_GET['__Ta'] == FALSE OR $_GET['__Semester'] == FALSE OR $_GET['__Keterangan'] == FALSE ) {
    
        header("Location: ". __Base_Url() . "");
        exit;
    
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Laporan <?= $__helpers->TanggalIndonesia(date('d-m-Y')); ?>
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
        <h1>
            Laporan
        </h1>

        <?php if ( $__req_filter['Keterangan'] == 'Selesai PUMB RPL' ) { ?>
        <table border="1">
            <tr>
                <th class="text-center">Nomor</th>
                <th class="text-center">NPM Mahasiswa</th>
                <th class="text-center">Prodi</th>
                <th class="text-center">Tahun Ajaran</th>
                <th class="text-center">Nama Mahasiswa</th>
                <th class="text-center">Jenis RPL</th>
                <th class="text-center">Jumlah SKS</th>
                <th class="text-center">Sisa SKS</th>
                <th class="text-center">Keterangan</th>
            </tr>

            <?php 
                                            
                $__nomor__ = '1';
                foreach ( $__record_data__ AS $data => $__record__ ) : 

                    $__get_sks_transfer__ = 0; 
                    $__get_sks_peroleh__ = 0;  
                    $__sks_transfer__ = 0;
                    $__sks_peroleh__ = 0;  

                    $__datas_sks_transfer__ = $this->__db->query(" SELECT IdMk_Pilih_Rpl_Assesor_2 AS IdMk FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' GROUP BY IdMk_Pilih_Rpl_Assesor_2 ");

                        foreach ( $__datas_sks_transfer__ AS $data => $__d_sks_transfer__ )  {
                            
                            $__data_sks_transfer__ = $this->__db->queryid(" SELECT TOP 1 Sks_Pilih_Rpl_Assesor_2 AS Sks FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' AND IdMk_Pilih_Rpl_Assesor_2 = '". $__d_sks_transfer__->IdMk ."' ");

                            $__sks_transfer__ += $__data_sks_transfer__->Sks;

                        }

                    $__datas_sks_peroleh__ = $this->__db->query(" SELECT IdMk_Rpl_Perolehan AS IdMk FROM Tbl_Rpl_Perolehan WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' GROUP BY IdMk_Rpl_Perolehan ");

                        foreach ( $__datas_sks_peroleh__ AS $data => $__d_sks_peroleh__ )  {
                            
                            $__data_sks_peroleh__ = $this->__db->queryid(" SELECT TOP 1 Sks_Rpl_Perolehan AS Sks FROM Tbl_Rpl_Perolehan WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' AND IdMk_Rpl_Perolehan = '". $__d_sks_peroleh__->IdMk ."' ");

                            $__sks_peroleh__ += $__data_sks_peroleh__->Sks;

                        }

                    $__get_sks_transfer__ = $__sks_transfer__ ?? 0; 
                    $__get_sks_peroleh__ = $__sks_peroleh__ ?? 0;

                    if ( isset($__record__->Npm) AND $__record__->Npm == TRUE ) {

                        $__data_pmbregistrasi__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama FROM PmbRegistrasi WHERE Ta = '". $__record__->Ta ."' AND Npm = '". $__record__->Npm ."' ORDER BY Npm DESC ");

                        $__sks_prodimk = $this->__db->queryid(" SELECT SUM(Sks) AS Sks FROM ProdiMk WHERE Prodi = '". $__record__->Prodi ."' AND Kurikulum = '". $__record__->Kurikulum ."' AND IdKampus = '". $__record__->IdKampus ."' ");

                        $__sisa_sks__ = $__sks_prodimk->Sks - ($__get_sks_transfer__ + $__get_sks_peroleh__);
                    
                    } else {

                        $__data_pmbregistrasi__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama FROM PmbRegistrasi WHERE Ta = '". $__record__->Ta ."' AND NoPeserta = '". $__record__->Nomor ."' ORDER BY Npm DESC ");

                    }

                        $__npm__ = $__data_pmbregistrasi__->Npm;    
                
            ?>

            <tr>
                <td class="text-center">
                    <?= $__nomor__++; ?>
                </td>
                <td class="text-center">
                    <?php if ( $__npm__ == TRUE ) { ?>
                    <?= $__data_pmbregistrasi__->Npm . '<br>' . $__data_pmbregistrasi__->Pass; ?>
                    <?php } else { ?>
                    <span class='badge bg-danger'>
                        -
                    </span>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Prodi; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Nama; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->TipeJenis; ?>
                </td>
                <td class="text-center">
                    <?= $__get_sks_transfer__ + $__get_sks_peroleh__; ?>
                </td>
                <td class="text-center">
                    <?= $__sisa_sks__; ?>
                </td>
                <td class="text-center">
                    <?php 
                        if ( $__npm__ == TRUE ) {
                            echo  
                                "
                                    <span class='badge bg-info'>
                                        Sudah PUMB
                                    </span>
                                ";
                        } else {
                            echo  
                                "
                                    <span class='badge bg-danger'>
                                        Belum Bayar PUMB
                                    </span>
                                ";
                        }
                    ?>
                </td>
            </tr>

            <?php endforeach; ?>

        </table>
        <?php } elseif ( $__req_filter['Keterangan'] == 'Proses PRL' ) { ?>
        <table border="1">
            <tr>
                <th class="text-center">Nomor</th>
                <th class="text-center">Prodi</th>
                <th class="text-center">Tahun Ajaran</th>
                <th class="text-center">Nama Mahasiswa</th>
                <th class="text-center">Jenis RPL</th>
                <th class="text-center">Jumlah SKS</th>
                <th class="text-center">Keterangan</th>
            </tr>

            <?php 
                                            
                $__nomor__ = '1';
                foreach ( $__record_data__ AS $data => $__record__ ) : 
                
            ?>

            <tr>
                <td class="text-center">
                    <?= $__nomor__++; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Prodi; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Nama; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->TipeJenis; ?>
                </td>
                <td class="text-center">
                    <?= $__req_filter['Keterangan']; ?>
                </td>
            </tr>

            <?php endforeach; ?>

        </table>
        <?php } elseif ( $__req_filter['Keterangan'] == 'Belum Bayar Konversi' ) { ?>
        <table border="1">
            <tr>
                <th class="text-center">Nomor</th>
                <th class="text-center">Prodi</th>
                <th class="text-center">Tahun Ajaran</th>
                <th class="text-center">Nama Mahasiswa</th>
                <th class="text-center">Jenis RPL</th>
                <th class="text-center">Jumlah SKS</th>
                <th class="text-center">Keterangan</th>
            </tr>

            <?php 
                                            
                $__nomor__ = '1';
                foreach ( $__record_data__ AS $data => $__record__ ) : 
                
            ?>

            <tr>
                <td class="text-center">
                    <?= $__nomor__++; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Prodi; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Ta . '/' . $__record__->Semester; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->Nama; ?>
                </td>
                <td class="text-center">
                    <?= $__record__->TipeJenis; ?>
                </td>
                <td class="text-center">
                    <?= $__req_filter['Keterangan']; ?>
                </td>
            </tr>

            <?php endforeach; ?>

        </table>
        <?php } ?>
    </center>
</body>

</html>