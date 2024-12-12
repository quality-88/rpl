<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';

    class HomeadminSettingdataDiskonFullController
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

        public function IndexAdmin_DiskonFull()
        {
            $__header       = 'Diskon Full | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__settingdata_diskonfull';

            $__active_setting                   = 'active';
            $__active_setting_diskonfull        = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Keuangan' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } 

                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();
                
                $__nomor__ = '1';
                $__record_data__ = $this->__db->query(" SELECT Id_Rpl_FullDiskon AS Id, Ta_Rpl_FullDiskon AS Ta, Semester_Rpl_FullDiskon AS Semester, TglAwal_Rpl_FullDiskon AS TglAwal, TglAkhir_Rpl_FullDiskon AS TglAkhir, Nominal_Rpl_FullDiskon AS Nominal, User_Rpl_FullDiskon AS Users, Log_Rpl_FullDiskon AS Logs, Kampus FROM Tbl_Rpl_FullDiskon ORDER BY Id_Rpl_FullDiskon DESC ");
            
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';
        }

        public function IndexAdmin_DiskonFull_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Ta'              => isset($data['__Ta']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ta'], ENT_QUOTES))) : '',
                '__Semester'        => isset($data['__Semester']) ? stripslashes(strip_tags(htmlspecialchars($data['__Semester'], ENT_QUOTES))) : '',
                '__TglAwal'         => isset($data['__TglAwal']) ? stripslashes(strip_tags(htmlspecialchars($data['__TglAwal'], ENT_QUOTES))) : '',
                '__TglAkhir'        => isset($data['__TglAkhir']) ? stripslashes(strip_tags(htmlspecialchars($data['__TglAkhir'], ENT_QUOTES))) : '',
                '__Nominal'         => isset($data['__Nominal']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nominal'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Ta'              => $__clean_data['__Ta'],
                '__Semester'        => $__clean_data['__Semester'],
                '__TglAwal'         => $__clean_data['__TglAwal'],
                '__TglAkhir'        => $__clean_data['__TglAkhir'],
                '__Nominal'         => $__clean_data['__Nominal'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__TglAwal'] == $__clean_data['__TglAkhir'] ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Tanggal Mulai Tidak Boleh Sama Dari Tanggal Selesai !');
                    exit();

                }

                if ( $__clean_data['__TglAwal'] >= $__clean_data['__TglAkhir'] ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Tanggal Mulai Tidak Boleh Lebih Maju Dari Tanggal Selesai !');
                    exit();

                }

                if ( $__clean_data['__Nominal'] == '0' ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Nominal Diskon Tidak Boleh Tidak Di Isikan !');
                    exit();

                }

                $__row_biaya__ = $this->__db->queryrow(" SELECT Id_Rpl_FullDiskon AS Id FROM Tbl_Rpl_FullDiskon WHERE Ta_Rpl_FullDiskon = '". $__clean_data['__Ta'] ."' AND Semester_Rpl_FullDiskon = '". $__clean_data['__Semester'] ."' ");

                if ( $__row_biaya__ == TRUE ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Data Sudah Tersedia Pada Tahun Ajaran ' . $__clean_data['__Ta'] . '/' . $__clean_data['__Semester'] . ' !');
                    exit();

                }

                $__session = [
                    'Ta_Rpl_FullDiskon'         => $__clean_data['__Ta'],
                    'Semester_Rpl_FullDiskon'   => $__clean_data['__Semester'],
                    'TglAwal_Rpl_FullDiskon'    => $__clean_data['__TglAwal'],
                    'TglAkhir_Rpl_FullDiskon'   => $__clean_data['__TglAkhir'],
                    'Nominal_Rpl_FullDiskon'    => $__clean_data['__Nominal'],
                    'User_Rpl_FullDiskon'       => self::__Session__()['__Nama'],
                    'Log_Rpl_FullDiskon'        => date('Y-m-d H:i:s'),
                    'Kampus'                    => __Aplikasi()['Kampus'],
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql = $this->__db->prepare( 
                                "
                                    INSERT INTO Tbl_Rpl_FullDiskon
                                    (
                                        Ta_Rpl_FullDiskon, Semester_Rpl_FullDiskon, TglAwal_Rpl_FullDiskon, TglAkhir_Rpl_FullDiskon, Nominal_Rpl_FullDiskon, User_Rpl_FullDiskon, Log_Rpl_FullDiskon, Kampus
                                    )
                                    VALUES
                                    (
                                        :Ta_Rpl_FullDiskon, :Semester_Rpl_FullDiskon, :TglAwal_Rpl_FullDiskon, :TglAkhir_Rpl_FullDiskon, :Nominal_Rpl_FullDiskon, :User_Rpl_FullDiskon, :Log_Rpl_FullDiskon, :Kampus
                                    )
                                "
                            ) -> execute ( $__session );

                            unset( $_SESSION['__Form_Notifikasi__'] , $_SESSION['__Old__'] );
                            
                        $this->__db->commit();

                            redirect($__clean_data['__Url'], '01', 'Berhasil Simpan Data');
                            exit();

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                        exit();

                    }

            } else {

                redirect($__clean_data['__Url'], '03', 'Token Tidak Sama Antara Tanggal dan Jam !');
                exit();

            }
        }

        public function IndexAdmin_DiskonFull_Ubah()
        {
            $__header       = 'Diskon Full | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__settingdata_diskonfull_ubah';

            $__active_setting                   = 'active';
            $__active_setting_diskonfull        = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Keuangan' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } 

                if ( !isset($_GET['__Id']) ) {

                    redirect(url('/homeadmin/settingdata_diskonfull'), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                } 
                    
                    $__record_data__ = $this->__db->queryid(" SELECT Id_Rpl_FullDiskon AS Id, Ta_Rpl_FullDiskon AS Ta, Semester_Rpl_FullDiskon AS Semester, TglAwal_Rpl_FullDiskon AS TglAwal, TglAkhir_Rpl_FullDiskon AS TglAkhir, Nominal_Rpl_FullDiskon AS Nominal, User_Rpl_FullDiskon AS Users, Log_Rpl_FullDiskon AS Logs, Kampus FROM Tbl_Rpl_FullDiskon WHERE Id_Rpl_FullDiskon = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ORDER BY Id_Rpl_FullDiskon DESC ");
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';
        }

        public function IndexAdmin_DiskonFull_Ubah_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Ta'              => isset($data['__Ta']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ta'], ENT_QUOTES))) : '',
                '__Semester'        => isset($data['__Semester']) ? stripslashes(strip_tags(htmlspecialchars($data['__Semester'], ENT_QUOTES))) : '',
                '__TglAwal'         => isset($data['__TglAwal']) ? stripslashes(strip_tags(htmlspecialchars($data['__TglAwal'], ENT_QUOTES))) : '',
                '__TglAkhir'        => isset($data['__TglAkhir']) ? stripslashes(strip_tags(htmlspecialchars($data['__TglAkhir'], ENT_QUOTES))) : '',
                '__Nominal'         => isset($data['__Nominal']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nominal'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Ta'              => $__clean_data['__Ta'],
                '__Semester'        => $__clean_data['__Semester'],
                '__TglAwal'         => $__clean_data['__TglAwal'],
                '__TglAkhir'        => $__clean_data['__TglAkhir'],
                '__Nominal'         => $__clean_data['__Nominal'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__TglAwal'] == $__clean_data['__TglAkhir'] ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Tanggal Mulai Tidak Boleh Sama Dari Tanggal Selesai !');
                    exit();

                }

                if ( $__clean_data['__TglAwal'] >= $__clean_data['__TglAkhir'] ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Tanggal Mulai Tidak Boleh Lebih Maju Dari Tanggal Selesai !');
                    exit();

                }

                if ( $__clean_data['__Nominal'] == '0' ) {

                    redirect($__clean_data['__Url'], '03', 'Mohon Maaf Nominal Diskon Tidak Boleh Tidak Di Isikan !');
                    exit();

                }

                $__session = [
                    'TglAkhir_Rpl_FullDiskon'   => $__clean_data['__TglAkhir'],
                    'Nominal_Rpl_FullDiskon'    => $__clean_data['__Nominal'],
                    'User_Rpl_FullDiskon'       => self::__Session__()['__Nama'],
                    'Log_Rpl_FullDiskon'        => date('Y-m-d H:i:s'),
                    'Id_Rpl_FullDiskon'         => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_FullDiskon SET
                                        TglAkhir_Rpl_FullDiskon      = :TglAkhir_Rpl_FullDiskon,
                                        Nominal_Rpl_FullDiskon       = :Nominal_Rpl_FullDiskon,
                                        User_Rpl_FullDiskon          = :User_Rpl_FullDiskon, 
                                        Log_Rpl_FullDiskon           = :Log_Rpl_FullDiskon
                                    WHERE Id_Rpl_FullDiskon          = :Id_Rpl_FullDiskon
                                "
                            ) -> execute ( $__session );

                            unset( $_SESSION['__Form_Notifikasi__'] , $_SESSION['__Old__'] );
                            
                        $this->__db->commit();

                            redirect($__clean_data['__Url_Success'], '02', 'Berhasil Ubah Data');
                            exit();

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                        exit();

                    }

            } else {

                redirect($__clean_data['__Url'], '03', 'Token Tidak Sama Antara Tanggal dan Jam !');
                exit();

            }
        }
    }