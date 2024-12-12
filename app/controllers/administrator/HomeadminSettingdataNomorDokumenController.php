<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/administrator/NomorDokumen.php';

    class HomeadminSettingdataNomorDokumenController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__NomorDokumenModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__NomorDokumenModel = new __NomorDokumenModel($this->__db);
        }

        public function __Filter_FormatFile()
        {
            $data = array(
                'PDF'       => 'PDF',
                'GAMBAR'    => 'GAMBAR',
                'URL'       => 'URL',
            );

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
            return url('/homeadmin/settingdata_nomordokumen');
        }

        // public function __Routes_Mod_File__()
        // {
        //     return __Base_Url() . 'src/storages/__file/';
        // }
        
        public function IndexAdmin_NomorDokumen()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_nomordokumen';

            // $__base_file    = self::__Routes_Mod_File__();

            $__active_setting                   = 'active';
            $__active_setting_nomordokumen      = 'active';

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

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

                $__nomor__ = '1';
                $__record_data__ = $this->__NomorDokumenModel->read();
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_NomorDokumen_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'       => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'         => isset($data['__Url']) ? $data['__Url'] : '',
                '__Kode'        => isset($data['__Kode']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kode'], ENT_QUOTES))) : '',
                '__Nama'        => isset($data['__Nama']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nama'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Kode'        => $__clean_data['__Kode'],
                '__Nama'        => $__clean_data['__Nama'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__check_kode = $this->__db->queryrow(" SELECT Id_Rpl_Cms_NomorDokumen AS Id FROM Tbl_Rpl_Cms_NomorDokumen WHERE Kode_Rpl_Cms_NomorDokumen = '". $__clean_data['__Kode'] ."' ");

                if ( $__check_kode == TRUE ) {

                    return [
                        'Error'   => '999',
                        'Message' => 'Mohon Maaf Kode ' . $__clean_data['__Kode'] . ' !',
                        'Data'    => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__session = [
                    'Kode_Rpl_Cms_NomorDokumen'     => $this->__helpers->HurufBesar( $__clean_data['__Kode'] ),
                    'Nama_Rpl_Cms_NomorDokumen'     => $this->__helpers->HurufBesar( $__clean_data['__Nama'] ),
                    'User_Rpl_Cms_NomorDokumen'     => self::__Session__()['__Nama'],
                    'Log_Rpl_Cms_NomorDokumen'      => date('Y-m-d H:i:s'),
                    'IdKampus'                      => __Aplikasi()['IdKampus'],
                    'Kampus'                        => __Aplikasi()['Kampus'],
                    'Data'                          => 'Y',
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__NomorDokumenModel->create( $__session );

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

        public function IndexAdmin_NomorDokumen_Ubah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_nomordokumen/ubah';

            // $__base_file    = self::__Routes_Mod_File__();

            $__active_setting                   = 'active';
            $__active_setting_nomordokumen      = 'active';

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

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE ) {

                    $__record_data__ = $this->__NomorDokumenModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexAdmin_NomorDokumen_Ubah_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Kode'            => isset($data['__Kode']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kode'], ENT_QUOTES))) : '',
                '__Nama'            => isset($data['__Nama']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nama'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Kode'            => $__clean_data['__Kode'],
                '__Nama'            => $__clean_data['__Nama'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    'Kode_Rpl_Cms_NomorDokumen'         => $this->__helpers->HurufBesar( $__clean_data['__Kode'] ),
                    'Nama_Rpl_Cms_NomorDokumen'         => $this->__helpers->HurufBesar( $__clean_data['__Nama'] ),
                    'User_Rpl_Cms_NomorDokumen'         => self::__Session__()['__Nama'],
                    'Log_Rpl_Cms_NomorDokumen'          => date('Y-m-d H:i:s'),
                    'Id_Rpl_Cms_NomorDokumen'           => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                $__check_kode = $this->__db->queryrow(" SELECT Id_Rpl_Cms_NomorDokumen AS Id FROM Tbl_Rpl_Cms_NomorDokumen WHERE Kode_Rpl_Cms_NomorDokumen = '". $__clean_data['__Kode'] ."' AND NOT Id_Rpl_Cms_NomorDokumen = '". $__session['Id_Rpl_Cms_NomorDokumen'] ."' ");

                if ( $__check_kode == TRUE ) {

                    return [
                        'Error'   => '999',
                        'Message' => 'Mohon Maaf Kode ' . $__clean_data['__Kode'] . ' !',
                        'Data'    => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__NomorDokumenModel->update( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'] );
                                unset( $_SESSION['__Old__'] );
                                
                                $this->__db->commit();

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Berhasil Ubah Data !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url_Success'],
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

        public function IndexAdmin_InformasiFile_Hapus()
        {
            $fileId = isset($_GET['__Id']) ? intval($_GET['__Id']) : 0;

            if ( $fileId <= 0 ) {
                
                redirect(self::__Routes_Mod__(), '03', 'ID Tidak Valid !');
                exit();
                
            }

            $fileRecord = $this->__KeteranganDokumenModel->read( $fileId ); 

            if ( !$fileRecord ) {

                redirect(self::__Routes_Mod__(), '03', 'Data Tidak Ditemukan !');
                exit();
                
            }

            $__session = [
                '__Id' => $fileRecord->Id,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__query_result = $this->__KeteranganDokumenModel->delete( $__session );

                        if ( $__query_result['Error'] === '000' ) {

                            unset( $_SESSION['__Form_Notifikasi__'] );
                            unset( $_SESSION['__Old__'] );

                            // if ( file_exists($filePath) ) {
                                
                                unlink( 'src/storages/__file/' . $fileRecord->Files );
                                
                            // }
                            
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