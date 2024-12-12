<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';

    class HomeadminRplHapusPendaftaranController
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
        
        public function IndexAdmin_HapusPendaftaran()
        {
            $__header       = 'Hapus Pendaftaran | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__rpl_hapuspendaftaran';

            $__active_rpl                       = 'active';
            $__active_rpl_hapuspendaftaran      = 'active';

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
                $__filter_prodi__ = self::__Filter_Prodi();

                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $__req_filter = [
                        'Ta'            => $_POST['__Filter_Ta'],
                        'Semester'      => $_POST['__Filter_Semester'],
                        'Prodi'         => $_POST['__Filter_Prodi'],
                    ];
                    
                    // $__record_data__ = $this->__db->query(" SELECT Id_Rpl_Pendaftaran AS Id, Nomor_Rpl_Pendaftaran AS Nomor, Nama_Rpl_Pendaftaran AS Nama, Prodi_Rpl_Pendaftaran AS Prodi, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, TipeJenis_Rpl_Pendaftaran AS TipeJenis, Email_Rpl_Pendaftaran AS Email, PasswordEmail_Rpl_Pendaftaran AS Password FROM Tbl_Rpl_Pendaftaran WHERE Ta_Rpl_Pendaftaran = '". $__req_filter['Ta'] ."' AND Semester_Rpl_Pendaftaran = '". $__req_filter['Semester'] ."' AND Prodi_Rpl_Pendaftaran = '". $__req_filter['Prodi'] ."' AND Selesai = 'N' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND PasswordEmail_Rpl_Pendaftaran IS NULL AND Nomor_Rpl_Pendaftaran IS NULL AND Npm_Pumb IS NULL ORDER BY Id_Rpl_Pendaftaran DESC ");
                    $__record_data__ = $this->__db->query(" SELECT Id_Rpl_Pendaftaran AS Id, Nomor_Rpl_Pendaftaran AS Nomor, Nama_Rpl_Pendaftaran AS Nama, Prodi_Rpl_Pendaftaran AS Prodi, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, TipeJenis_Rpl_Pendaftaran AS TipeJenis, Email_Rpl_Pendaftaran AS Email, PasswordEmail_Rpl_Pendaftaran AS Password FROM Tbl_Rpl_Pendaftaran WHERE Ta_Rpl_Pendaftaran = '". $__req_filter['Ta'] ."' AND Semester_Rpl_Pendaftaran = '". $__req_filter['Semester'] ."' AND Prodi_Rpl_Pendaftaran = '". $__req_filter['Prodi'] ."' AND Selesai = 'N' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND PasswordEmail_Rpl_Pendaftaran IS NULL AND Nomor_Rpl_Pendaftaran IS NULL ORDER BY Id_Rpl_Pendaftaran DESC ");
                    
                }

                $__db = $this->__db;
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';
        }

        public function IndexAdmin_HapusPendaftaran_Hapus()
        {
            $__id = isset($_GET['__Id']) ? intval($_GET['__Id']) : 0;

            if ( $__id <= 0 ) {
                
                redirect(url('/homeadmin/rpl_hapuspendaftaran'), '03', 'ID Tidak Valid !');
                exit();
                
            }

            $__session = [
                'Data'                  => 'N',
                'User_Rpl_Pendaftaran'  => 'Hapus Pendaftaran',
                'Log_Rpl_Pendaftaran'   => date('Y-m-d H:i:s'),
                'Id_Rpl_Pendaftaran'    => $__id,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Pendaftaran SET
                                    Data                    = :Data,
                                    User_Rpl_Pendaftaran    = :User_Rpl_Pendaftaran, 
                                    Log_Rpl_Pendaftaran     = :Log_Rpl_Pendaftaran
                                WHERE Id_Rpl_Pendaftaran    = :Id_Rpl_Pendaftaran
                            "
                        ) -> execute ( $__session );;

                    $this->__db->commit();

                        redirect(url('/homeadmin/rpl_hapuspendaftaran'), '01', 'Berhasil Hapus Data');
                        exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect(url('/homeadmin/rpl_hapuspendaftaran'), '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }
    }