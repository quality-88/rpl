<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/HakAkses.php';

    class HomeadminHakAksesController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__HakAksesModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__HakAksesModel = new __HakAksesModel($this->__db);
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
        
        public function IndexAdmin_HakAkses()
        {
            $__header       = 'Hak Akses | ';
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__settingdata_hakakses';

            $__active_hakakses = 'active';

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

            } 

                $__result_sessionlogin = self::__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                $__authlogin__ = $this->__db->queryid(" SELECT TOP 1 IdLogin AS Id, Nama, Status AS Level FROM Tbl_Login WHERE IdLogin = '". $__session_login__['__Id'] ."' AND Status = 'Admin' ORDER BY IdLogin DESC ");

                if ( isset($__authlogin__->Id) ) {

                    $__filter_user__ = $this->__db->query(" SELECT Id, Keterangan AS Nama, Divisi FROM InventoryId WHERE Aktif = 'Y' AND UserId <> '' AND Divisi <> '' ORDER BY Keterangan ASC ");

                    $__record_data__ = $this->__HakAksesModel->read();
                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/administrator/__data.php';

                } else {

                    $_SESSION = array();
                    session_unset();
                    session_destroy();
                    redirect(url('/'), '03', 'Akses Di Tolak !');
                    exit();

                }

        }

        public function IndexAdmin_HakAkses_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__User'            => isset($data['__User']) ? stripslashes(strip_tags(htmlspecialchars($data['__User'], ENT_QUOTES))) : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( !$__clean_data['__User'] ) 
                {
                    redirect($__clean_data['__Url'], '03', 'Harap Mengisi Form Dengan Benar !');
                    exit();
                }

                $__check_user__ = $this->__db->queryrow(" SELECT Id_Rpl_HakAkses AS Id FROM Tbl_Rpl_HakAkses WHERE IdUser_Rpl_HakAkses = '". $__clean_data['__User'] ."' ");

                if ( $__check_user__ == TRUE ) 
                {
                    redirect($__clean_data['__Url'], '03', 'Pilihan User Sudah Di Buatkan, Harap Memilih User Yang Belum tersedia !');
                    exit();
                }

                $__explode__ = explode('-||-',$__clean_data['__User']);

                $__session = [
                    'IdUser_Rpl_HakAkses'   => $__explode__[0],
                    'Ket_Rpl_HakAkses'      => $__explode__[1],
                    'Status_Rpl_HakAkses'   => 'Y',
                    'User_Rpl_HakAkses'     => self::__Session__()['__Nama'],
                    'Log_Rpl_HakAkses'      => date('Y-m-d H:i:s'),
                    'Kampus'                => __Aplikasi()['Kampus'],
                    'Data'                  => 'Y',
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__HakAksesModel->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'],$_SESSION['__Old__'] );
                                
                                $this->__db->commit();

                                redirect($__clean_data['__Url'], '01', 'Berhasil Simpan Data');
                                exit();

                            } else {

                                $this->__db->rollback();
                                
                                redirect($__clean_data['__Url'], '03', 'Error Query');
                                exit();

                            }

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
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

        public function IndexAdmin_HakAkses_Hapus()
        {
            $__clean_data = [
                '__Token'   => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'     => url('/homeadmin/hakakses'),
                '__Id'      => isset($_GET['__Id']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__Id'], ENT_QUOTES))) : '',
            ];

            $fileId = isset($__clean_data['__Id']) ? intval($__clean_data['__Id']) : 0;

            if ( $fileId <= 0 ) {
                
                redirect($__clean_data['__Url'], '03', 'ID Tidak Valid !');
                exit();
                
            }

            $fileRecord = $this->__HakAksesModel->read(['Id' => $fileId]); 

            if ( !$fileRecord ) {

                redirect($__clean_data['__Url'], '03', 'Data Tidak Ditemukan !');
                exit();
                
            }

            $__session = [
                '__Id' => $fileRecord->Id,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__query_result = $this->__HakAksesModel->delete( $__session );

                        if ( $__query_result['Error'] === '000' ) {

                            unset( $_SESSION['__Form_Notifikasi__'],$_SESSION['__Old__'] );
                            
                            $this->__db->commit();

                            redirect($__clean_data['__Url'], '01', 'Berhasil Hapus Data');
                            exit();

                        } else {

                            $this->__db->rollback();

                            redirect($__clean_data['__Url'], '03', 'Error Query');
                            exit();

                        }

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }
    }