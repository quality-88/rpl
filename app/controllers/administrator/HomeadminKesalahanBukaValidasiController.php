<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';

    class HomeadminKesalahanBukaValidasiController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
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

        public function __Filter_Dosen()
        {
            $data = $this->__db->query(" SELECT IdDosen_Rpl_KuotaAssesor AS IdDosen FROM Tbl_Rpl_KuotaAssesor WHERE Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' GROUP BY IdDosen_Rpl_KuotaAssesor ORDER BY IdDosen_Rpl_KuotaAssesor DESC ");

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
        
        public function IndexAdmin_Kesalahan_BukaValidasi()
        {
            $__header       = 'Buka Validasi | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__kesalahan_bukavalidasi';

            $__active_kesalahan                   = 'active';
            $__active_kesalahan_bukavalidasi      = 'active';

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

                // } elseif ( $__session_login__['__Level'] == 'Keuangan' OR $__session_login__['__Level'] == 'Akademik' ) {

                //     $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } elseif ( $__session_login__['__Level'] == 'Pegawai' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.Id = '". $__session_login__['__Id'] ."' ORDER BY A.Id DESC ");

                } 

                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();
                $__filter_prodi__ = self::__Filter_Prodi();
                $__filter_dosen__ = self::__Filter_Dosen();

                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $__req_filter = [
                        'Ta'            => $_POST['__Filter_Ta'],
                        'Semester'      => $_POST['__Filter_Semester'],
                        'Prodi'         => $_POST['__Filter_Prodi'],
                        'Dosen'         => $_POST['__Filter_Dosen'],
                        'Assesor'       => $_POST['__Filter_Assesor'],
                    ];
                    
                    $__record_data__ = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As2_Dosen_Rpl_Assesor AS Dosen_2, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As1_Status_Rpl_Assesor = 'Y' AND As2_Dosen_Rpl_Assesor = '". $__req_filter['Dosen'] ."' AND As2_Ta_Rpl_Assesor = '". $__req_filter['Ta'] ."' AND As2_Semester_Rpl_Assesor = '". $__req_filter['Semester'] ."' AND As2_Prodi_Rpl_Assesor = '". $__req_filter['Prodi'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Data = 'Y' AND Validasi_1_Rpl_Assesor = 'Y' AND Validasi_2_Rpl_Assesor = 'Y' AND Validasi_3_Rpl_Assesor = 'Y' ORDER BY Id_Rpl_Assesor DESC ");
                    
                }

                $__db = $this->__db;
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';
        }

        public function IndexAdmin_Kesalahan_BukaValidasi_Buka()
        {
            $__clean_data = [
                '__Url'         => url('/homeadmin/kesalahan_bukavalidasi'),
                '__IdAssesor'   => isset($_GET['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__IdAssesor'], ENT_QUOTES))) : '',
                '__Assesor'     => isset($_GET['__Assesor']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__Assesor'], ENT_QUOTES))) : '',
            ];

            $__id = isset($__clean_data['__IdAssesor']) ? intval($this->__helpers->SecretOpen($__clean_data['__IdAssesor'])) : 0;
            
            if ( $__id <= 0 || $__clean_data['__Assesor'] <= 0 ) {
                
                redirect($__clean_data['__Url'], '03', 'ID Tidak Valid !');
                exit();
                
            }

            $__session = [
                'As2_TglHapus_Rpl_Assesor'  => date('Y-m-d', strtotime('+3 day', strtotime(date('Y-m-d')))) . ' 23:59:59',
                'As2_Status_Rpl_Assesor'    => 'N',
                'As3_Status_Rpl_Assesor'    => 'N',
                'Validasi_1_Rpl_Assesor'    => NULL,
                'Tgl_1_Rpl_Assesor'         => NULL,
                'Validasi_2_Rpl_Assesor'    => NULL,
                'Tgl_2_Rpl_Assesor'         => NULL,
                'Validasi_3_Rpl_Assesor'    => NULL,
                'Tgl_3_Rpl_Assesor'         => NULL,
                'Id_Rpl_Assesor'            => $__id,
            ];

            $__session_insert = [
                'Assesor_Rpl_BukaValidasi'  => $__clean_data['__Assesor'],
                'Id_Rpl_Assesor'            => $__id,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__sql_perolehan = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Assesor SET
                                    As2_TglHapus_Rpl_Assesor    = :As2_TglHapus_Rpl_Assesor,
                                    As2_Status_Rpl_Assesor      = :As2_Status_Rpl_Assesor,
                                    As3_Status_Rpl_Assesor      = :As3_Status_Rpl_Assesor, 
                                    Validasi_1_Rpl_Assesor      = :Validasi_1_Rpl_Assesor, 
                                    Tgl_1_Rpl_Assesor           = :Tgl_1_Rpl_Assesor,
                                    Validasi_2_Rpl_Assesor      = :Validasi_2_Rpl_Assesor, 
                                    Tgl_2_Rpl_Assesor           = :Tgl_2_Rpl_Assesor,
                                    Validasi_3_Rpl_Assesor      = :Validasi_3_Rpl_Assesor, 
                                    Tgl_3_Rpl_Assesor           = :Tgl_3_Rpl_Assesor
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                            "
                        ) -> execute ( $__session );

                        $__sql_perolehan_detail = $this->__db->prepare( 
                            "
                                INSERT INTO Tbl_Rpl_BukaValidasi
                                (
                                    Assesor_Rpl_BukaValidasi, Id_Rpl_Assesor
                                )
                                VALUES
                                (
                                    :Assesor_Rpl_BukaValidasi, :Id_Rpl_Assesor
                                )
                            "
                        ) -> execute ( $__session_insert );

                    $this->__db->commit();

                        redirect($__clean_data['__Url'], '01', 'Berhasil Buka Validasi Data, Mohon Kerjakan dan Jangan Sampai Lewat Waktu, Jika Lewat Maka Akan Terhapus Secara Seluruhnya !');
                        exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }
    }