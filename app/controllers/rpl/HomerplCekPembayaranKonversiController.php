<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(dirname(__DIR__)) . '/api/__bri.php';
    require_once dirname(__DIR__) . '/../helpers/__Keuangan.php';

    class HomerplCekPembayarankonversiController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__Bri;
        protected $__Keuangan;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__Bri = new __Bri( $this->__db , $this->__secret_key , $this->__universitas , $this->__helpers );
            $this->__Keuangan = new __Keuangan( $this->__db );
        }

        public function __Header()
        {
            return 'RPL | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homerpl/pembayarankonversi/cekpembayaran');
        }
        
        public function IndexRpl_CekPembayaranKonversi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__pembayarankonversi/cekpembayaran';

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

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    $__data_carapembayaran = $this->__db->query(" SELECT * FROM Tbl_CaraPembayaranBriva ORDER BY Id_CaraPembayaranBriva ASC ");

                    $__db = $this->__db;

                    if ( date('Y-m-d H:i:s', strtotime(@$__data_pembayaran__->TglExp)) >= date('Y-m-d H:i:s') ) {

                        $__aktif__ = '000';

                        $__load_pembayaran_ = [
                            'Id'                      => $__authlogin__->Id,
                            'Id_Bri_Bayar'            => $__data_pembayaran__->Id,
                            'Ta_Bri_Bayar'            => $__data_pembayaran__->Ta,
                            'Semester_Bri_Bayar'      => $__data_pembayaran__->Semester,
                            'CustCode_Bri_Bayar'      => $__data_pembayaran__->CustCode,
                        ];

                        $result = $this->__Load_Bri_Bayar__( $__load_pembayaran_ );

                    } else {

                        $__aktif__ = '999';

                    }

                    if ( $result['Error'] == '000' ) {

                        redirect('/homerpl/pembayarankonversi', $result['Error'] === '000' ? '01' : '03', $result['Message']);
                        exit();

                    } else {

                        require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

                    }
                    
                }  else {
                
                    redirect('/homerpl/pembayarankonversi', $result['Error'] === '000' ? '01' : '03', 'Tidak Ada Pembayaran Kamu !');
                    exit();

                }
                
            }
        }

        public function __Query_BiayaKonversi( $data )
        {
            $data = $this->__db->queryid("SELECT TOP 1 Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, Tipe_Rpl_BiayaKonversi AS Tipe FROM Tbl_Rpl_BiayaKonversi WHERE Ta_Rpl_BiayaKonversi = '". $data['Ta'] ."' AND Semester_Rpl_BiayaKonversi = '". $data['Semester'] ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY Id_Rpl_BiayaKonversi DESC ");

            return $data;
        }

        public function IndexRpl_CekPembayaranKonversi_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = url('/homerpl/pembayarankonversi/cekpembayaran/pdf');
            $__content      = '__pembayarankonversi/cekpembayaran/pdf';

            $__active       = 'active';

            if ( !isset($_SESSION['__Rpl__']) OR $_GET['__Id'] == FALSE ) {

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

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND Id_Bri_Bayar = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    $__kop_surat = $this->__universitas->__Detail_Universitas()['KopSurat'];

                    if ( $__data_pembayaran__->StatusBayar == 'Y' ) {
                        $__statusbayar__ = 'SUDAH BAYAR';
                    } else {
                        $__statusbayar__ = 'BELUM BAYAR';
                    }
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__cek_bri.php';

                }  else {
                
                    redirect('/homerpl/pembayarankonversi', $result['Error'] === '000' ? '01' : '03', 'Tidak Ada Pembayaran Kamu !');
                    exit();

                }
                
            }
        }

        public function IndexRpl_CekPembayaranKonversi_Hapus( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__IdBayar'         => isset($data['__IdBayar']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdBayar'], ENT_QUOTES))) : '',
                '__Bank'            => isset($data['__Bank']) ? stripslashes(strip_tags(htmlspecialchars($data['__Bank'], ENT_QUOTES))) : '',
            ];

            // $_SESSION['__Old__'] = [
            //     '__Bank'            => $__clean_data['__Bank'],
            // ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__data_user = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__Id'] ) );

                $__log__ = date('Y-m-d H:i:s');

                if ( $this->__helpers->SecretOpen( $__clean_data['__Bank'] ) == 'BRI' ) {
            
                    $__session__ = [
                        'User_Bri_Bayar'    => $__data_user->Nama,
                        'Log_Bri_Bayar'     => date('Y-m-d H:i:s'),
                        'Data'              => 'N',
                        'Id_Bri_Bayar'      => $this->__helpers->SecretOpen( $__clean_data['__IdBayar'] ),
                        'UserId_Bri_Bayar'  => $__data_user->Id,
                        'Bank_Bri_Bayar'    => $this->__helpers->SecretOpen( $__clean_data['__Bank'] ),
                    ];

                    $__result = $this->__Delete_Bri_Bayar__( $__session__ );

                    return [
                        'Error'     => '000',
                        'Message'   => $__result['Message'],
                        'Data'      => [
                            'Url'   => $__clean_data['__Url_Success'],
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

        public function __Delete_Bri_Bayar__( array $data )
        {
            $__session__ = [
                'User_Bri_Bayar'    => $data['User_Bri_Bayar'],
                'Log_Bri_Bayar'     => $data['Log_Bri_Bayar'],
                'Data'              => $data['Data'],
                'Id_Bri_Bayar'      => $data['Id_Bri_Bayar'],
                'UserId_Bri_Bayar'  => $data['UserId_Bri_Bayar'],
                'Bank_Bri_Bayar'    => $data['Bank_Bri_Bayar'],
            ];

            try {

                $this->__db->beginTransaction();

                    $__sql = $this->__db->prepare( 
                        "
                            UPDATE Tbl_Bri_Bayar SET
                                User_Bri_Bayar      = :User_Bri_Bayar,
                                Log_Bri_Bayar       = :Log_Bri_Bayar,
                                Data                = :Data
                            WHERE Id_Bri_Bayar      = :Id_Bri_Bayar
                            AND UserId_Bri_Bayar    = :UserId_Bri_Bayar
                            AND Bank_Bri_Bayar      = :Bank_Bri_Bayar
                        "
                    ) -> execute ( $__session__ );

                    $this->__db->commit();

                    return [
                        'Error'   => '000',
                        'Message' => 'Berhasil Hapus Data Pembayaran !',
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

        public function __Load_Bri_Bayar__( array $data )
        {
            $__data_token = $this->__Bri->__Token__();

            if ( $__data_token['Error'] != '000' ) {

                return [
                    'Error'     => '999',
                    'Message'   => $__data_token['Message'],
                    'Data'      => [
                        'Data'      => [],
                    ],
                ];
                exit();

            }

            if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                    'Data'      => [
                        'Data'      => [],
                    ],
                ];
                exit();

            }
            
            $__load_va = [
                'Token'                         => $__data_token['Data']['Token'],
                'Id_User'                       => $data['Id_User'],
                'Id_Bri_Bayar'                  => $data['Id_Bri_Bayar'],
                'Ta_Bri_Bayar'                  => $data['Ta_Bri_Bayar'],
                'Semester_Bri_Bayar'            => $data['Semester_Bri_Bayar'],
                'CustCode_Bri_Bayar'            => $data['CustCode_Bri_Bayar'],
                'Tgl_1'                         => str_replace( "-", "", date('Y-m-d') ),
                'Tgl_2'                         => str_replace( "-", "", date('Y-m-d') ),
            ];

            $__data_load_va = $this->__Bri->__Load_Va__( $__load_va );

            if ( $__data_load_va['Error'] != '000' ) {

                return [
                    'Error'     => '000',
                    'Message'   => $__data_load_va['Message'],
                    'Data'      => [],
                ];
                exit();

            }

            $__success_load_bayar__ = $this->__Success_Bayar_Bri__( $__data_load_va['Data'] , $data );

            if ( $__success_load_bayar__['Error'] == '000' ) {

                return [
                    'Error'     => '000',
                    'Message'   => $__success_load_bayar__['Message'],
                    'Data'      => [],
                ];
                exit();

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => $__success_load_bayar__['Message'],
                    'Data'      => [],
                ];
                exit();

            }
        }

        public function __Success_Bayar_Bri__( array $data , array $datas )
        {
            $sysbol = $this->__db->queryid(" SELECT TOP 1 Beasiswa FROM TTBUKTISETORAN ");

            if ( $sysbol->Beasiswa == FALSE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Symbol Beasiswa Tidak Di Temukan !',
                    'Data'      => [],
                ];
                exit();

            }

            foreach ( $data AS $row => $report ) :

                if ( $report['custCode'] == $datas['CustCode_Bri_Bayar'] ) {

                    $__datas_bayar__ = $this->__Keuangan->__Bri_Bayar__( $datas['Id_Bri_Bayar'] );

                    $__datas_authlogin__ = $this->__SessionController->__Data_Rpl__( $datas['Id'] );

                    $tgl_reportstr = substr($report['paymentDate'], 0, 16);

                    $__jurnal_debet = [
                        'Ref'           => $__datas_authlogin__->Nomor ."." . $__datas_bayar__->Ta . '.' . $__datas_bayar__->Semester,
                        'Tgl'           => $report['paymentDate'],
                        'NoUrut'        => '1',
                        'Ta'            => $__datas_bayar__->Ta,
                        'Semester'      => '1',
                        'Npm'           => $__datas_authlogin__->Nomor,
                        'Kode'          => $this->__Keuangan->__Nomor_Debet__()['Kode'],
                        'Debet'         => $report['amount'],
                        'Kredit'        => '',
                        'Keterangan'    => $__datas_bayar__->Keterangan,
                        'Status'        => 'I',
                        'IdKampus'      => $__datas_authlogin__->IdKampus,
                        'Tabel'         => $this->__Keuangan->__Nomor_Debet__()['Table'],
                        'UserId'        => $__datas_authlogin__->Nama,
                        'Bank'          => $__datas_bayar__->Bank,
                    ];

                    $__jurnal_kredit = [
                        'Ref'           => $__datas_authlogin__->Nomor ."." . $__datas_bayar__->Ta . '.' . $__datas_bayar__->Semester,
                        'Tgl'           => $report['paymentDate'],
                        'NoUrut'        => '1',
                        'Ta'            => $__datas_bayar__->Ta,
                        'Semester'      => '1',
                        'Npm'           => $__datas_authlogin__->Nomor,
                        'Kode'          => $this->__Keuangan->__Nomor_Kredit__()['Kode'],
                        'Debet'         => '',
                        'Kredit'        => $report['amount'],
                        'Keterangan'    => $__datas_bayar__->Keterangan,
                        'Status'        => 'I',
                        'IdKampus'      => $__datas_authlogin__->IdKampus,
                        'Tabel'         => $this->__Keuangan->__Nomor_Kredit__()['Table'],
                        'UserId'        => $__datas_authlogin__->Nama,
                        'Bank'          => $__datas_bayar__->Bank,
                    ];

                    $__update_pembayaran = [
                        'Y'                         => 'Y',
                        'TanggalBayar_Bri_Bayar'    => $report['paymentDate'],
                        'User_Bri_Bayar'            => $this->__helpers->HurufBesar( $__datas_authlogin__->Nama ),
                        'Log_Bri_Bayar'             => $report['paymentDate'],
                        'Id_Bri_Bayar'              => $__datas_bayar__->Id,
                        'UserId_Bri_Bayar'          => $__datas_authlogin__->Id,
                        'Ta_Bri_Bayar'              => $__datas_bayar__->Ta,
                        'Semester_Bri_Bayar'        => $__datas_bayar__->Semester,
                        'CustCode_Bri_Bayar'        => $report['custCode'],
                        'StatusBayar_Bri_Bayar'     => 'N',
                        'Data'                      => 'Y',
                    ];

                    try {

                        $this->__db->beginTransaction();

                            $__jurnal_debet = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_debet );

                            $__jurnal_kredit = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_kredit );

                            $__update_bri_bayar = $this->__Keuangan->__Success_Bri_Bayar__( $__update_pembayaran );

                            if ( $__jurnal_debet['Error'] === '000' AND $__jurnal_kredit['Error'] === '000' AND $__update_bri_bayar['Error'] === '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'] );
                                unset( $_SESSION['__Old__'] );
                                
                                $this->__db->commit();

                                return [
                                    'Error'     => '000',
                                    'Message'   => 'Berhasil Sukses Pembayaran Dengan Bank BRI Data !',
                                    'Data'      => [],
                                ];
                                exit();

                            } else {

                                $this->__db->rollback();
                                
                                return [
                                    'Error'     => '999',
                                    'Message'   => 'Error Query',
                                    'Data'      => [],
                                ];
                                exit();

                            }

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        return [
                            'Error'     => '999',
                            'Message'   => 'A Data Error Occurred: ' . $e->getMessage(),
                            'Data'      => [],
                        ];
                        exit();

                    }

                }

            endforeach;
        }
    }