<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/administrator/HonorAssesor.php';
    require_once dirname(__DIR__) . '/../models/BayarHonor.php';

    class HomeadminSettingdataHonorAssesorController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__HonorAssesorModel;
        protected $__BayarHonorModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__HonorAssesorModel = new __HonorAssesorModel($this->__db);
            $this->__BayarHonorModel = new __BayarHonorModel($this->__db);
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
            $data = $this->__db->query(" SELECT Prodi FROM Prodi WHERE ". $this->__universitas->__QueryNot_Universitas() ." Prodi LIKE '%UQB%' GROUP BY Prodi ORDER BY Prodi ASC ");

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
            return url('/homeadmin/settingdata_honorassesor');
        }

        public function IndexAdmin_HonorAssesor()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_honorassesor';

            $__active_setting                   = 'active';
            $__active_setting_honorassesor      = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Keuangan' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } 

                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();
                $__filter_prodi__ = self::__Filter_Prodi();

                
                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' OR $_GET['__Ta'] == TRUE AND $_GET['__Semester'] == TRUE AND $_GET['__Prodi'] == TRUE ) {

                    if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                        $__req_filter = [
                            'Prodi'     => $_POST['__Prodi'],
                            'Ta'        => $_POST['__Ta'],
                            'Semester'  => $_POST['__Semester'],
                        ];

                    } else{

                        $__req_filter = [
                            'Prodi'     => $_GET['__Prodi'],
                            'Ta'        => $_GET['__Ta'],
                            'Semester'  => $_GET['__Semester'],
                        ];

                    }

                    $__nomor__ = '1';
                    $__record_data__ = $this->__db->query(" SELECT IdDosen_Rpl_KuotaAssesor AS IdDosen FROM Tbl_Rpl_KuotaAssesor WHERE Ta_Rpl_KuotaAssesor = '". $__req_filter['Ta'] ."' AND Semester_Rpl_KuotaAssesor = '". $__req_filter['Semester'] ."' AND Prodi_Rpl_KuotaAssesor = '". $__req_filter['Prodi'] ."' GROUP BY IdDosen_Rpl_KuotaAssesor ORDER BY IdDosen_Rpl_KuotaAssesor ASC ");

                    $__db = $this->__db;

                }
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_HonorAssesor_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Ta'              => isset($data['__Ta']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ta'], ENT_QUOTES))) : '',
                '__Semester'        => isset($data['__Semester']) ? stripslashes(strip_tags(htmlspecialchars($data['__Semester'], ENT_QUOTES))) : '',
                '__Prodi'           => isset($data['__Prodi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Prodi'], ENT_QUOTES))) : '',
                '__Check'           => isset($data['__Check']) ? $data['__Check'] : '',
            ];

            // $_SESSION['__Old__'] = [
            //     '__Ta'              => $__clean_data['__Ta'],
            //     '__Semester'        => $__clean_data['__Semester'],
            //     '__Biaya'           => $__clean_data['__Biaya'],
            //     '__Tipe'            => $__clean_data['__Tipe'],
            // ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( !$__clean_data['__Ta'] OR !$__clean_data['__Semester'] OR !$__clean_data['__Prodi'] OR !$__clean_data['__Check'] ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Dengan Benar !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__jumlah = COUNT($__clean_data['__Check']);

                if ( $__jumlah == '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Harap Pilih Data Yang Mau Di Bayarkan !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                for ( $x = '0'; $x < $__jumlah; $x++ ) {

                    $__explode__ = explode('-',$__clean_data['__Check'][$x]);

                    $__session = [
                        'Id_Rpl_Pendaftaran'        => $__explode__[0],
                        'Id_Rpl_Assesor'            => $__explode__[1],
                        'Id_Rpl_Sk'                 => $__explode__[2],
                        'IdDosen'                   => $__explode__[3],
                        'Ta_Rpl_BayarHonor'         => $__clean_data['__Ta'],
                        'Semester_Rpl_BayarHonor'   => $__clean_data['__Semester'],
                        'Prodi_Rpl_BayarHonor'      => $__clean_data['__Prodi'],
                        'Nominal_Rpl_BayarHonor'    => $__explode__[4] + 0,
                        'User_Rpl_BayarHonor'       => self::__Session__()['__Nama'],
                        'Log_Rpl_BayarHonor'        => date('Y-m-d H:i:s'),
                        'IdKampus'                  => __Aplikasi()['IdKampus'],
                        'Kampus'                    => __Aplikasi()['Kampus'],
                        'Data'                      => 'Y',
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__query_result = $this->__BayarHonorModel->create( $__session );

                                if ( $__query_result['Error'] === '000' ) {

                                    unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );
                                    
                                    $this->__db->commit();

                                } else {

                                    $this->__db->rollback();
                                    
                                }

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                        }

                }

                return [
                    'Error'   => '000',
                    'Message' => 'Silahkan Cek Kembali Untuk Data Yang Sudah Di Bayarkan !',
                    'Data'    => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function IndexAdmin_HonorAssesor_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__assesor';

            $__active       = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Keuangan' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                }

                if ( $__authlogin__->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    $__nomor__ = '1';
                    $__record_data__ = $this->__db->query(" SELECT IdDosen_Rpl_KuotaAssesor AS IdDosen FROM Tbl_Rpl_KuotaAssesor WHERE Ta_Rpl_KuotaAssesor = '". $_GET['__Ta'] ."' AND Semester_Rpl_KuotaAssesor = '". $_GET['__Semester'] ."' AND Prodi_Rpl_KuotaAssesor = '". $_GET['__Prodi'] ."' GROUP BY IdDosen_Rpl_KuotaAssesor ORDER BY IdDosen_Rpl_KuotaAssesor ASC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__honor.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }

        public function IndexAdmin_HonorAssesor_Excel()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__assesor';

            $__active       = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Keuangan' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                }

                if ( $__authlogin__->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    $__nomor__ = '1';
                    $__record_data__ = $this->__db->query(" SELECT IdDosen_Rpl_KuotaAssesor AS IdDosen FROM Tbl_Rpl_KuotaAssesor WHERE Ta_Rpl_KuotaAssesor = '". $_GET['__Ta'] ."' AND Semester_Rpl_KuotaAssesor = '". $_GET['__Semester'] ."' AND Prodi_Rpl_KuotaAssesor = '". $_GET['__Prodi'] ."' GROUP BY IdDosen_Rpl_KuotaAssesor ORDER BY IdDosen_Rpl_KuotaAssesor ASC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__excel/__honor.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }
    }