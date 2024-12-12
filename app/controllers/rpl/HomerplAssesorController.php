<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor2.php';
    require_once dirname(__DIR__) . '/../models/dosen/Sk.php';
    require_once dirname(__DIR__) . '/../models/AssesorEmail.php';

    class HomerplAssesorController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__Assesor2Model;
        protected $__SkModel;
        protected $__AssesorEmailModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__Assesor2Model = new __Assesor2Model($this->__db);
            $this->__SkModel = new __SkModel($this->__db);
            $this->__AssesorEmailModel = new __AssesorEmailModel($this->__db);
        }

        public function __Header()
        {
            return 'RPL | ';
        }
        
        public function __Routes_Mod__()
        {
            return url('/homerpl/assesor');
        }

        public function IndexRpl_Assesor()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
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
                    'Id_Rpl_Pendaftaran' => $__authlogin__->Id,
                ];

                $__check_assesor = $this->__Assesor__( ['Check' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__assesor_1 = $this->__Assesor__( ['Assesor_1' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__assesor_2 = $this->__Assesor__( ['Assesor_2' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__assesor_3 = $this->__Assesor__( ['Assesor_3' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                
                if ( $__assesor_1->Id == FALSE ) {

                    $__data_kuotadosen = $this->__Data_KuotaDosen__( $__session_kuotaassesor );
                    
                    if ( isset($__data_kuotadosen[0]) AND  $__data_kuotadosen[0] == TRUE ) {

                        if ( $__check_assesor == FALSE ) {

                            $__session_1__ = [
                                'Status'                    => 'Tambah',
                                'Assesor'                   => '',
                                'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                'As1_Status_Rpl_Assesor'    => 'N',
                                'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                'As1_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                'As1_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                'As1_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                'As2_Dosen_Rpl_Assesor'     => '',
                                'As2_Status_Rpl_Assesor'    => '',
                                'As2_TglDaftar_Rpl_Assesor' => '',
                                'As2_TglHapus_Rpl_Assesor'  => '',
                                'As2_Ta_Rpl_Assesor'        => '',
                                'As2_Semester_Rpl_Assesor'  => '',
                                'As2_Prodi_Rpl_Assesor'     => '',
                                'As3_Dosen_Rpl_Assesor'     => '',
                                'As3_Status_Rpl_Assesor'    => '',
                                'As3_TglDaftar_Rpl_Assesor' => '',
                                'As3_TglHapus_Rpl_Assesor'  => '',
                                'As3_Ta_Rpl_Assesor'        => '',
                                'As3_Semester_Rpl_Assesor'  => '',
                                'As3_Prodi_Rpl_Assesor'     => '',
                                'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                'IdKampus'                  => __Aplikasi()['IdKampus'],
                                'Kampus'                    => __Aplikasi()['Kampus'],
                                'Data'                      => 'Y',
                                'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                            ];

                            $__query_assesor = $this->__Query_Assesor__( $__session_1__ );
                            
                            if ( $__query_assesor['Error'] == '000' ) {

                                $__session_ubahkuotaasesor_1__ = [
                                    'Nama'      => $__authlogin__->Nama,
                                    'IdDosen'   => $__session_1__['As1_Dosen_Rpl_Assesor'],
                                    'Ta'        => $__authlogin__->Ta,
                                    'Semester'  => $__authlogin__->Semester,
                                    'Prodi'     => $__authlogin__->Prodi,
                                ];

                                $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_1__ );

                            }
                            
                            redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                            exit();

                        } else {

                            if ( $__assesor_1->Id == TRUE ) {
                            
                                // $__data_assesor_pendaftar_1__ = $this->__Assesor__( ['Assesor_1' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );

                                $__session_1__ = [
                                    'Status'                    => 'Ubah',
                                    'Assesor'                   => '1',
                                    'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                    'As1_Status_Rpl_Assesor'    => 'N',
                                    'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                    'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                    'As1_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                    'As1_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                    'As1_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                    'As2_Dosen_Rpl_Assesor'     => '',
                                    'As2_Status_Rpl_Assesor'    => '',
                                    'As2_TglDaftar_Rpl_Assesor' => '',
                                    'As2_TglHapus_Rpl_Assesor'  => '',
                                    'As2_Ta_Rpl_Assesor'        => '',
                                    'As2_Semester_Rpl_Assesor'  => '',
                                    'As2_Prodi_Rpl_Assesor'     => '',
                                    'As3_Dosen_Rpl_Assesor'     => '',
                                    'As3_Status_Rpl_Assesor'    => '',
                                    'As3_TglDaftar_Rpl_Assesor' => '',
                                    'As3_TglHapus_Rpl_Assesor'  => '',
                                    'As3_Ta_Rpl_Assesor'        => '',
                                    'As3_Semester_Rpl_Assesor'  => '',
                                    'As3_Prodi_Rpl_Assesor'     => '',
                                    'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                    'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                    'IdKampus'                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                    => __Aplikasi()['Kampus'],
                                    'Data'                      => 'Y',
                                    'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                    'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_1__['Id_Rpl_Assesor'],
                                ];

                                $__query_assesor = $this->__Query_Assesor__( $__session_1__ );

                                if ( $__query_assesor['Error'] == '000' ) {

                                    $__session_ubahkuotaasesor_1__ = [
                                        'Nama'      => $__authlogin__->Nama,
                                        'IdDosen'   => $__session_1__['As1_Dosen_Rpl_Assesor'],
                                        'Ta'        => $__authlogin__->Ta,
                                        'Semester'  => $__authlogin__->Semester,
                                        'Prodi'     => $__authlogin__->Prodi,
                                    ];

                                    $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_1__ );

                                }
                                
                                redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                                exit();

                            } else {

                                $__check_hapus_assesor__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_HapusAssesor AS Id FROM Tbl_Rpl_Assesor_HapusAssesor WHERE Assesor_Rpl_Assesor_HapusAssesor = '1' AND Id_Rpl_Pendaftaran = '". $__session_kuotaassesor['Id_Rpl_Pendaftaran'] ."' ");

                                if ( $__check_hapus_assesor__ == TRUE ) {

                                    $__session_1__ = [
                                        'Status'                    => 'Ubah',
                                        'Assesor'                   => '1',
                                        'As1_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                        'As1_Status_Rpl_Assesor'    => 'N',
                                        'As1_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                        'As1_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                        'As1_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                        'As1_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                        'As1_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                        'As2_Dosen_Rpl_Assesor'     => '',
                                        'As2_Status_Rpl_Assesor'    => '',
                                        'As2_TglDaftar_Rpl_Assesor' => '',
                                        'As2_TglHapus_Rpl_Assesor'  => '',
                                        'As2_Ta_Rpl_Assesor'        => '',
                                        'As2_Semester_Rpl_Assesor'  => '',
                                        'As2_Prodi_Rpl_Assesor'     => '',
                                        'As3_Dosen_Rpl_Assesor'     => '',
                                        'As3_Status_Rpl_Assesor'    => '',
                                        'As3_TglDaftar_Rpl_Assesor' => '',
                                        'As3_TglHapus_Rpl_Assesor'  => '',
                                        'As3_Ta_Rpl_Assesor'        => '',
                                        'As3_Semester_Rpl_Assesor'  => '',
                                        'As3_Prodi_Rpl_Assesor'     => '',
                                        'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                        'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                        'IdKampus'                  => __Aplikasi()['IdKampus'],
                                        'Kampus'                    => __Aplikasi()['Kampus'],
                                        'Data'                      => 'Y',
                                        'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                        'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_1__['Id_Rpl_Assesor'],
                                    ];

                                    $__query_assesor = $this->__Query_Assesor__( $__session_1__ );

                                    if ( $__query_assesor['Error'] == '000' ) {

                                        $__session_ubahkuotaasesor_1__ = [
                                            'Nama'      => $__authlogin__->Nama,
                                            'IdDosen'   => $__session_1__['As1_Dosen_Rpl_Assesor'],
                                            'Ta'        => $__authlogin__->Ta,
                                            'Semester'  => $__authlogin__->Semester,
                                            'Prodi'     => $__authlogin__->Prodi,
                                        ];

                                        $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_1__ );

                                    }
                                    
                                    redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                                    exit();

                                }

                            }

                        }

                    }

                }

                if ( $__assesor_2->Id == FALSE ) {

                    $__data_kuotadosen = $this->__Data_KuotaDosen__( $__session_kuotaassesor );
                    
                    if ( isset($__data_kuotadosen[0]) AND $__data_kuotadosen[0] == TRUE ) {

                        if ( $__check_assesor == TRUE ) {
                            
                            if ( $__assesor_2->Id == FALSE ) {
                            
                                // $__data_assesor_pendaftar_2__ = $this->__Assesor__( ['Assesor_2' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );

                                $__session_2__ = [
                                    'Status'                    => 'Ubah',
                                    'Assesor'                   => '2',
                                    'As1_Dosen_Rpl_Assesor'     => '',
                                    'As1_Status_Rpl_Assesor'    => '',
                                    'As1_TglDaftar_Rpl_Assesor' => '',
                                    'As1_TglHapus_Rpl_Assesor'  => '',
                                    'As1_Ta_Rpl_Assesor'        => '',
                                    'As1_Semester_Rpl_Assesor'  => '',
                                    'As1_Prodi_Rpl_Assesor'     => '',
                                    'As2_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                    'As2_Status_Rpl_Assesor'    => 'N',
                                    'As2_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                    'As2_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                    'As2_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                    'As2_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                    'As2_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                    'As3_Dosen_Rpl_Assesor'     => '',
                                    'As3_Status_Rpl_Assesor'    => '',
                                    'As3_TglDaftar_Rpl_Assesor' => '',
                                    'As3_TglHapus_Rpl_Assesor'  => '',
                                    'As3_Ta_Rpl_Assesor'        => '',
                                    'As3_Semester_Rpl_Assesor'  => '',
                                    'As3_Prodi_Rpl_Assesor'     => '',
                                    'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                    'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                    'IdKampus'                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                    => __Aplikasi()['Kampus'],
                                    'Data'                      => 'Y',
                                    'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                    'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_2__['Id_Rpl_Assesor'],
                                ];

                                $__query_assesor = $this->__Query_Assesor__( $__session_2__ );

                                if ( $__query_assesor['Error'] == '000' ) {

                                    $__session_ubahkuotaasesor_2__ = [
                                        'Nama'      => $__authlogin__->Nama,
                                        'IdDosen'   => $__session_2__['As2_Dosen_Rpl_Assesor'],
                                        'Ta'        => $__authlogin__->Ta,
                                        'Semester'  => $__authlogin__->Semester,
                                        'Prodi'     => $__authlogin__->Prodi,
                                    ];

                                    $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_2__ );

                                }
                                
                                redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                                exit();

                            } else {

                                $__check_hapus_assesor__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_HapusAssesor AS Id FROM Tbl_Rpl_Assesor_HapusAssesor WHERE Assesor_Rpl_Assesor_HapusAssesor = '2' AND Id_Rpl_Pendaftaran = '". $__session_kuotaassesor['Id_Rpl_Pendaftaran'] ."' ");

                                if ( $__check_hapus_assesor__ == TRUE ) {

                                    $__session_2__ = [
                                        'Status'                    => 'Ubah',
                                        'Assesor'                   => '2',
                                        'As1_Dosen_Rpl_Assesor'     => '',
                                        'As1_Status_Rpl_Assesor'    => '',
                                        'As1_TglDaftar_Rpl_Assesor' => '',
                                        'As1_TglHapus_Rpl_Assesor'  => '',
                                        'As1_Ta_Rpl_Assesor'        => '',
                                        'As1_Semester_Rpl_Assesor'  => '',
                                        'As1_Prodi_Rpl_Assesor'     => '',
                                        'As2_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                        'As2_Status_Rpl_Assesor'    => 'N',
                                        'As2_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                        'As2_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                        'As2_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                        'As2_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                        'As2_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                        'As3_Dosen_Rpl_Assesor'     => '',
                                        'As3_Status_Rpl_Assesor'    => '',
                                        'As3_TglDaftar_Rpl_Assesor' => '',
                                        'As3_TglHapus_Rpl_Assesor'  => '',
                                        'As3_Ta_Rpl_Assesor'        => '',
                                        'As3_Semester_Rpl_Assesor'  => '',
                                        'As3_Prodi_Rpl_Assesor'     => '',
                                        'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                        'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                        'IdKampus'                  => __Aplikasi()['IdKampus'],
                                        'Kampus'                    => __Aplikasi()['Kampus'],
                                        'Data'                      => 'Y',
                                        'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                        'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_2__['Id_Rpl_Assesor'],
                                    ];

                                    $__query_assesor = $this->__Query_Assesor__( $__session_2__ );

                                    if ( $__query_assesor['Error'] == '000' ) {

                                        $__session_ubahkuotaasesor_2__ = [
                                            'Nama'      => $__authlogin__->Nama,
                                            'IdDosen'   => $__session_2__['As2_Dosen_Rpl_Assesor'],
                                            'Ta'        => $__authlogin__->Ta,
                                            'Semester'  => $__authlogin__->Semester,
                                            'Prodi'     => $__authlogin__->Prodi,
                                        ];

                                        $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_2__ );

                                    }
                                    
                                    redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                                    exit();

                                }

                            }

                        } else {

                            $__session_2__ = [
                                'Status'                    => 'Tambah',
                                'Assesor'                   => '',
                                'As1_Dosen_Rpl_Assesor'     => '',
                                'As1_Status_Rpl_Assesor'    => '',
                                'As1_TglDaftar_Rpl_Assesor' => '',
                                'As1_TglHapus_Rpl_Assesor'  => '',
                                'As1_Ta_Rpl_Assesor'        => '',
                                'As1_Semester_Rpl_Assesor'  => '',
                                'As1_Prodi_Rpl_Assesor'     => '',
                                'As2_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                'As2_Status_Rpl_Assesor'    => 'N',
                                'As2_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                'As2_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                'As2_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                'As2_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                'As2_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                'As3_Dosen_Rpl_Assesor'     => '',
                                'As3_Status_Rpl_Assesor'    => '',
                                'As3_TglDaftar_Rpl_Assesor' => '',
                                'As3_TglHapus_Rpl_Assesor'  => '',
                                'As3_Ta_Rpl_Assesor'        => '',
                                'As3_Semester_Rpl_Assesor'  => '',
                                'As3_Prodi_Rpl_Assesor'     => '',
                                'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                'IdKampus'                  => __Aplikasi()['IdKampus'],
                                'Kampus'                    => __Aplikasi()['Kampus'],
                                'Data'                      => 'Y',
                                'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                            ];

                            $__query_assesor = $this->__Query_Assesor__( $__session_2__ );
                            
                            if ( $__query_assesor['Error'] == '000' ) {

                                $__session_ubahkuotaasesor_2__ = [
                                    'Nama'      => $__authlogin__->Nama,
                                    'IdDosen'   => $__session_2__['As2_Dosen_Rpl_Assesor'],
                                    'Ta'        => $__authlogin__->Ta,
                                    'Semester'  => $__authlogin__->Semester,
                                    'Prodi'     => $__authlogin__->Prodi,
                                ];

                                $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_2__ );

                            }

                            redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                            exit();

                        }

                    }
                    
                }

                if ( $__assesor_3->Id == FALSE ) {

                    $__data_kuotadosen = $this->__Data_KuotaDosen__( $__session_kuotaassesor );
                    
                    if ( isset($__data_kuotadosen[0]) AND  $__data_kuotadosen[0] == TRUE ) {

                        if ( $__check_assesor == TRUE ) {

                            if ( $__assesor_3->Id == FALSE ) {
                            
                                // $__data_assesor_pendaftar_3__ = $this->__Assesor__( ['Assesor_3' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );

                                $__session_3__ = [
                                    'Status'                    => 'Ubah',
                                    'Assesor'                   => '3',
                                    'As1_Dosen_Rpl_Assesor'     => '',
                                    'As1_Status_Rpl_Assesor'    => '',
                                    'As1_TglDaftar_Rpl_Assesor' => '',
                                    'As1_TglHapus_Rpl_Assesor'  => '',
                                    'As1_Ta_Rpl_Assesor'        => '',
                                    'As1_Semester_Rpl_Assesor'  => '',
                                    'As1_Prodi_Rpl_Assesor'     => '',
                                    'As2_Dosen_Rpl_Assesor'     => '',
                                    'As2_Status_Rpl_Assesor'    => '',
                                    'As2_TglDaftar_Rpl_Assesor' => '',
                                    'As2_TglHapus_Rpl_Assesor'  => '',
                                    'As2_Ta_Rpl_Assesor'        => '',
                                    'As2_Semester_Rpl_Assesor'  => '',
                                    'As2_Prodi_Rpl_Assesor'     => '',
                                    'As3_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                    'As3_Status_Rpl_Assesor'    => 'N',
                                    'As3_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                    'As3_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                    'As3_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                    'As3_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                    'As3_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                    'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                    'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                    'IdKampus'                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                    => __Aplikasi()['Kampus'],
                                    'Data'                      => 'Y',
                                    'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                    'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_3__['Id_Rpl_Assesor'],
                                ];

                                $__query_assesor = $this->__Query_Assesor__( $__session_3__ );

                                if ( $__query_assesor['Error'] == '000' ) {

                                    $__session_ubahkuotaasesor_3__ = [
                                        'Nama'      => $__authlogin__->Nama,
                                        'IdDosen'   => $__session_3__['As3_Dosen_Rpl_Assesor'],
                                        'Ta'        => $__authlogin__->Ta,
                                        'Semester'  => $__authlogin__->Semester,
                                        'Prodi'     => $__authlogin__->Prodi,
                                    ];

                                    $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_3__ );

                                }
                                
                                redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                                exit();

                            } else {

                                $__check_hapus_assesor__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_HapusAssesor AS Id FROM Tbl_Rpl_Assesor_HapusAssesor WHERE Assesor_Rpl_Assesor_HapusAssesor = '3' AND Id_Rpl_Pendaftaran = '". $__session_kuotaassesor['Id_Rpl_Pendaftaran'] ."' ");

                                if ( $__check_hapus_assesor__ == TRUE ) {

                                    $__session_3__ = [
                                        'Status'                    => 'Ubah',
                                        'Assesor'                   => '3',
                                        'As1_Dosen_Rpl_Assesor'     => '',
                                        'As1_Status_Rpl_Assesor'    => '',
                                        'As1_TglDaftar_Rpl_Assesor' => '',
                                        'As1_TglHapus_Rpl_Assesor'  => '',
                                        'As1_Ta_Rpl_Assesor'        => '',
                                        'As1_Semester_Rpl_Assesor'  => '',
                                        'As1_Prodi_Rpl_Assesor'     => '',
                                        'As2_Dosen_Rpl_Assesor'     => '',
                                        'As2_Status_Rpl_Assesor'    => '',
                                        'As2_TglDaftar_Rpl_Assesor' => '',
                                        'As2_TglHapus_Rpl_Assesor'  => '',
                                        'As2_Ta_Rpl_Assesor'        => '',
                                        'As2_Semester_Rpl_Assesor'  => '',
                                        'As2_Prodi_Rpl_Assesor'     => '',
                                        'As3_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                        'As3_Status_Rpl_Assesor'    => 'N',
                                        'As3_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                        'As3_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                        'As3_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                        'As3_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                        'As3_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                        'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                        'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                        'IdKampus'                  => __Aplikasi()['IdKampus'],
                                        'Kampus'                    => __Aplikasi()['Kampus'],
                                        'Data'                      => 'Y',
                                        'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                                        'Id_Rpl_Assesor'            => $__data_assesor_pendaftar_3__['Id_Rpl_Assesor'],
                                    ];

                                    $__query_assesor = $this->__Query_Assesor__( $__session_3__ );

                                    if ( $__query_assesor['Error'] == '000' ) {

                                        $__session_ubahkuotaasesor_3__ = [
                                            'Nama'      => $__authlogin__->Nama,
                                            'IdDosen'   => $__session_3__['As3_Dosen_Rpl_Assesor'],
                                            'Ta'        => $__authlogin__->Ta,
                                            'Semester'  => $__authlogin__->Semester,
                                            'Prodi'     => $__authlogin__->Prodi,
                                        ];

                                        $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_3__ );

                                    }
                                    
                                    redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                                    exit();

                                }

                            }

                        } else {

                            $__session_3__ = [
                                'Status'                    => 'Tambah',
                                'Assesor'                   => '',
                                'As1_Dosen_Rpl_Assesor'     => '',
                                'As1_Status_Rpl_Assesor'    => '',
                                'As1_TglDaftar_Rpl_Assesor' => '',
                                'As1_TglHapus_Rpl_Assesor'  => '',
                                'As1_Ta_Rpl_Assesor'        => '',
                                'As1_Semester_Rpl_Assesor'  => '',
                                'As1_Prodi_Rpl_Assesor'     => '',
                                'As2_Dosen_Rpl_Assesor'     => '',
                                'As2_Status_Rpl_Assesor'    => '',
                                'As2_TglDaftar_Rpl_Assesor' => '',
                                'As2_TglHapus_Rpl_Assesor'  => '',
                                'As2_Ta_Rpl_Assesor'        => '',
                                'As2_Semester_Rpl_Assesor'  => '',
                                'As2_Prodi_Rpl_Assesor'     => '',
                                'As3_Dosen_Rpl_Assesor'     => $__data_kuotadosen[0],
                                'As3_Status_Rpl_Assesor'    => 'N',
                                'As3_TglDaftar_Rpl_Assesor' => date('Y-m-d H:i:s'),
                                'As3_TglHapus_Rpl_Assesor'  => $this->__helpers->__TambahTanggal(),
                                'As3_Ta_Rpl_Assesor'        => $__authlogin__->Ta,
                                'As3_Semester_Rpl_Assesor'  => $__authlogin__->Semester,
                                'As3_Prodi_Rpl_Assesor'     => $__authlogin__->Prodi,
                                'User_Rpl_Assesor'          => $__authlogin__->Nama,
                                'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                                'IdKampus'                  => __Aplikasi()['IdKampus'],
                                'Kampus'                    => __Aplikasi()['Kampus'],
                                'Data'                      => 'Y',
                                'Id_Rpl_Pendaftaran'        => $__authlogin__->Id,
                            ];

                            $__query_assesor = $this->__Query_Assesor__( $__session_3__ );
                            
                            if ( $__query_assesor['Error'] == '000' ) {

                                $__session_ubahkuotaasesor_3__ = [
                                    'Nama'      => $__authlogin__->Nama,
                                    'IdDosen'   => $__session_3__['As3_Dosen_Rpl_Assesor'],
                                    'Ta'        => $__authlogin__->Ta,
                                    'Semester'  => $__authlogin__->Semester,
                                    'Prodi'     => $__authlogin__->Prodi,
                                ];

                                $__query_ubah_kuotaassesor = $this->__Ubah_KuotaDosen__( $__session_ubahkuotaasesor_3__ );

                            }

                            redirect( $__routes_mod, $__query_assesor['Error'] === '000' ? '01' : '03', $__query_assesor['Message'] );
                            exit();

                        }

                    }

                }


                $__record_assesor = $this->__Assesor__( ['Show' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__->Id] );
                $__dosen_assesor_1 = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_assesor->D_1 ."' ORDER BY IdDosen DESC ");
                $__dosen_assesor_2 = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_assesor->D_2 ."' ORDER BY IdDosen DESC ");
                $__dosen_assesor_3 = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, EmailDosen, EmailPribadi, Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_assesor->D_3 ."' ORDER BY IdDosen DESC ");

                if ( $__record_assesor->S_1 == 'Y' ) {
                    
                    $__nomor_1__ = '1';
                    $__total_sks_1__ = '0';
                    $__record_data_detail_1__ = $this->__db->query(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $__record_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Ta_Rpl_Assesor_1 = '". $__authlogin__->Ta ."' AND Semester_Rpl_Assesor_1 = '". $__authlogin__->Semester ."' AND Prodi_Rpl_Assesor_1 = '". $__authlogin__->Prodi ."' ORDER BY Id_Rpl_Assesor_1 DESC ");
                    
                }

                if ( $__record_assesor->S_1 == 'Y' AND $__record_assesor->S_2 == 'Y' ) {
                    
                    if ( $__authlogin__->Jenis == 'TP' ) {

                        $__nomor_2__ = '1';
                        $__calon_rpl_berkas__ = $this->__db->query(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Data = 'Y' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        $__url_file_penunjang = $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl_penunjang/';

                    }
                    
                }

                if ( $__record_assesor->S_1 == 'Y' AND $__record_assesor->S_2 == 'Y' AND $__record_assesor->S_3 == 'Y' ) {
                    
                    $__record_data_detail_3__ = $this->__db->queryid(" SELECT Id_Rpl_Assesor_3 AS Id, Tgl_Rpl_Assesor_3 AS Tgl, Judul_Rpl_Assesor_3 AS Judul, Keterangan_Rpl_Assesor_3 AS Keterangan, File_Rpl_Assesor_3 AS Files, Format_Rpl_Assesor_3 AS Format, Slugs_Rpl_Assesor_3 AS Slugs, User_Rpl_Assesor_3 AS Users, Log_Rpl_Assesor_3 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_3 AS IdDosen, Ta_Rpl_Assesor_3 AS Ta, Semester_Rpl_Assesor_3 AS Semester, Prodi_Rpl_Assesor_3 AS Prodi FROM Tbl_Rpl_Assesor_3 WHERE Id_Rpl_Assesor = '". $__record_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Ta_Rpl_Assesor_3 = '". $__authlogin__->Ta ."' AND Semester_Rpl_Assesor_3 = '". $__authlogin__->Semester ."' AND Prodi_Rpl_Assesor_3 = '". $__authlogin__->Prodi ."' ORDER BY Id_Rpl_Assesor_3 DESC ");

                }


                if ( $__record_assesor->D_1 == TRUE AND $__record_assesor->S_1 == 'N' AND date('Y-m-d') > date('Y-m-d', strtotime($__record_assesor->Hapus_1)) ) {

                    $__update_assesor__ = $this->__Hapus_Assesor__([
                        'Assesor'                       => '1',
                        'As1_Dosen_Rpl_Assesor'         => null,
                        'As1_Status_Rpl_Assesor'        => null,
                        'As1_TglDaftar_Rpl_Assesor'     => null,
                        'As1_TglHapus_Rpl_Assesor'      => null,
                        'As1_Ta_Rpl_Assesor'            => null,
                        'As1_Semester_Rpl_Assesor'      => null,
                        'As1_Prodi_Rpl_Assesor'         => null,
                        'User_Rpl_Assesor'              => 'Hapus Assesor 1',
                        'Log_Rpl_Assesor'               => date('Y-m-d H:i:s'),
                        'Id_Rpl_Assesor'                => $__record_assesor->Id,
                        'Id_Rpl_Pendaftaran'            => $__authlogin__->Id,
                    ]);  

                    if ( $__update_assesor__['Error'] != '000' ) {

                        redirect($this->__Routes_Mod__(), '03', $__update_assesor__['Message']);
                        exit();

                    } else {
                
                        $__hapus_histori_assesor__ = $this->__Hapus_Assesor_Histori__([
                            'IdDosen'               => $__record_assesor->D_1,
                            'TglHapus'              => date('Y-m-d H:i:s'),
                            'Assesor'               => '1',
                            'User'                  => 'Auto Hapus',
                            'Log'                   => date('Y-m-d H:i:s'),
                            'IdKampus'              => __Aplikasi()['IdKampus'],
                            'Kampus'                => __Aplikasi()['Kampus'],
                            'Data'                  => 'Y',
                            'Id_Rpl_Assesor'        => $__record_assesor->Id,
                            'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                        ]);

                            redirect($this->__Routes_Mod__(), '03', $__hapus_histori_assesor__['Message']);
                            exit();

                    }

                }

                if ( $__record_assesor->D_2 == TRUE AND $__record_assesor->S_2 == 'N' AND date('Y-m-d') > date('Y-m-d', strtotime($__record_assesor->Hapus_2)) ) {

                    if ( $__record_assesor->S_1 == 'Y' ) {

                        $__update_assesor__ = $this->__Hapus_Assesor__([
                            'Assesor'                       => '2',
                            'As2_Dosen_Rpl_Assesor'         => null,
                            'As2_Status_Rpl_Assesor'        => null,
                            'As2_TglDaftar_Rpl_Assesor'     => null,
                            'As2_TglHapus_Rpl_Assesor'      => null,
                            'As2_Ta_Rpl_Assesor'            => null,
                            'As2_Semester_Rpl_Assesor'      => null,
                            'As2_Prodi_Rpl_Assesor'         => null,
                            'User_Rpl_Assesor'              => 'Hapus Assesor 2',
                            'Log_Rpl_Assesor'               => date('Y-m-d H:i:s'),
                            'Id_Rpl_Assesor'                => $__record_assesor->Id,
                            'Id_Rpl_Pendaftaran'            => $__authlogin__->Id,
                        ]);  

                        if ( $__update_assesor__['Error'] != '000' ) {

                            redirect($this->__Routes_Mod__(), '03', $__update_assesor__['Message']);
                            exit();

                        } else {
                    
                            $__hapus_histori_assesor__ = $this->__Hapus_Assesor_Histori__([
                                'IdDosen'               => $__record_assesor->D_2,
                                'TglHapus'              => date('Y-m-d H:i:s'),
                                'Assesor'               => '2',
                                'User'                  => 'Auto Hapus',
                                'Log'                   => date('Y-m-d H:i:s'),
                                'IdKampus'              => __Aplikasi()['IdKampus'],
                                'Kampus'                => __Aplikasi()['Kampus'],
                                'Data'                  => 'Y',
                                'Id_Rpl_Assesor'        => $__record_assesor->Id,
                                'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                            ]);

                                redirect($this->__Routes_Mod__(), '03', $__hapus_histori_assesor__['Message']);
                                exit();

                        }

                    }

                }

                if ( $__record_assesor->D_3 == TRUE AND $__record_assesor->S_3 == 'N' AND date('Y-m-d') > date('Y-m-d', strtotime($__record_assesor->Hapus_3)) ) {

                    if ( $__record_assesor->S_2 == 'Y' ) {

                        $__update_assesor__ = $this->__Hapus_Assesor__([
                            'Assesor'                       => '3',
                            'As3_Dosen_Rpl_Assesor'         => null,
                            'As3_Status_Rpl_Assesor'        => null,
                            'As3_TglDaftar_Rpl_Assesor'     => null,
                            'As3_TglHapus_Rpl_Assesor'      => null,
                            'As3_Ta_Rpl_Assesor'            => null,
                            'As3_Semester_Rpl_Assesor'      => null,
                            'As3_Prodi_Rpl_Assesor'         => null,
                            'User_Rpl_Assesor'              => 'Hapus Assesor 3',
                            'Log_Rpl_Assesor'               => date('Y-m-d H:i:s'),
                            'Id_Rpl_Assesor'                => $__record_assesor->Id,
                            'Id_Rpl_Pendaftaran'            => $__authlogin__->Id,
                        ]);  

                        if ( $__update_assesor__['Error'] != '000' ) {

                            redirect($this->__Routes_Mod__(), '03', $__update_assesor__['Message']);
                            exit();

                        } else {
                    
                            $__hapus_histori_assesor__ = $this->__Hapus_Assesor_Histori__([
                                'IdDosen'               => $__record_assesor->D_3,
                                'TglHapus'              => date('Y-m-d H:i:s'),
                                'Assesor'               => '3',
                                'User'                  => 'Auto Hapus',
                                'Log'                   => date('Y-m-d H:i:s'),
                                'IdKampus'              => __Aplikasi()['IdKampus'],
                                'Kampus'                => __Aplikasi()['Kampus'],
                                'Data'                  => 'Y',
                                'Id_Rpl_Assesor'        => $__record_assesor->Id,
                                'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                            ]);

                                redirect($this->__Routes_Mod__(), '03', $__hapus_histori_assesor__['Message']);
                                exit();

                        }

                    }

                }


                $__hasil_progress__ = $this->__helpers->__Progres_Assesor( $__record_assesor->S_1 , $__record_assesor->S_2 , $__record_assesor->S_3 );

                $__progress_1 = $__hasil_progress__['1'];
                $__progress_2 = $__hasil_progress__['2'];
                $__progress_3 = $__hasil_progress__['3'];


                if ( $__record_assesor->Validasi_1 == 'Y' AND $__record_assesor->Validasi_2 == 'Y' AND $__record_assesor->Validasi_3 == 'Y' ) {
                    $__progress_sk = '100';
                } elseif ( $__record_assesor->Validasi_1 == 'Y' AND $__record_assesor->Validasi_2 == 'Y' ) {
                    $__progress_sk = '66';
                } elseif ( $__record_assesor->Validasi_1 == 'Y' ) {
                    $__progress_sk = '33';
                } else {
                    $__progress_sk = '0';
                }
                

                if ( $__record_assesor->Validasi_1 == 'Y' AND $__record_assesor->Validasi_2 == 'Y' AND $__record_assesor->Validasi_3 == 'Y' ) {

                    $__data_sk_rpl = $this->__SkModel->read(['Id_Rpl_Pendaftaran' => $__record_assesor->Id_Rpl_Pendaftaran, 'Id_Rpl_Assesor' => $__record_assesor->Id]);

                }


                $__data_hapusassesor__ = $this->__db->query(" SELECT Id_Rpl_Assesor_HapusAssesor AS Id, IdDosen_Rpl_Assesor_HapusAssesor AS IdDosen, TglHapus_Rpl_Assesor_HapusAssesor AS TglHapus, Assesor_Rpl_Assesor_HapusAssesor AS Assesor FROM Tbl_Rpl_Assesor_HapusAssesor WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' ORDER BY TglHapus_Rpl_Assesor_HapusAssesor DESC ");


                    // ##################### EMAIL ##################### //
                        // if ( @$__authlogin__->Id == TRUE AND @$__record_assesor->D_1 == TRUE AND @$__record_assesor->D_2 == TRUE AND @$__record_assesor->D_3 == TRUE ) {

                        //     @$__data_kirimemail_1__ = $this->__db->queryrow(" SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND IdDosen = '". @$__record_assesor->D_1 ."' ");

                        //     if ( @$__data_kirimemail_1__ == FALSE ) {

                        //         $__insert_email__ = $this->__Create_Email__([
                        //             'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                        //             'As_1'                  => $__record_assesor->D_1,
                        //             'Hapus_1'               => $__record_assesor->Hapus_1,
                        //             'As_2'                  => $__record_assesor->D_2,
                        //             'Hapus_2'               => $__record_assesor->Hapus_2,
                        //             'As_3'                  => $__record_assesor->D_3,
                        //             'Hapus_3'               => $__record_assesor->Hapus_3,
                        //             'Rpl'                   => [
                        //                 'Nama'      => $__authlogin__->Nama,
                        //                 'Ta'        => $__authlogin__->Ta,
                        //                 'Semester'  => $__authlogin__->Semester,
                        //                 'Prodi'     => $__authlogin__->Prodi,
                        //             ],
                        //         ]);

                        //         if ( $__insert_email__['Error'] == '000' ) {
                                    
                        //             redirect(url('homerpl/assesor'), '01', $__insert_email__['Message']);

                        //         } else {

                        //             redirect(url('homerpl/assesor'), '03', $__insert_email__['Message']);

                        //         }

                        //     }

                        //     @$__data_kirimemail_2__ = $this->__db->queryrow(" SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND IdDosen = '". @$__record_assesor->D_2 ."' ");

                        //     if ( @$__data_kirimemail_2__ == FALSE ) {

                        //         $__insert_email__ = $this->__Create_Email__([
                        //             'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                        //             'As_1'                  => $__record_assesor->D_1,
                        //             'Hapus_1'               => $__record_assesor->Hapus_1,
                        //             'As_2'                  => $__record_assesor->D_2,
                        //             'Hapus_2'               => $__record_assesor->Hapus_2,
                        //             'As_3'                  => $__record_assesor->D_3,
                        //             'Hapus_3'               => $__record_assesor->Hapus_3,
                        //             'Rpl'                   => [
                        //                 'Nama'      => $__authlogin__->Nama,
                        //                 'Ta'        => $__authlogin__->Ta,
                        //                 'Semester'  => $__authlogin__->Semester,
                        //                 'Prodi'     => $__authlogin__->Prodi,
                        //             ],
                        //         ]);

                        //         if ( $__insert_email__['Error'] == '000' ) {
                                    
                        //             redirect(url('homerpl/assesor'), '01', $__insert_email__['Message']);

                        //         } else {

                        //             redirect(url('homerpl/assesor'), '03', $__insert_email__['Message']);

                        //         }

                        //     }

                        //     @$__data_kirimemail_3__ = $this->__db->queryrow(" SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND IdDosen = '". @$__record_assesor->D_3 ."' ");

                        //     if ( @$__data_kirimemail_3__ == FALSE ) {

                        //         $__insert_email__ = $this->__Create_Email__([
                        //             'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                        //             'As_1'                  => $__record_assesor->D_1,
                        //             'Hapus_1'               => $__record_assesor->Hapus_1,
                        //             'As_2'                  => $__record_assesor->D_2,
                        //             'Hapus_2'               => $__record_assesor->Hapus_2,
                        //             'As_3'                  => $__record_assesor->D_3,
                        //             'Hapus_3'               => $__record_assesor->Hapus_3,
                        //             'Rpl'                   => [
                        //                 'Nama'      => $__authlogin__->Nama,
                        //                 'Ta'        => $__authlogin__->Ta,
                        //                 'Semester'  => $__authlogin__->Semester,
                        //                 'Prodi'     => $__authlogin__->Prodi,
                        //             ],
                        //         ]);

                        //         if ( $__insert_email__['Error'] == '000' ) {
                                    
                        //             redirect(url('homerpl/assesor'), '01', $__insert_email__['Message']);

                        //         } else {

                        //             redirect(url('homerpl/assesor'), '03', $__insert_email__['Message']);

                        //         }

                        //     }

                        // }

                        if (isset($__authlogin__->Id) && $__authlogin__->Id && 
                            isset($__record_assesor->D_1) && $__record_assesor->D_1 && 
                            isset($__record_assesor->D_2) && $__record_assesor->D_2 && 
                            isset($__record_assesor->D_3) && $__record_assesor->D_3) {

                            $assessorIds = [
                                $__record_assesor->D_1,
                                $__record_assesor->D_2,
                                $__record_assesor->D_3,
                            ];

                            foreach ($assessorIds as $index => $idDosen) {
                                if ($this->checkEmailExists($__authlogin__->Id, $idDosen)) {
                                    continue; 
                                }

                                $insertEmailResponse = $this->__Create_Email__([
                                    'Id_Rpl_Pendaftaran' => $__authlogin__->Id,
                                    'As_1'               => $__record_assesor->D_1,
                                    'Hapus_1'            => $__record_assesor->Hapus_1,
                                    'As_2'               => $__record_assesor->D_2,
                                    'Hapus_2'            => $__record_assesor->Hapus_2,
                                    'As_3'               => $__record_assesor->D_3,
                                    'Hapus_3'            => $__record_assesor->Hapus_3,
                                    'Rpl'                => [
                                        'Nama'     => $__authlogin__->Nama,
                                        'Ta'       => $__authlogin__->Ta,
                                        'Semester' => $__authlogin__->Semester,
                                        'Prodi'    => $__authlogin__->Prodi,
                                    ],
                                ]);

                                if ($insertEmailResponse['Error'] === '000') {
                                    redirect(url('homerpl/assesor'), '01', $insertEmailResponse['Message']);
                                } else {
                                    redirect(url('homerpl/assesor'), '03', $insertEmailResponse['Message']);
                                }
                            }
                        }
                    // ##################### EMAIL ##################### //


                $__db = $this->__db;
                
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function __Assesor__( array $data )
        {
            if ( $data['Check'] == '1' ) {

                $result = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' ");
                
            } elseif ( $data['Assesor_1'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As1_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Assesor_2'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As2_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Assesor_3'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND As3_Dosen_Rpl_Assesor <> '' ");

            } elseif ( $data['Show'] == '1' ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == 'ID' ) {

                $result = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $data['Id'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            }

            return $result;
        }

        public function __Data_KuotaDosen__( array $data )
        {
            $dosenList = [];

            $__data_id_rpl = $data['Id_Rpl_Pendaftaran']; 
            
            $result = $this->__db->query(" SELECT Id_Rpl_KuotaAssesor AS Id, Ta_Rpl_KuotaAssesor AS Ta, Semester_Rpl_KuotaAssesor AS Semester, IdDosen_Rpl_KuotaAssesor AS IdDosen, Prodi_Rpl_KuotaAssesor AS Prodi, Kuota_Rpl_KuotaAssesor AS Kuota, User_Rpl_KuotaAssesor AS Users, Log_Rpl_KuotaAssesor AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_KuotaAssesor WHERE Ta_Rpl_KuotaAssesor = '". $data['Ta'] ."' AND Semester_Rpl_KuotaAssesor = '". $data['Semester'] ."' AND Data = 'Y' AND Prodi_Rpl_KuotaAssesor = '". $data['Prodi'] ."' AND Kuota_Rpl_KuotaAssesor > '0' ORDER BY Kuota_Rpl_KuotaAssesor DESC ");

                foreach ( $result AS $data => $row ) :

                    $__check_dosen_1 = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $row->IdDosen ."' AND As1_Ta_Rpl_Assesor = '". $row->Ta ."' AND As1_Semester_Rpl_Assesor = '". $row->Semester ."' AND As1_Prodi_Rpl_Assesor = '". $row->Prodi ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' ");

                    $__check_dosen_2 = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE As2_Dosen_Rpl_Assesor = '". $row->IdDosen ."' AND As2_Ta_Rpl_Assesor = '". $row->Ta ."' AND As2_Semester_Rpl_Assesor = '". $row->Semester ."' AND As2_Prodi_Rpl_Assesor = '". $row->Prodi ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' ");

                    $__check_dosen_3 = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE As3_Dosen_Rpl_Assesor = '". $row->IdDosen ."' AND As3_Ta_Rpl_Assesor = '". $row->Ta ."' AND As3_Semester_Rpl_Assesor = '". $row->Semester ."' AND As3_Prodi_Rpl_Assesor = '". $row->Prodi ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' ");

                    if ( $__check_dosen_1 == FALSE ) {

                        if ( $__check_dosen_2 == FALSE ) {

                            if ( $__check_dosen_3 == FALSE ) {

                                $__check_dosen__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $row->IdDosen ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' OR As2_Dosen_Rpl_Assesor = '". $row->IdDosen ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' OR As3_Dosen_Rpl_Assesor = '". $row->IdDosen ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' ");

                                if ( $__check_dosen__ == FALSE ) {

                                    $__check_histori__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_HapusAssesor AS Id FROM Tbl_Rpl_Assesor_HapusAssesor WHERE IdDosen_Rpl_Assesor_HapusAssesor = '". $row->IdDosen ."' AND Id_Rpl_Pendaftaran = '". $__data_id_rpl ."' ");

                                    if ( $__check_histori__ == FALSE ) {

                                        $dosenList[] = $row->IdDosen;
                                        break;

                                    }

                                }

                            }

                        }

                    }

                endforeach;
                
            return $dosenList;
        }

        public function __Ubah_KuotaDosen__( array $data )
        {
            $__session = [
                'User_Rpl_KuotaAssesor'         => $data['Nama'],
                'Log_Rpl_KuotaAssesor'          => date('Y-m-d H:i:s'),
                'IdDosen_Rpl_KuotaAssesor'      => $data['IdDosen'],
                'Ta_Rpl_KuotaAssesor'           => $data['Ta'],
                'Semester_Rpl_KuotaAssesor'     => $data['Semester'],
                'Prodi_Rpl_KuotaAssesor'        => $data['Prodi'],
            ];

            try {

                $this->__db->beginTransaction();

                    $__sql = $this->__db->prepare( 
                        "
                            UPDATE Tbl_Rpl_KuotaAssesor SET
                                Kuota_Rpl_KuotaAssesor      = Kuota_Rpl_KuotaAssesor - 1, 
                                User_Rpl_KuotaAssesor       = :User_Rpl_KuotaAssesor, 
                                Log_Rpl_KuotaAssesor        = :Log_Rpl_KuotaAssesor
                            WHERE IdDosen_Rpl_KuotaAssesor  = :IdDosen_Rpl_KuotaAssesor
                            AND Ta_Rpl_KuotaAssesor         = :Ta_Rpl_KuotaAssesor
                            AND Semester_Rpl_KuotaAssesor   = :Semester_Rpl_KuotaAssesor
                            AND Prodi_Rpl_KuotaAssesor      = :Prodi_Rpl_KuotaAssesor
                        "
                    ) -> execute ( $__session );

                $this->__db->commit();

                    return [
                        'Error'   => '000',
                        'Message' => 'Berhasil Ubah Kuota Assesor Data !',
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

        public function __Query_Assesor__( array $data )
        {
            if ( $data['Status'] == 'Tambah' ) {

                $__session = [
                    'As1_Dosen_Rpl_Assesor'         => isset($data['As1_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_Status_Rpl_Assesor'        => isset($data['As1_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_TglDaftar_Rpl_Assesor'     => isset($data['As1_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_TglHapus_Rpl_Assesor'      => isset($data['As1_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_Ta_Rpl_Assesor'            => isset($data['As1_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_Semester_Rpl_Assesor'      => isset($data['As1_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As1_Prodi_Rpl_Assesor'         => isset($data['As1_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Dosen_Rpl_Assesor'         => isset($data['As2_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Status_Rpl_Assesor'        => isset($data['As2_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_TglDaftar_Rpl_Assesor'     => isset($data['As2_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_TglHapus_Rpl_Assesor'      => isset($data['As2_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Ta_Rpl_Assesor'            => isset($data['As2_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Semester_Rpl_Assesor'      => isset($data['As2_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As2_Prodi_Rpl_Assesor'         => isset($data['As2_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Dosen_Rpl_Assesor'         => isset($data['As3_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Status_Rpl_Assesor'        => isset($data['As3_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_TglDaftar_Rpl_Assesor'     => isset($data['As3_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_TglHapus_Rpl_Assesor'      => isset($data['As3_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Ta_Rpl_Assesor'            => isset($data['As3_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Semester_Rpl_Assesor'      => isset($data['As3_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                    'As3_Prodi_Rpl_Assesor'         => isset($data['As3_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
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
                        'As1_Ta_Rpl_Assesor'            => isset($data['As1_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As1_Semester_Rpl_Assesor'      => isset($data['As1_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As1_Prodi_Rpl_Assesor'         => isset($data['As1_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                        // 'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                    ];

                } elseif ( $data['Assesor'] == '2' ) {

                    $__session = [
                        'As2_Dosen_Rpl_Assesor'         => isset($data['As2_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_Status_Rpl_Assesor'        => isset($data['As2_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_TglDaftar_Rpl_Assesor'     => isset($data['As2_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_TglHapus_Rpl_Assesor'      => isset($data['As2_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_Ta_Rpl_Assesor'            => isset($data['As2_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_Semester_Rpl_Assesor'      => isset($data['As2_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As2_Prodi_Rpl_Assesor'         => isset($data['As2_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                        // 'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                    ];

                } elseif ( $data['Assesor'] == '3' ) {

                    $__session = [
                        'As3_Dosen_Rpl_Assesor'         => isset($data['As3_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_Status_Rpl_Assesor'        => isset($data['As3_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_TglDaftar_Rpl_Assesor'     => isset($data['As3_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_TglHapus_Rpl_Assesor'      => isset($data['As3_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_Ta_Rpl_Assesor'            => isset($data['As3_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_Semester_Rpl_Assesor'      => isset($data['As3_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'As3_Prodi_Rpl_Assesor'         => isset($data['As3_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'User_Rpl_Assesor'              => isset($data['User_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['User_Rpl_Assesor'], ENT_QUOTES))) : '',
                        'Log_Rpl_Assesor'               => isset($data['Log_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Log_Rpl_Assesor'], ENT_QUOTES))) : '',
                        // 'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
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
                                        As1_Dosen_Rpl_Assesor, As1_Status_Rpl_Assesor, As1_TglDaftar_Rpl_Assesor, As1_TglHapus_Rpl_Assesor, As1_Ta_Rpl_Assesor, As1_Semester_Rpl_Assesor, As1_Prodi_Rpl_Assesor,
                                        As2_Dosen_Rpl_Assesor, As2_Status_Rpl_Assesor, As2_TglDaftar_Rpl_Assesor, As2_TglHapus_Rpl_Assesor, As2_Ta_Rpl_Assesor, As2_Semester_Rpl_Assesor, As2_Prodi_Rpl_Assesor,
                                        As3_Dosen_Rpl_Assesor, As3_Status_Rpl_Assesor, As3_TglDaftar_Rpl_Assesor, As3_TglHapus_Rpl_Assesor, As3_Ta_Rpl_Assesor, As3_Semester_Rpl_Assesor, As3_Prodi_Rpl_Assesor,
                                        User_Rpl_Assesor, Log_Rpl_Assesor, IdKampus, Kampus, Data,
                                        Id_Rpl_Pendaftaran
                                    )
                                VALUES
                                    (
                                        :As1_Dosen_Rpl_Assesor, :As1_Status_Rpl_Assesor, :As1_TglDaftar_Rpl_Assesor, :As1_TglHapus_Rpl_Assesor, :As1_Ta_Rpl_Assesor, :As1_Semester_Rpl_Assesor, :As1_Prodi_Rpl_Assesor,
                                        :As2_Dosen_Rpl_Assesor, :As2_Status_Rpl_Assesor, :As2_TglDaftar_Rpl_Assesor, :As2_TglHapus_Rpl_Assesor, :As2_Ta_Rpl_Assesor, :As2_Semester_Rpl_Assesor, :As2_Prodi_Rpl_Assesor,
                                        :As3_Dosen_Rpl_Assesor, :As3_Status_Rpl_Assesor, :As3_TglDaftar_Rpl_Assesor, :As3_TglHapus_Rpl_Assesor, :As3_Ta_Rpl_Assesor, :As3_Semester_Rpl_Assesor, :As3_Prodi_Rpl_Assesor,
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
                                            As1_Ta_Rpl_Assesor          = :As1_Ta_Rpl_Assesor,
                                            As1_Semester_Rpl_Assesor    = :As1_Semester_Rpl_Assesor,
                                            As1_Prodi_Rpl_Assesor       = :As1_Prodi_Rpl_Assesor,
                                            User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                            Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                        WHERE Id_Rpl_Pendaftaran        = :Id_Rpl_Pendaftaran
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
                                            As2_Ta_Rpl_Assesor          = :As2_Ta_Rpl_Assesor,
                                            As2_Semester_Rpl_Assesor    = :As2_Semester_Rpl_Assesor,
                                            As2_Prodi_Rpl_Assesor       = :As2_Prodi_Rpl_Assesor,
                                            User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                            Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                        WHERE Id_Rpl_Pendaftaran        = :Id_Rpl_Pendaftaran
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
                                            As3_Ta_Rpl_Assesor          = :As3_Ta_Rpl_Assesor,
                                            As3_Semester_Rpl_Assesor    = :As3_Semester_Rpl_Assesor,
                                            As3_Prodi_Rpl_Assesor       = :As3_Prodi_Rpl_Assesor,
                                            User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                            Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                        WHERE Id_Rpl_Pendaftaran        = :Id_Rpl_Pendaftaran
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

        public function IndexRpl_Assesor_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
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

                $__authlogin__ = $__session_login__['__Id'];

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);

                $__data_assesor = $this->__Assesor__( ['Show' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__] );
                
                $__data_calon_rpl = $this->__SessionController->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__ == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    $__nomor_mk_transfer = '1';
                    $__data_mk_transfer = $this->__Assesor2Model->read(['Id_Rpl_Assesor' => $__data_assesor->Id, 'Id_Rpl_Pendaftaran' => $__data_calon_rpl->Id]);
                    $__data_rektor = $this->__db->queryid(" SELECT TOP 1 B.IdDosen AS Id, B.NamaGelar AS Nama, B.NidnNtbDos AS Nidn FROM Hak_Akses_Global A LEFT JOIN Dosen B ON A.id_dosen_pejabat = B.IdDosen WHERE A.Jabatan LIKE '%Rektor%' AND A.Id_Kampus LIKE '". __Aplikasi()['IdKampus'] ."%' ORDER BY A.Priode_Akhir DESC ");

                    $__data_mk_perolehan = $this->__db->query(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf FROM Tbl_Rpl_Perolehan WHERE Data = 'Y' AND Id_Rpl_Assesor = '". $__data_assesor->Id ."' AND Id_Rpl_Pendaftaran = '". $__data_calon_rpl->Id ."' ORDER BY Id_Rpl_Perolehan DESC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sk.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }

        public function IndexRpl_Assesor_Pdf_Lampiran()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
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

                $__authlogin__ = $__session_login__['__Id'];

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);

                $__data_assesor = $this->__Assesor__(['Assesor' => 'ID', 'Id' => $__data_sk_rpl->Id_Rpl_Assesor]);
                
                $__data_calon_rpl = $this->__SessionController->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__ == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
                    $__logo_kampus = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];

                    // $__data_mk_transfer = $this->__Assesor2Model->read(['Id_Rpl_Assesor' => $__data_assesor->Id, 'Id_Rpl_Pendaftaran' => $__data_calon_rpl->Id]);
                    $__data_rektor = $this->__db->queryid(" SELECT TOP 1 B.IdDosen AS Id, B.NamaGelar AS Nama, B.NidnNtbDos AS Nidn FROM Hak_Akses_Global A LEFT JOIN Dosen B ON A.id_dosen_pejabat = B.IdDosen WHERE A.Jabatan LIKE '%Rektor%' AND A.Id_Kampus LIKE '". __Aplikasi()['IdKampus'] ."%' ORDER BY A.Priode_Akhir DESC ");

                    if ( isset($__data_calon_rpl->TipePt) AND $__data_calon_rpl->TipePt == TRUE AND $__data_calon_rpl->TipePt == 'KULIAH' ) {

                        $__1_label  = 'PT Asal';
                        $__1_isi    = $__data_calon_rpl->IdPtAsal . ' - ' . $__data_calon_rpl->NamaPtAsal;
                        $__2_label  = 'Prodi Asal';
                        $__2_isi    = '(' . $__data_calon_rpl->JenjangAkhir . ')' . ' - ' . $__data_calon_rpl->IdProdiAsal . ' - ' . $__data_calon_rpl->NamaProdiAsal;

                    } else {

                        $__1_label  = 'Jenjang Akhir';
                        $__1_isi    = $__data_calon_rpl->JenjangAkhir;
                        $__2_label  = 'Nama Sekolah Asal';
                        $__2_isi    = $__data_calon_rpl->Sekolah;

                    }

                    $__nomor_prodi_mk = '1';
                    $__data_prodimk = $this->__db->query(" SELECT IdPrimary AS Id, Kurikulum, IdKampus, IdFakultas, Prodi, IdMk, Sks, Semester, Ta, MkPilihan FROM ProdiMk WHERE Prodi = '". $__data_calon_rpl->Prodi ."' AND Kurikulum = '". $__data_calon_rpl->Kurikulum ."' AND IdKampus = '". $__data_calon_rpl->IdKampus ."' ORDER BY Semester ASC ");

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sk_lampiran.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }

        public function __Hapus_Assesor_Histori__( array $data )
        {
            $__session__ = [
                'IdDosen_Rpl_Assesor_HapusAssesor'               => isset($data['IdDosen']) ? stripslashes(strip_tags(htmlspecialchars($data['IdDosen'], ENT_QUOTES))) : '',
                'TglHapus_Rpl_Assesor_HapusAssesor'              => isset($data['TglHapus']) ? stripslashes(strip_tags(htmlspecialchars($data['TglHapus'], ENT_QUOTES))) : '',
                'Assesor_Rpl_Assesor_HapusAssesor'               => isset($data['Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Assesor'], ENT_QUOTES))) : '',
                'User_Rpl_Assesor_HapusAssesor'                  => isset($data['User']) ? stripslashes(strip_tags(htmlspecialchars($data['User'], ENT_QUOTES))) : '',
                'Log_Rpl_Assesor_HapusAssesor'                   => isset($data['Log']) ? stripslashes(strip_tags(htmlspecialchars($data['Log'], ENT_QUOTES))) : '',
                'IdKampus'                                       => isset($data['IdKampus']) ? stripslashes(strip_tags(htmlspecialchars($data['IdKampus'], ENT_QUOTES))) : '',
                'Kampus'                                         => isset($data['Kampus']) ? stripslashes(strip_tags(htmlspecialchars($data['Kampus'], ENT_QUOTES))) : '',
                'Data'                                           => isset($data['Data']) ? stripslashes(strip_tags(htmlspecialchars($data['Data'], ENT_QUOTES))) : '',
                'Id_Rpl_Assesor'                                 => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                'Id_Rpl_Pendaftaran'                             => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
            ];

                try {

                    $this->__db->beginTransaction();

                        $__sql = $this->__db->prepare( 
                            "
                                INSERT INTO Tbl_Rpl_Assesor_HapusAssesor
                                (
                                    IdDosen_Rpl_Assesor_HapusAssesor,
                                    TglHapus_Rpl_Assesor_HapusAssesor,
                                    Assesor_Rpl_Assesor_HapusAssesor,
                                    User_Rpl_Assesor_HapusAssesor,
                                    Log_Rpl_Assesor_HapusAssesor,
                                    IdKampus,
                                    Kampus,
                                    Data,
                                    Id_Rpl_Assesor,
                                    Id_Rpl_Pendaftaran
                                )
                                VALUES
                                (
                                    :IdDosen_Rpl_Assesor_HapusAssesor,
                                    :TglHapus_Rpl_Assesor_HapusAssesor,
                                    :Assesor_Rpl_Assesor_HapusAssesor,
                                    :User_Rpl_Assesor_HapusAssesor,
                                    :Log_Rpl_Assesor_HapusAssesor,
                                    :IdKampus,
                                    :Kampus,
                                    :Data,
                                    :Id_Rpl_Assesor,
                                    :Id_Rpl_Pendaftaran
                                )
                            "
                        ) -> execute ( $__session__ );

                        $this->__db->commit();
                            
                        return [
                            'Error'   => '000',
                            'Message' => 'Sukses Hapus Dosen, Karena Terlambat Menyelesaikan Tugas',
                            'Data'    => '',
                        ];
                        exit();

                } catch ( PDOException $e ) {

                    $this->__db->rollback();

                    return [
                        'Error'   => '999',
                        'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                        'Data'    => '',
                    ];
                    exit();

                }
        }

        public function __Hapus_Assesor__( array $data )
        {
            try {

                $this->__db->beginTransaction();

                    if ( $data['Assesor'] == '1' ) {

                        $__session__ = [
                            'As1_Dosen_Rpl_Assesor'         => isset($data['As1_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As1_Status_Rpl_Assesor'        => isset($data['As1_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As1_TglDaftar_Rpl_Assesor'     => isset($data['As1_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As1_TglHapus_Rpl_Assesor'      => isset($data['As1_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As1_Ta_Rpl_Assesor'            => isset($data['As1_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As1_Semester_Rpl_Assesor'      => isset($data['As1_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As1_Prodi_Rpl_Assesor'         => isset($data['As1_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As1_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'User_Rpl_Assesor'              => 'Hapus Assesor 1',
                            'Log_Rpl_Assesor'               => date('Y-m-d H:i:s'),
                            'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                        ];

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Assesor SET
                                    As1_Dosen_Rpl_Assesor       = :As1_Dosen_Rpl_Assesor, 
                                    As1_Status_Rpl_Assesor      = :As1_Status_Rpl_Assesor, 
                                    As1_TglDaftar_Rpl_Assesor   = :As1_TglDaftar_Rpl_Assesor, 
                                    As1_TglHapus_Rpl_Assesor    = :As1_TglHapus_Rpl_Assesor, 
                                    As1_Ta_Rpl_Assesor          = :As1_Ta_Rpl_Assesor,
                                    As1_Semester_Rpl_Assesor    = :As1_Semester_Rpl_Assesor,
                                    As1_Prodi_Rpl_Assesor       = :As1_Prodi_Rpl_Assesor,
                                    User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                    Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                            "
                        ) -> execute ( $__session__ );

                    } elseif ( $data['Assesor'] == '2' ) {

                        $__session__ = [
                            'As2_Dosen_Rpl_Assesor'         => isset($data['As2_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As2_Status_Rpl_Assesor'        => isset($data['As2_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As2_TglDaftar_Rpl_Assesor'     => isset($data['As2_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As2_TglHapus_Rpl_Assesor'      => isset($data['As2_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As2_Ta_Rpl_Assesor'            => isset($data['As2_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As2_Semester_Rpl_Assesor'      => isset($data['As2_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As2_Prodi_Rpl_Assesor'         => isset($data['As2_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As2_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'User_Rpl_Assesor'              => 'Hapus Assesor 2',
                            'Log_Rpl_Assesor'               => date('Y-m-d H:i:s'),
                            'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                        ];

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Assesor SET
                                    As2_Dosen_Rpl_Assesor       = :As2_Dosen_Rpl_Assesor, 
                                    As2_Status_Rpl_Assesor      = :As2_Status_Rpl_Assesor, 
                                    As2_TglDaftar_Rpl_Assesor   = :As2_TglDaftar_Rpl_Assesor, 
                                    As2_TglHapus_Rpl_Assesor    = :As2_TglHapus_Rpl_Assesor, 
                                    As2_Ta_Rpl_Assesor          = :As2_Ta_Rpl_Assesor,
                                    As2_Semester_Rpl_Assesor    = :As2_Semester_Rpl_Assesor,
                                    As2_Prodi_Rpl_Assesor       = :As2_Prodi_Rpl_Assesor,
                                    User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                    Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                            "
                        ) -> execute ( $__session__ );

                    } elseif ( $data['Assesor'] == '3' ) {

                        $__session__ = [
                            'As3_Dosen_Rpl_Assesor'         => isset($data['As3_Dosen_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Dosen_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As3_Status_Rpl_Assesor'        => isset($data['As3_Status_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Status_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As3_TglDaftar_Rpl_Assesor'     => isset($data['As3_TglDaftar_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglDaftar_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As3_TglHapus_Rpl_Assesor'      => isset($data['As3_TglHapus_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_TglHapus_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As3_Ta_Rpl_Assesor'            => isset($data['As3_Ta_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Ta_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As3_Semester_Rpl_Assesor'      => isset($data['As3_Semester_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Semester_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'As3_Prodi_Rpl_Assesor'         => isset($data['As3_Prodi_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['As3_Prodi_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'User_Rpl_Assesor'              => 'Hapus Assesor 3',
                            'Log_Rpl_Assesor'               => date('Y-m-d H:i:s'),
                            'Id_Rpl_Assesor'                => isset($data['Id_Rpl_Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Assesor'], ENT_QUOTES))) : '',
                            'Id_Rpl_Pendaftaran'            => isset($data['Id_Rpl_Pendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['Id_Rpl_Pendaftaran'], ENT_QUOTES))) : '',
                        ];

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Assesor SET
                                    As3_Dosen_Rpl_Assesor       = :As3_Dosen_Rpl_Assesor, 
                                    As3_Status_Rpl_Assesor      = :As3_Status_Rpl_Assesor, 
                                    As3_TglDaftar_Rpl_Assesor   = :As3_TglDaftar_Rpl_Assesor, 
                                    As3_TglHapus_Rpl_Assesor    = :As3_TglHapus_Rpl_Assesor, 
                                    As3_Ta_Rpl_Assesor          = :As3_Ta_Rpl_Assesor,
                                    As3_Semester_Rpl_Assesor    = :As3_Semester_Rpl_Assesor,
                                    As3_Prodi_Rpl_Assesor       = :As3_Prodi_Rpl_Assesor,
                                    User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                    Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                            "
                        ) -> execute ( $__session__ );

                    }

                    $this->__db->commit();
                        
                    return [
                        'Error'   => '000',
                        'Message' => 'Sukses Hapus Dosen, Karena Terlambat Menyelesaikan Tugas',
                        'Data'    => '',
                    ];
                    exit();

            } catch ( PDOException $e ) {

                $this->__db->rollback();

                return [
                    'Error'   => '999',
                    'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                    'Data'    => '',
                ];
                exit();

            }
        }

        public function __Create_Email__( array $data )
        {
            $__check_1__ = $this->__db->queryrow(" SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen = '". $data['As_1'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' ");

            if ( @$__check_1__ == FALSE ) {

                $__session = [
                    'Id_Rpl_Pendaftaran'    => $data['Id_Rpl_Pendaftaran'],
                    'IdDosen'               => $data['As_1'],
                    'Status'                => 'Y',
                    'User_Rpl_AssesorEmail' => $this->__helpers->SecretOpen( $_SESSION['__Rpl__']['__Nama'] ),
                    'Log_Rpl_AssesorEmail'  => date('Y-m-d H:i:s'),
                    'Kampus'                => __Aplikasi()['Kampus'],
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__AssesorEmailModel->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                $this->__db->commit();

                                $__dosen__ = $this->__db->queryid(" SELECT TOP 1 EmailDosen, EmailPribadi, IdDosen, NamaGelar AS Nama, '1' AS Assesor FROM Dosen WHERE IdDosen = '". $data['As_1'] ."' ORDER BY IdDosen DESC ");

                                $__data_rpl_pendaftaran__ = $this->__SessionController->__Data_Rpl__( $data['Id_Rpl_Pendaftaran'] );

                                @require_once dirname(dirname(__DIR__)) . '/api/__send_email.php';

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Sukses Kirim Email Dosen',
                                    'Data'    => '',
                                ];
                                exit(); 

                            } else {

                                $this->__db->rollback();

                                return [
                                    'Error'   => '999',
                                    'Message' => 'Tidak Berhasil Kirim Email',
                                    'Data'    => '',
                                ];
                                exit(); 

                            }

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                    }

            }


            $__check_2__ = $this->__db->queryrow(" SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen = '". $data['As_2'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' ");

            if ( @$__check_2__ == FALSE ) {

                $__session = [
                    'Id_Rpl_Pendaftaran'    => $data['Id_Rpl_Pendaftaran'],
                    'IdDosen'               => $data['As_2'],
                    'Status'                => 'Y',
                    'User_Rpl_AssesorEmail' => $this->__helpers->SecretOpen( $_SESSION['__Rpl__']['__Nama'] ),
                    'Log_Rpl_AssesorEmail'  => date('Y-m-d H:i:s'),
                    'Kampus'                => __Aplikasi()['Kampus'],
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__AssesorEmailModel->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                $this->__db->commit();

                                $__dosen__ = $this->__db->queryid(" SELECT TOP 1 EmailDosen, EmailPribadi, IdDosen, NamaGelar AS Nama, '2' AS Assesor FROM Dosen WHERE IdDosen = '". $data['As_2'] ."' ORDER BY IdDosen DESC ");

                                $__data_rpl_pendaftaran__ = $this->__SessionController->__Data_Rpl__( $data['Id_Rpl_Pendaftaran'] );

                                @require_once dirname(dirname(__DIR__)) . '/api/__send_email.php';

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Sukses Kirim Email Dosen',
                                    'Data'    => '',
                                ];
                                exit(); 

                            } else {

                                $this->__db->rollback();

                                return [
                                    'Error'   => '999',
                                    'Message' => 'Tidak Berhasil Kirim Email',
                                    'Data'    => '',
                                ];
                                exit(); 

                            }

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                    }

            }


            $__check_3__ = $this->__db->queryrow(" SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen = '". $data['As_3'] ."' AND Kampus = '". __Aplikasi()['Kampus'] ."' ");

            if ( @$__check_3__ == FALSE ) {

                $__session = [
                    'Id_Rpl_Pendaftaran'    => $data['Id_Rpl_Pendaftaran'],
                    'IdDosen'               => $data['As_3'],
                    'Status'                => 'Y',
                    'User_Rpl_AssesorEmail' => $this->__helpers->SecretOpen( $_SESSION['__Rpl__']['__Nama'] ),
                    'Log_Rpl_AssesorEmail'  => date('Y-m-d H:i:s'),
                    'Kampus'                => __Aplikasi()['Kampus'],
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__AssesorEmailModel->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {

                                $this->__db->commit();

                                $__dosen__ = $this->__db->queryid(" SELECT TOP 1 EmailDosen, EmailPribadi, IdDosen, NamaGelar AS Nama, '3' AS Assesor FROM Dosen WHERE IdDosen = '". $data['As_3'] ."' ORDER BY IdDosen DESC ");

                                $__data_rpl_pendaftaran__ = $this->__SessionController->__Data_Rpl__( $data['Id_Rpl_Pendaftaran'] );

                                @require_once dirname(dirname(__DIR__)) . '/api/__send_email.php';

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Sukses Kirim Email Dosen',
                                    'Data'    => '',
                                ];
                                exit(); 

                            } else {

                                $this->__db->rollback();

                                return [
                                    'Error'   => '999',
                                    'Message' => 'Tidak Berhasil Kirim Email',
                                    'Data'    => '',
                                ];
                                exit(); 

                            }

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                    }

            }
        }

        public function __Create_Email__Old(array $data)
        {
            $assessorIds = [$data['As_1'], $data['As_2'], $data['As_3']];
            foreach ($assessorIds as $index => $idDosen) {
                if ($this->checkEmailExists($data['Id_Rpl_Pendaftaran'], $idDosen)) {
                    continue; // Skip if email already exists
                }

                $sessionData = $this->prepareSessionData($data['Id_Rpl_Pendaftaran'], $idDosen);
                
                try {
                    $this->__db->beginTransaction();
                    $queryResult = $this->__AssesorEmailModel->create($sessionData);

                    if ($queryResult['Error'] === '000') {
                        $this->__db->commit();
                        $this->sendEmailNotification($idDosen, $data['Id_Rpl_Pendaftaran']);
                        
                        return [
                            'Error'   => '000',
                            'Message' => 'Sukses Kirim Email Dosen',
                            'Data'    => '',
                        ];
                    } else {
                        $this->__db->rollback();
                        return [
                            'Error'   => '999',
                            'Message' => 'Tidak Berhasil Kirim Email',
                            'Data'    => '',
                        ];
                    }
                } catch (PDOException $e) {
                    $this->__db->rollback();
                    return [
                        'Error'   => '999',
                        'Message' => 'Error: ' . $e->getMessage(),
                        'Data'    => '',
                    ];
                }
            }
        }

        private function checkEmailExists($idRplPendaftaran, $idDosen)
        {
            return $this->__db->queryrow("SELECT Id_Rpl_AssesorEmail AS Id FROM Tbl_Rpl_AssesorEmail WHERE Id_Rpl_Pendaftaran = '$idRplPendaftaran' AND IdDosen = '$idDosen' AND Kampus = '" . __Aplikasi()['Kampus'] . "'") !== false;
        }

        private function prepareSessionData($idRplPendaftaran, $idDosen)
        {
            return [
                'Id_Rpl_Pendaftaran'    => $idRplPendaftaran,
                'IdDosen'               => $idDosen,
                'Status'                => 'Y',
                'User_Rpl_AssesorEmail' => $this->__helpers->SecretOpen($_SESSION['__Rpl__']['__Nama']),
                'Log_Rpl_AssesorEmail'  => date('Y-m-d H:i:s'),
                'Kampus'                => __Aplikasi()['Kampus'],
            ];
        }

        private function sendEmailNotification($idDosen, $idRplPendaftaran)
        {
            // Fetch additional information if necessary
            $dosenInfo = $this->__db->queryid("SELECT TOP 1 EmailDosen, EmailPribadi, IdDosen, NamaGelar AS Nama, '$idDosen' AS Assesor FROM Dosen WHERE IdDosen = '$idDosen' ORDER BY IdDosen DESC");
            $dataRplPendaftaran = $this->__SessionController->__Data_Rpl__($idRplPendaftaran);

            // Include the email sending logic
            @require_once dirname(dirname(__DIR__)) . '/api/__send_email.php';
        }
    }