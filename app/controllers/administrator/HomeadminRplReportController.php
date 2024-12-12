<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor2.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor3.php';
    require_once dirname(__DIR__) . '/../models/dosen/Sk.php';

    class HomeadminRplReportController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__Assesor2Model;
        protected $__Assesor3Model;
        protected $__SkModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__Assesor2Model = new __Assesor2Model($this->__db);
            $this->__Assesor3Model = new __Assesor3Model($this->__db);
            $this->__SkModel = new __SkModel($this->__db);
        }

        public function __Filter_Ta()
        {
            $data = $this->__db->query(" SELECT Ta_Rpl_Pendaftaran AS Datas FROM Tbl_Rpl_Pendaftaran GROUP BY Ta_Rpl_Pendaftaran ORDER BY Ta_Rpl_Pendaftaran DESC ");

            return $data;
        }

        public function __Filter_Semester()
        {
            $data = $this->__db->query(" SELECT Semester_Rpl_Pendaftaran AS Datas FROM Tbl_Rpl_Pendaftaran GROUP BY Semester_Rpl_Pendaftaran ORDER BY Semester_Rpl_Pendaftaran ASC ");

            return $data;
        }

        public function __Filter_Keterangan()
        {
            return array(
                'Selesai PUMB RPL', 'Proses PRL', 'Belum Bayar Konversi'
            );

            return $data;
        }

        public function __Filter_ListFormulirPendaftaran( $datas )
        {   
            if ( $datas['Keterangan'] == 'Selesai PUMB RPL' ) {
                
                $data = $this->__db->query(" SELECT A.Id_Rpl_Pendaftaran AS Id, A.Npm_Pumb AS Npm, A.Nomor_Rpl_Pendaftaran AS Nomor, A.Nama_Rpl_Pendaftaran AS Nama, A.Prodi_Rpl_Pendaftaran AS Prodi, A.Ta_Rpl_Pendaftaran AS Ta, A.Semester_Rpl_Pendaftaran AS Semester, A.TipeJenis_Rpl_Pendaftaran AS TipeJenis, A.Nomor_Rpl_Pendaftaran AS Nomor, B.Id_Rpl_Sk, B.Selesai_Pumb AS S, A.Email_Rpl_Pendaftaran AS Email, A.PasswordEmail_Rpl_Pendaftaran AS Password, A.Kurikulum_Rpl_Pendaftaran AS Kurikulum, A.IdKampus_Rpl_Pendaftaran AS IdKampus FROM Tbl_Rpl_Pendaftaran A JOIN Tbl_Rpl_Sk B ON A.Id_Rpl_Pendaftaran = B.Id_Rpl_Pendaftaran WHERE A.Ta_Rpl_Pendaftaran = '". $datas['Ta'] ."' AND A.Semester_Rpl_Pendaftaran = '". $datas['Semester'] ."' AND A.Selesai = 'Y' AND A.Data = 'Y' AND A.Kampus = '". __Aplikasi()['Kampus'] ."' AND B.Ta_Rpl_Sk = '". $datas['Ta'] ."' AND B.Semester_Rpl_Sk = '". $datas['Semester'] ."' AND B.Data = 'Y' AND B.Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY A.TglDaftar_Rpl_Pendaftaran DESC ");

            } elseif ( $datas['Keterangan'] == 'Proses PRL' ) {

                $data = $this->__db->query(" SELECT A.Id_Rpl_Pendaftaran AS Id, A.Npm_Pumb AS Npm, A.Nomor_Rpl_Pendaftaran AS Nomor, A.Nama_Rpl_Pendaftaran AS Nama, A.Prodi_Rpl_Pendaftaran AS Prodi, A.Ta_Rpl_Pendaftaran AS Ta, A.Semester_Rpl_Pendaftaran AS Semester, A.TipeJenis_Rpl_Pendaftaran AS TipeJenis, A.Email_Rpl_Pendaftaran AS Email, A.PasswordEmail_Rpl_Pendaftaran AS Password FROM Tbl_Rpl_Pendaftaran A JOIN Tbl_Rpl_Assesor B ON A.Id_Rpl_Pendaftaran = B.Id_Rpl_Pendaftaran WHERE A.Ta_Rpl_Pendaftaran = '". $datas['Ta'] ."' AND A.Semester_Rpl_Pendaftaran = '". $datas['Semester'] ."' AND A.Selesai = 'Y' AND A.Data = 'Y' AND A.Kampus = '". __Aplikasi()['Kampus'] ."' AND B.Validasi_1_Rpl_Assesor IS NULL AND B.Validasi_2_Rpl_Assesor IS NULL AND B.Validasi_3_Rpl_Assesor IS NULL AND B.Data = 'Y' AND B.Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY A.TglDaftar_Rpl_Pendaftaran DESC ");

            } elseif ( $datas['Keterangan'] == 'Belum Bayar Konversi' ) {

                $data = $this->__db->query(" SELECT Id_Rpl_Pendaftaran AS Id, Nomor_Rpl_Pendaftaran AS Nomor, Nama_Rpl_Pendaftaran AS Nama, Prodi_Rpl_Pendaftaran AS Prodi, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, TipeJenis_Rpl_Pendaftaran AS TipeJenis, Email_Rpl_Pendaftaran AS Email, PasswordEmail_Rpl_Pendaftaran AS Password FROM Tbl_Rpl_Pendaftaran WHERE Ta_Rpl_Pendaftaran = '". $datas['Ta'] ."' AND Semester_Rpl_Pendaftaran = '". $datas['Semester'] ."' AND NOT Selesai = 'Y' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY Id_Rpl_Pendaftaran DESC ");

            }
            
            return $data;
        }

        public function __Session__()
        {
            $__clean_data = [
                '__Id'      => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Administrator__']['__Id'], 221, 77) )[1],
                '__Nama'    => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Administrator__']['__Nama'], 221, 77) )[1],
                '__Level'   => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Administrator__']['__Level'], 221, 77) )[1],
                '__Log'     => $_SESSION['__Administrator__']['__Log'],
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
        
        public function IndexAdmin_Report()
        {
            $__header       = 'Report | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__rpl_report';

            $__active_rpl           = 'active';
            $__active_rpl_report    = 'active';

            if ( !isset($_SESSION['__Administrator__']) ) {

                $_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Akses Login Di Tolak, Silahkan Login terlebih Dahulu !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();

            }

                $__result_sessionlogin = self::__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                if ( $__session_login__['__Level'] == 'Admin' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

                } elseif ( $__session_login__['__Level'] == 'Keuangan' OR $__session_login__['__Level'] == 'Akademik' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } elseif ( $__session_login__['__Level'] == 'Pegawai' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.Id = '". $__session_login__['__Id'] ."' ORDER BY A.Id DESC ");

                } 

                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();
                $__filter_keterangan__ = self::__Filter_Keterangan();

                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $__req_filter = [
                        'Ta'            => $_POST['__Filter_Ta'],
                        'Semester'      => $_POST['__Filter_Semester'],
                        'Keterangan'    => $_POST['__Filter_Keterangan'],
                    ];
                    
                    $__record_data__ = self::__Filter_ListFormulirPendaftaran( $__req_filter );

                }
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';
        }

        public function __Assesor( array $data )
        {
            if ( $data['Assesor'] == '1' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As1_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As1_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == '2' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As2_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As2_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As2_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == '3' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As3_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As3_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As3_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == 'ID' ) {

                $result = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $data['Id'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == 'DOSEN' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As1_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As1_Semester_Rpl_Assesor = '". $data['Semester'] ."' OR As2_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As2_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As2_Semester_Rpl_Assesor = '". $data['Semester'] ."' OR As3_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As3_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As3_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");
                
            }

            return $result;
        }

        public function __Data_Rpl__( $id )
        {
            $data = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran AS Id, Nama_Rpl_Pendaftaran AS Nama, 'Rpl' AS Level, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, Kurikulum_Rpl_Pendaftaran AS Kurikulum, Gelombang_Rpl_Pendaftaran AS Gelombang, TglDaftar_Rpl_Pendaftaran AS TglDaftar, NoRegistrasi_Rpl_Pendaftaran AS NoRegistrasi, JenisKelamin_Rpl_Pendaftaran AS JenisKelamin, TempatLahir_Rpl_Pendaftaran AS TempatLahir, TanggalLahir_Rpl_Pendaftaran AS TglLahir, NoHp_Rpl_Pendaftaran AS NoHp, NoWa_Rpl_Pendaftaran AS NoWa, Email_Rpl_Pendaftaran AS Email, Alamat_Rpl_Pendaftaran AS Alamat, JenjangAkhir_Rpl_Pendaftaran AS JenjangAkhir, IdKampus_Rpl_Pendaftaran AS IdKampus, NamaKampus_Rpl_Pendaftaran AS NamaKampus, IdPtAsal_Rpl_Pendaftaran AS IdPtAsal, NamaPtAsal_Rpl_Pendaftaran AS NamaPtAsal, IdProdiAsal_Rpl_Pendaftaran AS IdProdiAsal, NamaProdiAsal_Rpl_Pendaftaran AS NamaProdiAsal, Prodi_Rpl_Pendaftaran AS Prodi, IdFakultas_Rpl_Pendaftaran AS IdFakultas, Fakultas_Rpl_Pendaftaran AS NamaFakultas, JamPerkuliahan_Rpl_Pendaftaran AS JamPerkuliahan, Referensi_Rpl_Pendaftaran AS Referensi, NamaReferensi_Rpl_Pendaftaran AS NamaReferensi, FileKtp_Rpl_Pendaftaran AS FileKtp, FormatKtp_Rpl_Pendaftaran AS FormatKtp, FileKk_Rpl_Pendaftaran AS FileKk, FormatKk_Rpl_Pendaftaran AS FormatKk, FileNilai_Rpl_Pendaftaran AS FileNilai, FormatNilai_Rpl_Pendaftaran AS FormatNilai, PasswordEmail_Rpl_Pendaftaran AS PasswordEmail, Nomor_Rpl_Pendaftaran AS Nomor, Sekolah_Rpl_Pendaftaran AS Sekolah, TipePt_Rpl_Pendaftaran AS TipePt, Bekerja_Rpl_Pendaftaran AS Bekerja, LamaBekerja_Rpl_Pendaftaran AS LamaBekerja, Kategori_Rpl_Pendaftaran AS Kategori, Studi_Rpl_Pendaftaran AS Studi, Jenis_Rpl_Pendaftaran AS Jenis, TipeJenis_Rpl_Pendaftaran AS TipeJenis FROM Tbl_Rpl_Pendaftaran WHERE Id_Rpl_Pendaftaran = '". $id ."' AND Data = 'Y' AND Selesai = 'Y' ORDER BY Id_Rpl_Pendaftaran DESC ");

            return $data;
        }

        public function __Data_Rpl_Berkas__( $id )
        {
            $data = $this->__db->query(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $id ."' AND Data = 'Y' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

            return $data;
        } 

        public function IndexAdmin_Report_Excel()
        {
            $__header       = 'Report';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;

            if ( !isset($_SESSION['__Administrator__']) ) {

                $_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Akses Login Di Tolak, Silahkan Login terlebih Dahulu !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();

            } else {

                $__result_sessionlogin = self::__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                if ( $__session_login__['__Level'] == 'Admin' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

                } elseif ( $__session_login__['__Level'] == 'Keuangan' OR $__session_login__['__Level'] == 'Akademik' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } elseif ( $__session_login__['__Level'] == 'Pegawai' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.Id = '". $__session_login__['__Id'] ."' ORDER BY A.Id DESC ");

                } 

                if ( $__authlogin__->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    $__nomor__ = '1';
                    
                    $__req_filter = [
                        'Ta'            => $_GET['__Ta'],
                        'Semester'      => $_GET['__Semester'],
                        'Keterangan'    => $_GET['__Keterangan'],
                    ];

                    $__record_data__ = self::__Filter_ListFormulirPendaftaran( $__req_filter );

                    $__db = $this->__db; 
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__excel/__report.php';

                } else {

                    redirect(url('homeadmin/rpl_report'), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }

        public function IndexAdmin_Report_Detail()
        {
            $__header       = 'Report | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__rpl_report_detail';

            $__active_rpl           = 'active';
            $__active_rpl_report    = 'active';

            if ( !isset($_SESSION['__Administrator__']) OR !isset($_GET['__Id']) ) {

                $_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Akses Login Di Tolak, Silahkan Login terlebih Dahulu !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();

            }

                $__result_sessionlogin = self::__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                if ( $__session_login__['__Level'] == 'Admin' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

                } elseif ( $__session_login__['__Level'] == 'Keuangan' OR $__session_login__['__Level'] == 'Akademik' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } elseif ( $__session_login__['__Level'] == 'Pegawai' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.Id = '". $__session_login__['__Id'] ."' ORDER BY A.Id DESC ");

                } 


                $__data_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen($_GET['__Id']) );
                $__data_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__data_rpl__->Id );

                $__url_file = $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl/';;
                $__url_file_penunjang = $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl_penunjang/';

                $__total_berkas_pendukung = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Pendaftaran_Berkas ) AS Total FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND Data = 'Y' ");
                
                $__check_assesor_1__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND As1_Status_Rpl_Assesor = 'Y' ");
                
                $__data_sk_rpl = $this->__db->queryrow(" SELECT Id_Rpl_Sk AS Id FROM Tbl_Rpl_Sk WHERE Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND Ta_Rpl_Sk = '". $__data_rpl__->Ta ."' AND Semester_Rpl_Sk = '". $__data_rpl__->Semester ."' ");


                    $__nomor_1__ = '1';
                    $__total_sks_1__ = '0';
                    $__record_data_detail_1__ = $this->__db->query(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND Ta_Rpl_Assesor_1 = '". $__data_rpl__->Ta ."' AND Semester_Rpl_Assesor_1 = '". $__data_rpl__->Semester ."' AND Prodi_Rpl_Assesor_1 = '". $__data_rpl__->Prodi ."' ORDER BY Id_Rpl_Assesor_1 DESC ");

                    if ( $__data_rpl__->Jenis == 'TP' ) {

                        $__nomor_2__ = '1';
                        $__calon_rpl_berkas__ = $this->__db->query(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__data_rpl__->Id ."' AND Data = 'Y' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                    }


                    $__record_assesor = $this->__Assesor__( ['Show' => '1', 'Id_Rpl_Pendaftaran' => $__data_rpl__->Id] );
                    $__dosen_assesor_1 = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_assesor->D_1 ."' ORDER BY IdDosen DESC ");
                    $__dosen_assesor_2 = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_assesor->D_2 ."' ORDER BY IdDosen DESC ");
                    $__dosen_assesor_3 = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_assesor->D_3 ."' ORDER BY IdDosen DESC ");

                    if ( $__record_assesor->Validasi_1 == 'Y' AND $__record_assesor->Validasi_2 == 'Y' AND $__record_assesor->Validasi_3 == 'Y' ) {

                        $__data_sk_rpl = $this->__SkModel->read(['Id_Rpl_Pendaftaran' => $__record_assesor->Id_Rpl_Pendaftaran, 'Id_Rpl_Assesor' => $__record_assesor->Id]);

                    }


                    $__data_assesor_3 = $this->__Assesor3Model->read(['Id_Rpl_Assesor' => $__record_assesor->Id, 'Id_Rpl_Pendaftaran' => $__data_rpl__->Id, 'IdDosen' => $__record_assesor->D_3, 'Ta' => $__record_assesor->Ta_3, 'Semester' => $__record_assesor->Semester_3, 'Prodi' => $__record_assesor->Prodi_3]);


                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';
        }

        public function __Assesor__( array $data )
        {
            if ( $data['Check'] == '1' ) {

                $result = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' ");
                
            } elseif ( $data['Assesor_1'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Assesor_2'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As2_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Assesor_3'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As3_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Show'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == 'ID' ) {

                $result = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $data['Id'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            }

            return $result;
        }

        public function IndexAdmin_Report_Detail_Pdf()
        {
            $__header       = 'Report | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__rpl_report_detail';

            $__active_rpl           = 'active';
            $__active_rpl_report    = 'active';

            if ( !isset($_SESSION['__Administrator__']) OR !isset($_GET['__Id']) OR !isset($_GET['__IdSk']) ) {

                $_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Akses Login Di Tolak, Silahkan Login terlebih Dahulu !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();

            }

            $__result_sessionlogin = self::__Session__();

            $__session_login__ = [
                '__Id'      => $__result_sessionlogin['__Id'],
                '__Nama'    => $__result_sessionlogin['__Nama'],
                '__Level'   => $__result_sessionlogin['__Level'],
                '__Log'     => $__result_sessionlogin['__Log'],
            ];

            if ( $__session_login__['__Level'] == 'Admin' ) {

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

            } elseif ( $__session_login__['__Level'] == 'Akademik' OR $__session_login__['__Level'] == 'Keuangan' ) {

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

            } 

                $__authlogin__ = $this->__helpers->SecretOpen( $_GET['__Id'] );

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__IdSk'] )]);

                $__data_assesor = $this->__Assesor__( ['Show' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__] );
                
                $__data_calon_rpl = $this->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__ == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    $__nomor_mk_transfer = '1';
                    $__data_mk_transfer = $this->__Assesor2Model->read(['Id_Rpl_Assesor' => $__data_assesor->Id, 'Id_Rpl_Pendaftaran' => $__data_calon_rpl->Id]);
                    $__data_rektor = $this->__db->queryid(" SELECT TOP 1 B.IdDosen AS Id, B.NamaGelar AS Nama, B.NidnNtbDos AS Nidn FROM Hak_Akses_Global A LEFT JOIN Dosen B ON A.id_dosen_pejabat = B.IdDosen WHERE A.Jabatan LIKE '%Rektor%' AND A.Id_Kampus LIKE '". __Aplikasi()['IdKampus'] ."%' ORDER BY A.Priode_Akhir DESC ");

                    $__data_mk_perolehan = $this->__db->query(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf FROM Tbl_Rpl_Perolehan WHERE Data = 'Y' AND Id_Rpl_Assesor = '". $__data_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_calon_rpl->Id ."' ORDER BY Id_Rpl_Perolehan DESC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sk.php';

                } else {

                    redirect(url('/homeadmin/rpl_report/detail?__Id=' . $_GET['__Id']), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
        }

        public function IndexAdmin_Report_Detail_Lampiran()
        {
            $__header       = 'Report | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__rpl_report_detail';

            $__active_rpl           = 'active';
            $__active_rpl_report    = 'active';

            if ( !isset($_SESSION['__Administrator__']) OR !isset($_GET['__Id']) OR !isset($_GET['__IdSk']) ) {

                $_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Akses Login Di Tolak, Silahkan Login terlebih Dahulu !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();

            }

            $__result_sessionlogin = self::__Session__();

            $__session_login__ = [
                '__Id'      => $__result_sessionlogin['__Id'],
                '__Nama'    => $__result_sessionlogin['__Nama'],
                '__Level'   => $__result_sessionlogin['__Level'],
                '__Log'     => $__result_sessionlogin['__Log'],
            ];

            if ( $__session_login__['__Level'] == 'Admin' ) {

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

            } elseif ( $__session_login__['__Level'] == 'Akademik' OR $__session_login__['__Level'] == 'Keuangan' ) {

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

            } 

                $__authlogin__ = $__session_login__['__Id'];

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__IdSk'] )]);

                $__data_assesor = $this->__Assesor__(['Assesor' => 'ID', 'Id' => $__data_sk_rpl->Id_Rpl_Assesor]);
                
                $__data_calon_rpl = $this->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__ == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    // $__data_mk_transfer = $this->__Assesor2Model->read(['Id_Rpl_Assesor' => $__data_assesor->Id, 'Id_Rpl_Pendaftaran' => $__data_calon_rpl->Id]);
                    $__data_rektor = $this->__db->queryid(" SELECT TOP 1 B.IdDosen AS Id, B.NamaGelar AS Nama, B.NidnNtbDos AS Nidn FROM Hak_Akses_Global A LEFT JOIN Dosen B ON A.id_dosen_pejabat = B.IdDosen WHERE A.Jabatan LIKE '%Rektor%' AND A.Id_Kampus LIKE '". __Aplikasi()['IdKampus'] ."%' ORDER BY A.Priode_Akhir DESC ");

                    if ( isset($__data_calon_rpl->TipePt) AND $__data_calon_rpl->TipePt == TRUE AND $__data_calon_rpl->TipePt == 'KULIAH' ) {

                        $__1_label  = 'PT Asal';
                        $__1_isi    = $__data_calon_rpl->IdPtAsal . ' - ' . $__data_calon_rpl->NamaPtAsal;
                        $__2_label  = 'Prodi Asal';
                        $__2_isi    = '(' . $__data_calon_rpl->JenjangAkhir . ')' . ' - ' . $__data_calon_rpl->IdProdiAsal . ' - ' . $__data_calon_rpl->NamaProdiAsal;

                    } else {

                        $__1_label  = 'Jenjang Akhir';
                        $__1_isi    = $__data_calon_rpl->JenjangAkhir;
                        $__2_label  = 'Nama Sekolah Asal';
                        $__2_isi    = $__data_calon_rpl->Sekolah;

                    }

                    $__nomor_prodi_mk = '1';
                    $__data_prodimk = $this->__db->query(" SELECT IdPrimary AS Id, Kurikulum, IdKampus, IdFakultas, Prodi, IdMk, Sks, Semester, Ta, MkPilihan FROM ProdiMk WHERE Prodi = '". $__data_calon_rpl->Prodi ."' AND Kurikulum = '". $__data_calon_rpl->Kurikulum ."' AND IdKampus = '". $__data_calon_rpl->IdKampus ."' ORDER BY Semester ASC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sk_lampiran.php';

                } else {

                    redirect(url('/homeadmin/rpl_report/detail?__Id=' . $_GET['__Id']), '03', 'Data Request Tidak Ditemukan !');
                    exit();
                
                }
        }
    }