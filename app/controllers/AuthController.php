<?php

    require_once __DIR__ . '/../helpers/__Helpers.php';

    class AuthController
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

        public function __Header()
        {
            return 'Login | ';
        }

        private function __GetData_Rpl__( $__email )
        {
            $__datas = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran AS Id, Email_Rpl_Pendaftaran AS Email, PasswordEmail_Rpl_Pendaftaran AS PasswordEmail FROM Tbl_Rpl_Pendaftaran WHERE Email_Rpl_Pendaftaran = '". $__email ."' AND Data = 'Y' AND Selesai = 'Y' AND PasswordEmail_Rpl_Pendaftaran <> '' ORDER BY Id_Rpl_Pendaftaran DESC ");

            return $__datas;
        }

        private function __GetData_Administrator__( $__username , $__password )
        {
            $__datas = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE Username = '". $__username ."' AND Password = '". $__password ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

            return $__datas;
        }

        private function __GetData_Keuangan__( $__username , $__password )
        {   
            $__datas = $this->__db->queryid(" SELECT TOP 1 A.Id, B.Nama_Akun_ELearning AS Nama, 'Keuangan' AS Level FROM InventoryId A LEFT JOIN Tbl_Akun_ELearning B ON A.Id = B.IdNama_Akun_ELearning WHERE B.Angka_Akun_ELearning = 'K-0201' AND A.UserId = '". $__username ."' AND A.Password = '". $__password ."' ORDER BY A.Id DESC ");

            return $__datas;
        }

        private function __GetData_Akademik__( $__username , $__password )
        {   
            $__datas = $this->__db->queryid(" SELECT TOP 1 A.Id, B.Nama_Akun_ELearning AS Nama, 'Akademik' AS Level FROM InventoryId A LEFT JOIN Tbl_Akun_ELearning B ON A.Id = B.IdNama_Akun_ELearning WHERE B.Angka_Akun_ELearning = 'K-0203' AND A.UserId = '". $__username ."' AND A.Password = '". $__password ."' ORDER BY A.Id DESC ");

            return $__datas;
        }

        private function __GetData_InventoryId__( $__username , $__password )
        {   
            $__datas = $this->__db->queryid(" SELECT TOP 1 A.Id, A.Keterangan AS Nama, 'Pegawai' AS Level FROM InventoryId A LEFT JOIN Tbl_Rpl_HakAkses B ON A.Id = B.IdUser_Rpl_HakAkses WHERE A.UserId = '". $__username ."' AND A.Password = '". $__password ."' ORDER BY A.Id DESC ");

            return $__datas;
        }

        public function IndexAdmin()
        {
            $__header       = 'Administrator | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__routes       = url('/admin');

            @require_once dirname(dirname(__DIR__)) . '/public/auth/admin/__data.php';
        }

        public function IndexAdminLogin( array $data )
        {
            $__clean_data = [
                '__Token'       => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'         => url('/admin'),
                '__Url_Success' => url('/homeadmin'),
                '__Username'    => isset($data['__Username']) ? stripslashes(strip_tags(htmlspecialchars($data['__Username'], ENT_QUOTES))) : '',
                '__Password'    => isset($data['__Password']) ? stripslashes(strip_tags(htmlspecialchars($data['__Password'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Username'    => $__clean_data['__Username'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( empty($__clean_data['__Username']) OR empty($__clean_data['__Password']) ) 
                {
                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Username Dan Password !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();
                }

                $__session = [
                    '__Username'    => $__clean_data['__Username'],
                    '__Password'    => $__clean_data['__Password'],
                ];

                $__data_administrator = self::__GetData_Administrator__( $__session['__Username'] , $__session['__Password'] );

                $__data_keuangan = self::__GetData_Keuangan__( $__session['__Username'] , $__session['__Password'] );

                $__data_akademik = self::__GetData_Akademik__( $__session['__Username'] , $__session['__Password'] );

                $__data_inventoryid = self::__GetData_InventoryId__( $__session['__Username'] , $__session['__Password'] );

                if ( $__data_administrator->Id == TRUE ) {

                    $_SESSION['__Administrator__'] = [
                        '__Id'      => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_administrator->Id . '|\|' . time() , 221 , 5 ),
                        '__Nama'    => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_administrator->Nama . '|\|' . time() , 221 , 5 ),
                        '__Level'   => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_administrator->Level . '|\|' . time() , 221 , 5 ),
                        '__Log'     => date('Y-m-d H:i:s'),
                    ];

                    return [
                        'Error'     => '000',
                        'Message'   => 'Berhasil Login Sebagai Administrator !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
                        ],
                    ];

                }

                if ( $__data_keuangan->Id == TRUE ) {

                    $_SESSION['__Administrator__'] = [
                        '__Id'      => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_keuangan->Id . '|\|' . time() , 221 , 5 ),
                        '__Nama'    => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_keuangan->Nama . '|\|' . time() , 221 , 5 ),
                        '__Level'   => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_keuangan->Level . '|\|' . time() , 221 , 5 ),
                        '__Log'     => date('Y-m-d H:i:s'),
                    ];

                    return [
                        'Error'     => '000',
                        'Message'   => 'Berhasil Login Sebagai Kepala Keuangan !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
                        ],
                    ];

                }

                if ( $__data_akademik->Id == TRUE ) {

                    $_SESSION['__Administrator__'] = [
                        '__Id'      => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_akademik->Id . '|\|' . time() , 221 , 5 ),
                        '__Nama'    => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_akademik->Nama . '|\|' . time() , 221 , 5 ),
                        '__Level'   => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_akademik->Level . '|\|' . time() , 221 , 5 ),
                        '__Log'     => date('Y-m-d H:i:s'),
                    ];

                    return [
                        'Error'     => '000',
                        'Message'   => 'Berhasil Login Sebagai Kepala Akademik !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
                        ],
                    ];

                }

                if ( $__data_inventoryid->Id == TRUE ) {

                    $_SESSION['__Administrator__'] = [
                        '__Id'      => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_inventoryid->Id . '|\|' . time() , 221 , 5 ),
                        '__Nama'    => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_inventoryid->Nama . '|\|' . time() , 221 , 5 ),
                        '__Level'   => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_inventoryid->Level . '|\|' . time() , 221 , 5 ),
                        '__Log'     => date('Y-m-d H:i:s'),
                    ];

                    return [
                        'Error'     => '000',
                        'Message'   => 'Berhasil Login Sebagai Inventory ID !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
                        ],
                    ];

                }

                    return [
                        'Error'     => '999',
                        'Message'   => 'Data Login Administrator Yang Di Input Tidak Terdaftar !',
                        'Data'      => [
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

        public function IndexLupapassword()
        {
            $__header       = 'Lupa Password | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__routes       = url('/auth/forget');

            @require_once dirname(dirname(__DIR__)) . '/public/auth/forget/__data.php';
        }

        public function IndexLupapasswordSimpan( array $data )
        {
            $__clean_data = [
                '__Token'       => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'         => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success' => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Email'       => isset($data['__Email']) ? stripslashes(strip_tags(htmlspecialchars($data['__Email'], ENT_QUOTES))) : '',
            ];
            
            $_SESSION['__Old__'] = [
                '__Email'      => $__clean_data['__Email'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    '__Email' => $__clean_data['__Email'],
                ];

                $__data_rpl = self::__GetData_Rpl__( $__session['__Email'] );

                if ( $__data_rpl->Id == FALSE ) {

                    return $result = [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Email Yang Di Input Tidak Pernah Terdaftar ' . $__session['__Email'] . ' !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 
                
                    unset($_SESSION['__Old__'], $_SESSION['__Post_Notifikasi__']);

                    return $result = [
                        'Error'     => '000',
                        'Message'   => 'Berhasil Verifikasi Lupa Password Login Dan Sudah Di Kirimkan Password Ke Email RPL Terdaftar ' . $__data_rpl->Email . ' - ' . $__data_rpl->PasswordEmail . ' !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
                        ]
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

        public function IndexLogout()
        {
            @$_SESSION = array();
            session_unset();
            session_destroy();
            
            session_start();
            $_SESSION['__Notifikasi'] = [
                'Error'     => '03',
                'Message'   => 'Berhasil Logout Dari Aplikasi !',
                'Data'      => [],
            ];

            header("Location: ". __Base_Url());
            exit();
        }

        private function __GetData_LoginRpl__( $__username , $__password )
        {
            $__datas = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran AS Id, Nama_Rpl_Pendaftaran AS Nama, Kampus FROM Tbl_Rpl_Pendaftaran WHERE Email_Rpl_Pendaftaran = '". $__username ."' AND PasswordEmail_Rpl_Pendaftaran = '". $__password ."' AND Data = 'Y' AND Selesai = 'Y' ORDER BY Id_Rpl_Pendaftaran DESC ");

            return $__datas;
        }

        public function IndexLoginProses( array $data )
        {
            $__clean_data = [
                '__Token'       => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'         => url('/login'),
                '__Url_Success' => url('/homerpl'),
                '__Email'       => isset($data['__Email']) ? stripslashes(strip_tags(htmlspecialchars($data['__Email'], ENT_QUOTES))) : '',
                '__Password'    => isset($data['__Password']) ? stripslashes(strip_tags(htmlspecialchars($data['__Password'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Email'    => $__clean_data['__Email'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( empty($__clean_data['__Email']) OR empty($__clean_data['__Password']) ) 
                {
                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Email Dan Password !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();
                }

                $__session = [
                    '__Email'       => $__clean_data['__Email'],
                    '__Password'    => $__clean_data['__Password'],
                ];

                $__data_login = self::__GetData_LoginRpl__( $__session['__Email'] , $__session['__Password'] );

                if ( empty($__data_login->Id) || !isset($__data_login->Id) ) 
                {
                    return [
                        'Error'     => '999',
                        'Message'   => 'Data Login Email Registrasi Calon RPL Yang Di Input Tidak Terdaftar !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();
                }

                if ( $__data_login->Kampus != __Aplikasi()['Kampus'] ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Lokasi Kamu Tidak Berada Di Kampus '. $this->__universitas->__Detail_Universitas()['Nama'] .' Harap Login Sesuai Universitas Kamu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $_SESSION['__Rpl__'] = [
                    '__Id'      => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_login->Id . '|\|' . time() , 221 , 5 ),
                    '__Nama'    => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_login->Nama . '|\|' . time() , 221 , 5 ),
                    '__Level'   => $this->__secret_key->Encrypt( date('sHis') . '|\|' . 'Rpl' . '|\|' . time() , 221 , 5 ),
                    '__Log'     => date('Y-m-d H:i:s'),
                ];
                return [
                    'Error'     => '000',
                    'Message'   => 'Berhasil Login Sebagai Calon Mahasiswa RPL !',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url_Success'],
                    ],
                ];

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

        public function IndexLoginDosen()
        {
            $__header       = 'Login Dosen | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;

            $__check_maintance__ = $this->__db->queryrow(" SELECT Id FROM Maintance WHERE App = '". __Aplikasi()['Aplikasi'] ."' AND Status = 'Y' ");

            if ( $__check_maintance__ == FALSE ) {

                @require_once dirname(dirname(__DIR__)) . '/public/auth/dosen/__data.php';

            } else {

                @require_once dirname(dirname(__DIR__)) . '/public/__maintance.php';

            }
        }

        public function IndexLoginDosenProses( array $data )
        {
            $__clean_data = [
                '__Token'       => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'         => url('/logindosen'),
                '__Url_Success' => url('/homedosen'),
                '__IdDosen'     => isset($data['__IdDosen']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosen'], ENT_QUOTES))) : '',
                '__Password'    => isset($data['__Password']) ? stripslashes(strip_tags(htmlspecialchars($data['__Password'], ENT_QUOTES))) : '',
            ];

            if ( $__clean_data['__Token'] == TRUE ) {

                $_SESSION['__Old__'] = [
                    '__IdDosen'     => $__clean_data['__IdDosen'],
                ];

                if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                    if ( empty($__clean_data['__IdDosen']) OR empty($__clean_data['__Password']) ) 
                    {
                        return [
                            'Error'     => '999',
                            'Message'   => 'Harap Mengisi ID Dosen Dan Password !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();
                    }

                    $__session = [
                        '__IdDosen'     => $__clean_data['__IdDosen'],
                        '__Password'    => $__clean_data['__Password'],
                    ];

                    $__data_login = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__session['__IdDosen'] ."' AND LoginPassword = '". $__session['__Password'] ."' ORDER BY IdDosen DESC ");

                    if ( empty($__data_login->Id) || !isset($__data_login->Id) ) 
                    {
                        return [
                            'Error'     => '999',
                            'Message'   => 'Data Login Dosen Yang Di Input Tidak Terdaftar !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();
                    }

                    $__check_asessor = $this->__db->queryrow(" SELECT Id_Rpl_KuotaAssesor AS Id FROM Tbl_Rpl_KuotaAssesor WHERE IdDosen_Rpl_KuotaAssesor = '". $__data_login->Id ."' AND Data = 'Y' ");

                    if ( $__check_asessor == FALSE ) 
                    {
                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf Kamu Tidak Terdaftar Sebagai Assesor !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();
                    }

                    $_SESSION['__Dosen__'] = [
                        '__Id'      => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_login->Id . '|\|' . time() , 221 , 5 ),
                        '__Nama'    => $this->__secret_key->Encrypt( date('sHis') . '|\|' . $__data_login->Nama . '|\|' . time() , 221 , 5 ),
                        '__Level'   => $this->__secret_key->Encrypt( date('sHis') . '|\|' . 'Dosen' . '|\|' . time() , 221 , 5 ),
                        '__Log'     => date('Y-m-d H:i:s'),
                    ];
                    return [
                        'Error'     => '000',
                        'Message'   => 'Berhasil Login Sebagai Dosen atau Assesor RPL !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
                        ],
                    ];

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

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Request Not Found !',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }
    }