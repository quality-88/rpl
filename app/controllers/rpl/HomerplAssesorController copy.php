<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';

    class HomerplAssesorController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
        }

        public function __Header()
        {
            return 'RPL | ';
        }
        
        public function __Routes_Mod__()
        {
            return '/homerpl/assesor';
        }

        public function IndexRpl_Assesor()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = '/homerpl';
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__assesor';

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

                $__session_kuotaassesor = [
                    'Ta'        => $__authlogin__->Ta,
                    'Semester'  => $__authlogin__->Semester,
                    'Prodi'     => $__authlogin__->Prodi,
                ];

                $__check_assesor = $this->__Assesor__( ['Check' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__assesor_1 = $this->__Assesor__( ['Assesor_1' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__assesor_2 = $this->__Assesor__( ['Assesor_2' => '2', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__assesor_3 = $this->__Assesor__( ['Assesor_3' => '3', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                
                if ( $__assesor_1->Id == FALSE ) {

                    $__data_kuotadosen = $this->__Data_KuotaDosen__( $__session_kuotaassesor );
                    
                    if ( $__check_assesor == FALSE ) {

                        $__session_1__ = [
                            'Status'                    => 'Tambah',
                            'Assesor'                   => '',
                            'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen,
                            'As1_Status_Rpl_Assesor'    => 'N',
                            'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                            'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                            'As2_Dosen_Rpl_Assesor'     => '',
                            'As2_Status_Rpl_Assesor'    => '',
                            'As2_TglDaftar_Rpl_Assesor' => '',
                            'As2_TglHapus_Rpl_Assesor'  => '',
                            'As3_Dosen_Rpl_Assesor'     => '',
                            'As3_Status_Rpl_Assesor'    => '',
                            'As3_TglDaftar_Rpl_Assesor' => '',
                            'As3_TglHapus_Rpl_Assesor'  => '',
                            'User_Rpl_Assesor'          => $__authlogin__->Nama,
                            'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                            'IdKampus'                  => __Aplikasi()['IdKampus'],
                            'Kampus'                    => __Aplikasi()['Kampus'],
                            'Data'                      => 'Y',
                            'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                        ];

                        $__query_assesor = $this->__Query_Assesor__( $__session_1__ );
                        
                        redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                        exit();

                    } else {

                        if ( $__assesor_1->Id == TRUE ) {
                        
                            $__data_assesor_pendaftar_1__ = $this->__Assesor__( ['Assesor_1' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );

                            $__session_1__ = [
                                'Status'                    => 'Ubah',
                                'Assesor'                   => '',
                                'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen,
                                'As1_Status_Rpl_Assesor'    => 'N',
                                'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                'As2_Dosen_Rpl_Assesor'     => '',
                                'As2_Status_Rpl_Assesor'    => '',
                                'As2_TglDaftar_Rpl_Assesor' => '',
                                'As2_TglHapus_Rpl_Assesor'  => '',
                                'As3_Dosen_Rpl_Assesor'     => '',
                                'As3_Status_Rpl_Assesor'    => '',
                                'As3_TglDaftar_Rpl_Assesor' => '',
                                'As3_TglHapus_Rpl_Assesor'  => '',
                                'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                'IdKampus'                  => __Aplikasi()['IdKampus'],
                                'Kampus'                    => __Aplikasi()['Kampus'],
                                'Data'                      => 'Y',
                                'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_1__['Id_Rpl_Assesor'],
                            ];

                            $__query_assesor = $this->__Query_Assesor__( $__session_1__ );
                            
                            redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                            exit();

                        }

                    }

                }

                if ( $__assesor_2->Id == FALSE ) {

                    $__data_kuotadosen = $this->__Data_KuotaDosen__( $__session_kuotaassesor );

                    echo json_encode($__data_kuotadosen); die();

                    if ( $__check_assesor == FALSE ) {

                        $__session_2__ = [
                            'Status'                    => 'Tambah',
                            'Assesor'                   => '',
                            'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen,
                            'As1_Status_Rpl_Assesor'    => 'N',
                            'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                            'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                            'As2_Dosen_Rpl_Assesor'     => '',
                            'As2_Status_Rpl_Assesor'    => '',
                            'As2_TglDaftar_Rpl_Assesor' => '',
                            'As2_TglHapus_Rpl_Assesor'  => '',
                            'As3_Dosen_Rpl_Assesor'     => '',
                            'As3_Status_Rpl_Assesor'    => '',
                            'As3_TglDaftar_Rpl_Assesor' => '',
                            'As3_TglHapus_Rpl_Assesor'  => '',
                            'User_Rpl_Assesor'          => $__authlogin__->Nama,
                            'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                            'IdKampus'                  => __Aplikasi()['IdKampus'],
                            'Kampus'                    => __Aplikasi()['Kampus'],
                            'Data'                      => 'Y',
                            'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                        ];

                        $__query_assesor = $this->__Query_Assesor__( $__session_2__ );
                        
                        redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                        exit();

                    } else {
                        
                        if ( $__assesor_2->Id == TRUE ) {

                            $__data_assesor_pendaftar_2__ = $this->__Assesor__( ['Assesor_2' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );

                            $__session_2__ = [
                                'Status'                    => 'Ubah',
                                'Assesor'                   => '',
                                'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen,
                                'As1_Status_Rpl_Assesor'    => 'N',
                                'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                'As2_Dosen_Rpl_Assesor'     => '',
                                'As2_Status_Rpl_Assesor'    => '',
                                'As2_TglDaftar_Rpl_Assesor' => '',
                                'As2_TglHapus_Rpl_Assesor'  => '',
                                'As3_Dosen_Rpl_Assesor'     => '',
                                'As3_Status_Rpl_Assesor'    => '',
                                'As3_TglDaftar_Rpl_Assesor' => '',
                                'As3_TglHapus_Rpl_Assesor'  => '',
                                'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                'IdKampus'                  => __Aplikasi()['IdKampus'],
                                'Kampus'                    => __Aplikasi()['Kampus'],
                                'Data'                      => 'Y',
                                'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_2__['Id_Rpl_Assesor'],
                            ];

                            $__query_assesor = $this->__Query_Assesor__( $__session_2__ );
                            
                            redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                            exit();

                        }

                    }

                }

                if ( $__assesor_3->Id == FALSE ) {

                    $__data_kuotadosen = $this->__Data_KuotaDosen__( $__session_kuotaassesor );

                    if ( $__check_assesor == FALSE ) {

                        $__session_3__ = [
                            'Status'                    => 'Tambah',
                            'Assesor'                   => '',
                            'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen,
                            'As1_Status_Rpl_Assesor'    => 'N',
                            'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                            'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                            'As2_Dosen_Rpl_Assesor'     => '',
                            'As2_Status_Rpl_Assesor'    => '',
                            'As2_TglDaftar_Rpl_Assesor' => '',
                            'As2_TglHapus_Rpl_Assesor'  => '',
                            'As3_Dosen_Rpl_Assesor'     => '',
                            'As3_Status_Rpl_Assesor'    => '',
                            'As3_TglDaftar_Rpl_Assesor' => '',
                            'As3_TglHapus_Rpl_Assesor'  => '',
                            'User_Rpl_Assesor'          => $__authlogin__->Nama,
                            'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                            'IdKampus'                  => __Aplikasi()['IdKampus'],
                            'Kampus'                    => __Aplikasi()['Kampus'],
                            'Data'                      => 'Y',
                            'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                        ];

                        $__query_assesor = $this->__Query_Assesor__( $__session_3__ );
                        
                        redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                        exit();

                    } else {
                        
                        if ( $__assesor_2->Id == TRUE ) {

                            $__data_assesor_pendaftar_3__ = $this->__Assesor__( ['Assesor_3' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );

                            $__session_3__ = [
                                'Status'                    => 'Ubah',
                                'Assesor'                   => '',
                                'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen,
                                'As1_Status_Rpl_Assesor'    => 'N',
                                'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                'As2_Dosen_Rpl_Assesor'     => '',
                                'As2_Status_Rpl_Assesor'    => '',
                                'As2_TglDaftar_Rpl_Assesor' => '',
                                'As2_TglHapus_Rpl_Assesor'  => '',
                                'As3_Dosen_Rpl_Assesor'     => '',
                                'As3_Status_Rpl_Assesor'    => '',
                                'As3_TglDaftar_Rpl_Assesor' => '',
                                'As3_TglHapus_Rpl_Assesor'  => '',
                                'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                'IdKampus'                  => __Aplikasi()['IdKampus'],
                                'Kampus'                    => __Aplikasi()['Kampus'],
                                'Data'                      => 'Y',
                                'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_3__['Id_Rpl_Assesor'],
                            ];

                            $__query_assesor = $this->__Query_Assesor__( $__session_3__ );
                            
                            redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                            exit();

                        }

                    }

                }

                echo 'asdasdas'; die();
                
                // require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function __Assesor__( array $data )
        {
            if ( $data['Check'] == '1' ) {

                $result = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' ");
                
            } elseif ( $data['Assesor_1'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Assesor_2'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As2_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Assesor_3'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As3_Dosen_Rpl_Assesor <> '' ");

            }

            return $result;
        }

        public function __Data_KuotaDosen__( array $data )
        {
            $result = $this->__db->query(" SELECT Id_Rpl_KuotaAssesor AS Id, Ta_Rpl_KuotaAssesor AS Ta, Semester_Rpl_KuotaAssesor AS Semester, IdDosen_Rpl_KuotaAssesor AS IdDosen, Prodi_Rpl_KuotaAssesor AS Prodi, Kuota_Rpl_KuotaAssesor AS Kuota, User_Rpl_KuotaAssesor AS Users, Log_Rpl_KuotaAssesor AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_KuotaAssesor WHERE Ta_Rpl_KuotaAssesor = '". $data['Ta'] ."' AND Semester_Rpl_KuotaAssesor = '". $data['Semester'] ."' AND Data = 'Y' AND Prodi_Rpl_KuotaAssesor = '". $data['Prodi'] ."' ORDER BY Kuota_Rpl_KuotaAssesor DESC ");

                foreach ( $result AS $data => $row ) :

                    $__kuota_dosen_1 = $this->__db->queryid(" SELECT COUNT( As1_Dosen_Rpl_Assesor ) AS Total FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor <> '' ");

                    $__check_dosen_1 = $this->__db->queryrow(" SELECT As1_Dosen_Rpl_Assesor AS Dosen FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor = '". $row->IdDosen ."' ");

                    $__check_dosen_2 = $this->__db->queryrow(" SELECT As2_Dosen_Rpl_Assesor AS Dosen FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor = '". $row->IdDosen ."' ");

                    $__check_dosen_3 = $this->__db->queryrow(" SELECT As3_Dosen_Rpl_Assesor AS Dosen FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor = '". $row->IdDosen ."' ");

                    if ( $__check_dosen_1 == FALSE ) {

                        if ( $__check_dosen_2 == FALSE ) {

                            if ( $__check_dosen_3 == FALSE ) {

                                return $row->IdDosen;

                            }

                        }

                    }

                endforeach;
        }

        public function __Query_Assesor__( array $data )
        {
            if ( $data['Status'] == 'Tambah' ) {

                $__session = [
                    'As1_Dosen_Rpl_Assesor'         => isset($data['As1_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_Status_Rpl_Assesor'        => isset($data['As1_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_TglDaftar_Rpl_Assesor'     => isset($data['As1_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_TglHapus_Rpl_Assesor'      => isset($data['As1_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Dosen_Rpl_Assesor'         => isset($data['As2_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Status_Rpl_Assesor'        => isset($data['As2_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_TglDaftar_Rpl_Assesor'     => isset($data['As2_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_TglHapus_Rpl_Assesor'      => isset($data['As2_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Dosen_Rpl_Assesor'         => isset($data['As3_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Status_Rpl_Assesor'        => isset($data['As3_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_TglDaftar_Rpl_Assesor'     => isset($data['As3_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_TglHapus_Rpl_Assesor'      => isset($data['As3_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'IdKampus'                      => isset($data['IdKampus']) ? stripslashes(strip_tags(htmlspecialchars($data['IdKampus'], ENT_QUOTES))) : '',
                    'Kampus'                        => isset($data['Kampus']) ? stripslashes(strip_tags(htmlspecialchars($data['Kampus'], ENT_QUOTES))) : '',
                    'Data'                          => isset($data['Data']) ? stripslashes(strip_tags(htmlspecialchars($data['Data'], ENT_QUOTES))) : '',
                    'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                ];

            } else {

                if ( $data['Assesor'] == '1' ) {

                    $__session = [
                        'As1_Dosen_Rpl_Assesor'         => isset($data['As1_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As1_Status_Rpl_Assesor'        => isset($data['As1_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As1_TglDaftar_Rpl_Assesor'     => isset($data['As1_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As1_TglHapus_Rpl_Assesor'      => isset($data['As1_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                    ];

                } elseif ( $data['Assesor'] == '2' ) {

                    $__session = [
                        'As2_Dosen_Rpl_Assesor'         => isset($data['As2_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_Status_Rpl_Assesor'        => isset($data['As2_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_TglDaftar_Rpl_Assesor'     => isset($data['As2_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_TglHapus_Rpl_Assesor'      => isset($data['As2_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                    ];

                } elseif ( $data['Assesor'] == '3' ) {

                    $__session = [
                        'As3_Dosen_Rpl_Assesor'         => isset($data['As3_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_Status_Rpl_Assesor'        => isset($data['As3_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_TglDaftar_Rpl_Assesor'     => isset($data['As3_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_TglHapus_Rpl_Assesor'      => isset($data['As3_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                    ];

                }

            }

                try {

                    $this->__db->beginTransaction();

                        if ( $data['Status'] == 'Tambah' ) {

                            $__sql = $this->__db->prepare( 
                                "
                                    INSERT INTO Tbl_Rpl_Assesor
                                    (
                                        As1_Dosen_Rpl_Assesor, As1_Status_Rpl_Assesor, As1_TglDaftar_Rpl_Assesor, As1_TglHapus_Rpl_Assesor, 
                                        As2_Dosen_Rpl_Assesor, As2_Status_Rpl_Assesor, As2_TglDaftar_Rpl_Assesor, As2_TglHapus_Rpl_Assesor,
                                        As3_Dosen_Rpl_Assesor, As3_Status_Rpl_Assesor, As3_TglDaftar_Rpl_Assesor, As3_TglHapus_Rpl_Assesor,
                                        User_Rpl_Assesor, Log_Rpl_Assesor, IdKampus, Kampus, Data,
                                        Id_Rpl_Pendaftaran
                                    )
                                VALUES
                                    (
                                        :As1_Dosen_Rpl_Assesor, :As1_Status_Rpl_Assesor, :As1_TglDaftar_Rpl_Assesor, :As1_TglHapus_Rpl_Assesor,
                                        :As2_Dosen_Rpl_Assesor, :As2_Status_Rpl_Assesor, :As2_TglDaftar_Rpl_Assesor, :As2_TglHapus_Rpl_Assesor,
                                        :As3_Dosen_Rpl_Assesor, :As3_Status_Rpl_Assesor, :As3_TglDaftar_Rpl_Assesor, :As3_TglHapus_Rpl_Assesor,
                                        :User_Rpl_Assesor, :Log_Rpl_Assesor, :IdKampus, :Kampus, :Data,
                                        :Id_Rpl_Pendaftaran
                                    )
                                "
                            ) -> execute ( $__session );

                        } else {

                            if ( $data['Assesor'] == '1' ) {

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Assesor SET
                                            As1_Dosen_Rpl_Assesor       = :As1_Dosen_Rpl_Assesor, 
                                            As1_Status_Rpl_Assesor      = :As1_Status_Rpl_Assesor, 
                                            As1_TglDaftar_Rpl_Assesor   = :As1_TglDaftar_Rpl_Assesor, 
                                            As1_TglHapus_Rpl_Assesor    = :As1_TglHapus_Rpl_Assesor, 
                                            User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                            Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                        WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                        AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                    "
                                ) -> execute ( $__session );

                            } elseif ( $data['Assesor'] == '2' ) {

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Assesor SET
                                            As2_Dosen_Rpl_Assesor       = :As2_Dosen_Rpl_Assesor, 
                                            As2_Status_Rpl_Assesor      = :As2_Status_Rpl_Assesor, 
                                            As2_TglDaftar_Rpl_Assesor   = :As2_TglDaftar_Rpl_Assesor, 
                                            As2_TglHapus_Rpl_Assesor    = :As2_TglHapus_Rpl_Assesor, 
                                            User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                            Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                        WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                        AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                    "
                                ) -> execute ( $__session );

                            } elseif ( $data['Assesor'] == '3' ) {

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Assesor SET
                                            As3_Dosen_Rpl_Assesor       = :As3_Dosen_Rpl_Assesor, 
                                            As3_Status_Rpl_Assesor      = :As3_Status_Rpl_Assesor, 
                                            As3_TglDaftar_Rpl_Assesor   = :As3_TglDaftar_Rpl_Assesor, 
                                            As3_TglHapus_Rpl_Assesor    = :As3_TglHapus_Rpl_Assesor, 
                                            User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                            Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                        WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                        AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                    "
                                ) -> execute ( $__session );

                            } else {

                                return [
                                    'Error'   => '999',
                                    'Message' => 'Tidak Ada Query !',
                                    'Data'    => [],
                                ];
                                exit();

                            }

                        }

                    $this->__db->commit();

                        return [
                            'Error'   => '000',
                            'Message' => 'Berhasil Menambahkan Kuota Assesor Data !',
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