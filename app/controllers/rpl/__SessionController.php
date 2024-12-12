<?php

    class __SessionController
    {
        private $__db;
        private $__secret_key;
        private $__universitas;

        public function __construct( $db , $__secret_key , $__universitas )
        {
            $this->__db = $db;
            $this->__universitas = $__universitas;
            $this->__secret_key = $__secret_key;
        }

        public function __Session__()
        {
            $__clean_data = [
                '__Id'      => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Rpl__']['__Id'], 221, 77) )[1],
                '__Nama'    => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Rpl__']['__Nama'], 221, 77) )[1],
                '__Level'   => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Rpl__']['__Level'], 221, 77) )[1],
                '__Log'     => $_SESSION['__Rpl__']['__Log'],
            ];

            if ( @$__clean_data['__Id'] == TRUE AND @$__clean_data['__Nama'] == TRUE AND @$__clean_data['__Level'] == TRUE AND @$__clean_data['__Log'] == TRUE )  {
                
                return $__datas = [
                    '__Id'      => $__clean_data['__Id'],
                    '__Nama'    => $__clean_data['__Nama'],
                    '__Level'   => $__clean_data['__Level'],
                    '__Log'     => $__clean_data['__Log'],
                ];
            
            } else {
            
                return $__datas = [
                    '__Id'      => '',
                    '__Nama'    => '',
                    '__Level'   => '',
                    '__Log'     => '',
                ];
            
            }
        }

        public function __Url_Curl__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl/__upload_receiver.php';
        }

        public function __Url_Curl_Penunjang__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl_penunjang/__upload_receiver.php';
        }

        public function __Url_File__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl/';
        }

        public function __Url_File_Penunjang__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl_penunjang/';
        }
        
        public function __Data_Rpl__( $id )
        {
            $data = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran AS Id, Nama_Rpl_Pendaftaran AS Nama, 'Rpl' AS Level, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, Kurikulum_Rpl_Pendaftaran AS Kurikulum, Gelombang_Rpl_Pendaftaran AS Gelombang, TglDaftar_Rpl_Pendaftaran AS TglDaftar, NoRegistrasi_Rpl_Pendaftaran AS NoRegistrasi, JenisKelamin_Rpl_Pendaftaran AS JenisKelamin, TempatLahir_Rpl_Pendaftaran AS TempatLahir, TanggalLahir_Rpl_Pendaftaran AS TglLahir, NoHp_Rpl_Pendaftaran AS NoHp, NoWa_Rpl_Pendaftaran AS NoWa, Email_Rpl_Pendaftaran AS Email, Alamat_Rpl_Pendaftaran AS Alamat, JenjangAkhir_Rpl_Pendaftaran AS JenjangAkhir, IdKampus_Rpl_Pendaftaran AS IdKampus, NamaKampus_Rpl_Pendaftaran AS NamaKampus, IdPtAsal_Rpl_Pendaftaran AS IdPtAsal, NamaPtAsal_Rpl_Pendaftaran AS NamaPtAsal, IdProdiAsal_Rpl_Pendaftaran AS IdProdiAsal, NamaProdiAsal_Rpl_Pendaftaran AS NamaProdiAsal, Prodi_Rpl_Pendaftaran AS Prodi, IdFakultas_Rpl_Pendaftaran AS IdFakultas, Fakultas_Rpl_Pendaftaran AS NamaFakultas, JamPerkuliahan_Rpl_Pendaftaran AS JamPerkuliahan, Referensi_Rpl_Pendaftaran AS Referensi, NamaReferensi_Rpl_Pendaftaran AS NamaReferensi, FileKtp_Rpl_Pendaftaran AS FileKtp, FormatKtp_Rpl_Pendaftaran AS FormatKtp, FileKk_Rpl_Pendaftaran AS FileKk, FormatKk_Rpl_Pendaftaran AS FormatKk, FileNilai_Rpl_Pendaftaran AS FileNilai, FormatNilai_Rpl_Pendaftaran AS FormatNilai, PasswordEmail_Rpl_Pendaftaran AS PasswordEmail, Nomor_Rpl_Pendaftaran AS Nomor, Sekolah_Rpl_Pendaftaran AS Sekolah, TipePt_Rpl_Pendaftaran AS TipePt, Bekerja_Rpl_Pendaftaran AS Bekerja, LamaBekerja_Rpl_Pendaftaran AS LamaBekerja, Kategori_Rpl_Pendaftaran AS Kategori, Studi_Rpl_Pendaftaran AS Studi, Jenis_Rpl_Pendaftaran AS Jenis, TipeJenis_Rpl_Pendaftaran AS TipeJenis, Kampus, Npm_Pumb AS Npm FROM Tbl_Rpl_Pendaftaran WHERE Id_Rpl_Pendaftaran = '". $id ."' AND Data = 'Y' AND Selesai = 'Y' ORDER BY Id_Rpl_Pendaftaran DESC ");

            return $data;
        } 

        public function __Data_Rpl_Berkas__( $id )
        {
            $data = $this->__db->query(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $id ."' AND Data = 'Y' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

            return $data;
        } 
    }