<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/administrator/Prodi.php';

    class HomeadminSettingdataProdiController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__ProdiModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__ProdiModel = new __ProdiModel($this->__db);
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
            return url('/homeadmin/settingdata_prodi');
        }
        
        public function IndexAdmin_Prodi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_prodi';

            $__active_setting                   = 'active';
            $__active_setting_prodi             = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Akademik' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdNama_Akun_ELearning AS Id, Nama_Akun_ELearning AS Nama, LevelRole_Akun_ELearning AS Level FROM Tbl_Akun_ELearning WHERE IdNama_Akun_ELearning = '". $__session_login__['__Id'] ."' ORDER BY IdNama_Akun_ELearning DESC ");

                } 

                $__filter_prodi__ = self::__Filter_Prodi();
                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();

                $__record_data__ = $this->__ProdiModel->read();
                $__nomor = '1';
                $__record__data__ = [];
                foreach ( $__record_data__ AS $data => $__record__ ) : 

                    $__record__data__[] = [
                        'Nomor'             => $__nomor++,
                        'Id'                => $__record__->Id,
                        'TahunAjaran'       => $__record__->Ta . '/' . $__record__->Semester,
                        'Prodi'             => $__record__->Prodi,
                        'Status'            => 'TRANSFER ATAU/DAN PEROLEHAN',
                    ];

                endforeach;
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_Prodi_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Ta'              => isset($data['__Ta']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ta'], ENT_QUOTES))) : '',
                '__Semester'        => isset($data['__Semester']) ? stripslashes(strip_tags(htmlspecialchars($data['__Semester'], ENT_QUOTES))) : '',
                '__Prodi'           => isset($data['__Prodi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Prodi'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Ta'              => $__clean_data['__Ta'],
                '__Semester'        => $__clean_data['__Semester'],
                '__Prodi'           => $__clean_data['__Prodi'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    'Ta_Rpl_Prodi'              => $__clean_data['__Ta'],
                    'Semester_Rpl_Prodi'        => $__clean_data['__Semester'],
                    'Prodi_Rpl_Prodi'           => $__clean_data['__Prodi'],
                    'User_Rpl_Prodi'            => self::__Session__()['__Nama'],
                    'Log_Rpl_Prodi'             => date('Y-m-d H:i:s'),
                    'IdKampus'                  => __Aplikasi()['IdKampus'],
                    'Kampus'                    => __Aplikasi()['Kampus'],
                    'Data'                      => 'Y',
                ];

                $__rowprodi__ = $this->__db->queryid(" SELECT Id_Rpl_Prodi AS Id FROM Tbl_Rpl_Prodi WHERE Ta_Rpl_Prodi = '". $__session['Ta_Rpl_Prodi'] ."' AND Semester_Rpl_Prodi = '". $__session['Semester_Rpl_Prodi'] ."' AND Prodi_Rpl_Prodi = '". $__session['Prodi_Rpl_Prodi'] ."' ");

                if ( $__rowprodi__ == TRUE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Sudah Tersedia Pada Tahun Ajaran ' . $__session['Ta_Rpl_Prodi'] . '/' . $__session['Semester_Rpl_Prodi'] . ' Pada Prodi ' . $__session['Prodi_Rpl_Prodi'] . ' !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__ProdiModel->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'] );
                                unset( $_SESSION['__Old__'] );
                                
                                $this->__db->commit();

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Berhasil Simpan Data !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            } else {

                                $this->__db->rollback();
                                
                                return [
                                    'Error'   => '999',
                                    'Message' => 'Error Query',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        return [
                            'Error'   => '999',
                            'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                            'Data'    => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

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

        public function IndexAdmin_Prodi_Hapus()
        {
            $fileId = isset($_GET['__Id']) ? intval($_GET['__Id']) : 0;

            if ( $fileId <= 0 ) {
                
                redirect(self::__Routes_Mod__(), '03', 'ID Tidak Valid !');
                exit();
                
            }

            $fileRecord = $this->__ProdiModel->read( ['Id' => $_GET['__Id']] ); 

            if ( !$fileRecord ) {

                redirect(self::__Routes_Mod__(), '03', 'Data Tidak Ditemukan !');
                exit();
                
            }

            $__session = [
                'Id_Rpl_Prodi' => $fileRecord->Id,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__query_result = $this->__ProdiModel->delete( $__session );

                        if ( $__query_result['Error'] === '000' ) {

                            unset( $_SESSION['__Form_Notifikasi__'] );
                            unset( $_SESSION['__Old__'] );
                            
                            $this->__db->commit();

                            redirect(self::__Routes_Mod__(), '01', 'Berhasil Hapus Data');
                            exit();

                        } else {

                            $this->__db->rollback();

                            redirect(self::__Routes_Mod__(), '03', 'Error Query');
                            exit();

                        }

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect(self::__Routes_Mod__(), '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }
    }