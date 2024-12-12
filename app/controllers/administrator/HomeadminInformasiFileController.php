<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/administrator/InformasiFile.php';

    class HomeadminInformasiFileController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__InformasiFileModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__InformasiFileModel = new __InformasiFileModel($this->__db);
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
            return url('/homeadmin/informasi_file');
        }

        public function __Routes_Mod_File__()
        {
            return __Base_Url() . 'src/storages/__file/';
        }
        
        public function IndexAdmin_InformasiFile()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__informasi_file';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_informasi         = 'active';
            $__active_informasi_file    = 'active';

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

                $__record_data__ = $this->__InformasiFileModel->read();
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_InformasiFile_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Judul'           => isset($data['__Judul']) ? stripslashes(strip_tags(htmlspecialchars($data['__Judul'], ENT_QUOTES))) : '',
                '__File_Name'       => isset($_FILES['__File']['name']) ? $_FILES['__File']['name'] : '',
                '__File_Size'       => isset($_FILES['__File']['size']) ? $_FILES['__File']['size'] : '',
                '__File_Type'       => isset($_FILES['__File']['type']) ? $_FILES['__File']['type'] : '',
                '__File_Tmp'        => isset($_FILES['__File']['tmp_name']) ? $_FILES['__File']['tmp_name'] : '',
            ];

            $_SESSION['__Old__'] = [
                '__Judul'           => $__clean_data['__Judul'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__export_getdata_file = $this->__helpers->__GetData_File( 'file' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' );

                if ( $__export_getdata_file['__Error'] != '00' ) {

                    return $result = [
                        'Error'     => '999',
                        'Message'   => @$__export_getdata_file['__Message'],
                        'Data'      => [
                            'Url'   => @$__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__session = [
                    '__File'            => $__export_getdata_file['__Nama_File'],
                    '__Judul'           => $this->__helpers->HurufBesar( $__clean_data['__Judul'] ),
                    '__Format'          => $__export_getdata_file['__Format_File'],
                    '__Slugs'           => $this->__helpers->__Slugs( $__clean_data['__Judul'] ),
                    '__User'            => self::__Session__()['__Nama'],
                    '__Log'             => date('Y-m-d H:i:s'),
                    '__Kampus'          => __Aplikasi()['Kampus'],
                    '__Data'            => 'Y',
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__InformasiFileModel->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'] );
                                unset( $_SESSION['__Old__'] );

                                move_uploaded_file($__export_getdata_file['__Tmp_File'], $__export_getdata_file['__Path_File']);
                                
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

        public function IndexAdmin_InformasiFile_Hapus()
        {
            $fileId = isset($_GET['__Id']) ? intval($_GET['__Id']) : 0;

            if ( $fileId <= 0 ) {
                
                redirect(self::__Routes_Mod__(), '03', 'ID Tidak Valid !');
                exit();
                
            }

            $fileRecord = $this->__InformasiFileModel->read( $fileId ); 

            if ( !$fileRecord ) {

                redirect(self::__Routes_Mod__(), '03', 'Data Tidak Ditemukan !');
                exit();
                
            }

            $__session = [
                '__Id' => $fileRecord->Id,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__query_result = $this->__InformasiFileModel->delete( $__session );

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