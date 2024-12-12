<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor2.php';
    require_once dirname(__DIR__) . '/../models/dosen/Sk.php';

    class HomerplBerkasController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__Assesor2Model;
        protected $__SkModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__Assesor2Model = new __Assesor2Model($this->__db);
            $this->__SkModel = new __SkModel($this->__db);
        }

        public function __Header()
        {
            return 'RPL | ';
        }
        
        public function __Routes_Mod__()
        {
            return url('/homerpl/berkas');
        }

        public function IndexRpl_Berkas()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = $this->__Routes_Mod__();
            $__content      = '__ubah/berkas';

            $__active       = 'active';

            if ( !isset($_SESSION['__Rpl__']) ) {

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

                $__result_sessionlogin = $this->__SessionController->__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $__session_login__['__Id'] );
                $__authlogin_berkas__ = $this->__SessionController->__Data_Rpl_Berkas__( $__session_login__['__Id'] );

                $__check_assesor_1__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND As1_Status_Rpl_Assesor = 'Y' ");

                if ( $__check_assesor_1__ == TRUE ) {

                    redirect($__routes, '03', 'Mohon Maaf Untuk Lengkapi Data Berkas Di Tolak, Karena Assesor Telah Validasi');
                    exit();

                }

                $__url_file = $this->__SessionController->__Url_File__();
                $__url_file_penunjang = $this->__SessionController->__Url_File_Penunjang__();

                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function IndexRpl_Berkas_Ktp( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__File_Name'       => isset($_FILES['__Ktp']['name']) ? $_FILES['__Ktp']['name'] : '',
                '__File_Size'       => isset($_FILES['__Ktp']['size']) ? $_FILES['__Ktp']['size'] : '',
                '__File_Type'       => isset($_FILES['__Ktp']['type']) ? $_FILES['__Ktp']['type'] : '',
                '__File_Tmp'        => isset($_FILES['__Ktp']['tmp_name']) ? $_FILES['__Ktp']['tmp_name'] : '',
            ];

            if ( $__clean_data['__Id'] == FALSE OR $__clean_data['__File_Name'] == FALSE ) {

                return [
                    'Error'   => '999',
                    'Message' => 'Pengisian Tidak Boleh Kosong',
                    'Data'    => [
                        'Url'   => @$__clean_data['__Url'],
                    ],
                ];

            }

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__export_getdata_file = $this->__helpers->__GetData_File( 'berkas' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' , ['Nama' => '__KTP'] );

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

                $url = $this->__SessionController->__Url_Curl__();

                $cFile = new CURLFile($__export_getdata_file['__Tmp_File'], $__clean_data['__File_Type'], $__export_getdata_file['__Nama_File']);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $cFile]);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                if ( curl_errno($ch) ) {
                    
                    return $result = [
                        'Error'     => '999',
                        'Message'   => curl_error($ch),
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 

                curl_close($ch);

                $__session = [
                    'FileKtp_Rpl_Pendaftaran'       => $__export_getdata_file['__Nama_File'],
                    'FormatKtp_Rpl_Pendaftaran'     => $__export_getdata_file['__Format_File'],
                    'Log_Rpl_Pendaftaran'           => date('Y-m-d H:i:s'),
                    'Id_Rpl_Pendaftaran'            => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql = $this->__db -> prepare( 
                                "
                                    UPDATE Tbl_Rpl_Pendaftaran SET
                                        FileKtp_Rpl_Pendaftaran         = :FileKtp_Rpl_Pendaftaran,
                                        FormatKtp_Rpl_Pendaftaran       = :FormatKtp_Rpl_Pendaftaran,
                                        Log_Rpl_Pendaftaran             = :Log_Rpl_Pendaftaran
                                    WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                "
                            ) -> execute ( $__session );

                        $this->__db->commit();

                            unset($_SESSION['__Old__'], $_SESSION['__Post_Notifikasi__']);

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => @$__clean_data['__Url_Success'],
                                ],
                            ];

                    } catch ( Exception $error ) {

                        $this->__db->rollBack();

                        return [
                            'Error'   => '999',
                            'Message' => 'Error: ' . $error,
                            'Data'    => [
                                'Url'   => @$__clean_data['__Url'],
                            ],
                        ];
                        
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

        public function IndexRpl_Berkas_Kk( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__File_Name'       => isset($_FILES['__Kk']['name']) ? $_FILES['__Kk']['name'] : '',
                '__File_Size'       => isset($_FILES['__Kk']['size']) ? $_FILES['__Kk']['size'] : '',
                '__File_Type'       => isset($_FILES['__Kk']['type']) ? $_FILES['__Kk']['type'] : '',
                '__File_Tmp'        => isset($_FILES['__Kk']['tmp_name']) ? $_FILES['__Kk']['tmp_name'] : '',
            ];

            if ( $__clean_data['__Id'] == FALSE OR $__clean_data['__File_Name'] == FALSE ) {

                return [
                    'Error'   => '999',
                    'Message' => 'Pengisian Tidak Boleh Kosong',
                    'Data'    => [
                        'Url'   => @$__clean_data['__Url'],
                    ],
                ];

            }

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__export_getdata_file = $this->__helpers->__GetData_File( 'berkas' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' , ['Nama' => '__KK'] );

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

                $url = $this->__SessionController->__Url_Curl__();

                $cFile = new CURLFile($__export_getdata_file['__Tmp_File'], $__clean_data['__File_Type'], $__export_getdata_file['__Nama_File']);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $cFile]);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                if ( curl_errno($ch) ) {
                    
                    return $result = [
                        'Error'     => '999',
                        'Message'   => curl_error($ch),
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 

                curl_close($ch);

                $__session = [
                    'FileKk_Rpl_Pendaftaran'        => $__export_getdata_file['__Nama_File'],
                    'FormatKk_Rpl_Pendaftaran'      => $__export_getdata_file['__Format_File'],
                    'Log_Rpl_Pendaftaran'           => date('Y-m-d H:i:s'),
                    'Id_Rpl_Pendaftaran'            => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql = $this->__db -> prepare( 
                                "
                                    UPDATE Tbl_Rpl_Pendaftaran SET
                                        FileKk_Rpl_Pendaftaran          = :FileKk_Rpl_Pendaftaran,
                                        FormatKk_Rpl_Pendaftaran        = :FormatKk_Rpl_Pendaftaran,
                                        Log_Rpl_Pendaftaran             = :Log_Rpl_Pendaftaran
                                    WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                "
                            ) -> execute ( $__session );

                        $this->__db->commit();

                            unset($_SESSION['__Old__'], $_SESSION['__Post_Notifikasi__']);

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => @$__clean_data['__Url_Success'],
                                ],
                            ];

                    } catch ( Exception $error ) {

                        $this->__db->rollBack();

                        return [
                            'Error'   => '999',
                            'Message' => 'Error: ' . $error,
                            'Data'    => [
                                'Url'   => @$__clean_data['__Url'],
                            ],
                        ];
                        
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

        public function IndexRpl_Berkas_Nilai( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__File_Name'       => isset($_FILES['__Nilai']['name']) ? $_FILES['__Nilai']['name'] : '',
                '__File_Size'       => isset($_FILES['__Nilai']['size']) ? $_FILES['__Nilai']['size'] : '',
                '__File_Type'       => isset($_FILES['__Nilai']['type']) ? $_FILES['__Nilai']['type'] : '',
                '__File_Tmp'        => isset($_FILES['__Nilai']['tmp_name']) ? $_FILES['__Nilai']['tmp_name'] : '',
            ];

            if ( $__clean_data['__Id'] == FALSE OR $__clean_data['__File_Name'] == FALSE ) {

                return [
                    'Error'   => '999',
                    'Message' => 'Pengisian Tidak Boleh Kosong',
                    'Data'    => [
                        'Url'   => @$__clean_data['__Url'],
                    ],
                ];

            }

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__export_getdata_file = $this->__helpers->__GetData_File( 'berkas' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' , ['Nama' => '__Transkip_Nilai'] );

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

                $url = $this->__SessionController->__Url_Curl__();

                $cFile = new CURLFile($__export_getdata_file['__Tmp_File'], $__clean_data['__File_Type'], $__export_getdata_file['__Nama_File']);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $cFile]);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                if ( curl_errno($ch) ) {
                    
                    return $result = [
                        'Error'     => '999',
                        'Message'   => curl_error($ch),
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 

                curl_close($ch);

                $__session = [
                    'FileNilai_Rpl_Pendaftaran'     => $__export_getdata_file['__Nama_File'],
                    'FormatNilai_Rpl_Pendaftaran'   => $__export_getdata_file['__Format_File'],
                    'Log_Rpl_Pendaftaran'           => date('Y-m-d H:i:s'),
                    'Id_Rpl_Pendaftaran'            => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql = $this->__db -> prepare( 
                                "
                                    UPDATE Tbl_Rpl_Pendaftaran SET
                                        FileNilai_Rpl_Pendaftaran       = :FileNilai_Rpl_Pendaftaran,
                                        FormatNilai_Rpl_Pendaftaran     = :FormatNilai_Rpl_Pendaftaran,
                                        Log_Rpl_Pendaftaran             = :Log_Rpl_Pendaftaran
                                    WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                "
                            ) -> execute ( $__session );

                        $this->__db->commit();

                            unset($_SESSION['__Old__'], $_SESSION['__Post_Notifikasi__']);

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => @$__clean_data['__Url_Success'],
                                ],
                            ];

                    } catch ( Exception $error ) {

                        $this->__db->rollBack();

                        return [
                            'Error'   => '999',
                            'Message' => 'Error: ' . $error,
                            'Data'    => [
                                'Url'   => @$__clean_data['__Url'],
                            ],
                        ];
                        
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

        public function IndexRpl_Berkas_2()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = $this->__Routes_Mod__() . '/2';
            $__content      = '__ubah/berkas/2';

            $__active       = 'active';

            if ( !isset($_SESSION['__Rpl__']) ) {

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

                $__result_sessionlogin = $this->__SessionController->__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $__session_login__['__Id'] );
                $__authlogin_berkas__ = $this->__SessionController->__Data_Rpl_Berkas__( $__session_login__['__Id'] );

                $__check_assesor_1__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND As1_Status_Rpl_Assesor = 'Y' ");

                if ( $__check_assesor_1__ == TRUE ) {

                    redirect($__routes, '03', 'Mohon Maaf Untuk Lengkapi Data Berkas Di Tolak, Karena Assesor Telah Validasi');
                    exit();

                }

                $__url_file = $this->__SessionController->__Url_File__();
                $__url_file_penunjang = $this->__SessionController->__Url_File_Penunjang__();

                $__data_keterangandokumen__ = $this->__db->query(" SELECT Id_Rpl_Cms_KeteranganDokumen AS Id, Judul_Rpl_Cms_KeteranganDokumen AS Judul, Format_Rpl_Cms_KeteranganDokumen AS Format, Ukuran_Rpl_Cms_KeteranganDokumen AS Ukuran, Isi_Rpl_Cms_KeteranganDokumen AS Isi, User_Rpl_Cms_KeteranganDokumen AS Users, Log_Rpl_Cms_KeteranganDokumen AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_Cms_KeteranganDokumen ORDER BY Id_Rpl_Cms_KeteranganDokumen ASC ");

                $__routes_mod_back   = $this->__Routes_Mod__();
                $__db = $this->__db;

                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function __CheckFile_Cms__( array $data )
        {
            $__uploads_file_media          = dirname(dirname(dirname(__DIR__))) . '/src/storages/__berkas_rpl_penunjang/';

            $__nama_file_media             = explode('.', $data['F_Name']);
            $__ekstensi_file_media         = strtolower(end($__nama_file_media));

            if ( $this->__helpers->HurufBesar( $data['Format'] ) == 'GAMBAR' ) {
                $__extensions_file_media       = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
            } elseif ( $this->__helpers->HurufBesar( $data['Format'] ) == 'PDF' ) {
                $__extensions_file_media       = array('pdf', 'PDF');
            } else {
                $__extensions_file_media       = array('');
            }

            $__nama_baru_file              = "__" . date('dmYHis') . "_" . rand(0,9999) . "." . $__ekstensi_file_media;
            $__path_file_file_media        = $__uploads_file_media . $__nama_baru_file;

            $__extension_file_media       = array_pop($__nama_file_media);
            $__file_explode_ekstensi      = explode("/", $data['F_Type']);

            if ( $__file_explode_ekstensi[1] == 'pdf' OR $__file_explode_ekstensi[1] == 'PDF' ) {
                $__hasil_ekstensi_file     = 'PDF';
            } elseif ( $__file_explode_ekstensi[1] == 'jpg' OR $__file_explode_ekstensi[1] == 'JPG' ) {
                $__hasil_ekstensi_file     = 'JPG';
            } elseif ( $__file_explode_ekstensi[1] == 'jpeg' OR $__file_explode_ekstensi[1] == 'JPEG' ) {
                $__hasil_ekstensi_file     = 'JPEG';
            } elseif ( $__file_explode_ekstensi[1] == 'png' OR $__file_explode_ekstensi[1] == 'PNG' ) {
                $__hasil_ekstensi_file     = 'PNG';
            } else {
                $__hasil_ekstensi_file     = 'Tidak Dapat Ekstensi';
            }

            
            if ( $__hasil_ekstensi_file == 'Tidak Dapat Ekstensi' OR !in_array($__extension_file_media, $__extensions_file_media) ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Format Wajib ' . $this->__helpers->HurufBesar( $data['Format'] ) . ' !',
                    'Data'      => [],
                ];

            }


            if ( $data['Ukuran'] > $data['F_Size'] . '000000' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Ukuran File Tidak Boleh Lebih Dari '. $data['F_Size'] .' MB !',
                    'Data'      => [],
                ];

            }


            if ( isset($__unlink) AND $__unlink == TRUE ) {

                @unlink('../../src/storages/__berkas_rpl_penunjang/' . @$__unlink);

            }

            return [
                'Error'     => '000',
                'Message'   => 'Sukses !',
                'Data'      => [
                    'Nama'  => $__nama_baru_file,
                    'File'  => $__path_file_file_media,
                    'Format'=> $__ekstensi_file_media,
                    'Tmp'   => $data['F_Tmp'],
                ],
            ];
        }

        public function __Masa_Studi__( array $data ) 
        {
            $__pengalaman   = $data['Pengalaman'] ?? '';
            $__pendidikan   = $data['Pendidikan'] ?? '';
            $__dokumen      = $data['Dokumen'] ?? '0';

            $lookupTable = [
                'S1' => [
                    'TIDAK BEKERJA' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 3],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 3],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 4],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA LEBIH DARI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 3],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 3],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 4],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA 2 SAMPAI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 3],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 3],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 4],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA KURANG DARI 2 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 3],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 3],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 4],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                ],
                'D3' => [
                    'TIDAK BEKERJA' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 4],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 4],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 5],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA LEBIH DARI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 4],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 4],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 5],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA 2 SAMPAI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 4],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 4],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 5],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA KURANG DARI 2 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 4],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 4],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 5],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                ],
                'D2' => [
                    'TIDAK BEKERJA' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA LEBIH DARI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA 2 SAMPAI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA KURANG DARI 2 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                ],
                'D1' => [
                    'TIDAK BEKERJA' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA LEBIH DARI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA 2 SAMPAI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA KURANG DARI 2 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 6],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                ],
                'SMA/SEDERAJAT' => [
                    'TIDAK BEKERJA' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 6],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 7],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 8],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA LEBIH DARI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 4],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 5],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 7],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA 2 SAMPAI 5 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 5],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 6],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 7],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                    'MASA KERJA KURANG DARI 2 TAHUN' => [
                        8 => ['Kategori' => 'LENGKAP', 'Studi' => 6],
                        4 => ['Kategori' => 'KURANG LENGKAP', 'Studi' => 7],
                        2 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 8],
                        0 => ['Kategori' => 'TIDAK LENGKAP', 'Studi' => 0],
                    ],
                ],
            ];
            
            if ( isset($lookupTable[$__pendidikan][$__pengalaman]) ) {
                $experienceData = $lookupTable[$__pendidikan][$__pengalaman];
                
                $closestMatch = null;
                foreach ($experienceData as $key_pendidikan => $value) {
                    if ($__dokumen >= $key_pendidikan) {
                        $closestMatch = $value;
                    // } else {
                        break;
                    }
                }
        
                $result = $closestMatch ?? ['Kategori' => 'TIDAK ADA', 'Studi' => 0];
            } else {
                $result = ['Kategori' => 'TIDAK ADA', 'Studi' => 0];
            }

            return [
                'Pengalaman'    => $__pengalaman,
                'Pendidikan'    => $__pendidikan,
                'Dokumen'       => $__dokumen,
                'Kategori'      => $result['Kategori'],
                'Studi'         => $result['Studi'],
            ];
        }

        public function IndexRpl_Berkas_2_Pendukung( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__IdBerkas'        => isset($data['__IdBerkas']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdBerkas'], ENT_QUOTES))) : '',
                '__IdUpload'        => isset($data['__IdUpload']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdUpload'], ENT_QUOTES))) : '',
                '__File_Name'       => isset($_FILES['__File']['name']) ? $_FILES['__File']['name'] : '',
                '__File_Size'       => isset($_FILES['__File']['size']) ? $_FILES['__File']['size'] : '',
                '__File_Type'       => isset($_FILES['__File']['type']) ? $_FILES['__File']['type'] : '',
                '__File_Tmp'        => isset($_FILES['__File']['tmp_name']) ? $_FILES['__File']['tmp_name'] : '',
            ];

            if ( $__clean_data['__Id'] == FALSE OR $__clean_data['__IdBerkas'] == FALSE OR $__clean_data['__File_Name'] == FALSE ) {

                return [
                    'Error'   => '999',
                    'Message' => 'Pengisian Tidak Boleh Kosong',
                    'Data'    => [
                        'Url'   => @$__clean_data['__Url'],
                    ],
                ];

            }

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__Id'] ) );

                if ( !$__authlogin__->Id ) {

                    return [
                        'Error'   => '999',
                        'Message' => 'Data RPL Pendaftaran Tidak Ada',
                        'Data'    => [
                            'Url'   => @$__clean_data['__Url'],
                        ],
                    ];

                }

                $__data_berkas__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_KeteranganDokumen AS Id, Judul_Rpl_Cms_KeteranganDokumen AS Judul, Format_Rpl_Cms_KeteranganDokumen AS Format, Ukuran_Rpl_Cms_KeteranganDokumen AS Ukuran, Isi_Rpl_Cms_KeteranganDokumen AS Isi, User_Rpl_Cms_KeteranganDokumen AS Users, Log_Rpl_Cms_KeteranganDokumen AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_Cms_KeteranganDokumen WHERE Id_Rpl_Cms_KeteranganDokumen = '". $this->__helpers->SecretOpen( $__clean_data['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Cms_KeteranganDokumen ASC ");

                if ( !$__data_berkas__->Id ) {

                    return [
                        'Error'   => '999',
                        'Message' => 'Data CMS Keterangan Dokumen Tidak Ada',
                        'Data'    => [
                            'Url'   => @$__clean_data['__Url'],
                        ],
                    ];

                }

                $__export_getdata_file = $this->__CheckFile_Cms__([
                    'F_Name'    => $__clean_data['__File_Name'], 
                    'F_Size'    => $__clean_data['__File_Size'], 
                    'F_Type'    => $__clean_data['__File_Type'], 
                    'F_Tmp'     => $__clean_data['__File_Tmp'], 
                    'Judul'     => $__data_berkas__->Judul, 
                    'Format'    => $__data_berkas__->Format, 
                    'Ukuran'    => $__data_berkas__->Ukuran,
                ]);

                if ( $__export_getdata_file['Error'] != '000' ) {

                    return $result = [
                        'Error'     => '999',
                        'Message'   => $__export_getdata_file['Message'],
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $url = $this->__SessionController->__Url_Curl_Penunjang__();

                $cFile = new CURLFile($__export_getdata_file['Data']['Tmp'], $__clean_data['__File_Type'], $__export_getdata_file['Data']['Nama']);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $cFile]);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                if ( curl_errno($ch) ) {
                    
                    return $result = [
                        'Error'     => '999',
                        'Message'   => curl_error($ch),
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 

                curl_close($ch);

                $__authlogin_berkas__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $__clean_data['__IdUpload'] ) ."' AND Data = 'Y' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

                $__authlogin_berkas_total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Pendaftaran_Berkas ) AS Total FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Data = 'Y' ");

                if ( $__authlogin_berkas__->Id == TRUE ) {

                    $__session = [
                        'Judul_Rpl_Pendaftaran_Berkas'  => $__data_berkas__->Judul,
                        'File_Rpl_Pendaftaran_Berkas'   => $__export_getdata_file['Data']['Nama'],
                        'Format_Rpl_Pendaftaran_Berkas' => $__export_getdata_file['Data']['Format'],
                        'User_Rpl_Pendaftaran_Berkas'   => $__authlogin__->Nama,
                        'Log_Rpl_Pendaftaran_Berkas'    => date('Y-m-d H:i:s'),
                        'Id_Rpl_Pendaftaran'            => $__authlogin__->Id,
                        'Id_Cms_KeteranganDokumen'      => $__data_berkas__->Id,
                    ];

                } else {

                    $__session = [
                        'Judul_Rpl_Pendaftaran_Berkas'  => $__data_berkas__->Judul,
                        'File_Rpl_Pendaftaran_Berkas'   => $__export_getdata_file['Data']['Nama'],
                        'Format_Rpl_Pendaftaran_Berkas' => $__export_getdata_file['Data']['Format'],
                        'User_Rpl_Pendaftaran_Berkas'   => $__authlogin__->Nama,
                        'Log_Rpl_Pendaftaran_Berkas'    => date('Y-m-d H:i:s'),
                        'Kampus'                        => $__authlogin__->Kampus,
                        'Data'                          => 'Y',
                        'Id_Rpl_Pendaftaran'            => $__authlogin__->Id,
                        'Id_Cms_KeteranganDokumen'      => $__data_berkas__->Id,
                    ];

                }


                $__masa_studi__ = $this->__Masa_Studi__([
                    'Pengalaman'    => $__authlogin__->Bekerja === 'BEKERJA' ? $__authlogin__->LamaBekerja : 'TIDAK BEKERJA', 
                    'Pendidikan'    => $__authlogin__->JenjangAkhir, 
                    'Dokumen'       => $__authlogin_berkas_total__->Total,
                ]);

                if ( $__authlogin__->Kategori == $__masa_studi__['Kategori'] AND $__authlogin__->Studi == $__masa_studi__['Studi'] AND $__authlogin__->Jenis == TRUE AND $__authlogin__->TipeJenis == TRUE ) { 



                } else {

                    // ##### UPDATE ##### //
                        $__datas_update = [
                            'Kategori_Rpl_Pendaftaran'  => $__masa_studi__['Kategori'],
                            'Studi_Rpl_Pendaftaran'     => $__masa_studi__['Studi'],
                            'Jenis_Rpl_Pendaftaran'     => $__authlogin__->Jenis,
                            'TipeJenis_Rpl_Pendaftaran' => $__authlogin__->TipeJenis,
                            'User_Rpl_Pendaftaran'      => 'Auto Update Page 6',
                            'Log_Rpl_Pendaftaran'       => date('Y-m-d H:i:s'),
                            'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                        ];
                    // ##### UPDATE ##### //

                }

                    try {

                        $this->__db->beginTransaction();

                            if ( $__authlogin_berkas__->Id == TRUE ) {

                                $__sql = $this->__db -> prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Pendaftaran_Berkas SET
                                            Judul_Rpl_Pendaftaran_Berkas    = :Judul_Rpl_Pendaftaran_Berkas,
                                            File_Rpl_Pendaftaran_Berkas     = :File_Rpl_Pendaftaran_Berkas, 
                                            Format_Rpl_Pendaftaran_Berkas   = :Format_Rpl_Pendaftaran_Berkas,
                                            User_Rpl_Pendaftaran_Berkas     = :User_Rpl_Pendaftaran_Berkas, 
                                            Log_Rpl_Pendaftaran_Berkas      = :Log_Rpl_Pendaftaran_Berkas
                                        WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                        AND Id_Cms_KeteranganDokumen        = :Id_Cms_KeteranganDokumen
                                    "
                                ) -> execute ( $__session );

                            } else {

                                $__sql = $this->__db -> prepare( 
                                    "
                                        INSERT INTO Tbl_Rpl_Pendaftaran_Berkas
                                        (
                                            Judul_Rpl_Pendaftaran_Berkas,
                                            File_Rpl_Pendaftaran_Berkas, Format_Rpl_Pendaftaran_Berkas,
                                            User_Rpl_Pendaftaran_Berkas, Log_Rpl_Pendaftaran_Berkas, Kampus, Data,
                                            Id_Rpl_Pendaftaran, Id_Cms_KeteranganDokumen
                                        )
                                        VALUES
                                        (
                                            :Judul_Rpl_Pendaftaran_Berkas,
                                            :File_Rpl_Pendaftaran_Berkas, :Format_Rpl_Pendaftaran_Berkas,
                                            :User_Rpl_Pendaftaran_Berkas, :Log_Rpl_Pendaftaran_Berkas, :Kampus, :Data,
                                            :Id_Rpl_Pendaftaran, :Id_Cms_KeteranganDokumen
                                        )
                                    "
                                ) -> execute ( $__session );

                            }


                            if ( $__authlogin__->Kategori == $__masa_studi__['Kategori'] AND $__authlogin__->Studi == $__masa_studi__['Studi'] AND $__authlogin__->Jenis == TRUE AND $__authlogin__->TipeJenis == TRUE ) {


                            } else {

                                $__sql_update = $this->__db -> prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Pendaftaran SET
                                            Kategori_Rpl_Pendaftaran    = :Kategori_Rpl_Pendaftaran,
                                            Studi_Rpl_Pendaftaran       = :Studi_Rpl_Pendaftaran,
                                            Jenis_Rpl_Pendaftaran       = :Jenis_Rpl_Pendaftaran,
                                            TipeJenis_Rpl_Pendaftaran   = :TipeJenis_Rpl_Pendaftaran,
                                            User_Rpl_Pendaftaran        = :User_Rpl_Pendaftaran,
                                            Log_Rpl_Pendaftaran         = :Log_Rpl_Pendaftaran
                                        WHERE Id_Rpl_Pendaftaran        = :Id_Rpl_Pendaftaran
                                    "
                                ) -> execute ( $__datas_update );

                            }

                        $this->__db->commit();

                            unset($_SESSION['__Old__'], $_SESSION['__Post_Notifikasi__']);

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => @$__clean_data['__Url_Success'],
                                ],
                            ];

                    } catch ( Exception $error ) {

                        $this->__db->rollBack();

                        return [
                            'Error'   => '999',
                            'Message' => 'Error: ' . $error,
                            'Data'    => [
                                'Url'   => @$__clean_data['__Url'],
                            ],
                        ];
                        
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

        public function IndexRpl_Berkas_2_Hapus()
        {
            $__id_1 = $this->__helpers->SecretOpen( $_GET['__IdRpl'] );
            $__id_2 = $this->__helpers->SecretOpen( $_GET['__IdBerkas'] );

            $__id_rpl = isset($__id_1) ? intval($__id_1) : 0;
            $__id_berkas = isset($__id_2) ? intval($__id_2) : 0;

            if ( $__id_rpl <= 0 OR $__id_berkas <= 0 ) {
                
                redirect(self::__Routes_Mod__() . '/2', '03', 'ID Tidak Valid !');
                exit();
                
            }

            $__data_record__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran_Berkas = '". $__id_berkas ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran = '". $__id_rpl ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

            if ( !$__data_record__ ) {

                redirect(self::__Routes_Mod__() . '/2', '03', 'Data Tidak Ditemukan !');
                exit();
                
            }

            $__session = [
                'Id_Rpl_Pendaftaran_Berkas'     => $__data_record__->Id,
                'Id_Rpl_Pendaftaran'            => $__data_record__->Id_Rpl_Pendaftaran,
            ];


            $__authlogin__ = $this->__SessionController->__Data_Rpl__( $__session['Id_Rpl_Pendaftaran'] );

            if ( !$__authlogin__->Id ) {

                return [
                    'Error'   => '999',
                    'Message' => 'Data RPL Pendaftaran Tidak Ada',
                    'Data'    => [
                        'Url'   => @$__clean_data['__Url'],
                    ],
                ];

            }
            
            $__authlogin_berkas_total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Pendaftaran_Berkas ) AS Total FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__session['Id_Rpl_Pendaftaran'] ."' AND Data = 'Y' ");

            $__masa_studi__ = $this->__Masa_Studi__([
                'Pengalaman'    => $__authlogin__->Bekerja === 'BEKERJA' ? $__authlogin__->LamaBekerja : 'TIDAK BEKERJA', 
                'Pendidikan'    => $__authlogin__->JenjangAkhir, 
                'Dokumen'       => $__authlogin_berkas_total__->Total,
            ]);

            if ( $__authlogin__->Kategori == $__masa_studi__['Kategori'] AND $__authlogin__->Studi == $__masa_studi__['Studi'] AND $__authlogin__->Jenis == TRUE AND $__authlogin__->TipeJenis == TRUE ) { 



            } else {

                // ##### UPDATE ##### //
                    $__datas_update = [
                        'Kategori_Rpl_Pendaftaran'  => $__masa_studi__['Kategori'],
                        'Studi_Rpl_Pendaftaran'     => $__masa_studi__['Studi'],
                        'Jenis_Rpl_Pendaftaran'     => $__authlogin__->Jenis,
                        'TipeJenis_Rpl_Pendaftaran' => $__authlogin__->TipeJenis,
                        'User_Rpl_Pendaftaran'      => 'Auto Update Page 6',
                        'Log_Rpl_Pendaftaran'       => date('Y-m-d H:i:s'),
                        'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                    ];
                // ##### UPDATE ##### //

            }

            
                try {

                    $this->__db->beginTransaction();

                        $__sql = $this->__db -> prepare( 
                            "
                                UPDATE Tbl_Rpl_Pendaftaran_Berkas SET
                                    Data = 'N'
                                WHERE Id_Rpl_Pendaftaran_Berkas = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                            "
                        ) -> execute ( $__session );

                        if ( $__authlogin__->Kategori == $__masa_studi__['Kategori'] AND $__authlogin__->Studi == $__masa_studi__['Studi'] AND $__authlogin__->Jenis == TRUE AND $__authlogin__->TipeJenis == TRUE ) {


                        } else {

                            $__sql_update = $this->__db -> prepare( 
                                "
                                    UPDATE Tbl_Rpl_Pendaftaran SET
                                        Kategori_Rpl_Pendaftaran    = :Kategori_Rpl_Pendaftaran,
                                        Studi_Rpl_Pendaftaran       = :Studi_Rpl_Pendaftaran,
                                        Jenis_Rpl_Pendaftaran       = :Jenis_Rpl_Pendaftaran,
                                        TipeJenis_Rpl_Pendaftaran   = :TipeJenis_Rpl_Pendaftaran,
                                        User_Rpl_Pendaftaran        = :User_Rpl_Pendaftaran,
                                        Log_Rpl_Pendaftaran         = :Log_Rpl_Pendaftaran
                                    WHERE Id_Rpl_Pendaftaran        = :Id_Rpl_Pendaftaran
                                "
                            ) -> execute ( $__datas_update );

                        }

                    $this->__db->commit();

                        redirect(self::__Routes_Mod__() . '/2', '01', 'Berhasil Hapus Data');
                        exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                        redirect(self::__Routes_Mod__() . '/2', '03', 'A Data Error Occurred: ' . $e->getMessage());
                        exit();
                    
                }
        }
    }