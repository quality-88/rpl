<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/administrator/Assesor.php';

    class HomeadminSettingdataAssesorController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__AssesorModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__AssesorModel = new __AssesorModel($this->__db , $this->__universitas);
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

        public function __Filter_Dosen()
        {
            $data = $this->__db->query(" SELECT IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE Aktif = 'Y' AND ". $this->__universitas->__QueryNot_Universitas() ." ProdiTerdaftar LIKE '%UQB%' ORDER BY IdDosen ASC ");

            return $data;
        }

        public function __Filter_Prodi()
        {
            $data = $this->__db->query(" SELECT Prodi FROM Prodi WHERE ". $this->__universitas->__QueryNot_Universitas() ." Prodi LIKE '%UQB%' GROUP BY Prodi ORDER BY Prodi ASC ");

            return $data;
        }

        public function __Filter_Kuota()
        {
            $data = '25';

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
            return url('/homeadmin/settingdata_assesor');
        }
        
        public function IndexAdmin_Assesor()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_assesor';

            $__active_setting                   = 'active';
            $__active_setting_asesor            = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Pegawai' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.Id = '". $__session_login__['__Id'] ."' ORDER BY A.Id DESC ");
                    
                } 

                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();
                $__filter_dosen__ = self::__Filter_Dosen();
                $__filter_prodi__ = self::__Filter_Prodi();
                $__filter_kuota__ = self::__Filter_Kuota();

                $__record_data__ = $this->__AssesorModel->read();
                $__nomor = '1';
                $__record__data__ = [];
                foreach ( $__record_data__ AS $data => $__record__ ) : 

                    $__data_dosen__ = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp FROM Dosen WHERE IdDosen = '". $__record__->IdDosen ."' ORDER BY IdDosen DESC ");

                    $__sisa_kuota_1 = $this->__db->queryid(" SELECT COUNT( As1_Dosen_Rpl_Assesor ) AS Total FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $__data_dosen__->Id ."' AND As1_Ta_Rpl_Assesor = '". $__record__->Ta ."' AND As1_Semester_Rpl_Assesor = '". $__record__->Semester ."' AND As1_Prodi_Rpl_Assesor = '". $__record__->Prodi ."' ");

                    $__sisa_kuota_2 = $this->__db->queryid(" SELECT COUNT( As2_Dosen_Rpl_Assesor ) AS Total FROM Tbl_Rpl_Assesor WHERE As2_Dosen_Rpl_Assesor = '". $__data_dosen__->Id ."' AND As2_Ta_Rpl_Assesor = '". $__record__->Ta ."' AND As2_Semester_Rpl_Assesor = '". $__record__->Semester ."' AND As2_Prodi_Rpl_Assesor = '". $__record__->Prodi ."' ");

                    $__sisa_kuota_3 = $this->__db->queryid(" SELECT COUNT( As3_Dosen_Rpl_Assesor ) AS Total FROM Tbl_Rpl_Assesor WHERE As3_Dosen_Rpl_Assesor = '". $__data_dosen__->Id ."' AND As3_Ta_Rpl_Assesor = '". $__record__->Ta ."' AND As3_Semester_Rpl_Assesor = '". $__record__->Semester ."' AND As3_Prodi_Rpl_Assesor = '". $__record__->Prodi ."' ");

                    $__sisa_kuota__ = $__sisa_kuota_1->Total + $__sisa_kuota_2->Total + $__sisa_kuota_3->Total;

                    if ( $__sisa_kuota__ >= $__record__->Kuota ) {
                        $__status = 'Y';
                    } else {
                        $__status = 'N';
                    }

                    $__record__data__[] = [
                        'Nomor'             => $__nomor++,
                        'Id'                => $__record__->Id,
                        'TahunAjaran'       => $__record__->Ta . '/' . $__record__->Semester,
                        'IdDosen'           => $__data_dosen__->Id,
                        'NamaDosen'         => $__data_dosen__->Nama,
                        'Prodi'             => $__record__->Prodi,
                        'Kuotas'            => $__record__->Kuotas,
                        'Kuota'             => $__record__->Kuota,
                        'SisaKuota'         => $__sisa_kuota__,
                        'Email'             => $__data_dosen__->EmailDosen . ' / ' . $__data_dosen__->EmailPribadi,
                        'Hp'                => $__data_dosen__->Hp,
                        'Status'            => $__status,
                    ];

                endforeach;
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_Assesor_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Ta'              => isset($data['__Ta']) ? stripslashes(strip_tags(htmlspecialchars($data['__Ta'], ENT_QUOTES))) : '',
                '__Semester'        => isset($data['__Semester']) ? stripslashes(strip_tags(htmlspecialchars($data['__Semester'], ENT_QUOTES))) : '',
                '__Assesor'         => isset($data['__Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__Assesor'], ENT_QUOTES))) : '',
                '__Prodi'         => isset($data['__Prodi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Prodi'], ENT_QUOTES))) : '',
                '__Kuota'           => isset($data['__Kuota']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kuota'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Ta'              => $__clean_data['__Ta'],
                '__Semester'        => $__clean_data['__Semester'],
                '__Assesor'         => $__clean_data['__Assesor'],
                '__Prodi'           => $__clean_data['__Prodi'],
                '__Kuota'           => $__clean_data['__Kuota'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    '__Ta'              => $__clean_data['__Ta'],
                    '__Semester'        => $__clean_data['__Semester'],
                    '__Assesor'         => $__clean_data['__Assesor'],
                    '__Prodi'           => $__clean_data['__Prodi'],
                    '__Kuota'           => $__clean_data['__Kuota'],
                    '__Kuotas'          => $__clean_data['__Kuota'],
                    '__User'            => self::__Session__()['__Nama'],
                    '__Log'             => date('Y-m-d H:i:s'),
                    '__Kampus'          => __Aplikasi()['Kampus'],
                    '__Data'            => 'Y',
                ];

                $__row_assesor__ = $this->__db->queryid(" SELECT Id_Rpl_KuotaAssesor AS Id FROM Tbl_Rpl_KuotaAssesor WHERE Ta_Rpl_KuotaAssesor = '". $__session['__Ta'] ."' AND Semester_Rpl_KuotaAssesor = '". $__session['__Semester'] ."' AND IdDosen_Rpl_KuotaAssesor = '". $__session['__Assesor'] ."' AND Prodi_Rpl_KuotaAssesor = '". $__session['__Prodi'] ."' ");

                if ( $__row_assesor__ == TRUE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Sudah Tersedia Pada Tahun Ajaran ' . $__session['__Ta'] . '/' . $__session['__Semester'] . ' Pada Prodi ' . $__session['__Prodi'] . ' Untuk Asessor !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__AssesorModel->create( $__session );

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

        public function IndexAdmin_Assesor_Ubah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__settingdata_assesor/ubah';

            $__active_setting                   = 'active';
            $__active_setting_biayakonversi     = 'active';

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

                } elseif ( $__session_login__['__Level'] == 'Pegawai' ) {

                    $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.Id = '". $__session_login__['__Id'] ."' ORDER BY A.Id DESC ");
                    
                } 

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE ) {

                    $__filter_kuota__ = self::__Filter_Kuota();
                    $__record_data__ = $this->__AssesorModel->read( $this->__helpers->SecretOpen( $_GET['__Id'] ) );
                    $__data_dosen__ = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp FROM Dosen WHERE IdDosen = '". $__record_data__->IdDosen ."' ORDER BY IdDosen DESC ");
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexAdmin_Assesor_Ubah_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Kuota'           => isset($data['__Kuota']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kuota'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Kuota'           => $__clean_data['__Kuota'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    '__Kuota'       => $__clean_data['__Kuota'],
                    '__Kuotas'      => $__clean_data['__Kuota'],
                    '__User'        => self::__Session__()['__Nama'],
                    '__Log'         => date('Y-m-d H:i:s'),
                    '__Id'          => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__AssesorModel->update( $__session );

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
    }