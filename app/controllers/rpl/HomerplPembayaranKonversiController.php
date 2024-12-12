<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(dirname(__DIR__)) . '/api/__bri.php';

    class HomerplPembayaranKonversiController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__Bri;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__Bri = new __Bri( $this->__db , $this->__secret_key , $this->__universitas , $this->__helpers );
        }

        public function __Header()
        {
            return 'RPL | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homerpl/pembayarankonversi');
        }
        
        public function IndexRpl_PembayaranKonversi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__pembayarankonversi';

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

                $__record_data_biayakonversi__ = self::__Query_BiayaKonversi( $__datas = ['Ta' => $__authlogin__->Ta, 'Semester' => $__authlogin__->Semester] );

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    if ( $__data_pembayaran__->StatusBayar == 'Y' ) {

                        redirect($__routes_mod . '/suksespembayaran', $result['Error'] === '000' ? '01' : '03', 'Sukses Melakukan Pembayaran Nilai Konversi !');
                        exit();

                    } else {

                        redirect($__routes_mod . '/cekpembayaran', $result['Error'] === '000' ? '01' : '03', 'Silahkan Lakukan Pembayaran dan Cek Pembayaran Nilai Konversi !');
                        exit();

                    }

                }  else {
                
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

                }
                
            }
        }

        public function __Query_BiayaKonversi( $data )
        {
            $data = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, Tipe_Rpl_BiayaKonversi AS Tipe FROM Tbl_Rpl_BiayaKonversi WHERE Ta_Rpl_BiayaKonversi = '". $data['Ta'] ."' AND Semester_Rpl_BiayaKonversi = '". $data['Semester'] ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY Id_Rpl_BiayaKonversi DESC ");

            return $data;
        }

        public function __Check_Va__( array $data )
        {
            $__tgl__ = date('Y-m-d H:i:s');
            $__nomor_va__ = rand(0, 999999999) . date('s') . '10';

            if ( $__nomor_va__ == FALSE ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Nomor Pembayaran VA Tidak Terbuatkan !',
                    'Data'          => [],
                ];
                exit();

            }

            if ( strlen( $__nomor_va__ ) > '13' ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Nomor Pembayaran VA Tidak Terbuatkan !',
                    'Data'          => [],
                ];
                exit();

            }

            if ( strlen( $__nomor_va__ ) > '0' AND strlen( @$__nomor_va__ ) < '14' ) {

                $__check_nomor_va__ = $this->__db->queryrow(" SELECT CustCode_Bri_Bayar AS CC FROM Tbl_Bri_Bayar WHERE CustCode_Bri_Bayar = '". $__nomor_va__ ."' ");
        
                if ( $__check_nomor_va__ == TRUE ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf Nomor Pembayaran VA Sudah Terpakai, Silahkan Ulangi Kembali !',
                        'Data'          => [],
                    ];
                    exit();

                }

                $__check_duplikat__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $data['DataUser']['Id'] ."' AND Ta_Bri_Bayar = '". $data['DataUser']['Ta'] ."' AND Semester_Bri_Bayar = '". $data['DataUser']['Semester'] ."' AND StatusBayar_Bri_Bayar = 'N' AND Data = 'Y' ");

                if ( $__check_duplikat__ > 0 ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf Nomor Pembayaran VA Sudah Ada, Silahkan Lakukan Pembayaran !',
                        'Data'          => [],
                    ];
                    exit();

                }

                $__check_va_y__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $data['DataUser']['Id'] ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $data['DataUser']['Ta'] ."' AND Semester_Bri_Bayar = '". $data['DataUser']['Semester'] ."' AND Data = 'Y' ");

                if ( $__check_va_y__ == TRUE ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf ' . $data['Nama'] . ', Nomor Pembayaran Virtual Account Bank Kamu Sudah Membayar, Silahkan Tinggalkan Halaman Ini Dan Lanjut Ke Tahap Selanjutnya Ya !',
                        'Data'          => [],
                    ];
                    exit();

                }

                $__check_va_exp__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $data['DataUser']['Id'] ."' AND TanggalExpired_Bri_Bayar >= '". $__tgl__ ."' AND Data = 'Y' ");

                if ( $__check_va_exp__ == TRUE ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf ' . $data['Nama'] . ', Nomor Pembayaran Virtual Account Bank Kamu Masih Ada dan Belum Habis Masa Aktifnya. Silahkan Melakukan Pembayaran Ya !',
                        'Data'          => [],
                    ];
                    exit();

                }

                return [
                    'Error'         => '000',
                    'Message'       => 'Sukses !',
                    'Data'          => [
                        'Va'        => $__nomor_va__,
                    ],
                ];
                exit();

            } else {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Nomor Pembayaran VA Harus Di Antara 1 - 13 Nomor Code Saja !',
                    'Data'          => [],
                ];
                exit();
                
            }
        }

        public function IndexRpl_PembayaranKonversi_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Biaya'           => isset($data['__Biaya']) ? stripslashes(strip_tags(htmlspecialchars($data['__Biaya'], ENT_QUOTES))) : '',
                '__Bank'            => isset($data['__Bank']) ? stripslashes(strip_tags(htmlspecialchars($data['__Bank'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Bank'            => $__clean_data['__Bank'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__data_user = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__Id'] ) );

                $__log__ = date('Y-m-d H:i:s');

                if ( $__clean_data['__Bank'] == 'BRI' ) {

                    $__data_token = $this->__Bri->__Token__();

                    if ( $__data_token['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_token['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__not_exp = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__data_user->Id ."' AND TanggalExpired_Bri_Bayar >= '". $__log__ ."' AND Data = 'Y' ");

                    if ( $__not_exp == TRUE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf ' . $this->__helpers->HurufAwalBesar( $__data_user->Nama ) . ', Nomor Pembayaran Virtual Account Bank Kamu Masih Ada dan Belum Habis Masa Aktifnya. Silahkan Melakukan Pembayaran Ya',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } 


                    $__session_check_data = [
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => 'RPL',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];


                    $__check_va__ = $this->__Check_Va__( $__session_check_data );

                    if ( $__check_va__['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__check_va__['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__create_va = [
                        'Token'         => $__data_token['Data']['Token'],
                        'Nama'          => substr( $this->__helpers->HurufAwalBesar( $__data_user->Nama ) , 0 , 40 ),
                        'Amount'        => $__clean_data['__Biaya'] + 0,
                        'Keterangan'    => 'Bayar Biaya Konversi RPL TA - ' . $__data_user->Ta . '/' . $__data_user->Semester,
                        'Va'            => $__check_va__['Data']['Va'],
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => 'RPL',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];

                    $__data_create_va = $this->__Bri->__Create_Va__( $__create_va );

                    if ( $__data_create_va['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_create_va['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__tgl__ = date('Y-m-d H:i:s');
            
                    $__session__ = [
                        'UserId_Bri_Bayar'              => $__data_user->Id,
                        'Ta_Bri_Bayar'                  => $__data_user->Ta,
                        'Semester_Bri_Bayar'            => $__data_user->Semester,
                        'InstitutionCode_Bri_Bayar'     => $this->__Bri->__Data_Bri__()['Institutioncode'],
                        'BrivaNo_Bri_Bayar'             => $this->__Bri->__Data_Bri__()['Brivano'],
                        'CustCode_Bri_Bayar'            => $__create_va['Va'],
                        'Nama_Bri_Bayar'                => $__create_va['Nama'],
                        'Amount_Bri_Bayar'              => $__create_va['Amount'],
                        'Diskon_Bri_Bayar'              => '0',
                        'Nominal_Bri_Bayar'             => $__create_va['Amount'],
                        'Keterangan_Bri_Bayar'          => $__create_va['Keterangan'],
                        'StatusBayar_Bri_Bayar'         => 'N',
                        'AccessToken_Bri_Bayar'         => $__create_va['Token'],
                        'TanggalBuat_Bri_Bayar'         => $__tgl__,
                        'TanggalExpired_Bri_Bayar'      => $this->__helpers->__TambahTanggal(),
                        'TanggalBayar_Bri_Bayar'        => $__tgl__,
                        'JenisBayar_Bri_Bayar'          => 'Full',
                        'Bank_Bri_Bayar'                => $__create_va['DataUser']['Bank'],
                        'Tujuan_Bri_Bayar'              => $__create_va['DataUser']['Tujuan'],
                        'User_Bri_Bayar'                => $__create_va['Nama'],
                        'Log_Bri_Bayar'                 => $__tgl__,
                        'IdKampus'                      => __Aplikasi()['IdKampus'],
                        'Kampus'                        => __Aplikasi()['Kampus'],
                        'Data'                          => 'Y',
                        'KeteranganDeskripsi_Bri_Bayar' => '',
                        'Deskripsi_Bri_Bayar'           => '',
                        'NominalDeskripsi_Bri_Bayar'    => '',
                        'TotalDeskripsi_Bri_Bayar'      => '',
                    ];

                    $__result = $this->__Insert_Bri_Bayar__( $__session__ );

                    return [
                        'Error'     => '999',
                        'Message'   => $__result['Message'],
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } else {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Bank Tidak Tersedia !',
                        'Data'      => [
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

        public function __Insert_Bri_Bayar__( array $data )
        {
            $__session__ = [
                'UserId_Bri_Bayar'              => $data['UserId_Bri_Bayar'],
                'Ta_Bri_Bayar'                  => $data['Ta_Bri_Bayar'],
                'Semester_Bri_Bayar'            => $data['Semester_Bri_Bayar'],
                'InstitutionCode_Bri_Bayar'     => $data['InstitutionCode_Bri_Bayar'],
                'BrivaNo_Bri_Bayar'             => $data['BrivaNo_Bri_Bayar'],
                'CustCode_Bri_Bayar'            => $data['CustCode_Bri_Bayar'],
                'Nama_Bri_Bayar'                => $data['Nama_Bri_Bayar'],
                'Amount_Bri_Bayar'              => $data['Amount_Bri_Bayar'],
                'Diskon_Bri_Bayar'              => $data['Diskon_Bri_Bayar'],
                'Nominal_Bri_Bayar'             => $data['Nominal_Bri_Bayar'],
                'Keterangan_Bri_Bayar'          => $data['Keterangan_Bri_Bayar'],
                'StatusBayar_Bri_Bayar'         => $data['StatusBayar_Bri_Bayar'],
                'AccessToken_Bri_Bayar'         => $data['AccessToken_Bri_Bayar'],
                'TanggalBuat_Bri_Bayar'         => $data['TanggalBuat_Bri_Bayar'],
                'TanggalExpired_Bri_Bayar'      => $data['TanggalExpired_Bri_Bayar'],
                'TanggalBayar_Bri_Bayar'        => $data['TanggalBayar_Bri_Bayar'],
                'JenisBayar_Bri_Bayar'          => $data['JenisBayar_Bri_Bayar'],
                'Bank_Bri_Bayar'                => $data['Bank_Bri_Bayar'],
                'Tujuan_Bri_Bayar'              => $data['Tujuan_Bri_Bayar'],
                'User_Bri_Bayar'                => $data['User_Bri_Bayar'],
                'Log_Bri_Bayar'                 => $data['Log_Bri_Bayar'],
                'IdKampus'                      => $data['IdKampus'],
                'Kampus'                        => $data['Kampus'],
                'Data'                          => $data['Data'],
                'KeteranganDeskripsi_Bri_Bayar' => $data['KeteranganDeskripsi_Bri_Bayar'],
                'Deskripsi_Bri_Bayar'           => $data['Deskripsi_Bri_Bayar'],
                'NominalDeskripsi_Bri_Bayar'    => $data['NominalDeskripsi_Bri_Bayar'],
                'TotalDeskripsi_Bri_Bayar'      => $data['TotalDeskripsi_Bri_Bayar'],
            ];

            try {

                $this->__db->beginTransaction();

                    $__sql = $this->__db->prepare( 
                        "
                            INSERT INTO Tbl_Bri_Bayar
                            (
                                UserId_Bri_Bayar,
                                Ta_Bri_Bayar,
                                Semester_Bri_Bayar,
                                InstitutionCode_Bri_Bayar,
                                BrivaNo_Bri_Bayar,
                                CustCode_Bri_Bayar,
                                Nama_Bri_Bayar,
                                Amount_Bri_Bayar,
                                Diskon_Bri_Bayar,
                                Nominal_Bri_Bayar,
                                Keterangan_Bri_Bayar,
                                StatusBayar_Bri_Bayar,
                                AccessToken_Bri_Bayar,
                                TanggalBuat_Bri_Bayar,
                                TanggalExpired_Bri_Bayar,
                                TanggalBayar_Bri_Bayar,
                                JenisBayar_Bri_Bayar,
                                Bank_Bri_Bayar,
                                Tujuan_Bri_Bayar,
                                User_Bri_Bayar,
                                Log_Bri_Bayar,
                                IdKampus,
                                Kampus,
                                Data,
                                KeteranganDeskripsi_Bri_Bayar,
                                Deskripsi_Bri_Bayar,
                                NominalDeskripsi_Bri_Bayar,
                                TotalDeskripsi_Bri_Bayar
                            )
                        VALUES
                            (
                                :UserId_Bri_Bayar,
                                :Ta_Bri_Bayar,
                                :Semester_Bri_Bayar,
                                :InstitutionCode_Bri_Bayar,
                                :BrivaNo_Bri_Bayar,
                                :CustCode_Bri_Bayar,
                                :Nama_Bri_Bayar,
                                :Amount_Bri_Bayar,
                                :Diskon_Bri_Bayar,
                                :Nominal_Bri_Bayar,
                                :Keterangan_Bri_Bayar,
                                :StatusBayar_Bri_Bayar,
                                :AccessToken_Bri_Bayar,
                                :TanggalBuat_Bri_Bayar,
                                :TanggalExpired_Bri_Bayar,
                                :TanggalBayar_Bri_Bayar,
                                :JenisBayar_Bri_Bayar,
                                :Bank_Bri_Bayar,
                                :Tujuan_Bri_Bayar,
                                :User_Bri_Bayar,
                                :Log_Bri_Bayar,
                                :IdKampus,
                                :Kampus,
                                :Data,
                                :KeteranganDeskripsi_Bri_Bayar,
                                :Deskripsi_Bri_Bayar,
                                :NominalDeskripsi_Bri_Bayar,
                                :TotalDeskripsi_Bri_Bayar
                            )
                        "
                    ) -> execute ( $__session__ );

                    $this->__db->commit();

                    return [
                        'Error'   => '000',
                        'Message' => 'Berhasil Simpan Data Pembayaran !',
                        'Data'    => [],
                    ];
                    exit();

            } catch ( PDOException $e ) {

                $this->__db->rollback();

                return [
                    'Error'   => '999',
                    'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                    'Data'    => [],
                ];
                exit();

            }
        }
    }