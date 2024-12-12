<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';

    class HomeadminMaintanceController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__BiayaKonversiModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
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
            return url('/homeadmin/maintance');
        }
        
        public function IndexAdmin_Maintance()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homeadmin');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__maintance';

            $__active_maintance = 'active';

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

                $__maintace__ = $this->__db->queryid(" SELECT Id, App, Status FROM Maintance WHERE App = '". __Aplikasi()['Aplikasi'] ."' ");
                
                if ( $__maintace__->Status == 'Y' ) {

                    $__checked  = 'checked';
                    $__values   = 'Y';

                } else {

                    $__checked  = '';
                    $__values   = 'N';

                }
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

            }
        }

        public function IndexAdmin_Maintance_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Status'          => isset($data['__Status']) ? stripslashes(strip_tags(htmlspecialchars($data['__Status'], ENT_QUOTES))) : '',
            ];

            // $_SESSION['__Old__'] = [
            //     '__Ta'              => $__clean_data['__Ta'],
            //     '__Semester'        => $__clean_data['__Semester'],
            //     '__Biaya'           => $__clean_data['__Biaya'],
            // ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    '__Status'      => $this->__helpers->SecretOpen( $__clean_data['__Status'] ),
                    '__User'        => self::__Session__()['__Nama'],
                    '__Log'         => date('Y-m-d H:i:s'),
                    '__Id'          => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Maintance SET
                                        Status      = :__Status,
                                        Users       = :__User, 
                                        Logs        = :__Log
                                    WHERE Id        = :__Id
                                "
                            ) -> execute ( $__session );

                            unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );
                            
                        $this->__db->commit();

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

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