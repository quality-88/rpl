<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor2.php';
    require_once dirname(__DIR__) . '/../models/dosen/Sk.php';

    class HomeadminRplFormulirPendaftaranController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__Assesor2Model;
        protected $__SkModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__Assesor2Model = new __Assesor2Model($this->__db);
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

        public function __Filter_Prodi()
        {
            $data = $this->__db->query(" SELECT Prodi AS Datas FROM Prodi WHERE ". $this->__universitas->__QueryNot_Universitas() ." Prodi LIKE '%UQB%' GROUP BY Prodi ORDER BY Prodi ASC ");

            return $data;
        }

        public function __Filter_ListFormulirPendaftaran( $datas )
        {   
            $data = $this->__db->query(" SELECT Id_Rpl_Pendaftaran AS Id, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, Kurikulum_Rpl_Pendaftaran AS Kurikulum, Gelombang_Rpl_Pendaftaran AS Gelombang, TglDaftar_Rpl_Pendaftaran AS TglDaftar, NoRegistrasi_Rpl_Pendaftaran AS NoRegistrasi, Nama_Rpl_Pendaftaran AS Nama, JenisKelamin_Rpl_Pendaftaran AS JenisKelamin, TempatLahir_Rpl_Pendaftaran AS TempatLahir, TanggalLahir_Rpl_Pendaftaran AS TglLahir, NoHp_Rpl_Pendaftaran AS NoHp, NoWa_Rpl_Pendaftaran AS NoWa, Email_Rpl_Pendaftaran AS Email, Alamat_Rpl_Pendaftaran AS Alamat, JenjangAkhir_Rpl_Pendaftaran AS JenjangAkhir, IdKampus_Rpl_Pendaftaran AS IdKampus, NamaKampus_Rpl_Pendaftaran AS NamaKampus, IdPtAsal_Rpl_Pendaftaran AS IdPtAsal, NamaPtAsal_Rpl_Pendaftaran AS NamaPtAsal, IdProdiAsal_Rpl_Pendaftaran AS IdProdiAsal, NamaProdiAsal_Rpl_Pendaftaran AS NamaProdiAsal, Prodi_Rpl_Pendaftaran AS Prodi, IdFakultas_Rpl_Pendaftaran AS IdFakultas, Fakultas_Rpl_Pendaftaran AS Fakultas, JamPerkuliahan_Rpl_Pendaftaran AS JamPerkuliahan, Referensi_Rpl_Pendaftaran AS Referensi, NamaReferensi_Rpl_Pendaftaran AS NamaReferensi, FileKtp_Rpl_Pendaftaran AS FileKtp, FormatKtp_Rpl_Pendaftaran AS FormatKtp, FileKk_Rpl_Pendaftaran AS FileKk, FormatKk_Rpl_Pendaftaran AS FormatKk, FileNilai_Rpl_Pendaftaran AS FileNilai, FormatNilai_Rpl_Pendaftaran AS FormatNilai, PasswordEmail_Rpl_Pendaftaran AS PasswordEmail, Selesai, Npm_Pumb AS Npm, TipeJenis_Rpl_Pendaftaran AS TipeJenis, Nomor_Rpl_Pendaftaran AS Nomor FROM Tbl_Rpl_Pendaftaran WHERE Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Ta_Rpl_Pendaftaran = '". $datas['Ta'] ."' AND Semester_Rpl_Pendaftaran = '". $datas['Semester'] ."' AND Prodi_Rpl_Pendaftaran = '". $datas['Prodi'] ."' ORDER BY TglDaftar_Rpl_Pendaftaran DESC ");
            
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

        public function __Header()
        {
            return 'Administrator | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homeadmin/rpl_formulirpendaftaran');
        }

        public function __Routes_Mod_File__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl/';
        }
        
        public function IndexAdmin_FormulirPendaftaran()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__rpl_formulirpendaftaran';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl                       = 'active';
            $__active_rpl_formulirpendaftaran   = 'active';

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

                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();
                $__filter_prodi__ = self::__Filter_Prodi();

                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $__req_filter = [
                        'Ta'        => $_POST['__Filter_Ta'],
                        'Semester'  => $_POST['__Filter_Semester'],
                        'Prodi'     => $_POST['__Filter_Prodi'],
                    ];

                    $__record_data__ = self::__Filter_ListFormulirPendaftaran( $__req_filter ); 

                    $__nomor = '1';
                    $__record__data__ = [];
                    foreach ( $__record_data__ AS $data => $__record__ ) : 

                        $__data_assesor__ = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $__record__->Id ."' ORDER BY Id_Rpl_Assesor DESC ");

                        $__data_dosen_1__ = $this->__db->queryid(" SELECT TOP 1 IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__data_assesor__->D_1 ."' ORDER BY IdDosen DESC ");

                        $__data_dosen_2__ = $this->__db->queryid(" SELECT TOP 1 IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__data_assesor__->D_2 ."' ORDER BY IdDosen DESC ");

                        $__data_dosen_3__ = $this->__db->queryid(" SELECT TOP 1 IdDosen, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__data_assesor__->D_3 ."' ORDER BY IdDosen DESC ");

                        $__record__data__[] = [
                            'Nomor'             => $__nomor++,
                            'Id'                => $__record__->Id,
                            'TglDaftar'         => $this->__helpers->TanggalWaktu( $__record__->TglDaftar ),
                            'Email'             => $__record__->Email . '<br><br>' . $__record__->PasswordEmail,
                            'Nama'              => $__record__->Nama,
                            'TahunAjaran'       => $__record__->Ta . '/' . $__record__->Semester,
                            'Gelombang'         => $__record__->Gelombang,
                            'Jenjang_Asal'      => $__record__->JenjangAkhir,
                            'PT_Asal'           => $__record__->NamaPtAsal,
                            'Prodi_Asal'        => $__record__->NamaProdiAsal,
                            'Kampus'            => $__record__->IdKampus . ' - ' . $__record__->NamaKampus,
                            'Fakultas'          => $__record__->IdFakultas . ' - ' . $__record__->NamaFakultas,
                            'Prodi'             => $__record__->Prodi,
                            'Ktp'               => $__record__->FileKtp,
                            'Kk'                => $__record__->FileKk,
                            'Nilai'             => $__record__->FileNilai,
                            'Selesai'           => $__record__->Selesai,
                            'D_1'               => $__data_dosen_1__->IdDosen,
                            'N_1'               => $__data_dosen_1__->Nama,
                            'S_1'               => $__data_assesor__->S_1,
                            'H_1'               => isset($__data_assesor__->Hapus_1) ? $this->__helpers->TanggalWaktu( $__data_assesor__->Hapus_1 ) : 'Kosong',
                            'D_2'               => $__data_dosen_2__->IdDosen,
                            'N_2'               => $__data_dosen_2__->Nama,
                            'S_2'               => $__data_assesor__->S_2,
                            'H_2'               => isset($__data_assesor__->Hapus_2) ? $this->__helpers->TanggalWaktu( $__data_assesor__->Hapus_2 ) : 'Kosong',
                            'D_3'               => $__data_dosen_3__->IdDosen,
                            'N_3'               => $__data_dosen_3__->Nama,
                            'S_3'               => $__data_assesor__->S_3,
                            'H_3'               => isset($__data_assesor__->Hapus_3) ? $this->__helpers->TanggalWaktu( $__data_assesor__->Hapus_3 ) : 'Kosong',
                            'Npm'               => isset($__record__->Npm) ? $__record__->Npm : '<span class="badge bg-danger">Tidak PUMB</span>',
                            'Id_Rpl_Asseosr'    => $__data_assesor__->Id,
                            'TipeJenis'         => $__record__->TipeJenis,
                            'NomorRpl'          => $__record__->Nomor,
                            'Ta'                => $__record__->Ta,
                        ];

                    endforeach;

                }
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
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

        public function IndexAdmin_FormulirPendaftaran_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__rpl_formulirpendaftaran';

            $__active_rpl                       = 'active';
            $__active_rpl_formulirpendaftaran   = 'active';

            if ( !isset($_SESSION['__Administrator__']) OR $_GET['__Id'] == FALSE ) {

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

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);

                $__data_assesor = $this->__Assesor(['Assesor' => 'ID', 'Id' => $__data_sk_rpl->Id_Rpl_Assesor]);
                
                $__data_calon_rpl = $this->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__->Id == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    $__nomor_mk_transfer = '1';
                    $__data_mk_transfer = $this->__Assesor2Model->read(['Id_Rpl_Assesor' => $__data_assesor->Id, 'Id_Rpl_Pendaftaran' => $__data_calon_rpl->Id]);
                    $__data_rektor = $this->__db->queryid(" SELECT TOP 1 B.IdDosen AS Id, B.NamaGelar AS Nama, B.NidnNtbDos AS Nidn FROM Hak_Akses_Global A LEFT JOIN Dosen B ON A.id_dosen_pejabat = B.IdDosen WHERE A.Jabatan LIKE '%Rektor%' AND A.Id_Kampus LIKE '". __Aplikasi()['IdKampus'] ."%' ORDER BY A.Priode_Akhir DESC ");

                    $__data_mk_perolehan = $this->__db->query(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf FROM Tbl_Rpl_Perolehan WHERE Data = 'Y' AND Id_Rpl_Assesor = '". $__data_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_calon_rpl->Id ."' ORDER BY Id_Rpl_Perolehan DESC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sk.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }
    }