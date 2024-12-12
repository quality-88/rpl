<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    // require_once dirname(__DIR__) . '/../models/administrator/KeteranganDokumen.php';

    class HomeadminRplListmatakuliahController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        // protected $__KeteranganDokumenModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            // $this->__KeteranganDokumenModel = new __KeteranganDokumenModel($this->__db);
        }

        public function __Filter_Prodi()
        {
            $data = $this->__db->query(" SELECT Prodi AS Datas FROM Prodi WHERE ". $this->__universitas->__QueryNot_Universitas() ." Prodi LIKE '%UQB%' GROUP BY Prodi ORDER BY Prodi ASC ");

            return $data;
        }

        public function __Filter_Kurikulum()
        {
            $data = $this->__db->query(" SELECT Kurikulum AS Datas FROM Kurikulum WHERE Kurikulum >= '". date('Y')-7 ."' GROUP BY Kurikulum ORDER BY Kurikulum DESC ");

            return $data;
        }

        public function __Filter_Kampus()
        {
            $data = $this->__db->query(" SELECT IdKampus AS Id, Lokasi AS Datas FROM Kampus WHERE ". $this->__universitas->__QueryNot_Universitas() ." Lokasi LIKE '%UQB%' ORDER BY IdKampus ASC ");

            return $data;
        }

        public function __Filter_ListMatakuliah( $data )
        {
            $explode = $this->__helpers->__Explode_Data($data['Kampus']);
            
            $data = $this->__db->query(" SELECT IdPrimary AS Id, Kurikulum, IdKampus, IdFakultas, Prodi, IdMk, Sks, Semester, Ta, MkPilihan FROM ProdiMk WHERE Prodi = '". $data['Prodi'] ."' AND Kurikulum = '". $data['Kurikulum'] ."' AND IdKampus = '". $explode[0] ."' ORDER BY Semester ASC ");
            
            return $data;
        }

        public function __GetData_Count( $__status , $__data )
        {
            if ( $__status == 'SKS' ) {
                
                @$__query = "SUM( Sks ) AS Count";

            } elseif ( $__status == 'MATAKULIAH' ) {

                @$__query = "COUNT( IdMk ) AS Count";

            } elseif ( $__status == 'MAX SEMESTER' ) {

                @$__query = "MAX( Semester ) AS Count";

            } elseif ( $__status == 'MIN SEMESTER' ) {

                @$__query = "MIN( Semester ) AS Count";

            } elseif ( $__status == 'MAX SKS' ) {

                @$__query = "MAX( Sks ) AS Count";

            } elseif ( $__status == 'MIN SKS' ) {

                @$__query = "MIN( Sks ) AS Count";

            } 

            $explode = $this->__helpers->__Explode_Data($__data['Kampus']);

            $data = $this->__db->queryid(" SELECT ". $__query ." FROM ProdiMk WHERE Prodi = '". $__data['Prodi'] ."' AND Kurikulum = '". $__data['Kurikulum'] ."' AND IdKampus = '". $explode[0] ."' ");

            return $data->Count;
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
            return url('/homeadmin/rpl_listmatakuliah');
        }

        // public function __Routes_Mod_File__()
        // {
        //     return __Base_Url() . 'src/storages/__file/';
        // }
        
        public function IndexAdmin_Listmatakuliah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__rpl_listmatakuliah';

            // $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl                   = 'active';
            $__active_rpl_listmatakuliah    = 'active';

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

                $__filter_prodi__ = self::__Filter_Prodi();
                $__filter_kurikulum__ = self::__Filter_Kurikulum();
                $__filter_kampus__ = self::__Filter_Kampus();

                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $__req_filter = [
                        'Prodi'     => $_POST['__Filter_Prodi'],
                        'Kurikulum' => $_POST['__Filter_Kurikulum'],
                        'Kampus'    => $_POST['__Filter_Kampus'],
                    ];

                    $__explode_kampus = $this->__helpers->__Explode_Data($__req_filter['Kampus']);
                    $__record_data__ = self::__Filter_ListMatakuliah( $__req_filter );

                    $__nomor = '1';
                    $__record__data__ = [];
                    foreach ( $__record_data__ AS $data => $__record__ ) : 

                        $data_matakuliah = $this->__db->queryid(" SELECT TOP 1 IdPrimary AS Id, IdMk, Matakuliah, Semester, Sks, Tipe, Skripsi, ProdiMatakuliah, Pkl, Id_Mk AS IdMk_Feeder, Rpl FROM Matakuliah WHERE IdMk = '". $__record__->IdMk ."' ORDER BY IdMk DESC ");

                        $__record__data__[] = [
                            'Nomor'         => $__nomor++,
                            'IdMk'          => $data_matakuliah->IdMk,
                            'Matakuliah'    => $data_matakuliah->Matakuliah,
                            'Sks'           => $data_matakuliah->Sks,
                            'Ta'            => $__record__->Ta,
                            'Semester'      => $__record__->Semester,
                            'Rpl'           => $data_matakuliah->Rpl,
                        ];

                    endforeach;

                    $__total_sks            = self::__GetData_Count( 'SKS' , $__req_filter );
                    $__total_matakuliah     = self::__GetData_Count( 'MATAKULIAH' , $__req_filter );
                    $__total_minsem         = self::__GetData_Count( 'MIN SEMESTER' , $__req_filter );
                    $__total_maxmin         = self::__GetData_Count( 'MAX SEMESTER' , $__req_filter );
                    $__total_minsks         = self::__GetData_Count( 'MIN SKS' , $__req_filter );
                    $__total_maxsks         = self::__GetData_Count( 'MAX SKS' , $__req_filter );

                }
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_Keterangandokumen_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Judul'           => isset($data['__Judul']) ? stripslashes(strip_tags(htmlspecialchars($data['__Judul'], ENT_QUOTES))) : '',
                '__Format'          => isset($data['__Format']) ? stripslashes(strip_tags(htmlspecialchars($data['__Format'], ENT_QUOTES))) : '',
                '__Ukuran'          => isset($data['__Ukuran']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ukuran'], ENT_QUOTES))) : '',
                '__Isi'             => isset($data['__Isi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Isi'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Judul'           => $__clean_data['__Judul'],
                '__Format'          => $__clean_data['__Format'],
                '__Ukuran'          => $__clean_data['__Ukuran'],
                '__Isi'             => $__clean_data['__Isi'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    '__Judul'           => $this->__helpers->HurufBesar( $__clean_data['__Judul'] ),
                    '__Format'          => $this->__helpers->HurufBesar( $__clean_data['__Format'] ),
                    '__Ukuran'          => $__clean_data['__Ukuran'],
                    '__Isi'             => $__clean_data['__Isi'],
                    '__User'            => self::__Session__()['__Nama'],
                    '__Log'             => date('Y-m-d H:i:s'),
                    '__Kampus'          => __Aplikasi()['Kampus'],
                    '__Data'            => 'Y',
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__KeteranganDokumenModel->create( $__session );

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

        public function IndexAdmin_Keterangandokumen_Ubah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_keterangandokumen/ubah';

            // $__base_file    = self::__Routes_Mod_File__();

            $__active_setting                   = 'active';
            $__active_setting_keterangandokumen = 'active';

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

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE ) {

                    $__filter_formatfile__ = self::__Filter_FormatFile();
                    $__record_data__ = $this->__KeteranganDokumenModel->read( $this->__helpers->SecretOpen( $_GET['__Id'] ) );
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexAdmin_Keterangandokumen_Ubah_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Judul'           => isset($data['__Judul']) ? stripslashes(strip_tags(htmlspecialchars($data['__Judul'], ENT_QUOTES))) : '',
                '__Format'          => isset($data['__Format']) ? stripslashes(strip_tags(htmlspecialchars($data['__Format'], ENT_QUOTES))) : '',
                '__Ukuran'          => isset($data['__Ukuran']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ukuran'], ENT_QUOTES))) : '',
                '__Isi'             => isset($data['__Isi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Isi'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Judul'           => $__clean_data['__Judul'],
                '__Format'          => $__clean_data['__Format'],
                '__Ukuran'          => $__clean_data['__Ukuran'],
                '__Isi'             => $__clean_data['__Isi'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    '__Judul'       => $this->__helpers->HurufBesar( $__clean_data['__Judul'] ),
                    '__Format'      => $this->__helpers->HurufBesar( $__clean_data['__Format'] ),
                    '__Ukuran'      => $__clean_data['__Ukuran'],
                    '__Isi'         => $__clean_data['__Isi'],
                    '__User'        => self::__Session__()['__Nama'],
                    '__Log'         => date('Y-m-d H:i:s'),
                    '__Id'          => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__KeteranganDokumenModel->update( $__session );

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