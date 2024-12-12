<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor1.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor2.php';
    require_once dirname(__DIR__) . '/../models/dosen/Assesor3.php';
    require_once dirname(__DIR__) . '/../models/administrator/Profesiensi.php';
    require_once dirname(__DIR__) . '/../models/administrator/Hasilevaluasiasesor.php';
    require_once dirname(__DIR__) . '/../models/administrator/KeteranganDokumen.php';
    require_once dirname(__DIR__) . '/../models/administrator/NomorDokumen.php';
    require_once dirname(__DIR__) . '/../models/dosen/Sk.php';

    class HomedosenRplController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__Assesor1Model;
        protected $__Assesor2Model;
        protected $__Assesor3Model;
        protected $__ProfesiensiModel;
        protected $__HasilevaluasiasesorModel;
        protected $__KeteranganDokumenModel;
        protected $__NomorDokumenModel;
        protected $__SkModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__Assesor1Model = new __Assesor1Model($this->__db);
            $this->__Assesor2Model = new __Assesor2Model($this->__db);
            $this->__Assesor3Model = new __Assesor3Model($this->__db);
            $this->__ProfesiensiModel = new __ProfesiensiModel($this->__db);
            $this->__HasilevaluasiasesorModel = new __HasilevaluasiasesorModel($this->__db);
            $this->__KeteranganDokumenModel = new __KeteranganDokumenModel($this->__db);
            $this->__NomorDokumenModel = new __NomorDokumenModel($this->__db);
            $this->__SkModel = new __SkModel($this->__db);
        }

        public function __Header()
        {
            return 'Dosen | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homedosen/rpl');
        }

        public function __Routes_Mod_File__()
        {
            return __Base_Url() . 'src/storages/__dokumen/';
        }
        
        public function IndexDosen_Rpl()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );
                
                $__filter_ta__ = self::__Filter_Ta();
                $__filter_semester__ = self::__Filter_Semester();

                if ( isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $__record_data_1__ = $this->__Assesor( ['Assesor' => '1', 'IdDosen' => $__authlogin__->Id, 'Ta' => $_POST['__Ta'], 'Semester' => $_POST['__Semester']] );
                    $__nomor_1 = '1';
                    $__record_data_assesor_1__ = [];
                    foreach ( $__record_data_1__ AS $data => $__record_1__ ) : 

                        $__telpon_dosen = $this->__db->queryid(" SELECT TOP 1 Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_1__->D_2 ."' ORDER BY IdDosen DESC ");

                        if ( $__record_1__->S_1 == 'Y' ) {
                            $__status_1 = 'Sudah Selesai';
                            $__progress_1 = '100';
                        } elseif ( $__record_1__->S_1 == 'N' ) {
                            $__status_1 = 'Belum Selesai';
                            $__progress_1 = '50';
                        } else {
                            $__status_1 = '404';
                            $__progress_1 = '0';
                        }

                        $__record_data_assesor_1__[] = [
                            'Nomor'         => $__nomor_1++,
                            'Id'            => $__record_1__->Id,
                            'IdDosen'       => $__authlogin__->Id,
                            'NamaDosen'     => $__authlogin__->Nama,
                            'Cek_Status'    => $__record_1__->S_1,
                            'Status'        => $__status_1,
                            'Progres'       => $__progress_1,
                            'TglDaftar'     => $this->__helpers->TanggalWaktu( $__record_1__->Daftar_1 ),
                            'TglHapus'      => $this->__helpers->TanggalWaktu( $__record_1__->Hapus_1 ),
                            'Ta'            => $__record_1__->Ta_1,
                            'Semester'      => $__record_1__->Semester_1,
                            'Prodi'         => $__record_1__->Prodi_1,
                            'Hp'            => $__telpon_dosen->Hp,
                            'Telepon'       => $__telpon_dosen->Telepon,
                            'Id_Rpl_Pendaftaran' => $__record_1__->Id_Rpl_Pendaftaran,
                        ];

                    endforeach;
                    
                }

                if ( $_GET['__Ta'] == TRUE && $_GET['__Semester'] == TRUE ) {

                    $__record_data_1__ = $this->__Assesor( ['Assesor' => '1', 'IdDosen' => $__authlogin__->Id, 'Ta' => $_GET['__Ta'], 'Semester' => $_GET['__Semester']] );
                    $__nomor_1 = '1';
                    $__record_data_assesor_1__ = [];
                    foreach ( $__record_data_1__ AS $data => $__record_1__ ) : 

                        $__telpon_dosen = $this->__db->queryid(" SELECT TOP 1 Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_1__->D_2 ."' ORDER BY IdDosen DESC ");

                        $__hasil_progress__ = $this->__helpers->__Progres_Assesor( $__record_1__->S_1 , $__record_1__->S_2 , $__record_1__->S_3 );

                        $__progress_1 = $__hasil_progress__['1'];
                        $__progress_2 = $__hasil_progress__['2'];
                        $__progress_3 = $__hasil_progress__['3'];

                        if ( $__record_1__->S_1 == 'Y' ) {
                            $__status_1 = 'Sudah Selesai';
                        } elseif ( $__record_1__->S_1 == 'N' ) {
                            $__status_1 = 'Belum Selesai';
                        } else {
                            $__status_1 = '404';
                        }

                        $__record_data_assesor_1__[] = [
                            'Nomor'         => $__nomor_1++,
                            'Id'            => $__record_1__->Id,
                            'IdDosen'       => $__authlogin__->Id,
                            'NamaDosen'     => $__authlogin__->Nama,
                            'Cek_Status'    => $__record_1__->S_1,
                            'Status'        => $__status_1,
                            'Progres'       => $__progress_1,
                            'TglDaftar'     => $this->__helpers->TanggalWaktu( $__record_1__->Daftar_1 ),
                            'TglHapus'      => $this->__helpers->TanggalWaktu( $__record_1__->Hapus_1 ),
                            'TglHapus_1'    => $__record_1__->Hapus_1,
                            'Ta'            => $__record_1__->Ta_1,
                            'Semester'      => $__record_1__->Semester_1,
                            'Prodi'         => $__record_1__->Prodi_1,
                            'Hp'            => $__telpon_dosen->Hp,
                            'Telepon'       => $__telpon_dosen->Telepon,
                            'Id_Rpl_Pendaftaran' => $__record_1__->Id_Rpl_Pendaftaran,
                        ];

                    endforeach;
                    
                }

                if ( $_GET['__Ta'] == TRUE && $_GET['__Semester'] == TRUE ) {

                    $__ta       = $_GET['__Ta'];
                    $__semester = $_GET['__Semester'];

                } elseif ( $_POST['__Ta'] == TRUE && $_POST['__Semester'] == TRUE ) {

                    $__ta       = $_POST['__Ta'];
                    $__semester = $_POST['__Semester'];

                }

                $__db = $this->__db;
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

            }
        }

        public function IndexDosen_Rpl_2()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/2';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( $__authlogin__->Id == TRUE AND isset($_GET['__Ta']) AND $_GET['__Semester'] == TRUE ) {
                
                    $__filter_ta__ = self::__Filter_Ta();
                    $__filter_semester__ = self::__Filter_Semester();

                    $__record_data_2__ = $this->__Assesor( ['Assesor' => '2', 'IdDosen' => $__authlogin__->Id, 'Ta' => $_GET['__Ta'], 'Semester' => $_GET['__Semester']] );
                    $__nomor_2 = '1';
                    $__record_data_assesor_2__ = [];
                    foreach ( $__record_data_2__ AS $data => $__record_2__ ) : 

                        $__telpon_dosen = $this->__db->queryid(" SELECT TOP 1 Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_2__->D_3 ."' ORDER BY IdDosen DESC ");

                        $__hasil_progress__ = $this->__helpers->__Progres_Assesor( $__record_2__->S_1 , $__record_2__->S_2 , $__record_2__->S_3 );

                        $__progress_1 = $__hasil_progress__['1'];
                        $__progress_2 = $__hasil_progress__['2'];
                        $__progress_3 = $__hasil_progress__['3'];

                        if ( $__record_2__->S_2 == 'Y' ) {
                            $__status_2 = 'Sudah Selesai';
                        } elseif ( $__record_2__->S_2 == 'N' ) {
                            $__status_2 = 'Belum Selesai';
                        } else {
                            $__status_2 = '404';
                        }

                        $__record_data_assesor_2__[] = [
                            'Nomor'         => $__nomor_2++,
                            'Id'            => $__record_2__->Id,
                            'IdDosen'       => $__authlogin__->Id,
                            'NamaDosen'     => $__authlogin__->Nama,
                            'Cek_Status'    => $__record_2__->S_2,
                            'Status'        => $__status_2,
                            'Progres'       => $__progress_2,
                            'TglDaftar'     => $this->__helpers->TanggalWaktu( $__record_2__->Daftar_2 ),
                            'TglHapus'      => $this->__helpers->TanggalWaktu( $__record_2__->Hapus_2 ),
                            'TglHapus_2'    => $__record_2__->Hapus_2,
                            'Ta'            => $__record_2__->Ta_2,
                            'Semester'      => $__record_2__->Semester_2,
                            'Prodi'         => $__record_2__->Prodi_2,
                            'Check_As_1'    => $__record_2__->S_1,
                            'Hp'            => $__telpon_dosen->Hp,
                            'Telepon'       => $__telpon_dosen->Telepon,
                            'Id_Rpl_Pendaftaran' => $__record_2__->Id_Rpl_Pendaftaran,
                        ];

                    endforeach;

                    if ( $_GET['__Ta'] == TRUE && $_GET['__Semester'] == TRUE ) {

                        $__ta       = $_GET['__Ta'];
                        $__semester = $_GET['__Semester'];

                    }

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_3()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/3';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( $__authlogin__->Id == TRUE AND isset($_GET['__Ta']) AND $_GET['__Semester'] == TRUE ) {
                
                    $__filter_ta__ = self::__Filter_Ta();
                    $__filter_semester__ = self::__Filter_Semester();

                    $__record_data_3__ = $this->__Assesor( ['Assesor' => '3', 'IdDosen' => $__authlogin__->Id, 'Ta' => $_GET['__Ta'], 'Semester' => $_GET['__Semester']] );
                    $__nomor_3 = '1';
                    $__record_data_assesor_3__ = [];
                    foreach ( $__record_data_3__ AS $data => $__record_3__ ) : 

                        $__telpon_dosen_1 = $this->__db->queryid(" SELECT TOP 1 Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_3__->D_1 ."' ORDER BY IdDosen DESC ");
                        $__telpon_dosen_2 = $this->__db->queryid(" SELECT TOP 1 Hp, Telepon FROM Dosen WHERE IdDosen = '". $__record_3__->D_2 ."' ORDER BY IdDosen DESC ");

                        $__hasil_progress__ = $this->__helpers->__Progres_Assesor( $__record_3__->S_1 , $__record_3__->S_2 , $__record_3__->S_3 );

                        $__progress_1 = $__hasil_progress__['1'];
                        $__progress_2 = $__hasil_progress__['2'];
                        $__progress_3 = $__hasil_progress__['3'];

                        if ( $__record_3__->S_3 == 'Y' ) {
                            $__status_3 = 'Sudah Selesai';
                        } elseif ( $__record_3__->S_3 == 'N' ) {
                            $__status_3 = 'Belum Selesai';
                        } else {
                            $__status_3 = '404';
                        }

                        $__record_data_assesor_3__[] = [
                            'Nomor'         => $__nomor_3++,
                            'Id'            => $__record_3__->Id,
                            'IdDosen'       => $__authlogin__->Id,
                            'NamaDosen'     => $__authlogin__->Nama,
                            'Cek_Status'    => $__record_3__->S_3,
                            'Status'        => $__status_3,
                            'Progres'       => $__progress_3,
                            'TglDaftar'     => $this->__helpers->TanggalWaktu( $__record_3__->Daftar_3 ),
                            'TglHapus'      => $this->__helpers->TanggalWaktu( $__record_3__->Hapus_3 ),
                            'TglHapus_3'    => $__record_3__->Hapus_3,
                            'Ta'            => $__record_3__->Ta_3,
                            'Semester'      => $__record_3__->Semester_3,
                            'Prodi'         => $__record_3__->Prodi_3,
                            'Check_As_2'    => $__record_3__->S_2,
                            'Hp_1'          => $__telpon_dosen_1->Hp,
                            'Telepon_1'     => $__telpon_dosen_1->Telepon,
                            'Hp_2'          => $__telpon_dosen_2->Hp,
                            'Telepon_2'     => $__telpon_dosen_2->Telepon,
                            'Id_Rpl_Pendaftaran' => $__record_3__->Id_Rpl_Pendaftaran,
                        ];

                    endforeach;

                    if ( $_GET['__Ta'] == TRUE && $_GET['__Semester'] == TRUE ) {

                        $__ta       = $_GET['__Ta'];
                        $__semester = $_GET['__Semester'];

                    }

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_4()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/4';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( $__authlogin__->Id == TRUE AND isset($_GET['__Ta']) AND $_GET['__Semester'] == TRUE ) {
                
                    $__filter_ta__ = self::__Filter_Ta();
                    $__filter_semester__ = self::__Filter_Semester();

                    $__record_data_4__ = $this->__Assesor( ['Assesor' => 'DOSEN', 'IdDosen' => $__authlogin__->Id, 'Ta' => $_GET['__Ta'], 'Semester' => $_GET['__Semester']] );
                    $__nomor_4 = '1';
                    $__record_data_assesor_4__ = [];
                    foreach ( $__record_data_4__ AS $data => $__record_4__ ) : 

                        $__data_dosen_1 = $this->__SessionController->__Data_Dosen__( $__record_4__->D_1 );
                        $__data_dosen_2 = $this->__SessionController->__Data_Dosen__( $__record_4__->D_2 );
                        $__data_dosen_3 = $this->__SessionController->__Data_Dosen__( $__record_4__->D_3 );

                        $__data_rpl_mahasiswa = $this->__Data_Rpl__( $__record_4__->Id_Rpl_Pendaftaran );

                        $__data_sk_rpl = $this->__SkModel->read(['Id_Rpl_Pendaftaran' => $__data_rpl_mahasiswa->Id, 'Id_Rpl_Assesor' => $__record_4__->Id]);

                        if ( isset($__data_sk_rpl->Id) AND $__data_sk_rpl->Id == TRUE ) {

                            $__sk_id_sk = $__data_sk_rpl->Id;
                            $__sk_nomor = $__data_sk_rpl->Nomor;
                            $__sk_tgl   = $this->__helpers->TanggalWaktu( $__data_sk_rpl->Tgl );

                        } else {

                            $__sk_id_sk = '';
                            $__sk_nomor = '';
                            $__sk_tgl   = '';

                        }

                        $__record_data_assesor_4__[] = [
                            'Nomor'         => $__nomor_4++,
                            'Id'            => $__record_4__->Id,
                            'Rpl_Nama'      => $__data_rpl_mahasiswa->Nama,
                            'Rpl_Prodi'     => $__data_rpl_mahasiswa->Prodi,
                            'Rpl_TipeJenis' => isset($__data_rpl_mahasiswa->TipeJenis) ? $__data_rpl_mahasiswa->TipeJenis : '-',
                            '1_IdDosen'     => $__data_dosen_1->Id,
                            '1_NamaDosen'   => $__data_dosen_1->Nama,
                            '1_Validasi'    => $__record_4__->Validasi_1 === 'Y' ? '<span class="badge bg-primary">Validasi</span>' : '-',
                            '1_Selesai'     => $__record_4__->Validasi_1,
                            '1_Tgl'         => $__record_4__->Validasi_1 === 'Y' ? $this->__helpers->TanggalWaktu( $__record_4__->Tgl_1 ) : '-',
                            '1_Status'      => $__record_4__->S_1,
                            '2_IdDosen'     => $__data_dosen_2->Id,
                            '2_NamaDosen'   => $__data_dosen_2->Nama,
                            '2_Validasi'    => $__record_4__->Validasi_2 === 'Y' ? '<span class="badge bg-primary">Validasi</span>' : '-',
                            '2_Selesai'     => $__record_4__->Validasi_2,
                            '2_Tgl'         => $__record_4__->Validasi_2 === 'Y' ? $this->__helpers->TanggalWaktu( $__record_4__->Tgl_2 ) : '-',
                            '2_Status'      => $__record_4__->S_2,
                            '3_IdDosen'     => $__data_dosen_3->Id,
                            '3_NamaDosen'   => $__data_dosen_3->Nama,
                            '3_Validasi'    => $__record_4__->Validasi_3 === 'Y' ? '<span class="badge bg-primary">Validasi</span>' : '-',
                            '3_Selesai'     => $__record_4__->Validasi_3,
                            '3_Tgl'         => $__record_4__->Validasi_3 === 'Y' ? $this->__helpers->TanggalWaktu( $__record_4__->Tgl_3 ) : '-',
                            '3_Status'      => $__record_4__->S_3,
                            'Sk_Id'         => $__sk_id_sk,
                            'Sk_Nomor'      => $__sk_nomor,
                            'Sk_Tgl'        => $__sk_tgl,
                            'Id_Rpl_Pendaftaran' => $__record_4__->Id_Rpl_Pendaftaran,
                        ];

                    endforeach;

                    if ( $_GET['__Ta'] == TRUE && $_GET['__Semester'] == TRUE ) {

                        $__ta       = $_GET['__Ta'];
                        $__semester = $_GET['__Semester'];

                    }

                    $__db = $this->__db;
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_4_Validasi()
        {   
            $__explode  = explode("/",$this->__helpers->SecretOpen( $_GET['__Req'] ));
            $__ta       = $__explode[0];
            $__semester = $__explode[1];
            
            if ( $this->__helpers->SecretOpen( $_GET['__Id'] ) == FALSE OR $_GET['__Check'] == FALSE OR $this->__helpers->SecretOpen( $_GET['__Req'] ) == FALSE ) 
            {
                
                redirect(self::__Routes_Mod__() . '/4?__Ta=' . $__ta . '&__Semester=' . $__semester, '03', 'ID Tidak Valid !');
                exit();
                
            }
            
            $__check_data_assesor__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor AS Id, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' AND As1_Status_Rpl_Assesor = 'Y' AND As2_Status_Rpl_Assesor = 'Y' AND As3_Status_Rpl_Assesor = 'Y' ORDER BY Id_Rpl_Assesor DESC ");

            if ( !$__check_data_assesor__->Id ) 
            {

                redirect(self::__Routes_Mod__() . '/4?__Ta=' . $__ta . '&__Semester=' . $__semester, '03', 'Data Tidak Ditemukan Pendaftar Assesor !');
                exit();
                
            }

            if ( $_GET['__Check'] == '1' ) {

                $__session = [
                    'Validasi_1_Rpl_Assesor'    => 'Y',
                    'Tgl_1_Rpl_Assesor'         => date('Y-m-d H:i:s'),
                    'User_Rpl_Assesor'          => 'Validasi Assesor 1 Akhir',
                    'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                    'Id_Rpl_Assesor'            => $__check_data_assesor__->Id,
                ];

            } elseif ( $_GET['__Check'] == '2' ) {

                $__session = [
                    'Validasi_2_Rpl_Assesor'    => 'Y',
                    'Tgl_2_Rpl_Assesor'         => date('Y-m-d H:i:s'),
                    'User_Rpl_Assesor'          => 'Validasi Assesor 2 Akhir',
                    'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                    'Id_Rpl_Assesor'            => $__check_data_assesor__->Id,
                ];

            } elseif ( $_GET['__Check'] == '3' ) {

                $__nomor_sk = [
                    'Id_Rpl_Assesor'        => $__check_data_assesor__->Id,
                    'Id_Rpl_Pendaftaran'    => $__check_data_assesor__->Id_Rpl_Pendaftaran,
                    'Ta'                    => $__ta,
                    'Semester'              => $__semester,
                ];

                $__result_nomor_sk__ = $this->Nomor_Sk( $__nomor_sk );

                if ( $__result_nomor_sk__['Error'] != '000' ) {

                    redirect(self::__Routes_Mod__() . '/4?__Ta=' . $__ta . '&__Semester=' . $__semester, '03', $__result_nomor_sk__['Message']);
                    exit();

                }   

                $__session = [
                    'Validasi_3_Rpl_Assesor'    => 'Y',
                    'Tgl_3_Rpl_Assesor'         => date('Y-m-d H:i:s'),
                    'User_Rpl_Assesor'          => 'Validasi Assesor 3 Akhir',
                    'Log_Rpl_Assesor'           => date('Y-m-d H:i:s'),
                    'Id_Rpl_Assesor'            => $__check_data_assesor__->Id,
                ];

            }
            
                try {

                    $this->__db->beginTransaction();

                        if ( $_GET['__Check'] == '1' ) {

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Assesor SET
                                        Validasi_1_Rpl_Assesor      = :Validasi_1_Rpl_Assesor,
                                        Tgl_1_Rpl_Assesor           = :Tgl_1_Rpl_Assesor,
                                        User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                        Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                    WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                "
                            ) -> execute ( $__session );

                        } elseif ( $_GET['__Check'] == '2' ) {

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Assesor SET
                                        Validasi_2_Rpl_Assesor      = :Validasi_2_Rpl_Assesor,
                                        Tgl_2_Rpl_Assesor           = :Tgl_2_Rpl_Assesor,
                                        User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                        Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                    WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                "
                            ) -> execute ( $__session );

                        } elseif ( $_GET['__Check'] == '3' ) {

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Assesor SET
                                        Validasi_3_Rpl_Assesor      = :Validasi_3_Rpl_Assesor,
                                        Tgl_3_Rpl_Assesor           = :Tgl_3_Rpl_Assesor,
                                        User_Rpl_Assesor            = :User_Rpl_Assesor, 
                                        Log_Rpl_Assesor             = :Log_Rpl_Assesor
                                    WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                "
                            ) -> execute ( $__session );

                        }

                        unset( $_SESSION['__Form_Notifikasi__'] );
                        unset( $_SESSION['__Old__'] );
                        
                    $this->__db->commit();

                    redirect(self::__Routes_Mod__() . '/4?__Ta=' . $__ta . '&__Semester=' . $__semester, '01', 'Berhasil Validasi Data Untuk Assesor Ke ' . $_GET['__Check']);
                    exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect(self::__Routes_Mod__() . '/4?__Ta=' . $__ta . '&__Semester=' . $__semester, '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }

        public function Nomor_Sk( array $data )
        {
            $__check_nomor = $this->__db->queryrow(" SELECT Id_Rpl_Sk AS Id FROM Tbl_Rpl_Sk WHERE Ta_Rpl_Sk = '". $data['Ta'] ."' AND Semester_Rpl_Sk = '". $data['Semester'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Data = 'Y' ");

            if ( $__check_nomor == TRUE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Nomor Surat Telah Terbuat !',
                    'Data'      => '',
                ];

            }

            $__data_rpl__ = $this->__Data_Rpl__( $data['Id_Rpl_Pendaftaran'] );

            if ( $__data_rpl__->Id == FALSE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Data RPL Pendaftaran Tidak Di Temukan !',
                    'Data'      => '',
                ];

            }

            $tanggal_nomor        = explode("-", date('Y-m-d'));
            $tahun_nomor          = $tanggal_nomor[0];
            $bulan_ambil          = $tanggal_nomor[1];
            $bulan_nomor          = $this->__helpers->RomawiBulan($bulan_ambil);

            $query_number         = $this->__db->queryid(" SELECT MAX(number) AS maxKode FROM Tbl_StartNumber WHERE lokasi = '". __Aplikasi()['Kampus'] ."' ");
            $noidnilai_1          = $query_number->maxKode + 1;
            $noidnilai            = $this->__helpers->FormatNomorSurat($noidnilai_1);

            if ( $noidnilai == FALSE OR $noidnilai == '0' OR $noidnilai < '1' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Nomor Surat Baru Tidak Ada !',
                    'Data'      => '',
                ];

            }

            $__ket = $this->__helpers->__Singkat_Fakultas( $__data_rpl__->IdFakultas );

            if ( $__ket == '-' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Mohon Maaf Keterangan FAKULTAS Tidak Ada !',
                    'Data'      => '',
                ];

            }

                try {

                    $this->__db->beginTransaction();

                        if ( __Aplikasi()['Kampus'] == 'UQM' ) {
                            $alokasi_uq = 'UQ';
                        } elseif ( __Aplikasi()['Kampus'] == 'UQB' ) {
                            $alokasi_uq = 'UQB';
                        } else {
                            $alokasi_uq = 'UQ';
                        } 

                        $__skt__ = 'SKT';
                        $__rpl__ = 'REK';
                        // $__rpl__ = 'RPL';

                        $nomor_surat = $noidnilai."/".$__skt__."/".$__rpl__."/".$alokasi_uq."/".$bulan_nomor."/".$tahun_nomor;
                        
                        
                        $__update_startnumber = [
                            'number'    => $noidnilai,
                            'lokasi'    => __Aplikasi()['Kampus'],
                        ];

                        $__sql_statunumber = $this->__db->prepare( 
                            "
                                UPDATE Tbl_StartNumber SET
                                    number      = :number
                                WHERE lokasi    = :lokasi
                            "
                        ) -> execute ( $__update_startnumber );
                        

                        $__insert_detail_surat = [
                            'id_surat'          => $noidnilai,
                            'id_naskah'         => $__skt__,
                            'perihal'           => 'SURAT KETERANGAN',
                            'kepada'            => 'MAHASISWA RPL',
                            'id_penandatangan'  => $__rpl__, 
                            'tgl_permohonan'    => date('Y-m-d'), 
                            'gambar_ori'        => '', 
                            'gambar'            => '', 
                            'Status'            => 'Selesai', 
                            'UserId'            => $__data_rpl__->Nama, 
                            'JenisSurat'        => 'Biasa', 
                            'gambar_revisi'     => '', 
                            'lokasi'            => __Aplikasi()['Kampus'],
                        ];

                        $__sql_detailsurat = $this->__db->prepare( 
                            "
                                INSERT INTO Tbl_detail_surat 
                                (
                                    id_surat, id_naskah, perihal, kepada, 
                                    id_penandatangan, tgl_permohonan, gambar_ori, gambar, Status, 
                                    UserId, JenisSurat, gambar_revisi, lokasi
                                ) 
                                VALUES 
                                (
                                    :id_surat, :id_naskah, :perihal, :kepada, 
                                    :id_penandatangan, :tgl_permohonan, :gambar_ori, :gambar, :Status, 
                                    :UserId, :JenisSurat, :gambar_revisi, :lokasi
                                ) 
                            "
                        ) -> execute ( $__insert_detail_surat );


                        $__insert_surat = [
                            'id_surat'          => $noidnilai,
                            'no_surat'          => $noidnilai,
                            'keterangan'        => $nomor_surat,
                            'lokasi'            => __Aplikasi()['Kampus'],
                        ];

                        $__sql_surat = $this->__db->prepare( 
                            "
                                INSERT INTO Tbl_Surat 
                                (
                                    id_surat, no_surat, keterangan, lokasi
                                ) 
                                VALUES 
                                (
                                    :id_surat, :no_surat, :keterangan, :lokasi
                                ) 
                            "
                        ) -> execute ( $__insert_surat );


                        $__insert_sk = [
                            'Ta_Rpl_Sk'             => $data['Ta'],
                            'Semester_Rpl_Sk'       => $data['Semester'],
                            'Nomor_Rpl_Sk'          => $nomor_surat,
                            'TglBuat_Rpl_Sk'        => date('Y-m-d H:i:s'),
                            'User_Rpl_Sk'           => $__data_rpl__->Nama,
                            'Log_Rpl_Sk'            => date('Y-m-d H:i:s'),
                            'IdKampus'              => __Aplikasi()['IdKampus'],
                            'Kampus'                => __Aplikasi()['Kampus'],
                            'Data'                  => 'Y',
                            'Id_Rpl_Pendaftaran'    => $__data_rpl__->Id,
                            'Id_Rpl_Assesor'        => $data['Id_Rpl_Assesor'],
                        ];

                        $__sql_sk = $this->__SkModel->create( $__insert_sk );

                        if ( $__sql_sk['Error'] === '000' ) {

                            $this->__db->commit();

                            return [
                                'Error'     => '000',
                                'Message'   => 'SUKSES',
                                'Data'      => '',
                            ];

                        } else {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Erro SK: ' . $e->getMessage(),
                                'Data'      => '',
                            ];

                        }

                } catch (Exception $e) {

                    $this->__db->rollback();

                    return [
                        'Error'     => '999',
                        'Message'   => 'A Data Error Occurred SK: ' . $e->getMessage(),
                        'Data'      => '',
                    ];
                    
                }
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

        public function __Assesor( array $data )
        {
            if ( $data['Assesor'] == '1' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As1_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As1_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == '2' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As2_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As2_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As2_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == '3' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE As3_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As3_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As3_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == 'ID' ) {

                $result = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $data['Id'] ."' ORDER BY Id_Rpl_Assesor DESC ");

            } elseif ( $data['Assesor'] == 'DOSEN' ) {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor AS Id, As1_Dosen_Rpl_Assesor AS D_1, As1_Status_Rpl_Assesor AS S_1, As1_TglDaftar_Rpl_Assesor AS Daftar_1, As1_TglHapus_Rpl_Assesor AS Hapus_1, As1_Ta_Rpl_Assesor AS Ta_1, As1_Semester_Rpl_Assesor As Semester_1, As1_Prodi_Rpl_Assesor As Prodi_1, As2_Dosen_Rpl_Assesor AS D_2, As2_Status_Rpl_Assesor AS S_2, As2_TglDaftar_Rpl_Assesor AS Daftar_2, As2_TglHapus_Rpl_Assesor AS Hapus_2, As2_Ta_Rpl_Assesor AS Ta_2, As2_Semester_Rpl_Assesor As Semester_2, As2_Prodi_Rpl_Assesor As Prodi_2, As3_Dosen_Rpl_Assesor AS D_3, As3_Status_Rpl_Assesor AS S_3, As3_TglDaftar_Rpl_Assesor AS Daftar_3, As3_TglHapus_Rpl_Assesor AS Hapus_3, As3_Ta_Rpl_Assesor AS Ta_3, As3_Semester_Rpl_Assesor As Semester_3, As3_Prodi_Rpl_Assesor As Prodi_3, User_Rpl_Assesor AS Users, Log_Rpl_Assesor AS Logs, IdKampus, Kampus, Id_Rpl_Pendaftaran, Validasi_1_Rpl_Assesor AS Validasi_1, Tgl_1_Rpl_Assesor AS Tgl_1, Validasi_2_Rpl_Assesor AS Validasi_2, Tgl_2_Rpl_Assesor AS Tgl_2, Validasi_3_Rpl_Assesor AS Validasi_3, Tgl_3_Rpl_Assesor AS Tgl_3 FROM Tbl_Rpl_Assesor WHERE As1_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As1_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As1_Semester_Rpl_Assesor = '". $data['Semester'] ."' OR As2_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As2_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As2_Semester_Rpl_Assesor = '". $data['Semester'] ."' OR As3_Dosen_Rpl_Assesor = '". $data['IdDosen'] ."' AND As3_Ta_Rpl_Assesor = '". $data['Ta'] ."' AND As3_Semester_Rpl_Assesor = '". $data['Semester'] ."' ORDER BY Id_Rpl_Assesor DESC ");
                
            }

            return $result;
        }

        public function __Url_File__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl/';
        }

        public function __Url_File_Penunjang__()
        {
            return $this->__universitas->__Url_Universitas()['Pmb'] . 'src/storages/__berkas_rpl_penunjang/';
        }
        
        public function __Data_Rpl__( $id )
        {
            $data = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran AS Id, Nama_Rpl_Pendaftaran AS Nama, 'Rpl' AS Level, Ta_Rpl_Pendaftaran AS Ta, Semester_Rpl_Pendaftaran AS Semester, Kurikulum_Rpl_Pendaftaran AS Kurikulum, Gelombang_Rpl_Pendaftaran AS Gelombang, TglDaftar_Rpl_Pendaftaran AS TglDaftar, NoRegistrasi_Rpl_Pendaftaran AS NoRegistrasi, JenisKelamin_Rpl_Pendaftaran AS JenisKelamin, TempatLahir_Rpl_Pendaftaran AS TempatLahir, TanggalLahir_Rpl_Pendaftaran AS TglLahir, NoHp_Rpl_Pendaftaran AS NoHp, NoWa_Rpl_Pendaftaran AS NoWa, Email_Rpl_Pendaftaran AS Email, Alamat_Rpl_Pendaftaran AS Alamat, JenjangAkhir_Rpl_Pendaftaran AS JenjangAkhir, IdKampus_Rpl_Pendaftaran AS IdKampus, NamaKampus_Rpl_Pendaftaran AS NamaKampus, IdPtAsal_Rpl_Pendaftaran AS IdPtAsal, NamaPtAsal_Rpl_Pendaftaran AS NamaPtAsal, IdProdiAsal_Rpl_Pendaftaran AS IdProdiAsal, NamaProdiAsal_Rpl_Pendaftaran AS NamaProdiAsal, Prodi_Rpl_Pendaftaran AS Prodi, IdFakultas_Rpl_Pendaftaran AS IdFakultas, Fakultas_Rpl_Pendaftaran AS NamaFakultas, JamPerkuliahan_Rpl_Pendaftaran AS JamPerkuliahan, Referensi_Rpl_Pendaftaran AS Referensi, NamaReferensi_Rpl_Pendaftaran AS NamaReferensi, FileKtp_Rpl_Pendaftaran AS FileKtp, FormatKtp_Rpl_Pendaftaran AS FormatKtp, FileKk_Rpl_Pendaftaran AS FileKk, FormatKk_Rpl_Pendaftaran AS FormatKk, FileNilai_Rpl_Pendaftaran AS FileNilai, FormatNilai_Rpl_Pendaftaran AS FormatNilai, PasswordEmail_Rpl_Pendaftaran AS PasswordEmail, Nomor_Rpl_Pendaftaran AS Nomor, Sekolah_Rpl_Pendaftaran AS Sekolah, TipePt_Rpl_Pendaftaran AS TipePt, Bekerja_Rpl_Pendaftaran AS Bekerja, LamaBekerja_Rpl_Pendaftaran AS LamaBekerja, Kategori_Rpl_Pendaftaran AS Kategori, Studi_Rpl_Pendaftaran AS Studi, Jenis_Rpl_Pendaftaran AS Jenis, TipeJenis_Rpl_Pendaftaran AS TipeJenis FROM Tbl_Rpl_Pendaftaran WHERE Id_Rpl_Pendaftaran = '". $id ."' AND Data = 'Y' AND Selesai = 'Y' ORDER BY Id_Rpl_Pendaftaran DESC ");

            return $data;
        } 

        public function __Data_Rpl_Berkas__( $id )
        {

            $data = $this->__db->query(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $id ."' AND Data = 'Y' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

            return $data;
        } 

        public function IndexDosen_Rpl_Cms_1()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_1';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    if ( date('Y-m-d H:i:s', strtotime($__record_data__->Hapus_1)) > date('Y-m-d H:i:s') OR $__record_data__->S_1 == 'Y' ) {

                        $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                        $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                        
                        $__url_file = $this->__Url_File__();
                        $__url_file_penunjang = $this->__Url_File_Penunjang__();

                        $__record_data_detail__ = $this->__Assesor1Model->read(['Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1]);

                        if ( is_array($__record_data_detail__) && !empty($__record_data_detail__) ) {

                            $__nomor__ = '1';
                            $__total_sks = 0;

                        }

                        $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);
                        
                        require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Mohon Maaf Akses Kamu Di Tolak Karna Sudah Lewat Batas Kamu Hanya Sampai Tanggal ' . $this->__helpers->TanggalWaktu( $__record_data__->Hapus_1 ) .' !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_1_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__IdRpl'           => isset($data['__IdRpl']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRpl'], ENT_QUOTES))) : '',
                '__Assesor'         => isset($data['__Assesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__Assesor'], ENT_QUOTES))) : '',
                '__IdMk'            => isset($data['__IdMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdMk'], ENT_QUOTES))) : '',
                '__NamaMk'          => isset($data['__NamaMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__NamaMk'], ENT_QUOTES))) : '',
                '__Sks'             => isset($data['__Sks']) ? stripslashes(strip_tags(htmlspecialchars($data['__Sks'], ENT_QUOTES))) : '',
                '__NilaiMk'         => isset($data['__NilaiMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__NilaiMk'], ENT_QUOTES))) : '',
                '__HurufMk'         => isset($data['__HurufMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__HurufMk'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__IdMk'            => $__clean_data['__IdMk'],
                '__NamaMk'          => $__clean_data['__NamaMk'],
                '__Sks'             => $__clean_data['__Sks'],
                '__NilaiMk'         => $__clean_data['__NilaiMk'],
                '__HurufMk'         => $__clean_data['__HurufMk'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__assesor__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__Id'] )] );
                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__assesor__->D_1 ."' ORDER BY IdDosen DESC ");

                $__check_idmk = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_1 AS Id FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $__assesor__->Id ."' AND Id_Rpl_Pendaftaran = '". $__assesor__->Id_Rpl_Pendaftaran ."' AND IdDosen_Rpl_Assesor_1 = '". $__assesor__->D_1 ."' AND Ta_Rpl_Assesor_1 = '". $__assesor__->Ta_1 ."' AND Semester_Rpl_Assesor_1 = '". $__assesor__->Semester_1 ."' AND Prodi_Rpl_Assesor_1 = '". $__assesor__->Prodi_1 ."' AND IdMk_Rpl_Assesor_1 = '". $__clean_data['__IdMk'] ."' ");

                if ( $__check_idmk == TRUE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf IDMK ' . $__clean_data['__IdMk'] . ' Dengan Matakuliah ' . $__clean_data['__NamaMk'] . ' Sudah Tersedia !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__titik_nilai = substr($__clean_data['__NilaiMk'],1,1);

                if ( $__titik_nilai != '.' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Nilai Angka Wajib Mengikuti Format, Contohnya ' . substr($__clean_data['__NilaiMk'],0,1) . '.' . substr($__clean_data['__NilaiMk'],2,2) . ' !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__session = [
                    '__IdMk'        => $__clean_data['__IdMk'],
                    '__NamaMk'      => $__clean_data['__NamaMk'],
                    '__Sks'         => $__clean_data['__Sks'],
                    '__NilaiMk'     => $__clean_data['__NilaiMk'],
                    '__User'        => $__data_dosen->Nama,
                    '__Log'         => date('Y-m-d H:i:s'),
                    '__IdKampus'    => __Aplikasi()['IdKampus'],
                    '__Kampus'      => __Aplikasi()['Kampus'],
                    '__Data'        => 'Y',
                    '__Id_Assesor'  => $__assesor__->Id,
                    '__Id_Rpl'      => $__assesor__->Id_Rpl_Pendaftaran,
                    '__IdDosen'     => $__assesor__->D_1,
                    '__Ta'          => $__assesor__->Ta_1,
                    '__Semester'    => $__assesor__->Semester_1,
                    '__Prodi'       => $__assesor__->Prodi_1,
                    '__HurufMk'     => $__clean_data['__HurufMk'],
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__Assesor1Model->create( $__session );

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

        public function IndexDosen_Rpl_Cms_1_Hapus()
        {
            if ( $this->__helpers->SecretOpen( $_GET['__Id'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__Id1'] ) == FALSE ) {
                
                redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'ID Tidak Valid !');
                exit();
                
            }

            $__check_data__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_1 AS Id FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor_1 = '". $this->__helpers->SecretOpen( $_GET['__Id1'] ) ."' AND Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ");

            if ( !$__check_data__ ) {

                redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'Data Tidak Ditemukan !');
                exit();
                
            }

            $__session = [
                '__Id_Assesor'  => $this->__helpers->SecretOpen( $_GET['__Id1'] ),
                '__Id_Rpl'      => $this->__helpers->SecretOpen( $_GET['__Id'] ),
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__query_result = $this->__Assesor1Model->delete( $__session );

                        if ( $__query_result['Error'] === '000' ) {

                            unset( $_SESSION['__Form_Notifikasi__'] );
                            unset( $_SESSION['__Old__'] );
                            
                            $this->__db->commit();

                            redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '01', 'Berhasil Hapus Data');
                            exit();

                        } else {

                            $this->__db->rollback();

                            redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'Error Query');
                            exit();

                        }

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }

        public function IndexDosen_Rpl_Cms_1_Validasi()
        {
            if ( $this->__helpers->SecretOpen( $_GET['__Id'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__Id1'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__As1'] ) == FALSE ) 
            {
                
                redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'ID Tidak Valid !');
                exit();
                
            }
            
            $__check_data_pendaftar__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' AND As1_Dosen_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__As1'] ) ."' AND As1_Status_Rpl_Assesor = 'N' ");

            if ( !$__check_data_pendaftar__ ) 
            {

                redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'Data Tidak Ditemukan Pendaftar !');
                exit();
                
            }

            $__check_data__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor_1 AS Id FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor_1 = '". $this->__helpers->SecretOpen( $_GET['__Id1'] ) ."' AND Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ");

            $__session = [
                '__Status'      => 'Y',
                '__TglHapus'    => $this->__helpers->__TambahTanggal(),
                '__User'        => 'Validasi Assesor 1',
                '__Log'         => date('Y-m-d H:i:s'),
                '__Id_Assesor'  => $this->__helpers->SecretOpen( $_GET['__Id'] ),
                '__IdDosen'     => $this->__helpers->SecretOpen( $_GET['__As1'] ),
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Assesor SET
                                    As1_Status_Rpl_Assesor      = :__Status,
                                    As2_TglHapus_Rpl_Assesor    = :__TglHapus,
                                    User_Rpl_Assesor            = :__User, 
                                    Log_Rpl_Assesor             = :__Log
                                WHERE Id_Rpl_Assesor            = :__Id_Assesor
                                AND As1_Dosen_Rpl_Assesor       = :__IdDosen
                            "
                        ) -> execute ( $__session );

                        unset( $_SESSION['__Form_Notifikasi__'] );
                        unset( $_SESSION['__Old__'] );
                        
                    $this->__db->commit();

                    redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '01', 'Berhasil Validasi Data');
                    exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect(self::__Routes_Mod__() . '/cms_1?__Id=' . $_GET['__Id'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }

        public function __Filter_ListMatakuliah( array $data )
        {   
            $result = $this->__db->query(" SELECT IdPrimary AS Id, Kurikulum, IdKampus, IdFakultas, Prodi, IdMk, Sks, Semester, Ta, MkPilihan FROM ProdiMk WHERE Prodi = '". $data['Prodi'] ."' AND Kurikulum = '". $data['Kurikulum'] ."' AND IdKampus = '". $data['IdKampus'] ."' ORDER BY Semester ASC ");
            
            return $result;
        }

        public function IndexDosen_Rpl_Cms_2()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    if ( date('Y-m-d H:i:s', strtotime($__record_data__->Hapus_2)) > date('Y-m-d H:i:s') OR $__record_data__->S_2 == 'Y' ) {

                        $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                        $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                        
                        $__url_file = $this->__Url_File__();
                        $__url_file_penunjang = $this->__Url_File_Penunjang__();

                        $__record_data_detail__ = $this->__Assesor1Model->read(['Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1]);

                        if ( is_array($__record_data_detail__) && !empty($__record_data_detail__) ) {

                            $__nomor__ = '1';
                            $__total_sks = 0;

                        }

                            // $__req_filter = [
                            //     'Prodi'     => $__calon_rpl__->Prodi,
                            //     'Kurikulum' => $__calon_rpl__->Kurikulum,
                            //     'IdKampus'  => $__calon_rpl__->IdKampus,
                            // ];
                            // $__record_data__ = $this->__Filter_ListMatakuliah( $__req_filter );

                            // $__nomor = '1';
                            // $__record__data__ = [];
                            // foreach ( $__record_data__ AS $data => $__record__ ) : 

                            //     $data_matakuliah = $this->__db->queryid(" SELECT TOP 1 IdPrimary AS Id, IdMk, Matakuliah, Semester, Sks, Tipe, Skripsi, ProdiMatakuliah, Pkl, Id_Mk AS IdMk_Feeder, Rpl FROM Matakuliah WHERE IdMk = '". $__record__->IdMk ."' ORDER BY IdMk DESC ");

                            //     $__record__data__[] = [
                            //         'Nomor'         => $__nomor++,
                            //         'IdMk'          => $data_matakuliah->IdMk,
                            //         'Matakuliah'    => $data_matakuliah->Matakuliah,
                            //         'Sks'           => $data_matakuliah->Sks,
                            //         'Ta'            => $__record__->Ta,
                            //         'Semester'      => $__record__->Semester,
                            //         'Rpl'           => $data_matakuliah->Rpl,
                            //     ];

                            // endforeach;

                        $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);
                    
                        require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Mohon Maaf Akses Kamu Di Tolak Karna Sudah Lewat Batas Kamu Hanya Sampai Tanggal ' . $this->__helpers->TanggalWaktu( $__record_data__->Hapus_2 ) .' !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__Id1']) AND $_GET['__Id1'] == TRUE AND isset($_GET['__IdMk']) AND $_GET['__IdMk'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    $__record_data_detail__ = $this->__Assesor1Model->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id1'] ),'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1]);


                    $__data_filter_assesor_2 = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Assesor_2 AS Id, IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Pilih, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Pilih, Sks_Pilih_Rpl_Assesor_2 AS Sks_Pilih, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen, File_Rpl_Assesor_2 AS Files, Judul_Rpl_Assesor_2 AS Judul, Format_Rpl_Assesor_2 AS Format, Slugs_Rpl_Assesor_2 AS Slugs, User_Rpl_Assesor_2 AS Users, Log_Rpl_Assesor_2 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2 AS IdDosen, Ta_Rpl_Assesor_2 AS Ta, Semester_Rpl_Assesor_2 AS Semester, Prodi_Rpl_Assesor_2 AS Prodi, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE IdMk_Asal_Rpl_Assesor_2 = '". $__record_data_detail__->IdMk ."' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND IdDosen_Rpl_Assesor_2 = '". $__record_data__->D_2 ."' AND Ta_Rpl_Assesor_2 = '". $__record_data__->Ta_2 ."' AND Semester_Rpl_Assesor_2 = '". $__record_data__->Semester_2 ."' AND Prodi_Rpl_Assesor_2 = '". $__record_data__->Prodi_2 ."' AND Id_Rpl_Assesor_1 = '". $__record_data_detail__->Id ."' ORDER BY Id_Rpl_Assesor_2 DESC ");

                    if ( !isset($__data_filter_assesor_2->Id) ) {

                        $__data_filter_matakuliah__ = $this->__db->query(" SELECT DISTINCT B.IdMk, B.Matakuliah, B.Sks FROM ProdiMk A LEFT JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.Prodi = '". $__calon_rpl__->Prodi ."' AND A.Kurikulum = '". $__calon_rpl__->Kurikulum ."' AND A.IdKampus = '". $__calon_rpl__->IdKampus ."' AND B.Rpl = 'Y' ");
                        $__record__data__filter__ = [];
                        foreach ( $__data_filter_matakuliah__ AS $data => $__record__ ) : 

                            $__record__data__filter__[] = [
                                'IdMk'          => $__record__->IdMk,
                                'Matakuliah'    => $__record__->Matakuliah,
                                'Sks'           => $__record__->Sks,
                            ];

                        endforeach;

                    }


                    if ( (isset( $_POST['__BtnSubmit_Filter'] ) && $_SERVER['REQUEST_METHOD'] == 'POST') || isset($__data_filter_assesor_2->Id) ) {

                        $__get_filter_idmk = isset($__data_filter_assesor_2->Id) ? $__data_filter_assesor_2->IdMk_Pilih : $_POST['__Filter_IdMk'];

                        $__filter_data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $__get_filter_idmk ."' ORDER BY IdMK DESC ");

                        $__data_evaluasidiri__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");
                        
                        $__data_profesiensi__ = $this->__ProfesiensiModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                        // $__data_profesiensi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_Profesiensi ) AS Total FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                        $__data_hasilevaluasi__ = $this->__HasilevaluasiasesorModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                        $__data_hasilevaluasi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_HasilEvaluasiAsesor ) AS Total FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                        $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read();
                        // $__data_keterangandokumen__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_KeteranganDokumen ) AS Total FROM Tbl_Rpl_Cms_KeteranganDokumen ");

                        // $__data_cpmk__ = $this->__db->queryid(" SELECT DISTINCT C.IdMk, C.Matakuliah FROM Tbl_Cpmk ALEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE A.Id_Penugasan <> '' AND B.IdMk = '". $this->__helpers->SecretOpen( $_GET['__IdMk'] ) ."' AND C.IdMk = '". $this->__helpers->SecretOpen( $_GET['__IdMk'] ) ."' ORDER BY C.IdMk DESC ");
                        
                        $__nomor_cpmk__ = '1';
                        $__check_cpmk__ = $this->__db->queryrow(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__filter_data_matakuliah__->IdMk ."' AND C.IdMk = '". $__filter_data_matakuliah__->IdMk ."' ORDER BY A.Id_Cpmk DESC ");

                        if ( $__check_cpmk__ == TRUE ) {

                            $__data_cpmk__ = $this->__db->query(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__filter_data_matakuliah__->IdMk ."' AND C.IdMk = '". $__filter_data_matakuliah__->IdMk ."' ORDER BY A.Id_Cpmk DESC ");

                        } else {

                            $__data_cpmk_awal__ = $this->__db->queryid(" SELECT A.Id_Penugasan AS Id FROM Tbl_Penugasan A LEFT JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE B.Matakuliah LIKE '%". $__filter_data_matakuliah__->Matakuliah ."%' ");

                            $__data_cpmk__ = $this->__db->query(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE A.Id_Penugasan = '". $__data_cpmk_awal__->Id ."' AND B.Id_Penugasan = '". $__data_cpmk_awal__->Id ."' ORDER BY A.Id_Cpmk DESC ");

                        }

                    }

                    $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);
                
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Upload()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah/upload';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__Id1']) AND $_GET['__Id1'] == TRUE AND isset($_GET['__IdMk']) AND $_GET['__IdMk'] == TRUE AND isset($_GET['__IdMkCpmk']) AND $_GET['__IdMkCpmk'] == TRUE AND isset($_GET['__IdCpmk']) AND $_GET['__IdCpmk'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    $__record_data_detail__ = $this->__Assesor1Model->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id1'] ),'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1]);

                    
                        $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $_GET['__IdMkCpmk'] ) ."' ORDER BY IdMK DESC ");

                        $__data_evaluasidiri__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");
                        
                        $__data_profesiensi__ = $this->__ProfesiensiModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                        // $__data_profesiensi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_Profesiensi ) AS Total FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                        $__data_hasilevaluasi__ = $this->__HasilevaluasiasesorModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                        $__data_hasilevaluasi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_HasilEvaluasiAsesor ) AS Total FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                        $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read();
                        // $__data_keterangandokumen__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_KeteranganDokumen ) AS Total FROM Tbl_Rpl_Cms_KeteranganDokumen ");
                        
                        $__data_nomordokumen__ = $this->__NomorDokumenModel->read();

                        $__data_cpmk__ = $this->__db->queryid(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__data_matakuliah__->IdMk ."' AND C.IdMk = '". $__data_matakuliah__->IdMk ."' AND A.Id_Cpmk = '". $this->__helpers->SecretOpen( $_GET['__IdCpmk'] ) ."' ORDER BY A.Id_Cpmk DESC ");

                    $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);
                
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Upload_Simpan_Old( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdAssesor_1'                     => isset($data['__IdAssesor_1']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_1'], ENT_QUOTES))) : '',
                '__IdAssesor_1_IdMk'                => isset($data['__IdAssesor_1_IdMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_1_IdMk'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdMk_Cpmk'                       => isset($data['__IdMk_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdMk_Cpmk'], ENT_QUOTES))) : '',
                '__Id_Cpmk'                         => isset($data['__Id_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id_Cpmk'], ENT_QUOTES))) : '',
                '__Post_Profesiensi'                => isset($data['__Post_Profesiensi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Post_Profesiensi'], ENT_QUOTES))) : '',
                '__Post_HasilEvaluasiAssesor'       => isset($data['__Post_HasilEvaluasiAssesor']) ? $data['__Post_HasilEvaluasiAssesor'] : '',
                '__Post_IdKeteranganDokumen'        => isset($data['__Post_IdKeteranganDokumen']) ? stripslashes(strip_tags(htmlspecialchars($data['__Post_IdKeteranganDokumen'], ENT_QUOTES))) : '',
                '__File_Name'                       => isset($_FILES['__Post_File']['name']) ? $_FILES['__Post_File']['name'] : '',
                '__File_Size'                       => isset($_FILES['__Post_File']['size']) ? $_FILES['__Post_File']['size'] : '',
                '__File_Type'                       => isset($_FILES['__Post_File']['type']) ? $_FILES['__Post_File']['type'] : '',
                '__File_Tmp'                        => isset($_FILES['__Post_File']['tmp_name']) ? $_FILES['__Post_File']['tmp_name'] : '',
            ];

            // $_SESSION['__Old__'] = [
            //     '__IdMk'            => $__clean_data['__IdMk'],
            //     '__NamaMk'          => $__clean_data['__NamaMk'],
            //     '__Sks'             => $__clean_data['__Sks'],
            //     '__NilaiMk'         => $__clean_data['__NilaiMk'],
            // ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdAssesor_1'] == FALSE OR $__clean_data['__IdAssesor_1_IdMk'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdMk_Cpmk'] == FALSE OR $__clean_data['__Id_Cpmk'] == FALSE OR $__clean_data['__Post_Profesiensi'] == FALSE OR $__clean_data['__Post_HasilEvaluasiAssesor'] == FALSE OR $__clean_data['__Post_IdKeteranganDokumen'] == FALSE OR $__clean_data['__File_Name'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  

                

                $__jumlah_hasilevaluasi__ = COUNT( $__clean_data['__Post_HasilEvaluasiAssesor'] );

                if ( $__jumlah_hasilevaluasi__ == '0' OR $__jumlah_hasilevaluasi__ <= '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Hasil Evaluasi Wajib Di Pilih Salah Satu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }



                $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read( $__clean_data['__Post_IdKeteranganDokumen'] );

                $__export_getdata_file = $this->__helpers->__GetData_File_Dokumen( 'dokumen' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' , $__data_keterangandokumen__->Format , $__data_keterangandokumen__->Ukuran , str_replace(" ","",$__data_keterangandokumen__->Judul) );

                if ( $__export_getdata_file['__Error'] != '00' ) {

                    return $result = [
                        'Error'     => '999',
                        'Message'   => $__export_getdata_file['__Message'],
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                
                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );

                $__record_data_assesor_1__ = $this->__Assesor1Model->read(['Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_1'] ),'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1, 'IdMk' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_1_IdMk'] )]);

                $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' ORDER BY IdMK DESC ");

                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");

                if ( $__record_data__->Id == FALSE OR $__calon_rpl__->Id == FALSE OR $__record_data_assesor_1__->Id == FALSE OR $__data_matakuliah__->IdMk == FALSE OR $__data_dosen->Id == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Request Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                $__nama_file__ = $this->__helpers->HurufBesar( substr($__export_getdata_file['__Nama_File'],0,1) ) . '_' . date('dmY') . '_' . rand(9,9999);
                
                $__session = [
                    'IdMk_Asal_Rpl_Assesor_2'               => $__record_data_assesor_1__->IdMk,
                    'Matakuliah_Asal_Rpl_Assesor_2'         => $__record_data_assesor_1__->Matakuliah,
                    'Sks_Asal_Rpl_Assesor_2'                => $__record_data_assesor_1__->Sks,
                    'IdMk_Pilih_Rpl_Assesor_2'              => $__data_matakuliah__->IdMk,
                    'Matakuliah_Pilih_Rpl_Assesor_2'        => $__data_matakuliah__->Matakuliah,
                    'Sks_Pilih_Rpl_Assesor_2'               => $__data_matakuliah__->Sks,
                    'Id_Cpmk'                               => $this->__helpers->SecretOpen( $__clean_data['__Id_Cpmk'] ),
                    'Id_Rpl_Cms_Profesiensi'                => $__clean_data['__Post_Profesiensi'],
                    'Id_Rpl_Cms_KeteranganDokumen'          => $__data_keterangandokumen__->Id,
                    'File_Rpl_Assesor_2'                    => $__export_getdata_file['__Nama_File'],
                    'Judul_Rpl_Assesor_2'                   => $__nama_file__,
                    'Format_Rpl_Assesor_2'                  => $__export_getdata_file['__Format_File'],
                    'Slugs_Rpl_Assesor_2'                   => $__nama_file__,
                    'User_Rpl_Assesor_2'                    => $__data_dosen->Nama,
                    'Log_Rpl_Assesor_2'                     => date('Y-m-d H:i:s'),
                    'IdKampus'                              => __Aplikasi()['IdKampus'],
                    'Kampus'                                => __Aplikasi()['Kampus'],
                    'Data'                                  => 'Y',
                    'Id_Rpl_Assesor'                        => $__record_data__->Id,
                    'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                    'IdDosen_Rpl_Assesor_2'                 => $__data_dosen->Id,
                    'Ta_Rpl_Assesor_2'                      => $__record_data__->Ta_2,
                    'Semester_Rpl_Assesor_2'                => $__record_data__->Semester_2,
                    'Prodi_Rpl_Assesor_2'                   => $__record_data__->Prodi_2,
                    'Id_Rpl_Assesor_1'                      => $__record_data_assesor_1__->Id,
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__Assesor2Model->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {
                                
                                $this->__db->commit();

                                move_uploaded_file($__export_getdata_file['__Tmp_File'], $__export_getdata_file['__Path_File']);

                                $__success_assesor_2 = '000';

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

                    
                    if ( $__success_assesor_2 == '000' ) {

                        $__record_data_assesor_2__ = $this->__Assesor2Model->read(['Show' => '1','Id_Rpl_Assesor' => $__session['Id_Rpl_Assesor'], 'Id_Rpl_Pendaftaran' => $__session['Id_Rpl_Pendaftaran'], 'IdDosen' => $__session['IdDosen_Rpl_Assesor_2'], 'Ta' => $__session['Ta_Rpl_Assesor_2'], 'Semester' => $__session['Semester_Rpl_Assesor_2'], 'Prodi' => $__session['Prodi_Rpl_Assesor_2'], 'IdMk_Asal' => $__session['IdMk_Asal_Rpl_Assesor_2'], 'IdMk_Pilih' => $__session['IdMk_Pilih_Rpl_Assesor_2'], 'Id_Rpl_Assesor_1' => $__session['Id_Rpl_Assesor_1']]);

                        if ( isset($__record_data_assesor_2__->Id) AND $__record_data_assesor_2__->Id == TRUE ) {

                            for ( $x = 0; $x < $__jumlah_hasilevaluasi__; $x++ ) {

                                $__session_hasilevaluasi = [
                                    'Id_Rpl_Cms_HasilEvaluasiAsesor'      => $__clean_data['__Post_HasilEvaluasiAssesor'][$x],
                                    'User_Rpl_Assesor_2_HasilEvaluasi'    => $__data_dosen->Nama,
                                    'Log_Rpl_Assesor_2_HasilEvaluasi'     => date('Y-m-d H:i:s'),
                                    'IdKampus'                            => __Aplikasi()['IdKampus'],
                                    'Kampus'                              => __Aplikasi()['Kampus'],
                                    'Data'                                => 'Y',
                                    'Id_Rpl_Assesor_1'                    => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                    'Id_Rpl_Assesor_2'                    => $__record_data_assesor_2__->Id,
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__query_result_hasilevaluasi = $this->__Assesor2Model->create_hasilevaluasi( $__session_hasilevaluasi );

                                        if ( $__query_result_hasilevaluasi['Error'] === '000' ) {
                                            
                                            $this->__db->commit();

                                            $__success_hasilevaluasi = '000';

                                        } else {

                                            $this->__db->rollback();

                                            $__session_delete_assesor_2 = [
                                                'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                                'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                                'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                                'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                                'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                                'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                                'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                                'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                                'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                                'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                            ];

                                            try {

                                                $this->__db->beginTransaction();

                                                    $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                                    if ( $__query_result_detele['Error'] === '000' ) {
                                                        
                                                        $this->__db->commit();

                                                        return [
                                                            'Error'   => '000',
                                                            'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                            'Data'    => [
                                                                'Url'   => $__clean_data['__Url'],
                                                            ],
                                                        ];
                                                        exit();

                                                    } else {

                                                        $this->__db->rollback();
                                                        
                                                        return [
                                                            'Error'   => '999',
                                                            'Message' => 'Error Query Hapus Assesor 2',
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
                                                    'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                                    'Data'    => [
                                                        'Url'   => $__clean_data['__Url'],
                                                    ],
                                                ];
                                                exit();

                                            }
                                            
                                            return [
                                                'Error'   => '999',
                                                'Message' => 'Error Query Hasil Evaluasi',
                                                'Data'    => [
                                                    'Url'   => $__clean_data['__Url'],
                                                ],
                                            ];
                                            exit();

                                        }

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                    $__session_delete_assesor_2 = [
                                        'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                        'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                        'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                        'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                        'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                        'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                        'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                        'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                        'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                        'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                    ];

                                    try {

                                        $this->__db->beginTransaction();

                                            $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                            if ( $__query_result_detele['Error'] === '000' ) {
                                                
                                                $this->__db->commit();

                                                return [
                                                    'Error'   => '000',
                                                    'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                    'Data'    => [
                                                        'Url'   => $__clean_data['__Url'],
                                                    ],
                                                ];
                                                exit();

                                            } else {

                                                $this->__db->rollback();
                                                
                                                return [
                                                    'Error'   => '999',
                                                    'Message' => 'Error Query Hapus Assesor 2',
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
                                            'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                            'Data'    => [
                                                'Url'   => $__clean_data['__Url'],
                                            ],
                                        ];
                                        exit();

                                    }

                                    return [
                                        'Error'   => '999',
                                        'Message' => 'A Data Error Hasil Evaluasi Occurred : ' . $e->getMessage(),
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                                }

                            }

                            if ( $__success_hasilevaluasi == '000' ) {

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Berhasil Simpan Data !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url_Success'],
                                    ],
                                ];
                                exit();

                            } else {

                                $__session_delete_assesor_2 = [
                                    'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                    'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                    'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                    'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                    'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                    'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                    'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                    'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                    'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                    'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                        if ( $__query_result_detele['Error'] === '000' ) {
                                            
                                            $this->__db->commit();

                                            return [
                                                'Error'   => '000',
                                                'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                'Data'    => [
                                                    'Url'   => $__clean_data['__Url'],
                                                ],
                                            ];
                                            exit();

                                        } else {

                                            $this->__db->rollback();
                                            
                                            return [
                                                'Error'   => '999',
                                                'Message' => 'Error Query Hapus Assesor 2',
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
                                        'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                                }

                            }

                        } else {

                            $__session_delete_assesor_2 = [
                                'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                            ];

                            try {

                                $this->__db->beginTransaction();

                                    $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                    if ( $__query_result_detele['Error'] === '000' ) {
                                        
                                        $this->__db->commit();

                                        return [
                                            'Error'   => '000',
                                            'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                            'Data'    => [
                                                'Url'   => $__clean_data['__Url'],
                                            ],
                                        ];
                                        exit();

                                    } else {

                                        $this->__db->rollback();
                                        
                                        return [
                                            'Error'   => '999',
                                            'Message' => 'Error Query Hapus Assesor 2',
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
                                    'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                        }

                    } else {

                        return [
                            'Error'   => '999',
                            'Message' => 'Tidak Berhasil Simpan Data !',
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
        
        public function IndexDosen_Rpl_Cms_2_Matakuliah_Upload_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdAssesor_1'                     => isset($data['__IdAssesor_1']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_1'], ENT_QUOTES))) : '',
                '__IdAssesor_1_IdMk'                => isset($data['__IdAssesor_1_IdMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_1_IdMk'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdMk_Cpmk'                       => isset($data['__IdMk_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdMk_Cpmk'], ENT_QUOTES))) : '',
                '__Id_Cpmk'                         => isset($data['__Id_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id_Cpmk'], ENT_QUOTES))) : '',
                '__Post_Profesiensi'                => isset($data['__Post_Profesiensi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Post_Profesiensi'], ENT_QUOTES))) : '',
                '__Post_HasilEvaluasiAssesor'       => isset($data['__Post_HasilEvaluasiAssesor']) ? $data['__Post_HasilEvaluasiAssesor'] : '',
                '__Post_NomorDokumen'               => isset($data['__Post_NomorDokumen']) ? $data['__Post_NomorDokumen'] : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdAssesor_1'] == FALSE OR $__clean_data['__IdAssesor_1_IdMk'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdMk_Cpmk'] == FALSE OR $__clean_data['__Id_Cpmk'] == FALSE OR $__clean_data['__Post_Profesiensi'] == FALSE OR $__clean_data['__Post_HasilEvaluasiAssesor'] == FALSE OR $__clean_data['__Post_NomorDokumen'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  


                $__jumlah_hasilevaluasi__ = COUNT( $__clean_data['__Post_HasilEvaluasiAssesor'] );
                $__jumlah_nomordokumen__ = COUNT( $__clean_data['__Post_NomorDokumen'] );

                if ( $__jumlah_hasilevaluasi__ == '0' OR $__jumlah_hasilevaluasi__ <= '0' OR $__jumlah_nomordokumen__ == '0' OR $__jumlah_nomordokumen__ <= '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Hasil Evaluasi dan Nomor Dokumen Wajib Di Pilih Salah Satu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                
                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );

                $__record_data_assesor_1__ = $this->__Assesor1Model->read(['Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_1'] ),'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1, 'IdMk' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_1_IdMk'] )]);

                $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' ORDER BY IdMK DESC ");

                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");

                if ( $__record_data__->Id == FALSE OR $__calon_rpl__->Id == FALSE OR $__record_data_assesor_1__->Id == FALSE OR $__data_matakuliah__->IdMk == FALSE OR $__data_dosen->Id == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Request Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                $__nama_file__ = '-';
                
                $__session = [
                    'IdMk_Asal_Rpl_Assesor_2'               => $__record_data_assesor_1__->IdMk,
                    'Matakuliah_Asal_Rpl_Assesor_2'         => $__record_data_assesor_1__->Matakuliah,
                    'Sks_Asal_Rpl_Assesor_2'                => $__record_data_assesor_1__->Sks,
                    'IdMk_Pilih_Rpl_Assesor_2'              => $__data_matakuliah__->IdMk,
                    'Matakuliah_Pilih_Rpl_Assesor_2'        => $__data_matakuliah__->Matakuliah,
                    'Sks_Pilih_Rpl_Assesor_2'               => $__data_matakuliah__->Sks,
                    'Id_Cpmk'                               => $this->__helpers->SecretOpen( $__clean_data['__Id_Cpmk'] ),
                    'Id_Rpl_Cms_Profesiensi'                => $__clean_data['__Post_Profesiensi'],
                    'Id_Rpl_Cms_KeteranganDokumen'          => $__nama_file__,
                    'File_Rpl_Assesor_2'                    => $__nama_file__,
                    'Judul_Rpl_Assesor_2'                   => $__nama_file__,
                    'Format_Rpl_Assesor_2'                  => $__nama_file__,
                    'Slugs_Rpl_Assesor_2'                   => $__nama_file__,
                    'User_Rpl_Assesor_2'                    => $__data_dosen->Nama,
                    'Log_Rpl_Assesor_2'                     => date('Y-m-d H:i:s'),
                    'IdKampus'                              => __Aplikasi()['IdKampus'],
                    'Kampus'                                => __Aplikasi()['Kampus'],
                    'Data'                                  => 'Y',
                    'Id_Rpl_Assesor'                        => $__record_data__->Id,
                    'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                    'IdDosen_Rpl_Assesor_2'                 => $__data_dosen->Id,
                    'Ta_Rpl_Assesor_2'                      => $__record_data__->Ta_2,
                    'Semester_Rpl_Assesor_2'                => $__record_data__->Semester_2,
                    'Prodi_Rpl_Assesor_2'                   => $__record_data__->Prodi_2,
                    'Id_Rpl_Assesor_1'                      => $__record_data_assesor_1__->Id,
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__Assesor2Model->create( $__session );

                            if ( $__query_result['Error'] === '000' ) {
                                
                                $this->__db->commit();

                                $__success_assesor_2 = '000';

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
                    
                    if ( $__success_assesor_2 == '000' ) {

                        $__record_data_assesor_2__ = $this->__Assesor2Model->read(['Show' => '1','Id_Rpl_Assesor' => $__session['Id_Rpl_Assesor'], 'Id_Rpl_Pendaftaran' => $__session['Id_Rpl_Pendaftaran'], 'IdDosen' => $__session['IdDosen_Rpl_Assesor_2'], 'Ta' => $__session['Ta_Rpl_Assesor_2'], 'Semester' => $__session['Semester_Rpl_Assesor_2'], 'Prodi' => $__session['Prodi_Rpl_Assesor_2'], 'IdMk_Asal' => $__session['IdMk_Asal_Rpl_Assesor_2'], 'IdMk_Pilih' => $__session['IdMk_Pilih_Rpl_Assesor_2'], 'Id_Rpl_Assesor_1' => $__session['Id_Rpl_Assesor_1']]);

                        if ( isset($__record_data_assesor_2__->Id) AND $__record_data_assesor_2__->Id == TRUE ) {

                            for ( $x = 0; $x < $__jumlah_hasilevaluasi__; $x++ ) {

                                $__session_hasilevaluasi = [
                                    'Id_Rpl_Cms_HasilEvaluasiAsesor'      => $__clean_data['__Post_HasilEvaluasiAssesor'][$x],
                                    'User_Rpl_Assesor_2_HasilEvaluasi'    => $__data_dosen->Nama,
                                    'Log_Rpl_Assesor_2_HasilEvaluasi'     => date('Y-m-d H:i:s'),
                                    'IdKampus'                            => __Aplikasi()['IdKampus'],
                                    'Kampus'                              => __Aplikasi()['Kampus'],
                                    'Data'                                => 'Y',
                                    'Id_Rpl_Assesor_1'                    => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                    'Id_Rpl_Assesor_2'                    => $__record_data_assesor_2__->Id,
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__query_result_hasilevaluasi = $this->__Assesor2Model->create_hasilevaluasi( $__session_hasilevaluasi );

                                        if ( $__query_result_hasilevaluasi['Error'] === '000' ) {
                                            
                                            $this->__db->commit();

                                            $__success_hasilevaluasi = '000';

                                        } else {

                                            $this->__db->rollback();

                                            $__session_delete_assesor_2 = [
                                                'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                                'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                                'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                                'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                                'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                                'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                                'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                                'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                                'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                                'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                            ];

                                            try {

                                                $this->__db->beginTransaction();

                                                    $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                                    if ( $__query_result_detele['Error'] === '000' ) {
                                                        
                                                        $this->__db->commit();

                                                        return [
                                                            'Error'   => '000',
                                                            'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                            'Data'    => [
                                                                'Url'   => $__clean_data['__Url'],
                                                            ],
                                                        ];
                                                        exit();

                                                    } else {

                                                        $this->__db->rollback();
                                                        
                                                        return [
                                                            'Error'   => '999',
                                                            'Message' => 'Error Query Hapus Assesor 2',
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
                                                    'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                                    'Data'    => [
                                                        'Url'   => $__clean_data['__Url'],
                                                    ],
                                                ];
                                                exit();

                                            }
                                            
                                            return [
                                                'Error'   => '999',
                                                'Message' => 'Error Query Hasil Evaluasi',
                                                'Data'    => [
                                                    'Url'   => $__clean_data['__Url'],
                                                ],
                                            ];
                                            exit();

                                        }

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                    $__session_delete_assesor_2 = [
                                        'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                        'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                        'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                        'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                        'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                        'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                        'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                        'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                        'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                        'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                    ];

                                    try {

                                        $this->__db->beginTransaction();

                                            $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                            if ( $__query_result_detele['Error'] === '000' ) {
                                                
                                                $this->__db->commit();

                                                return [
                                                    'Error'   => '000',
                                                    'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                    'Data'    => [
                                                        'Url'   => $__clean_data['__Url'],
                                                    ],
                                                ];
                                                exit();

                                            } else {

                                                $this->__db->rollback();
                                                
                                                return [
                                                    'Error'   => '999',
                                                    'Message' => 'Error Query Hapus Assesor 2',
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
                                            'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                            'Data'    => [
                                                'Url'   => $__clean_data['__Url'],
                                            ],
                                        ];
                                        exit();

                                    }

                                    return [
                                        'Error'   => '999',
                                        'Message' => 'A Data Error Hasil Evaluasi Occurred : ' . $e->getMessage(),
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                                }

                            }

                            for ( $x = 0; $x < $__jumlah_nomordokumen__; $x++ ) {

                                $__data_nomordokumen__ = $this->__NomorDokumenModel->read(['Id' => $__clean_data['__Post_NomorDokumen'][$x]]);

                                $__session_nomordokumen = [
                                    'Id_Rpl_Cms_NomorDokumen'           => $__data_nomordokumen__->Id,
                                    'Kode_Rpl_Cms_NomorDokumen'         => $__data_nomordokumen__->Kode,
                                    'Nama_Rpl_Cms_NomorDokumen'         => $__data_nomordokumen__->Nama,
                                    'User_Rpl_Assesor_2_NomorDokumen'   => $__data_dosen->Nama,
                                    'Log_Rpl_Assesor_2_NomorDokumen'    => date('Y-m-d H:i:s'),
                                    'IdKampus'                          => __Aplikasi()['IdKampus'],
                                    'Kampus'                            => __Aplikasi()['Kampus'],
                                    'Data'                              => 'Y',
                                    'Id_Rpl_Assesor_1'                  => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                    'Id_Rpl_Assesor_2'                  => $__record_data_assesor_2__->Id,
                                ];
                                
                                try {

                                    $this->__db->beginTransaction();
                                    
                                        $__query_result_nomordokumen = $this->__Assesor2Model->create_nomordokumen( $__session_nomordokumen );

                                        if ( $__query_result_nomordokumen['Error'] === '000' ) {
                                            
                                            $this->__db->commit();

                                            $__success_nomordokumen = '000';

                                        } else {

                                            $this->__db->rollback();

                                            $__session_delete_assesor_2 = [
                                                'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                                'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                                'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                                'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                                'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                                'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                                'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                                'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                                'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                                'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                            ];

                                            try {

                                                $this->__db->beginTransaction();

                                                    $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                                    if ( $__query_result_detele['Error'] === '000' ) {
                                                        
                                                        $this->__db->commit();

                                                        return [
                                                            'Error'   => '000',
                                                            'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                            'Data'    => [
                                                                'Url'   => $__clean_data['__Url'],
                                                            ],
                                                        ];
                                                        exit();

                                                    } else {

                                                        $this->__db->rollback();
                                                        
                                                        return [
                                                            'Error'   => '999',
                                                            'Message' => 'Error Query Hapus Assesor 2',
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
                                                    'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                                    'Data'    => [
                                                        'Url'   => $__clean_data['__Url'],
                                                    ],
                                                ];
                                                exit();

                                            }
                                            
                                            return [
                                                'Error'   => '999',
                                                'Message' => 'Error Query Hasil Evaluasi',
                                                'Data'    => [
                                                    'Url'   => $__clean_data['__Url'],
                                                ],
                                            ];
                                            exit();

                                        }

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                    $__session_delete_assesor_2 = [
                                        'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                        'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                        'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                        'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                        'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                        'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                        'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                        'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                        'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                        'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                    ];

                                    try {

                                        $this->__db->beginTransaction();

                                            $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                            if ( $__query_result_detele['Error'] === '000' ) {
                                                
                                                $this->__db->commit();

                                                return [
                                                    'Error'   => '000',
                                                    'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                    'Data'    => [
                                                        'Url'   => $__clean_data['__Url'],
                                                    ],
                                                ];
                                                exit();

                                            } else {

                                                $this->__db->rollback();
                                                
                                                return [
                                                    'Error'   => '999',
                                                    'Message' => 'Error Query Hapus Assesor 2',
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
                                            'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                            'Data'    => [
                                                'Url'   => $__clean_data['__Url'],
                                            ],
                                        ];
                                        exit();

                                    }

                                    return [
                                        'Error'   => '999',
                                        'Message' => 'A Data Error Hasil Evaluasi Occurred : ' . $e->getMessage(),
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                                }

                            }

                            if ( $__success_hasilevaluasi == '000' AND $__success_nomordokumen == '000' ) {

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Berhasil Simpan Data !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url_Success'],
                                    ],
                                ];
                                exit();

                            } else {

                                $__session_delete_assesor_2 = [
                                    'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                    'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                    'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                    'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                    'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                    'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                    'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                    'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                    'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                    'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                        if ( $__query_result_detele['Error'] === '000' ) {
                                            
                                            $this->__db->commit();

                                            return [
                                                'Error'   => '000',
                                                'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                                'Data'    => [
                                                    'Url'   => $__clean_data['__Url'],
                                                ],
                                            ];
                                            exit();

                                        } else {

                                            $this->__db->rollback();
                                            
                                            return [
                                                'Error'   => '999',
                                                'Message' => 'Error Query Hapus Assesor 2',
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
                                        'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                                }

                            }

                        } else {

                            $__session_delete_assesor_2 = [
                                'Id_Rpl_Assesor_2'      => $__record_data_assesor_2__->Id,
                                'Id_Rpl_Assesor_1'      => $__record_data_assesor_2__->Id_Rpl_Assesor_1,
                                'Id_Rpl_Assesor'        => $__record_data_assesor_2__->Id_Rpl_Assesor, 
                                'Id_Rpl_Pendaftaran'    => $__record_data_assesor_2__->Id_Rpl_Pendaftaran, 
                                'IdDosen'               => $__record_data_assesor_2__->IdDosen_Rpl_Assesor_2, 
                                'Ta'                    => $__record_data_assesor_2__->Ta_Rpl_Assesor_2, 
                                'Semester'              => $__record_data_assesor_2__->Semester_Rpl_Assesor_2, 
                                'Prodi'                 => $__record_data_assesor_2__->Prodi_Rpl_Assesor_2, 
                                'IdMk_Asal'             => $__record_data_assesor_2__->IdMk_Asal_Rpl_Assesor_2, 
                                'IdMk_Pilih'            => $__record_data_assesor_2__->IdMk_Pilih_Rpl_Assesor_2, 
                            ];

                            try {

                                $this->__db->beginTransaction();

                                    $__query_result_detele = $this->__Assesor2Model->delete( $__session_delete_assesor_2 );

                                    if ( $__query_result_detele['Error'] === '000' ) {
                                        
                                        $this->__db->commit();

                                        return [
                                            'Error'   => '000',
                                            'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                            'Data'    => [
                                                'Url'   => $__clean_data['__Url'],
                                            ],
                                        ];
                                        exit();

                                    } else {

                                        $this->__db->rollback();
                                        
                                        return [
                                            'Error'   => '999',
                                            'Message' => 'Error Query Hapus Assesor 2',
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
                                    'Message' => 'A Data Error Hapus Assesor 2 Occurred: ' . $e->getMessage(),
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                        }

                    } else {

                        return [
                            'Error'   => '999',
                            'Message' => 'Tidak Berhasil Simpan Data !',
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

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Ubah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah/ubah';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__Id1']) AND $_GET['__Id1'] == TRUE AND isset($_GET['__IdMk']) AND $_GET['__IdMk'] == TRUE AND isset($_GET['__IdMkCpmk']) AND $_GET['__IdMkCpmk'] == TRUE AND isset($_GET['__IdCpmk']) AND $_GET['__IdCpmk'] == TRUE AND $_GET['__Id2'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    $__record_data_detail__ = $this->__Assesor1Model->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id1'] ),'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1]);

                    
                        $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $_GET['__IdMkCpmk'] ) ."' ORDER BY IdMK DESC ");

                        $__data_evaluasidiri__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");
                        
                        $__data_profesiensi__ = $this->__ProfesiensiModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                        // $__data_profesiensi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_Profesiensi ) AS Total FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                        $__data_hasilevaluasi__ = $this->__HasilevaluasiasesorModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                        $__data_hasilevaluasi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_HasilEvaluasiAsesor ) AS Total FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                        $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read();
                        // $__data_keterangandokumen__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_KeteranganDokumen ) AS Total FROM Tbl_Rpl_Cms_KeteranganDokumen ");
                        
                        $__data_nomordokumen__ = $this->__NomorDokumenModel->read();

                        $__data_cpmk__ = $this->__db->queryid(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__data_matakuliah__->IdMk ."' AND C.IdMk = '". $__data_matakuliah__->IdMk ."' AND A.Id_Cpmk = '". $this->__helpers->SecretOpen( $_GET['__IdCpmk'] ) ."' ORDER BY A.Id_Cpmk DESC ");

                        $__data_assesor_2_detail__ = $this->__Assesor2Model->read([
                            'Id_Rpl_Assesor'        => $__record_data__->Id, 
                            'Id_Rpl_Pendaftaran'    => $__calon_rpl__->Id, 
                            'IdDosen'               => $__record_data__->D_2, 
                            'Ta'                    => $__record_data__->Ta_2, 
                            'Semester'              => $__record_data__->Semester_2, 
                            'Prodi'                 => $__record_data__->Prodi_2,
                            'Assesor_1'             => $__record_data_detail__->Id,
                            'Id'                    => $this->__helpers->SecretOpen( $_GET['__Id2'] ),
                        ]);

                        $__data_profesiensi_assesor_2__ = $this->__ProfesiensiModel->read(['Id' => $__data_evaluasidiri__->Id, 'Id2' => $__data_assesor_2_detail__->Id_Rpl_Cms_Profesiensi]);

                    $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);
                
                    require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Ubah_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdAssesor_1'                     => isset($data['__IdAssesor_1']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_1'], ENT_QUOTES))) : '',
                '__IdAssesor_1_IdMk'                => isset($data['__IdAssesor_1_IdMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_1_IdMk'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdMk_Cpmk'                       => isset($data['__IdMk_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdMk_Cpmk'], ENT_QUOTES))) : '',
                '__Id_Cpmk'                         => isset($data['__Id_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id_Cpmk'], ENT_QUOTES))) : '',
                '__IdAssesor_2'                     => isset($data['__IdAssesor_2']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_2'], ENT_QUOTES))) : '',
                '__Post_Profesiensi'                => isset($data['__Post_Profesiensi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Post_Profesiensi'], ENT_QUOTES))) : '',
                '__Post_HasilEvaluasiAssesor'       => isset($data['__Post_HasilEvaluasiAssesor']) ? $data['__Post_HasilEvaluasiAssesor'] : '',
                '__Post_NomorDokumen'               => isset($data['__Post_NomorDokumen']) ? $data['__Post_NomorDokumen'] : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdAssesor_1'] == FALSE OR $__clean_data['__IdAssesor_1_IdMk'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdMk_Cpmk'] == FALSE OR $__clean_data['__Id_Cpmk'] == FALSE OR $__clean_data['__Post_Profesiensi'] == FALSE OR $__clean_data['__Post_HasilEvaluasiAssesor'] == FALSE OR $__clean_data['__Post_NomorDokumen'] == FALSE OR $__clean_data['__IdAssesor_2'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  


                $__jumlah_hasilevaluasi__ = COUNT( $__clean_data['__Post_HasilEvaluasiAssesor'] );
                $__jumlah_nomordokumen__ = COUNT( $__clean_data['__Post_NomorDokumen'] );

                if ( $__jumlah_hasilevaluasi__ == '0' OR $__jumlah_hasilevaluasi__ <= '0' OR $__jumlah_nomordokumen__ == '0' OR $__jumlah_nomordokumen__ <= '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Hasil Evaluasi dan Nomor Dokumen Wajib Di Pilih Salah Satu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                
                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );

                $__record_data_assesor_1__ = $this->__Assesor1Model->read(['Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_1'] ),'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_1, 'Ta' => $__record_data__->Ta_1, 'Semester' => $__record_data__->Semester_1, 'Prodi' => $__record_data__->Prodi_1, 'IdMk' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_1_IdMk'] )]);

                $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' ORDER BY IdMK DESC ");

                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");


                $__data_assesor_2_detail__ = $this->__Assesor2Model->read([
                    'Id_Rpl_Assesor'        => $__record_data__->Id, 
                    'Id_Rpl_Pendaftaran'    => $__calon_rpl__->Id, 
                    'IdDosen'               => $__record_data__->D_2, 
                    'Ta'                    => $__record_data__->Ta_2, 
                    'Semester'              => $__record_data__->Semester_2, 
                    'Prodi'                 => $__record_data__->Prodi_2,
                    'Assesor_1'             => $__record_data_assesor_1__->Id,
                    'Id'                    => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_2'] ),
                ]);
                

                if ( $__record_data__->Id == FALSE OR $__calon_rpl__->Id == FALSE OR $__record_data_assesor_1__->Id == FALSE OR $__data_matakuliah__->IdMk == FALSE OR $__data_dosen->Id == FALSE OR $__data_assesor_2_detail__->Id == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Request Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                $__nama_file__ = '-';
                
                $__session = [
                    'Id_Rpl_Cms_Profesiensi'                => $__clean_data['__Post_Profesiensi'],
                    'User_Rpl_Assesor_2'                    => $__data_dosen->Nama,
                    'Log_Rpl_Assesor_2'                     => date('Y-m-d H:i:s'),
                    'IdMk_Asal_Rpl_Assesor_2'               => $__record_data_assesor_1__->IdMk,
                    'Id_Cpmk'                               => $this->__helpers->SecretOpen( $__clean_data['__Id_Cpmk'] ),
                    'Id_Rpl_Assesor'                        => $__record_data__->Id,
                    'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                    'IdDosen_Rpl_Assesor_2'                 => $__data_dosen->Id,
                    'Ta_Rpl_Assesor_2'                      => $__record_data__->Ta_2,
                    'Semester_Rpl_Assesor_2'                => $__record_data__->Semester_2,
                    'Prodi_Rpl_Assesor_2'                   => $__record_data__->Prodi_2,
                    'Id_Rpl_Assesor_1'                      => $__record_data_assesor_1__->Id,
                    'Id_Rpl_Assesor_2'                      => $__data_assesor_2_detail__->Id,
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__Assesor2Model->update( $__session );

                            if ( $__query_result['Error'] === '000' ) {
                                
                                $this->__db->commit();

                                $__success_assesor_2 = '000';

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
                    
                    if ( $__success_assesor_2 == '000' ) {

                        $__session_delete__ = [
                            'Id_Rpl_Assesor_1'                  => $__data_assesor_2_detail__->Id_Rpl_Assesor_1,
                            'Id_Rpl_Assesor_2'                  => $__data_assesor_2_detail__->Id,
                        ];
                        $__query_result_delete_hasilevaluasi = $this->__Assesor2Model->delete_hasilevaluasi( $__session_delete__ );

                        $__session_delete_nomordokumen = [
                            'Id_Rpl_Assesor_1'                  => $__data_assesor_2_detail__->Id_Rpl_Assesor_1,
                            'Id_Rpl_Assesor_2'                  => $__data_assesor_2_detail__->Id,
                        ];
                        $__query_result_delete_nomordokumen = $this->__Assesor2Model->delete_nomordokumen( $__session_delete_nomordokumen );

                        
                        for ( $x = 0; $x < $__jumlah_hasilevaluasi__; $x++ ) {

                            $__session_hasilevaluasi = [
                                'Id_Rpl_Cms_HasilEvaluasiAsesor'      => $__clean_data['__Post_HasilEvaluasiAssesor'][$x],
                                'User_Rpl_Assesor_2_HasilEvaluasi'    => $__data_dosen->Nama,
                                'Log_Rpl_Assesor_2_HasilEvaluasi'     => date('Y-m-d H:i:s'),
                                'IdKampus'                            => __Aplikasi()['IdKampus'],
                                'Kampus'                              => __Aplikasi()['Kampus'],
                                'Data'                                => 'Y',
                                'Id_Rpl_Assesor_1'                    => $__data_assesor_2_detail__->Id_Rpl_Assesor_1,
                                'Id_Rpl_Assesor_2'                    => $__data_assesor_2_detail__->Id,
                            ];

                            try {

                                $this->__db->beginTransaction();

                                    $__query_result_hasilevaluasi = $this->__Assesor2Model->create_hasilevaluasi( $__session_hasilevaluasi );

                                    if ( $__query_result_hasilevaluasi['Error'] === '000' ) {
                                        
                                        $this->__db->commit();

                                        $__success_hasilevaluasi = '000';

                                    } else {

                                        $this->__db->rollback();
                                        
                                        return [
                                            'Error'   => '999',
                                            'Message' => 'Error Query Hasil Evaluasi',
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
                                    'Message' => 'A Data Error Hasil Evaluasi Occurred : ' . $e->getMessage(),
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                        }

                        for ( $x = 0; $x < $__jumlah_nomordokumen__; $x++ ) {

                            $__data_nomordokumen__ = $this->__NomorDokumenModel->read(['Id' => $__clean_data['__Post_NomorDokumen'][$x]]);

                            $__session_nomordokumen = [
                                'Id_Rpl_Cms_NomorDokumen'           => $__data_nomordokumen__->Id,
                                'Kode_Rpl_Cms_NomorDokumen'         => $__data_nomordokumen__->Kode,
                                'Nama_Rpl_Cms_NomorDokumen'         => $__data_nomordokumen__->Nama,
                                'User_Rpl_Assesor_2_NomorDokumen'   => $__data_dosen->Nama,
                                'Log_Rpl_Assesor_2_NomorDokumen'    => date('Y-m-d H:i:s'),
                                'IdKampus'                          => __Aplikasi()['IdKampus'],
                                'Kampus'                            => __Aplikasi()['Kampus'],
                                'Data'                              => 'Y',
                                'Id_Rpl_Assesor_1'                  => $__data_assesor_2_detail__->Id_Rpl_Assesor_1,
                                'Id_Rpl_Assesor_2'                  => $__data_assesor_2_detail__->Id,
                            ];
                            
                            try {

                                $this->__db->beginTransaction();
                                
                                    $__query_result_nomordokumen = $this->__Assesor2Model->create_nomordokumen( $__session_nomordokumen );

                                    if ( $__query_result_nomordokumen['Error'] === '000' ) {
                                        
                                        $this->__db->commit();

                                        $__success_nomordokumen = '000';

                                    } else {

                                        $this->__db->rollback();
                                        
                                        return [
                                            'Error'   => '999',
                                            'Message' => 'Error Query Hasil Evaluasi',
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
                                    'Message' => 'A Data Error Hasil Evaluasi Occurred : ' . $e->getMessage(),
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                        }

                        if ( $__success_hasilevaluasi == '000' AND $__success_nomordokumen == '000' ) {

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } else {

                            return [
                                'Error'   => '999',
                                'Message' => 'Tidak Berhasil Simpan Data Pada Hasil Evaluasi dan Nomor Dokumen !',
                                'Data'    => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                    } else {

                        return [
                            'Error'   => '999',
                            'Message' => 'Tidak Berhasil Simpan Data !',
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

        public function IndexDosen_Rpl_Cms_2_Validasi()
        {
            if ( $this->__helpers->SecretOpen( $_GET['__Id'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__Id1'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__As2'] ) == FALSE ) 
            {
                
                redirect(self::__Routes_Mod__() . '/cms_2?__Id=' . $_GET['__Id'], '03', 'ID Tidak Valid !');
                exit();
                
            }
            
            $__check_data_pendaftar__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' AND As2_Dosen_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__As2'] ) ."' AND As1_Status_Rpl_Assesor = 'Y' AND As2_Status_Rpl_Assesor = 'N' ");

            if ( !$__check_data_pendaftar__ ) 
            {

                redirect(self::__Routes_Mod__() . '/cms_2?__Id=' . $_GET['__Id'], '03', 'Data Tidak Ditemukan Pendaftar !');
                exit();
                
            }

            $__check_bukavalidasi__ = $this->__db->queryrow(" SELECT Id_Rpl_BukaValidasi AS Id FROM Tbl_Rpl_BukaValidasi WHERE Assesor_Rpl_BukaValidasi = '2' AND Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ");

            if ( !$__check_bukavalidasi__ && $__check_bukavalidasi__ == FALSE ) {

                $__session = [
                    '__Status_2'    => 'Y',
                    '__TglHapus_2'  => $this->__helpers->__TambahTanggal(),
                    '__Status_3'    => 'N',
                    '__TglHapus_3'  => $this->__helpers->__TambahTanggal(),
                    // 'Validasi_1_Rpl_Assesor'    => 'Y',
                    // 'Tgl_1_Rpl_Assesor'         => $this->__helpers->__TambahTanggal(),
                    // 'Validasi_2_Rpl_Assesor'    => 'Y',
                    // 'Tgl_2_Rpl_Assesor'         => $this->__helpers->__TambahTanggal(),
                    // 'Validasi_3_Rpl_Assesor'    => 'Y',
                    // 'Tgl_3_Rpl_Assesor'         => $this->__helpers->__TambahTanggal(),
                    '__User'        => 'Validasi Assesor 2',
                    '__Log'         => date('Y-m-d H:i:s'),
                    '__Id_Assesor'  => $this->__helpers->SecretOpen( $_GET['__Id'] ),
                    '__IdDosen'     => $this->__helpers->SecretOpen( $_GET['__As2'] ),
                ]; 
                
                    try {

                        $this->__db->beginTransaction();

                                        // Validasi_1_Rpl_Assesor      = :Validasi_1_Rpl_Assesor, 
                                        // Tgl_1_Rpl_Assesor           = :Tgl_1_Rpl_Assesor,
                                        // Validasi_2_Rpl_Assesor      = :Validasi_2_Rpl_Assesor, 
                                        // Tgl_2_Rpl_Assesor           = :Tgl_2_Rpl_Assesor,
                                        // Validasi_3_Rpl_Assesor      = :Validasi_3_Rpl_Assesor, 
                                        // Tgl_3_Rpl_Assesor           = :Tgl_3_Rpl_Assesor

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Assesor SET
                                        As2_Status_Rpl_Assesor      = :__Status_2,
                                        As2_TglHapus_Rpl_Assesor    = :__TglHapus_2,
                                        As3_Status_Rpl_Assesor      = :__Status_3,
                                        As3_TglHapus_Rpl_Assesor    = :__TglHapus_3,
                                        User_Rpl_Assesor            = :__User, 
                                        Log_Rpl_Assesor             = :__Log
                                    WHERE Id_Rpl_Assesor            = :__Id_Assesor
                                    AND As2_Dosen_Rpl_Assesor       = :__IdDosen
                                "
                            ) -> execute ( $__session );

                            unset( $_SESSION['__Form_Notifikasi__'] );
                            unset( $_SESSION['__Old__'] );
                            
                        $this->__db->commit();

                        redirect(self::__Routes_Mod__() . '/cms_2?__Id=' . $_GET['__Id'], '01', 'Berhasil Validasi Data');
                        exit();

                    } catch (Exception $e) {

                        $this->__db->rollback();
                        
                        redirect(self::__Routes_Mod__() . '/cms_2?__Id=' . $_GET['__Id'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                        exit();
                        
                    }

            } else {

                $__session = [
                    'As2_TglHapus_Rpl_Assesor'  => date('Y-m-d H:i:s'),
                    'As2_Status_Rpl_Assesor'    => 'Y',
                    'As3_Status_Rpl_Assesor'    => 'Y',
                    'Validasi_1_Rpl_Assesor'    => 'Y',
                    'Tgl_1_Rpl_Assesor'         => date('Y-m-d H:i:s'),
                    'Validasi_2_Rpl_Assesor'    => 'Y',
                    'Tgl_2_Rpl_Assesor'         => date('Y-m-d H:i:s'),
                    'Validasi_3_Rpl_Assesor'    => 'Y',
                    'Tgl_3_Rpl_Assesor'         => date('Y-m-d H:i:s'),
                    'Id_Rpl_Assesor'            => $this->__helpers->SecretOpen( $_GET['__Id'] ),
                ];

                $__session_insert = [
                    'Assesor_Rpl_BukaValidasi'  => '2',
                    'Id_Rpl_Assesor'            => $this->__helpers->SecretOpen( $_GET['__Id'] ),
                ]; 

                    try {

                        $this->__db->beginTransaction();

                            $__sql_perolehan = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Assesor SET
                                        As2_TglHapus_Rpl_Assesor    = :As2_TglHapus_Rpl_Assesor,
                                        As2_Status_Rpl_Assesor      = :As2_Status_Rpl_Assesor,
                                        As3_Status_Rpl_Assesor      = :As3_Status_Rpl_Assesor, 
                                        Validasi_1_Rpl_Assesor      = :Validasi_1_Rpl_Assesor, 
                                        Tgl_1_Rpl_Assesor           = :Tgl_1_Rpl_Assesor,
                                        Validasi_2_Rpl_Assesor      = :Validasi_2_Rpl_Assesor, 
                                        Tgl_2_Rpl_Assesor           = :Tgl_2_Rpl_Assesor,
                                        Validasi_3_Rpl_Assesor      = :Validasi_3_Rpl_Assesor, 
                                        Tgl_3_Rpl_Assesor           = :Tgl_3_Rpl_Assesor
                                    WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                "
                            ) -> execute ( $__session );

                            $__sql_perolehan_detail = $this->__db->prepare( 
                                "
                                    DELETE FROM Tbl_Rpl_BukaValidasi 
                                    WHERE Assesor_Rpl_BukaValidasi  = :Assesor_Rpl_BukaValidasi
                                    AND Id_Rpl_Assesor              = :Id_Rpl_Assesor
                                "
                            ) -> execute ( $__session_insert );

                        $this->__db->commit();

                            redirect(self::__Routes_Mod__() . '/cms_2?__Id=' . $_GET['__Id'], '01', 'Berhasil Memvalidasikan Data Kamu, Terimakasih Sudah Memperbaiki. Mohon Selanjutnya Jangan Sampai Ada Salah Kembali !');
                            exit();

                    } catch (Exception $e) {

                        $this->__db->rollback();
                        
                        redirect(self::__Routes_Mod__() . '/cms_2?__Id=' . $_GET['__Id'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                        exit();
                        
                    }

            }
        }

        public function IndexDosen_Rpl_Cms_3()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_3';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    if ( date('Y-m-d H:i:s', strtotime($__record_data__->Hapus_3)) > date('Y-m-d H:i:s') OR $__record_data__->S_3 == 'Y' ) {

                        $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                        $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                        
                        $__url_file = $this->__Url_File__();
                        $__url_file_penunjang = $this->__Url_File_Penunjang__();

                        $__data_assesor_3 = $this->__Assesor3Model->read(['Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_3, 'Ta' => $__record_data__->Ta_3, 'Semester' => $__record_data__->Semester_3, 'Prodi' => $__record_data__->Prodi_3]);

                        $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);
                        
                        require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Mohon Maaf Akses Kamu Di Tolak Karna Sudah Lewat Batas Kamu Hanya Sampai Tanggal ' . $this->__helpers->TanggalWaktu( $__record_data__->Hapus_3 ) .' !');
                        exit();

                    }
                    
                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_3_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__Tgl'                             => isset($data['__Tgl']) ? stripslashes(strip_tags(htmlspecialchars($data['__Tgl'], ENT_QUOTES))) : '',
                '__Waktu'                           => isset($data['__Waktu']) ? stripslashes(strip_tags(htmlspecialchars($data['__Waktu'], ENT_QUOTES))) : '',
                '__Judul'                           => isset($data['__Judul']) ? stripslashes(strip_tags(htmlspecialchars($data['__Judul'], ENT_QUOTES))) : '',
                '__Keterangan'                      => isset($data['__Keterangan']) ? stripslashes(strip_tags(htmlspecialchars($data['__Keterangan'], ENT_QUOTES))) : '',
                '__File_Name'                       => isset($_FILES['__File']['name']) ? $_FILES['__File']['name'] : '',
                '__File_Size'                       => isset($_FILES['__File']['size']) ? $_FILES['__File']['size'] : '',
                '__File_Type'                       => isset($_FILES['__File']['type']) ? $_FILES['__File']['type'] : '',
                '__File_Tmp'                        => isset($_FILES['__File']['tmp_name']) ? $_FILES['__File']['tmp_name'] : '',
                '__IdAssesor_3'                     => isset($data['__IdAssesor_3']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_3'], ENT_QUOTES))) : '',
                '__IdAssesor_3_File'                => isset($data['__IdAssesor_3_File']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor_3_File'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Judul'                           => $__clean_data['__Judul'],
                '__Keterangan'                      => $__clean_data['__Keterangan'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__Tgl'] == FALSE OR $__clean_data['__Waktu'] == FALSE OR $__clean_data['__Judul'] == FALSE OR $__clean_data['__Keterangan'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  


                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                
                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_3 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");

                if ( $__record_data__->Id == FALSE OR $__calon_rpl__->Id == FALSE OR $__data_dosen->Id == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Request Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                if ( $__clean_data['__IdAssesor_3'] == FALSE ) {

                    if ( $__clean_data['__File_Name'] == FALSE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'File Gambar Wajib Di Pilih !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__export_getdata_file = $this->__helpers->__GetData_Gambar( 'beritaacara' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' );

                    if ( $__export_getdata_file['__Error'] != '00' ) {

                        return $result = [
                            'Error'     => '999',
                            'Message'   => $__export_getdata_file['__Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }
                    
                    $__session = [
                        'Tgl_Rpl_Assesor_3'                     => $__clean_data['__Tgl'] . ' ' . $__clean_data['__Waktu'] . ':00',
                        'Judul_Rpl_Assesor_3'                   => $this->__helpers->HurufBesar( $__clean_data['__Judul'] ),
                        'Keterangan_Rpl_Assesor_3'              => $__clean_data['__Keterangan'],
                        'File_Rpl_Assesor_3'                    => $__export_getdata_file['__Nama_File'],
                        'Format_Rpl_Assesor_3'                  => $__export_getdata_file['__Format_File'],
                        'Slugs_Rpl_Assesor_3'                   => $this->__helpers->__Slugs( $__clean_data['__Judul'] ),
                        'User_Rpl_Assesor_3'                    => $__data_dosen->Nama,
                        'Log_Rpl_Assesor_3'                     => date('Y-m-d H:i:s'),
                        'IdKampus'                              => __Aplikasi()['IdKampus'],
                        'Kampus'                                => __Aplikasi()['Kampus'],
                        'Data'                                  => 'Y',
                        'Id_Rpl_Assesor'                        => $__record_data__->Id,
                        'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                        'IdDosen_Rpl_Assesor_3'                 => $__data_dosen->Id,
                        'Ta_Rpl_Assesor_3'                      => $__record_data__->Ta_3,
                        'Semester_Rpl_Assesor_3'                => $__record_data__->Semester_3,
                        'Prodi_Rpl_Assesor_3'                   => $__record_data__->Prodi_3,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__query_result = $this->__Assesor3Model->create( $__session );

                                if ( $__query_result['Error'] === '000' ) {
                                    
                                    $this->__db->commit();

                                    unset( $_SESSION['__Form_Notifikasi__'] );
                                    unset( $_SESSION['__Old__'] );
                                    
                                    move_uploaded_file($__export_getdata_file['__Tmp_File'], $__export_getdata_file['__Path_File']);

                                    return [
                                        'Error'   => '000',
                                        'Message' => 'Berhasil Simpan Data !',
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

                    $__data_assesor_3 = $this->__Assesor3Model->read(['Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_3'] ), 'Id_Rpl_Assesor' => $__record_data__->Id, 'Id_Rpl_Pendaftaran' => $__calon_rpl__->Id, 'IdDosen' => $__record_data__->D_3, 'Ta' => $__record_data__->Ta_3, 'Semester' => $__record_data__->Semester_3, 'Prodi' => $__record_data__->Prodi_3]);

                    if ( $__data_assesor_3->Id == FALSE ) {

                        return [
                            'Error'   => '999',
                            'Message' => 'Mohon Maaf Data Assesor Tidak Di Temukan !',
                            'Data'    => [
                                'Url'   => $__clean_data['__Url_Success'],
                            ],
                        ];
                        exit();

                    }
                    
                    if ( $__clean_data['__File_Name'] == TRUE ) {

                        $__export_getdata_file = $this->__helpers->__GetData_Gambar( 'beritaacara' , $__clean_data['__Url'] , $__clean_data['__File_Name'] , $__clean_data['__File_Size'] , $__clean_data['__File_Type'] , $__clean_data['__File_Tmp'] , '' );

                        if ( $__export_getdata_file['__Error'] != '00' ) {

                            return $result = [
                                'Error'     => '999',
                                'Message'   => $__export_getdata_file['__Message'],
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                        $__get_file     = $__export_getdata_file['__Nama_File'];
                        $__get_format   = $__export_getdata_file['__Format_File'];

                    } else {

                        $__get_file     = $__data_assesor_3->Files;
                        $__get_format   = $__data_assesor_3->Format;

                    }
                    
                    $__session = [
                        'Tgl_Rpl_Assesor_3'                     => $__clean_data['__Tgl'] . ' ' . $__clean_data['__Waktu'] . ':00',
                        'Judul_Rpl_Assesor_3'                   => $this->__helpers->HurufBesar( $__clean_data['__Judul'] ),
                        'Keterangan_Rpl_Assesor_3'              => $__clean_data['__Keterangan'],
                        'File_Rpl_Assesor_3'                    => $__get_file,
                        'Format_Rpl_Assesor_3'                  => $__get_format,
                        'Slugs_Rpl_Assesor_3'                   => $this->__helpers->__Slugs( $__clean_data['__Judul'] ),
                        'User_Rpl_Assesor_3'                    => $__data_dosen->Nama,
                        'Log_Rpl_Assesor_3'                     => date('Y-m-d H:i:s'),
                        'Id_Rpl_Assesor'                        => $__record_data__->Id,
                        'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                        'IdDosen_Rpl_Assesor_3'                 => $__data_dosen->Id,
                        'Ta_Rpl_Assesor_3'                      => $__record_data__->Ta_3,
                        'Semester_Rpl_Assesor_3'                => $__record_data__->Semester_3,
                        'Prodi_Rpl_Assesor_3'                   => $__record_data__->Prodi_3,
                        'Id_Rpl_Assesor_3'                      => $__data_assesor_3->Id,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__query_result = $this->__Assesor3Model->update( $__session );

                                if ( $__query_result['Error'] === '000' ) {
                                    
                                    $this->__db->commit();

                                    unset( $_SESSION['__Form_Notifikasi__'] );
                                    unset( $_SESSION['__Old__'] );
                                    
                                    if ( $__clean_data['__IdAssesor_3'] == FALSE ) {

                                        if ( $__clean_data['__File_Name'] == TRUE ) {

                                            move_uploaded_file($__export_getdata_file['__Tmp_File'], $__export_getdata_file['__Path_File']);

                                        }

                                    } else {

                                        if ( $__clean_data['__File_Name'] == TRUE ) {

                                            unlink('src/storages/__beritaacara/' . $this->__helpers->SecretOpen( $__clean_data['__IdAssesor_3_File'] ));
                                            move_uploaded_file($__export_getdata_file['__Tmp_File'], $__export_getdata_file['__Path_File']);

                                        }

                                    }

                                    return [
                                        'Error'   => '000',
                                        'Message' => 'Berhasil Simpan Data !',
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

        public function IndexDosen_Rpl_Cms_3_Validasi()
        {
            if ( $this->__helpers->SecretOpen( $_GET['__Id'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__Id1'] ) == FALSE OR $this->__helpers->SecretOpen( $_GET['__As3'] ) == FALSE ) 
            {
                
                redirect(self::__Routes_Mod__() . '/cms_3?__Id=' . $_GET['__Id'], '03', 'ID Tidak Valid !');
                exit();
                
            }
            
            $__check_data_pendaftar__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' AND As3_Dosen_Rpl_Assesor = '". $this->__helpers->SecretOpen( $_GET['__As3'] ) ."' AND As1_Status_Rpl_Assesor = 'Y' AND As2_Status_Rpl_Assesor = 'Y' AND As3_Status_Rpl_Assesor = 'N' ");

            if ( !$__check_data_pendaftar__ ) 
            {

                redirect(self::__Routes_Mod__() . '/cms_3?__Id=' . $_GET['__Id'], '03', 'Data Tidak Ditemukan Pendaftar !');
                exit();
                
            }

            $__session = [
                '__Status'      => 'Y',
                '__User'        => 'Validasi Assesor 3',
                '__Log'         => date('Y-m-d H:i:s'),
                '__Id_Assesor'  => $this->__helpers->SecretOpen( $_GET['__Id'] ),
                '__IdDosen'     => $this->__helpers->SecretOpen( $_GET['__As3'] ),
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Rpl_Assesor SET
                                    As3_Status_Rpl_Assesor      = :__Status,
                                    User_Rpl_Assesor            = :__User, 
                                    Log_Rpl_Assesor             = :__Log
                                WHERE Id_Rpl_Assesor            = :__Id_Assesor
                                AND As3_Dosen_Rpl_Assesor       = :__IdDosen
                            "
                        ) -> execute ( $__session );

                        unset( $_SESSION['__Form_Notifikasi__'] );
                        unset( $_SESSION['__Old__'] );
                        
                    $this->__db->commit();

                    redirect(self::__Routes_Mod__() . '/cms_3?__Id=' . $_GET['__Id'], '01', 'Berhasil Validasi Data');
                    exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect(self::__Routes_Mod__() . '/cms_3?__Id=' . $_GET['__Id'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }

        public function __Total_File_Pendukung_Rpl( array $data )
        {
            $result = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Pendaftaran_Berkas ) AS Total FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND Data = 'Y' ");

            return $result->Total;
        }

        public function IndexDosen_Rpl_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__() . '/rpl/4';
            $__content      = '__homedosen/rpl/4';

            $__active       = 'active';

            if ( !isset($_SESSION['__Dosen__']) OR $_GET['__Id'] == FALSE ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);

                $__data_assesor = $this->__Assesor(['Assesor' => 'ID', 'Id' => $__data_sk_rpl->Id_Rpl_Assesor]);
                
                $__data_calon_rpl = $this->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__->Id == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
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

        public function IndexDosen_Rpl_Pdf_Lampiran()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__() . '/rpl/4';
            $__content      = '__homedosen/rpl/4';

            $__active       = 'active';

            if ( !isset($_SESSION['__Dosen__']) OR $_GET['__Id'] == FALSE ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);

                $__data_assesor = $this->__Assesor(['Assesor' => 'ID', 'Id' => $__data_sk_rpl->Id_Rpl_Assesor]);
                
                $__data_calon_rpl = $this->__Data_Rpl__( $__data_assesor->Id_Rpl_Pendaftaran );

                if ( $__authlogin__->Id == TRUE AND $__data_sk_rpl->Id == TRUE AND $__data_assesor->Id == TRUE AND $__data_calon_rpl->Id == TRUE ) {
                
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

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah_perolehan';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__IdBerkas']) AND $_GET['__IdBerkas'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    if ( $__calon_rpl__->Id == TRUE AND $__calon_rpl_berkas__ == TRUE ) {

                        $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record_data__->Id_Rpl_Pendaftaran ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $_GET['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                        $__data_mk_perolehan = $this->__db->queryrow(" SELECT Id_Rpl_Perolehan AS Id FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_data__->D_2 ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' ");

                        if ( $__data_mk_perolehan == FALSE ) {

                            $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);

                            $__nomor_mk_rpl__ = '1';
                            $__data_matakuliah_rpl__ = $this->__db->query(" SELECT A.IdPrimary AS Id, B.IdMk, B.Matakuliah, A.Sks, A.Semester, B.Rpl  FROM ProdiMk A LEFT JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.Prodi = '". $__calon_rpl__->Prodi ."' AND A.Kurikulum = '". $__calon_rpl__->Kurikulum ."' AND A.IdKampus = '". $__calon_rpl__->IdKampus ."' AND B.Rpl = 'Y' ORDER BY A.Semester ASC ");
                            
                            $__db = $this->__db;
                            
                            require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                        } else {

                            redirect($__routes . '/rpl/cms_2/matakuliah_perolehan/detail?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas'], '01', 'Data Konversi Telah Di Pilih !');
                            exit();

                        }
                        
                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan Untuk Detail !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdRplBerkas'                     => isset($data['__IdRplBerkas']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplBerkas'], ENT_QUOTES))) : '',
                '__IdPrimary'                       => isset($data['__IdPrimary']) ? $data['__IdPrimary'] : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdRplBerkas'] == FALSE  OR $__clean_data['__IdPrimary'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  

                $__jumlah_idmk__ = COUNT( $__clean_data['__IdPrimary'] );

                if ( $__jumlah_idmk__ == '0' OR $__jumlah_idmk__ <= '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Hasil Matakuliah Wajib Di Pilih Salah Satu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                
                
                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );
                
                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");
                
                $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $__clean_data['__IdRplBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");


                    for ( $x = 0; $x < $__jumlah_idmk__; $x++ ) {

                        $__data_matakuliah__ = $this->__db->queryid(" SELECT A.IdPrimary AS Id, B.IdMk, B.Matakuliah, A.Sks, A.Semester, B.Rpl  FROM ProdiMk A LEFT JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.Prodi = '". $__calon_rpl__->Prodi ."' AND A.Kurikulum = '". $__calon_rpl__->Kurikulum ."' AND A.IdKampus = '". $__calon_rpl__->IdKampus ."' AND B.Rpl = 'Y' AND A.IdPrimary = '". $this->__helpers->SecretOpen( $__clean_data['__IdPrimary'][$x] ) ."' ORDER BY A.Semester ASC ");

                        $__session = [
                            'IdMk_Rpl_Perolehan'        => $__data_matakuliah__->IdMk,
                            'Matakuliah_Rpl_Perolehan'  => $__data_matakuliah__->Matakuliah,
                            'Sks_Rpl_Perolehan'         => $__data_matakuliah__->Sks,
                            'Nilai_Rpl_Perolehan'       => '',
                            'Huruf_Rpl_Perolehan'       => '',
                            'IdDosen_Rpl_Perolehan'     => $__data_dosen->Id,
                            'Ta_Rpl_Perolehan'          => $__calon_rpl__->Ta,
                            'Semester_Rpl_Perolehan'    => $__calon_rpl__->Semester,
                            'Prodi_Rpl_Perolehan'       => $__calon_rpl__->Prodi,
                            'User_Rpl_Perolehan'        => $__calon_rpl__->Nama,
                            'Log_Rpl_Perolehan'         => date('Y-m-d H:i:s'),
                            'IdKampus'                  => __Aplikasi()['IdKampus'],
                            'Kampus'                    => __Aplikasi()['Kampus'],
                            'Data'                      => 'Y',
                            'Id_Rpl_Assesor'            => $__record_data__->Id,
                            'Id_Rpl_Pendaftaran'        => $__calon_rpl__->Id,
                            'Id_Rpl_Pendaftaran_Berkas' => $__data_matakuliah_perolehan__->Id,
                        ];

                            try {

                                $this->__db->beginTransaction();

                                    $__sql = $this->__db->prepare( 
                                        "
                                            INSERT INTO Tbl_Rpl_Perolehan
                                            (
                                                IdMk_Rpl_Perolehan, Matakuliah_Rpl_Perolehan, Sks_Rpl_Perolehan, Nilai_Rpl_Perolehan, Huruf_Rpl_Perolehan,
                                                IdDosen_Rpl_Perolehan, Ta_Rpl_Perolehan, Semester_Rpl_Perolehan, Prodi_Rpl_Perolehan, 
                                                User_Rpl_Perolehan, Log_Rpl_Perolehan, IdKampus, Kampus, Data,
                                                Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas
                                            )
                                            VALUES
                                            (
                                                :IdMk_Rpl_Perolehan, :Matakuliah_Rpl_Perolehan, :Sks_Rpl_Perolehan, :Nilai_Rpl_Perolehan, :Huruf_Rpl_Perolehan,
                                                :IdDosen_Rpl_Perolehan, :Ta_Rpl_Perolehan, :Semester_Rpl_Perolehan, :Prodi_Rpl_Perolehan,
                                                :User_Rpl_Perolehan, :Log_Rpl_Perolehan, :IdKampus, :Kampus, :Data,
                                                :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas
                                            )
                                        "
                                    ) -> execute ( $__session );

                                $this->__db->commit();

                                    $__success_query__ = '000';

                            } catch ( PDOException $e ) {

                                $this->__db->rollback();

                                    $__success_query__ = '999';

                            }

                    }


                        if ( $__success_query__ == '000' ) {

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } else {

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error Query, SIlahkan Input Kembali !',
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

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah_perolehan_detail';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__IdBerkas']) AND $_GET['__IdBerkas'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    if ( $__calon_rpl__->Id == TRUE AND $__calon_rpl_berkas__ == TRUE ) {

                        $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record_data__->Id_Rpl_Pendaftaran ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $_GET['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                        $__data_mk_perolehan = $this->__db->query(" SELECT Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_data__->D_2 ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                        if ( array($__data_mk_perolehan) ) {

                            $__nomor_mk_perolehan__ = '1';
                            $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);

                            $__data_matakuliah_rpl__ = $this->__db->query(" SELECT A.IdPrimary AS Id, B.IdMk, B.Matakuliah, A.Sks, A.Semester, B.Rpl  FROM ProdiMk A LEFT JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.Prodi = '". $__calon_rpl__->Prodi ."' AND A.Kurikulum = '". $__calon_rpl__->Kurikulum ."' AND A.IdKampus = '". $__calon_rpl__->IdKampus ."' AND B.Rpl = 'Y' ORDER BY A.Semester ASC ");
                            
                            $__db = $this->__db;
                            
                            require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                        } else {

                            redirect($__routes . '/rpl/cms_2/matakuliah_perolehan?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas'], '01', 'Tidak Ada Data Konversi Telah Di Pilih !');
                            exit();

                        }
                        
                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan Untuk Detail !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdRplBerkas'                     => isset($data['__IdRplBerkas']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplBerkas'], ENT_QUOTES))) : '',
                '__IdPrimary'                       => isset($data['__IdPrimary']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPrimary'], ENT_QUOTES))) : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdRplBerkas'] == FALSE  OR $__clean_data['__IdPrimary'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  
                
                
                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );
                
                if ( !$__record_data__->Id OR !$__calon_rpl__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Data Assesor dan Pendaftaran RPL Tidak Di Temukan !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 


                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");
                
                if ( !$__data_dosen->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Data Dosen Tidak Di Temukan !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 


                $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $__clean_data['__IdRplBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

                if ( !$__data_matakuliah_perolehan__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Data Matakuliah Perolehan Tidak Di Temukan !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 


                $__data_matakuliah__ = $this->__db->queryid(" SELECT A.IdPrimary AS Id, B.IdMk, B.Matakuliah, A.Sks, A.Semester, B.Rpl  FROM ProdiMk A LEFT JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.Prodi = '". $__calon_rpl__->Prodi ."' AND A.Kurikulum = '". $__calon_rpl__->Kurikulum ."' AND A.IdKampus = '". $__calon_rpl__->IdKampus ."' AND B.Rpl = 'Y' AND A.IdPrimary = '". $this->__helpers->SecretOpen( $__clean_data['__IdPrimary'] ) ."' ORDER BY A.Semester ASC ");

                if ( !$__data_matakuliah__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Data Matakuliah Tidak Di Temukan !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } 

                    $__session = [
                        'IdMk_Rpl_Perolehan'        => $__data_matakuliah__->IdMk,
                        'Matakuliah_Rpl_Perolehan'  => $__data_matakuliah__->Matakuliah,
                        'Sks_Rpl_Perolehan'         => $__data_matakuliah__->Sks,
                        'Nilai_Rpl_Perolehan'       => '',
                        'Huruf_Rpl_Perolehan'       => '',
                        'IdDosen_Rpl_Perolehan'     => $__data_dosen->Id,
                        'Ta_Rpl_Perolehan'          => $__calon_rpl__->Ta,
                        'Semester_Rpl_Perolehan'    => $__calon_rpl__->Semester,
                        'Prodi_Rpl_Perolehan'       => $__calon_rpl__->Prodi,
                        'User_Rpl_Perolehan'        => $__calon_rpl__->Nama,
                        'Log_Rpl_Perolehan'         => date('Y-m-d H:i:s'),
                        'IdKampus'                  => __Aplikasi()['IdKampus'],
                        'Kampus'                    => __Aplikasi()['Kampus'],
                        'Data'                      => 'Y',
                        'Id_Rpl_Assesor'            => $__record_data__->Id,
                        'Id_Rpl_Pendaftaran'        => $__calon_rpl__->Id,
                        'Id_Rpl_Pendaftaran_Berkas' => $__data_matakuliah_perolehan__->Id,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__sql = $this->__db->prepare( 
                                    "
                                        INSERT INTO Tbl_Rpl_Perolehan
                                        (
                                            IdMk_Rpl_Perolehan, Matakuliah_Rpl_Perolehan, Sks_Rpl_Perolehan, Nilai_Rpl_Perolehan, Huruf_Rpl_Perolehan,
                                            IdDosen_Rpl_Perolehan, Ta_Rpl_Perolehan, Semester_Rpl_Perolehan, Prodi_Rpl_Perolehan, 
                                            User_Rpl_Perolehan, Log_Rpl_Perolehan, IdKampus, Kampus, Data,
                                            Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas
                                        )
                                        VALUES
                                        (
                                            :IdMk_Rpl_Perolehan, :Matakuliah_Rpl_Perolehan, :Sks_Rpl_Perolehan, :Nilai_Rpl_Perolehan, :Huruf_Rpl_Perolehan,
                                            :IdDosen_Rpl_Perolehan, :Ta_Rpl_Perolehan, :Semester_Rpl_Perolehan, :Prodi_Rpl_Perolehan,
                                            :User_Rpl_Perolehan, :Log_Rpl_Perolehan, :IdKampus, :Kampus, :Data,
                                            :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas
                                        )
                                    "
                                ) -> execute ( $__session );

                            $this->__db->commit();

                                unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );

                                return [
                                    'Error'     => '000',
                                    'Message'   => 'Berhasil Simpan Data !',
                                    'Data'      => [
                                        'Url'   => $__clean_data['__Url_Success'],
                                    ],
                                ];
                                exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                                return [
                                    'Error'     => '999',
                                    'Message'   => 'Error Query, SIlahkan Input Kembali !',
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

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/konversi';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__IdBerkas']) AND $_GET['__IdBerkas'] == TRUE AND isset($_GET['__IdPerolehan']) AND $_GET['__IdPerolehan'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    if ( $__calon_rpl__->Id == TRUE AND $__calon_rpl_berkas__ == TRUE ) {

                        $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record_data__->Id_Rpl_Pendaftaran ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $_GET['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                        $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_data__->D_2 ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $_GET['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                        if ( $__data_mk_perolehan->Id == TRUE ) {

                            $__nomor_mk_perolehan__ = '1';
                            $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);

                            $__data_evaluasidiri__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");
                        
                            $__data_profesiensi__ = $this->__ProfesiensiModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                            // $__data_profesiensi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_Profesiensi ) AS Total FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                            $__data_hasilevaluasi__ = $this->__HasilevaluasiasesorModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                            $__data_hasilevaluasi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_HasilEvaluasiAsesor ) AS Total FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                            $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read();
                            // $__data_keterangandokumen__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_KeteranganDokumen ) AS Total FROM Tbl_Rpl_Cms_KeteranganDokumen ");

                            // $__data_cpmk__ = $this->__db->queryid(" SELECT DISTINCT C.IdMk, C.Matakuliah FROM Tbl_Cpmk ALEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE A.Id_Penugasan <> '' AND B.IdMk = '". $this->__helpers->SecretOpen( $_GET['__IdMk'] ) ."' AND C.IdMk = '". $this->__helpers->SecretOpen( $_GET['__IdMk'] ) ."' ORDER BY C.IdMk DESC ");
                            
                            $__nomor_cpmk__ = '1';
                            $__data_cpmk__ = $this->__db->query(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__data_mk_perolehan->IdMk ."' AND C.IdMk = '". $__data_mk_perolehan->IdMk ."' ORDER BY A.Id_Cpmk DESC ");
                            
                            $__db = $this->__db;
                            
                            
                            require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                        } else {

                            redirect($__routes . '/rpl/cms_2/matakuliah_perolehan?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas'], '01', 'Tidak Ada Data Konversi Telah Di Pilih !');
                            exit();

                        }
                        
                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan Untuk Detail !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/konversi/upload';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__IdBerkas']) AND $_GET['__IdBerkas'] == TRUE AND isset($_GET['__IdPerolehan']) AND $_GET['__IdPerolehan'] == TRUE AND isset($_GET['__IdCpmk']) AND $_GET['__IdCpmk'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    if ( $__calon_rpl__->Id == TRUE AND $__calon_rpl_berkas__ == TRUE ) {

                        $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record_data__->Id_Rpl_Pendaftaran ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $_GET['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                        $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_data__->D_2 ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $_GET['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                        $__data_cpmk__ = $this->__db->queryid(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__data_mk_perolehan->IdMk ."' AND C.IdMk = '". $__data_mk_perolehan->IdMk ."' AND A.Id_Cpmk = '". $this->__helpers->SecretOpen( $_GET['__IdCpmk'] ) ."' ORDER BY A.Id_Cpmk DESC ");

                        if ( $__data_mk_perolehan->Id == TRUE AND $__data_cpmk__->Id == TRUE ) {

                            $__nomor_mk_perolehan__ = '1';
                            $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);

                            $__data_evaluasidiri__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");
                        
                            $__data_profesiensi__ = $this->__ProfesiensiModel->read( ['Id' => $__data_evaluasidiri__->Id] );

                            $__data_hasilevaluasi__ = $this->__HasilevaluasiasesorModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                            $__data_hasilevaluasi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_HasilEvaluasiAsesor ) AS Total FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                            $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read();

                            $__data_nomordokumen__ = $this->__NomorDokumenModel->read();
                            
                            $__db = $this->__db;
                            
                            
                            require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                        } else {

                            redirect($__routes . '/rpl/cms_2/matakuliah_perolehan?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas'], '01', 'Tidak Ada Data Konversi Telah Di Pilih !');
                            exit();

                        }
                        
                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan Untuk Detail !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdRplBerkas'                     => isset($data['__IdRplBerkas']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplBerkas'], ENT_QUOTES))) : '',
                '__IdPerolehan'                     => isset($data['__IdPerolehan']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPerolehan'], ENT_QUOTES))) : '',
                '__IdMk_Cpmk'                       => isset($data['__IdMk_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdMk_Cpmk'], ENT_QUOTES))) : '',
                '__Id_Cpmk'                         => isset($data['__Id_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id_Cpmk'], ENT_QUOTES))) : '',
                '__NilaiMk'                         => isset($data['__NilaiMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__NilaiMk'], ENT_QUOTES))) : '',
                '__HurufMk'                         => isset($data['__HurufMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__HurufMk'], ENT_QUOTES))) : '',
                '__Post_Profesiensi'                => isset($data['__Post_Profesiensi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Post_Profesiensi'], ENT_QUOTES))) : '',
                '__Post_HasilEvaluasiAssesor'       => isset($data['__Post_HasilEvaluasiAssesor']) ? $data['__Post_HasilEvaluasiAssesor'] : '',
                '__Post_NomorDokumen'               => isset($data['__Post_NomorDokumen']) ? $data['__Post_NomorDokumen'] : '',
            ];

            $_SESSION['__Old__'] = [
                '__NilaiMk'         => $__clean_data['__NilaiMk'],
                '__HurufMk'         => $__clean_data['__HurufMk'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                // $__titik_nilai = substr($__clean_data['__NilaiMk'],1,1);

                // if ( $__titik_nilai != '.' ) {

                //     return [
                //         'Error'     => '999',
                //         'Message'   => 'Mohon Maaf Nilai Angka Wajib Mengikuti Format, Contohnya ' . substr($__clean_data['__NilaiMk'],0,1) . '.' . substr($__clean_data['__NilaiMk'],2,2) . ' !',
                //         'Data'      => [
                //             'Url'   => $__clean_data['__Url'],
                //         ],
                //     ];
                //     exit();

                // }
                

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdRplBerkas'] == FALSE OR $__clean_data['__IdMk_Cpmk'] == FALSE OR $__clean_data['__Id_Cpmk'] == FALSE OR $__clean_data['__Post_Profesiensi'] == FALSE OR $__clean_data['__Post_HasilEvaluasiAssesor'] == FALSE OR $__clean_data['__Post_NomorDokumen'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  


                $__jumlah_hasilevaluasi__ = COUNT( $__clean_data['__Post_HasilEvaluasiAssesor'] );
                $__jumlah_nomordokumen__ = COUNT( $__clean_data['__Post_NomorDokumen'] );

                if ( $__jumlah_hasilevaluasi__ == '0' OR $__jumlah_hasilevaluasi__ <= '0' OR $__jumlah_nomordokumen__ == '0' OR $__jumlah_nomordokumen__ <= '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Hasil Evaluasi dan Nomor Dokumen Wajib Di Pilih Salah Satu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );
                
                if ( !$__record_data__->Id OR !$__calon_rpl__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Assesor dan Pendaftaran RPL Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");
                
                if ( !$__data_dosen->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Dosen Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $__clean_data['__IdRplBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

                if ( !$__data_matakuliah_perolehan__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Pendaftaran Berkas Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__data_dosen->Id ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $__clean_data['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                if ( !$__data_mk_perolehan->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Matakuliah Perolehan Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                
                $__data_cpmk__ = $this->__db->queryid(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' AND C.IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' AND A.Id_Cpmk = '". $this->__helpers->SecretOpen( $__clean_data['__Id_Cpmk'] ) ."' ORDER BY A.Id_Cpmk DESC ");

                if ( !$__data_cpmk__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Cpmk Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' ORDER BY IdMK DESC ");

                if ( !$__data_matakuliah__->IdMk ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Matakuliah Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                // $__session_update_nilai__ = [
                //     'Nilai_Rpl_Perolehan'                   => $__clean_data['__NilaiMk'],
                //     'Huruf_Rpl_Perolehan'                   => $__clean_data['__HurufMk'],
                //     'User_Rpl_Perolehan'                    => $__data_dosen->Nama,
                //     'Log_Rpl_Perolehan'                     => date('Y-m-d H:i:s'),
                //     'Id_Rpl_Perolehan'                      => $__data_mk_perolehan->Id,
                //     'Id_Rpl_Assesor'                        => $__record_data__->Id,
                //     'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                //     'Id_Rpl_Pendaftaran_Berkas'             => $__data_matakuliah_perolehan__->Id,
                // ];

                $__session = [
                    'Id_Cpmk'                               => $__data_cpmk__->Id,
                    'Id_Rpl_Cms_Profesiensi'                => $__clean_data['__Post_Profesiensi'],
                    'User_Rpl_Perolehan_Detail'             => $__data_dosen->Nama,
                    'Log_Rpl_Perolehan_Detail'              => date('Y-m-d H:i:s'),
                    'IdKampus'                              => __Aplikasi()['IdKampus'],
                    'Kampus'                                => __Aplikasi()['Kampus'],
                    'Data'                                  => 'Y',
                    'Id_Rpl_Assesor'                        => $__record_data__->Id,
                    'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                    'Id_Rpl_Pendaftaran_Berkas'             => $__data_matakuliah_perolehan__->Id,
                    'Id_Rpl_Perolehan'                      => $__data_mk_perolehan->Id,
                ];

                    try {

                        $this->__db->beginTransaction();

                            // $__sql_nilai = $this->__db->prepare( 
                            //     "
                            //         UPDATE Tbl_Rpl_Perolehan SET
                            //             Nilai_Rpl_Perolehan         = :Nilai_Rpl_Perolehan,
                            //             Huruf_Rpl_Perolehan         = :Huruf_Rpl_Perolehan,
                            //             User_Rpl_Perolehan          = :User_Rpl_Perolehan,
                            //             Log_Rpl_Perolehan           = :Log_Rpl_Perolehan
                            //         WHERE Id_Rpl_Perolehan          = :Id_Rpl_Perolehan
                            //         AND Id_Rpl_Assesor              = :Id_Rpl_Assesor
                            //         AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                            //         AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                            //     "
                            // ) -> execute ( $__session_update_nilai__ );

                            $__sql = $this->__db->prepare( 
                                "
                                    INSERT INTO Tbl_Rpl_Perolehan_Detail
                                    (
                                        Id_Cpmk, Id_Rpl_Cms_Profesiensi, 
                                        User_Rpl_Perolehan_Detail, Log_Rpl_Perolehan_Detail, IdKampus, Kampus, Data,
                                        Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan
                                    )
                                    VALUES
                                    (
                                        :Id_Cpmk, :Id_Rpl_Cms_Profesiensi, 
                                        :User_Rpl_Perolehan_Detail, :Log_Rpl_Perolehan_Detail, :IdKampus, :Kampus, :Data,
                                        :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas, :Id_Rpl_Perolehan
                                    )
                                "
                            ) -> execute ( $__session );

                        $this->__db->commit();

                            $__success_query__ = '000';

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                            $__success_query__ = '999';

                    }

                    if ( $__success_query__ == '000' ) {

                        $__data_perolehan_detail__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan_Detail AS Id, Id_Cpmk, Id_Rpl_Cms_Profesiensi, User_Rpl_Perolehan_Detail AS Users, Log_Rpl_Perolehan_Detail AS Logs, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan FROM Tbl_Rpl_Perolehan_Detail WHERE Id_Rpl_Assesor = '". $__data_mk_perolehan->Id_Rpl_Assesor ."' AND Id_Rpl_Pendaftaran = '". $__data_mk_perolehan->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_mk_perolehan->Id_Rpl_Pendaftaran_Berkas ."' AND Id_Rpl_Perolehan = '". $__data_mk_perolehan->Id ."' ORDER BY Id_Rpl_Perolehan_Detail DESC ");

                        if ( isset($__data_perolehan_detail__->Id) AND $__data_perolehan_detail__->Id == TRUE ) {

                            for ( $x = 0; $x < $__jumlah_hasilevaluasi__; $x++ ) {

                                $__session_hasilevaluasi = [
                                    'Id_Rpl_Cms_HasilEvaluasiAsesor'            => $__clean_data['__Post_HasilEvaluasiAssesor'][$x],
                                    'User_Rpl_Perolehan_Detail_HasilEvaluasi'   => $__data_dosen->Nama,
                                    'Log_Rpl_Perolehan_Detail_HasilEvaluasi'    => date('Y-m-d H:i:s'),
                                    'IdKampus'                                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                                    => __Aplikasi()['Kampus'],
                                    'Data'                                      => 'Y',
                                    'Id_Rpl_Assesor'                            => $__data_perolehan_detail__->Id_Rpl_Assesor,
                                    'Id_Rpl_Pendaftaran'                        => $__data_perolehan_detail__->Id_Rpl_Pendaftaran,
                                    'Id_Rpl_Pendaftaran_Berkas'                 => $__data_perolehan_detail__->Id_Rpl_Pendaftaran_Berkas,
                                    'Id_Rpl_Perolehan'                          => $__data_perolehan_detail__->Id_Rpl_Perolehan,
                                    'Id_Rpl_Perolehan_Detail'                   => $__data_perolehan_detail__->Id,
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__sql = $this->__db->prepare( 
                                            "
                                                INSERT INTO Tbl_Rpl_Perolehan_Detail_HasilEvaluasi
                                                (
                                                    Id_Rpl_Cms_HasilEvaluasiAsesor, User_Rpl_Perolehan_Detail_HasilEvaluasi, Log_Rpl_Perolehan_Detail_HasilEvaluasi, IdKampus, Kampus, Data, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan, Id_Rpl_Perolehan_Detail
                                                )
                                                VALUES
                                                (
                                                    :Id_Rpl_Cms_HasilEvaluasiAsesor, :User_Rpl_Perolehan_Detail_HasilEvaluasi, :Log_Rpl_Perolehan_Detail_HasilEvaluasi, :IdKampus, :Kampus, :Data, :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas, :Id_Rpl_Perolehan, :Id_Rpl_Perolehan_Detail
                                                )
                                            "
                                        ) -> execute ( $__session_hasilevaluasi );

                                    $this->__db->commit();

                                        $__success_hasilevaluasi = '000';

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                        $__success_hasilevaluasi = '999';

                                }

                            }

                            for ( $x = 0; $x < $__jumlah_nomordokumen__; $x++ ) {

                                $__data_nomordokumen__ = $this->__NomorDokumenModel->read(['Id' => $__clean_data['__Post_NomorDokumen'][$x]]);

                                $__session_nomordokumen = [
                                    'Id_Rpl_Cms_NomorDokumen'                   => $__data_nomordokumen__->Id,
                                    'Kode_Rpl_Cms_NomorDokumen'                 => $__data_nomordokumen__->Kode,
                                    'Nama_Rpl_Cms_NomorDokumen'                 => $__data_nomordokumen__->Nama,
                                    'User_Rpl_Perolehan_Detail_NomorDokumen'    => $__data_dosen->Nama,
                                    'Log_Rpl_Perolehan_Detail_NomorDokumen'     => date('Y-m-d H:i:s'),
                                    'IdKampus'                                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                                    => __Aplikasi()['Kampus'],
                                    'Data'                                      => 'Y',
                                    'Id_Rpl_Assesor'                            => $__data_perolehan_detail__->Id_Rpl_Assesor,
                                    'Id_Rpl_Pendaftaran'                        => $__data_perolehan_detail__->Id_Rpl_Pendaftaran,
                                    'Id_Rpl_Pendaftaran_Berkas'                 => $__data_perolehan_detail__->Id_Rpl_Pendaftaran_Berkas,
                                    'Id_Rpl_Perolehan'                          => $__data_perolehan_detail__->Id_Rpl_Perolehan,
                                    'Id_Rpl_Perolehan_Detail'                   => $__data_perolehan_detail__->Id,
                                ];
                                
                                try {

                                    $this->__db->beginTransaction();

                                        $__sql = $this->__db->prepare( 
                                            "
                                                INSERT INTO Tbl_Rpl_Perolehan_Detail_NomorDokumen
                                                (
                                                    Id_Rpl_Cms_NomorDokumen, Kode_Rpl_Cms_NomorDokumen, Nama_Rpl_Cms_NomorDokumen, User_Rpl_Perolehan_Detail_NomorDokumen, Log_Rpl_Perolehan_Detail_NomorDokumen, IdKampus, Kampus, Data, 
                                                    Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan, Id_Rpl_Perolehan_Detail
                                                )
                                                VALUES
                                                (
                                                    :Id_Rpl_Cms_NomorDokumen, :Kode_Rpl_Cms_NomorDokumen, :Nama_Rpl_Cms_NomorDokumen, :User_Rpl_Perolehan_Detail_NomorDokumen, :Log_Rpl_Perolehan_Detail_NomorDokumen, :IdKampus, :Kampus, :Data, 
                                                    :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas, :Id_Rpl_Perolehan, :Id_Rpl_Perolehan_Detail
                                                )
                                            "
                                        ) -> execute ( $__session_nomordokumen );

                                    $this->__db->commit();

                                        $__success_nomordokumen = '000';

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                        $__success_nomordokumen = '999';

                                }

                            }

                            if ( $__success_hasilevaluasi == '000' AND $__success_nomordokumen == '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Berhasil Simpan Data !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url_Success'],
                                    ],
                                ];
                                exit();

                            } else {

                                $__session_detail__ = [
                                    'Id_Rpl_Assesor'                => $__session['Id_Rpl_Assesor'], 
                                    'Id_Rpl_Pendaftaran'            => $__session['Id_Rpl_Pendaftaran'], 
                                    'Id_Rpl_Pendaftaran_Berkas'     => $__session['Id_Rpl_Pendaftaran_Berkas'], 
                                    'Id_Rpl_Perolehan'              => $__session['Id_Rpl_Perolehan'], 
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__sql = $this->__db->prepare( 
                                            "
                                                DELETE FROM Tbl_Rpl_Perolehan_Detail
                                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                                            "
                                        ) -> execute ( $__session );

                                    $this->__db->commit();

                                        return [
                                            'Error'   => '000',
                                            'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                            'Data'    => [
                                                'Url'   => $__clean_data['__Url'],
                                            ],
                                        ];
                                        exit();

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                    return [
                                        'Error'   => '999',
                                        'Message' => 'A Data Error Hapus Perolehan Detail Occurred: ' . $e->getMessage(),
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                                }

                            }

                        } else {

                            $__session_detail__ = [
                                'Id_Rpl_Assesor'                => $__session['Id_Rpl_Assesor'], 
                                'Id_Rpl_Pendaftaran'            => $__session['Id_Rpl_Pendaftaran'], 
                                'Id_Rpl_Pendaftaran_Berkas'     => $__session['Id_Rpl_Pendaftaran_Berkas'], 
                                'Id_Rpl_Perolehan'              => $__session['Id_Rpl_Perolehan'], 
                            ];

                            try {

                                $this->__db->beginTransaction();

                                    $__sql = $this->__db->prepare( 
                                        "
                                            DELETE FROM Tbl_Rpl_Perolehan_Detail
                                            WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                            AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                            AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                            AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                                        "
                                    ) -> execute ( $__session );

                                $this->__db->commit();

                                    return [
                                        'Error'   => '000',
                                        'Message' => 'Tidak Berhasil Simpan Data Hasil Evaluasi, Jadinya Reset Ulang !',
                                        'Data'    => [
                                            'Url'   => $__clean_data['__Url'],
                                        ],
                                    ];
                                    exit();

                            } catch ( PDOException $e ) {

                                $this->__db->rollback();

                                return [
                                    'Error'   => '999',
                                    'Message' => 'A Data Error Hapus Perolehan Detail Occurred: ' . $e->getMessage(),
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                        }

                    } else {

                        return [
                            'Error'   => '999',
                            'Message' => 'Tidak Berhasil Simpan Data !',
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

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Ubah()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/konversi/upload/ubah';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__IdBerkas']) AND $_GET['__IdBerkas'] == TRUE AND isset($_GET['__IdPerolehan']) AND $_GET['__IdPerolehan'] == TRUE AND isset($_GET['__IdCpmk']) AND $_GET['__IdCpmk'] == TRUE AND isset($_GET['__IdPerolehanDetail']) AND $_GET['__IdPerolehanDetail'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    if ( $__calon_rpl__->Id == TRUE AND $__calon_rpl_berkas__ == TRUE ) {

                        $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record_data__->Id_Rpl_Pendaftaran ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $_GET['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                        $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_data__->D_2 ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $_GET['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                        $__data_cpmk__ = $this->__db->queryid(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $__data_mk_perolehan->IdMk ."' AND C.IdMk = '". $__data_mk_perolehan->IdMk ."' AND A.Id_Cpmk = '". $this->__helpers->SecretOpen( $_GET['__IdCpmk'] ) ."' ORDER BY A.Id_Cpmk DESC ");

                        $__data_perolehan_detail__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan_Detail AS Id, Id_Cpmk, Id_Rpl_Cms_Profesiensi, User_Rpl_Perolehan_Detail AS Users, Log_Rpl_Perolehan_Detail AS Logs, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan FROM Tbl_Rpl_Perolehan_Detail WHERE Id_Rpl_Assesor = '". $__data_mk_perolehan->Id_Rpl_Assesor ."' AND Id_Rpl_Pendaftaran = '". $__data_mk_perolehan->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_mk_perolehan->Id_Rpl_Pendaftaran_Berkas ."' AND Id_Rpl_Perolehan = '". $__data_mk_perolehan->Id ."' AND Id_Cpmk = '". $__data_cpmk__->Id ."' AND Id_Rpl_Perolehan_Detail = '". $this->__helpers->SecretOpen( $_GET['__IdPerolehanDetail'] ) ."' ORDER BY Id_Rpl_Perolehan_Detail DESC ");

                        if ( $__data_mk_perolehan->Id == TRUE AND $__data_cpmk__->Id == TRUE AND $__data_perolehan_detail__->Id == TRUE ) {

                            $__nomor_mk_perolehan__ = '1';
                            $__total_berkas_pendukung = $this->__Total_File_Pendukung_Rpl(['Id_Rpl_Pendaftaran' => $__calon_rpl__->Id]);

                            $__data_evaluasidiri__ = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");
                        
                            $__data_profesiensi__ = $this->__ProfesiensiModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                            $__data_profesiensi_ubah__ = $this->__ProfesiensiModel->read(['Id' => $__data_evaluasidiri__->Id, 'Id2' => $__data_perolehan_detail__->Id_Rpl_Cms_Profesiensi]);

                            $__data_hasilevaluasi__ = $this->__HasilevaluasiasesorModel->read( ['Id' => $__data_evaluasidiri__->Id] );
                            $__data_hasilevaluasi__total__ = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Cms_HasilEvaluasiAsesor ) AS Total FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $__data_evaluasidiri__->Id ."' ");

                            $__data_keterangandokumen__ = $this->__KeteranganDokumenModel->read();

                            $__data_nomordokumen__ = $this->__NomorDokumenModel->read();
                            
                            $__db = $this->__db;
                            
                            require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                        } else {

                            redirect($__routes . '/rpl/cms_2/matakuliah_perolehan/detail/konversi?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas'] . '&__IdPerolehan=' . $_GET['__IdPerolehan'], '01', 'Tidak Ada Data Konversi Telah Di Pilih !');
                            exit();

                        }
                        
                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan Untuk Detail !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Ubah_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdRplBerkas'                     => isset($data['__IdRplBerkas']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplBerkas'], ENT_QUOTES))) : '',
                '__IdPerolehan'                     => isset($data['__IdPerolehan']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPerolehan'], ENT_QUOTES))) : '',
                '__IdMk_Cpmk'                       => isset($data['__IdMk_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdMk_Cpmk'], ENT_QUOTES))) : '',
                '__Id_Cpmk'                         => isset($data['__Id_Cpmk']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id_Cpmk'], ENT_QUOTES))) : '',
                '__IdPerolehanDetail'               => isset($data['__IdPerolehanDetail']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPerolehanDetail'], ENT_QUOTES))) : '',
                '__NilaiMk'                         => isset($data['__NilaiMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__NilaiMk'], ENT_QUOTES))) : '',
                '__HurufMk'                         => isset($data['__HurufMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__HurufMk'], ENT_QUOTES))) : '',
                '__Post_Profesiensi'                => isset($data['__Post_Profesiensi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Post_Profesiensi'], ENT_QUOTES))) : '',
                '__Post_HasilEvaluasiAssesor'       => isset($data['__Post_HasilEvaluasiAssesor']) ? $data['__Post_HasilEvaluasiAssesor'] : '',
                '__Post_NomorDokumen'               => isset($data['__Post_NomorDokumen']) ? $data['__Post_NomorDokumen'] : '',
            ];

            $_SESSION['__Old__'] = [
                '__NilaiMk'         => $__clean_data['__NilaiMk'],
                '__HurufMk'         => $__clean_data['__HurufMk'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                // $__titik_nilai = substr($__clean_data['__NilaiMk'],1,1);

                // if ( $__titik_nilai != '.' ) {

                //     return [
                //         'Error'     => '999',
                //         'Message'   => 'Mohon Maaf Nilai Angka Wajib Mengikuti Format, Contohnya ' . substr($__clean_data['__NilaiMk'],0,1) . '.' . substr($__clean_data['__NilaiMk'],2,2) . ' !',
                //         'Data'      => [
                //             'Url'   => $__clean_data['__Url'],
                //         ],
                //     ];
                //     exit();

                // }
                

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdRplBerkas'] == FALSE OR $__clean_data['__IdMk_Cpmk'] == FALSE OR $__clean_data['__Id_Cpmk'] == FALSE OR $__clean_data['__Post_Profesiensi'] == FALSE OR $__clean_data['__Post_HasilEvaluasiAssesor'] == FALSE OR $__clean_data['__Post_NomorDokumen'] == FALSE OR $__clean_data['__IdPerolehanDetail'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  


                $__jumlah_hasilevaluasi__ = COUNT( $__clean_data['__Post_HasilEvaluasiAssesor'] );
                $__jumlah_nomordokumen__ = COUNT( $__clean_data['__Post_NomorDokumen'] );

                if ( $__jumlah_hasilevaluasi__ == '0' OR $__jumlah_hasilevaluasi__ <= '0' OR $__jumlah_nomordokumen__ == '0' OR $__jumlah_nomordokumen__ <= '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Hasil Evaluasi dan Nomor Dokumen Wajib Di Pilih Salah Satu !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );
                
                if ( !$__record_data__->Id OR !$__calon_rpl__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Assesor dan Pendaftaran RPL Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");
                
                if ( !$__data_dosen->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Dosen Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $__clean_data['__IdRplBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

                if ( !$__data_matakuliah_perolehan__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Pendaftaran Berkas Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__data_dosen->Id ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $__clean_data['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                if ( !$__data_mk_perolehan->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Matakuliah Perolehan Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                
                $__data_cpmk__ = $this->__db->queryid(" SELECT A.Id_Cpmk AS Id, A.Cpmk AS C FROM Tbl_Cpmk A LEFT JOIN Tbl_Penugasan B ON A.Id_Penugasan = B.Id_Penugasan LEFT JOIN Matakuliah C ON B.IdMk = C.IdMk WHERE B.IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' AND C.IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' AND A.Id_Cpmk = '". $this->__helpers->SecretOpen( $__clean_data['__Id_Cpmk'] ) ."' ORDER BY A.Id_Cpmk DESC ");

                if ( !$__data_cpmk__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Cpmk Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_matakuliah__ = $this->__db->queryid(" SELECT TOP 1 IdMk, Matakuliah, Sks FROM Matakuliah WHERE IdMk = '". $this->__helpers->SecretOpen( $__clean_data['__IdMk_Cpmk'] ) ."' ORDER BY IdMK DESC ");

                if ( !$__data_matakuliah__->IdMk ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Matakuliah Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_perolehan_detail__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan_Detail AS Id, Id_Cpmk, Id_Rpl_Cms_Profesiensi, User_Rpl_Perolehan_Detail AS Users, Log_Rpl_Perolehan_Detail AS Logs, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan FROM Tbl_Rpl_Perolehan_Detail WHERE Id_Rpl_Assesor = '". $__data_mk_perolehan->Id_Rpl_Assesor ."' AND Id_Rpl_Pendaftaran = '". $__data_mk_perolehan->Id_Rpl_Pendaftaran ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_mk_perolehan->Id_Rpl_Pendaftaran_Berkas ."' AND Id_Rpl_Perolehan = '". $__data_mk_perolehan->Id ."' AND Id_Cpmk = '". $__data_cpmk__->Id ."' AND Id_Rpl_Perolehan_Detail = '". $this->__helpers->SecretOpen( $__clean_data['__IdPerolehanDetail'] ) ."' ORDER BY Id_Rpl_Perolehan_Detail DESC ");

                if ( !$__data_perolehan_detail__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Perolehan Detail Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                // $__session_update_nilai__ = [
                //     'Nilai_Rpl_Perolehan'                   => $__clean_data['__NilaiMk'],
                //     'Huruf_Rpl_Perolehan'                   => $__clean_data['__HurufMk'],
                //     'User_Rpl_Perolehan'                    => $__data_dosen->Nama,
                //     'Log_Rpl_Perolehan'                     => date('Y-m-d H:i:s'),
                //     'Id_Rpl_Perolehan'                      => $__data_mk_perolehan->Id,
                //     'Id_Rpl_Assesor'                        => $__record_data__->Id,
                //     'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                //     'Id_Rpl_Pendaftaran_Berkas'             => $__data_matakuliah_perolehan__->Id,
                // ];

                $__session = [
                    'Id_Rpl_Cms_Profesiensi'                => $__clean_data['__Post_Profesiensi'],
                    'User_Rpl_Perolehan_Detail'             => $__data_dosen->Nama,
                    'Log_Rpl_Perolehan_Detail'              => date('Y-m-d H:i:s'),
                    'Id_Rpl_Assesor'                        => $__record_data__->Id,
                    'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                    'Id_Rpl_Pendaftaran_Berkas'             => $__data_matakuliah_perolehan__->Id,
                    'Id_Rpl_Perolehan'                      => $__data_mk_perolehan->Id,
                    'Id_Rpl_Perolehan_Detail'               => $__data_perolehan_detail__->Id,
                ];

                    try {

                        $this->__db->beginTransaction();

                            // $__sql_nilai = $this->__db->prepare( 
                            //     "
                            //         UPDATE Tbl_Rpl_Perolehan SET
                            //             Nilai_Rpl_Perolehan         = :Nilai_Rpl_Perolehan,
                            //             Huruf_Rpl_Perolehan         = :Huruf_Rpl_Perolehan,
                            //             User_Rpl_Perolehan          = :User_Rpl_Perolehan,
                            //             Log_Rpl_Perolehan           = :Log_Rpl_Perolehan
                            //         WHERE Id_Rpl_Perolehan          = :Id_Rpl_Perolehan
                            //         AND Id_Rpl_Assesor              = :Id_Rpl_Assesor
                            //         AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                            //         AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                            //     "
                            // ) -> execute ( $__session_update_nilai__ );

                            $__sql = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Perolehan_Detail SET
                                        Id_Rpl_Cms_Profesiensi      = :Id_Rpl_Cms_Profesiensi,
                                        User_Rpl_Perolehan_Detail   = :User_Rpl_Perolehan_Detail, 
                                        Log_Rpl_Perolehan_Detail    = :Log_Rpl_Perolehan_Detail
                                    WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor 
                                    AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                    AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                    AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                                    AND Id_Rpl_Perolehan_Detail     = :Id_Rpl_Perolehan_Detail
                                "
                            ) -> execute ( $__session );

                        $this->__db->commit();

                            $__success_query__ = '000';

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                            $__success_query__ = '999';

                    }

                    if ( $__success_query__ == '000' ) {

                        $__session_delete__ = [
                            'Id_Rpl_Assesor'                        => $__record_data__->Id,
                            'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                            'Id_Rpl_Pendaftaran_Berkas'             => $__data_matakuliah_perolehan__->Id,
                            'Id_Rpl_Perolehan'                      => $__data_mk_perolehan->Id,
                            'Id_Rpl_Perolehan_Detail'               => $__data_perolehan_detail__->Id,
                        ];

                        $__sql = $this->__db->prepare( 
                            "
                                DELETE FROM Tbl_Rpl_Perolehan_Detail_HasilEvaluasi
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor 
                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                                AND Id_Rpl_Perolehan_Detail     = :Id_Rpl_Perolehan_Detail
                            "
                        ) -> execute ( $__session_delete__ );

                        $__sql = $this->__db->prepare( 
                            "
                                DELETE FROM Tbl_Rpl_Perolehan_Detail_NomorDokumen
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor 
                                AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                                AND Id_Rpl_Perolehan_Detail     = :Id_Rpl_Perolehan_Detail
                            "
                        ) -> execute ( $__session_delete__ );


                            for ( $x = 0; $x < $__jumlah_hasilevaluasi__; $x++ ) {

                                $__session_hasilevaluasi = [
                                    'Id_Rpl_Cms_HasilEvaluasiAsesor'            => $__clean_data['__Post_HasilEvaluasiAssesor'][$x],
                                    'User_Rpl_Perolehan_Detail_HasilEvaluasi'   => $__data_dosen->Nama,
                                    'Log_Rpl_Perolehan_Detail_HasilEvaluasi'    => date('Y-m-d H:i:s'),
                                    'IdKampus'                                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                                    => __Aplikasi()['Kampus'],
                                    'Data'                                      => 'Y',
                                    'Id_Rpl_Assesor'                            => $__data_perolehan_detail__->Id_Rpl_Assesor,
                                    'Id_Rpl_Pendaftaran'                        => $__data_perolehan_detail__->Id_Rpl_Pendaftaran,
                                    'Id_Rpl_Pendaftaran_Berkas'                 => $__data_perolehan_detail__->Id_Rpl_Pendaftaran_Berkas,
                                    'Id_Rpl_Perolehan'                          => $__data_perolehan_detail__->Id_Rpl_Perolehan,
                                    'Id_Rpl_Perolehan_Detail'                   => $__data_perolehan_detail__->Id,
                                ];

                                try {

                                    $this->__db->beginTransaction();

                                        $__sql = $this->__db->prepare( 
                                            "
                                                INSERT INTO Tbl_Rpl_Perolehan_Detail_HasilEvaluasi
                                                (
                                                    Id_Rpl_Cms_HasilEvaluasiAsesor, User_Rpl_Perolehan_Detail_HasilEvaluasi, Log_Rpl_Perolehan_Detail_HasilEvaluasi, IdKampus, Kampus, Data, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan, Id_Rpl_Perolehan_Detail
                                                )
                                                VALUES
                                                (
                                                    :Id_Rpl_Cms_HasilEvaluasiAsesor, :User_Rpl_Perolehan_Detail_HasilEvaluasi, :Log_Rpl_Perolehan_Detail_HasilEvaluasi, :IdKampus, :Kampus, :Data, :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas, :Id_Rpl_Perolehan, :Id_Rpl_Perolehan_Detail
                                                )
                                            "
                                        ) -> execute ( $__session_hasilevaluasi );

                                    $this->__db->commit();

                                        $__success_hasilevaluasi = '000';

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                        $__success_hasilevaluasi = '999';

                                }

                            }

                            for ( $x = 0; $x < $__jumlah_nomordokumen__; $x++ ) {

                                $__data_nomordokumen__ = $this->__NomorDokumenModel->read(['Id' => $__clean_data['__Post_NomorDokumen'][$x]]);

                                $__session_nomordokumen = [
                                    'Id_Rpl_Cms_NomorDokumen'                   => $__data_nomordokumen__->Id,
                                    'Kode_Rpl_Cms_NomorDokumen'                 => $__data_nomordokumen__->Kode,
                                    'Nama_Rpl_Cms_NomorDokumen'                 => $__data_nomordokumen__->Nama,
                                    'User_Rpl_Perolehan_Detail_NomorDokumen'    => $__data_dosen->Nama,
                                    'Log_Rpl_Perolehan_Detail_NomorDokumen'     => date('Y-m-d H:i:s'),
                                    'IdKampus'                                  => __Aplikasi()['IdKampus'],
                                    'Kampus'                                    => __Aplikasi()['Kampus'],
                                    'Data'                                      => 'Y',
                                    'Id_Rpl_Assesor'                            => $__data_perolehan_detail__->Id_Rpl_Assesor,
                                    'Id_Rpl_Pendaftaran'                        => $__data_perolehan_detail__->Id_Rpl_Pendaftaran,
                                    'Id_Rpl_Pendaftaran_Berkas'                 => $__data_perolehan_detail__->Id_Rpl_Pendaftaran_Berkas,
                                    'Id_Rpl_Perolehan'                          => $__data_perolehan_detail__->Id_Rpl_Perolehan,
                                    'Id_Rpl_Perolehan_Detail'                   => $__data_perolehan_detail__->Id,
                                ];
                                
                                try {

                                    $this->__db->beginTransaction();

                                        $__sql = $this->__db->prepare( 
                                            "
                                                INSERT INTO Tbl_Rpl_Perolehan_Detail_NomorDokumen
                                                (
                                                    Id_Rpl_Cms_NomorDokumen, Kode_Rpl_Cms_NomorDokumen, Nama_Rpl_Cms_NomorDokumen, User_Rpl_Perolehan_Detail_NomorDokumen, Log_Rpl_Perolehan_Detail_NomorDokumen, IdKampus, Kampus, Data, 
                                                    Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas, Id_Rpl_Perolehan, Id_Rpl_Perolehan_Detail
                                                )
                                                VALUES
                                                (
                                                    :Id_Rpl_Cms_NomorDokumen, :Kode_Rpl_Cms_NomorDokumen, :Nama_Rpl_Cms_NomorDokumen, :User_Rpl_Perolehan_Detail_NomorDokumen, :Log_Rpl_Perolehan_Detail_NomorDokumen, :IdKampus, :Kampus, :Data, 
                                                    :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :Id_Rpl_Pendaftaran_Berkas, :Id_Rpl_Perolehan, :Id_Rpl_Perolehan_Detail
                                                )
                                            "
                                        ) -> execute ( $__session_nomordokumen );

                                    $this->__db->commit();

                                        $__success_nomordokumen = '000';

                                } catch ( PDOException $e ) {

                                    $this->__db->rollback();

                                        $__success_nomordokumen = '999';

                                }

                            }

                            if ( $__success_hasilevaluasi == '000' AND $__success_nomordokumen == '000' ) {

                                unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );

                                return [
                                    'Error'   => '000',
                                    'Message' => 'Berhasil Simpan Data !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url_Success'],
                                    ],
                                ];
                                exit();

                            } else {

                                return [
                                    'Error'   => '999',
                                    'Message' => 'Tidak Berhasil Simpan Data Pada Hasil Evaluasi dan Nomor Dokumen !',
                                    'Data'    => [
                                        'Url'   => $__clean_data['__Url'],
                                    ],
                                ];
                                exit();

                            }

                    } else {

                        return [
                            'Error'   => '999',
                            'Message' => 'Tidak Berhasil Simpan Data !',
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

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Nilai()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__homedosen/rpl/cms_2/matakuliah_perolehan_detail/nilai';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Dosen__']) ) {

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

                $__authlogin__ = $this->__SessionController->__Data_Dosen__( $__session_login__['__Id'] );

                if ( isset($_GET['__Id']) AND $_GET['__Id'] == TRUE AND isset($_GET['__IdBerkas']) AND $_GET['__IdBerkas'] == TRUE AND isset($_GET['__IdPerolehan']) AND $_GET['__IdPerolehan'] == TRUE ) {

                    $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )] );

                    $__calon_rpl__ = $this->__Data_Rpl__( $__record_data__->Id_Rpl_Pendaftaran );
                    $__calon_rpl_berkas__ = $this->__Data_Rpl_Berkas__( $__record_data__->Id_Rpl_Pendaftaran );
                    
                    $__url_file = $this->__Url_File__();
                    $__url_file_penunjang = $this->__Url_File_Penunjang__();

                    if ( $__calon_rpl__->Id == TRUE AND $__calon_rpl_berkas__ == TRUE ) {

                        $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__record_data__->Id_Rpl_Pendaftaran ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $_GET['__IdBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");
                        
                        $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__record_data__->D_2 ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $_GET['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                        if ( $__data_mk_perolehan->Id == TRUE ) {
                        
                            require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

                        } else {

                            redirect($__routes . '/rpl/cms_2/matakuliah_perolehan?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas'], '01', 'Tidak Ada Data Konversi Telah Di Pilih !');
                            exit();

                        }
                        
                    } else {

                        redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan Untuk Detail !');
                        exit();

                    }

                } else {

                    redirect(self::__Routes_Mod__(), '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }

            }
        }

        public function IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Nilai_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'                           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'                             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'                     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__IdAssesor'                       => isset($data['__IdAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdAssesor'], ENT_QUOTES))) : '',
                '__IdRplPendaftaran'                => isset($data['__IdRplPendaftaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplPendaftaran'], ENT_QUOTES))) : '',
                '__IdDosenAssesor'                  => isset($data['__IdDosenAssesor']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdDosenAssesor'], ENT_QUOTES))) : '',
                '__IdRplBerkas'                     => isset($data['__IdRplBerkas']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdRplBerkas'], ENT_QUOTES))) : '',
                '__IdPerolehan'                     => isset($data['__IdPerolehan']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPerolehan'], ENT_QUOTES))) : '',
                '__NilaiMk'                         => isset($data['__NilaiMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__NilaiMk'], ENT_QUOTES))) : '',
                '__HurufMk'                         => isset($data['__HurufMk']) ? stripslashes(strip_tags(htmlspecialchars($data['__HurufMk'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__NilaiMk'         => $__clean_data['__NilaiMk'],
                '__HurufMk'         => $__clean_data['__HurufMk'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__titik_nilai = substr($__clean_data['__NilaiMk'],1,1);

                if ( $__titik_nilai != '.' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Nilai Angka Wajib Mengikuti Format, Contohnya ' . substr($__clean_data['__NilaiMk'],0,1) . '.' . substr($__clean_data['__NilaiMk'],2,2) . ' !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }
                

                if ( $__clean_data['__IdAssesor'] == FALSE OR $__clean_data['__IdRplPendaftaran'] == FALSE OR $__clean_data['__IdDosenAssesor'] == FALSE OR $__clean_data['__IdRplBerkas'] == FALSE OR $__clean_data['__IdPerolehan'] == FALSE OR $__clean_data['__NilaiMk'] == FALSE OR $__clean_data['__HurufMk'] == FALSE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Keseluruhannya !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }  


                $__record_data__ = $this->__Assesor( ['Assesor' => 'ID', 'Id' => $this->__helpers->SecretOpen( $__clean_data['__IdAssesor'] )] );

                $__calon_rpl__ = $this->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__IdRplPendaftaran'] ) );
                
                if ( !$__record_data__->Id OR !$__calon_rpl__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Assesor dan Pendaftaran RPL Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_dosen = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama FROM Dosen WHERE IdDosen = '". $__record_data__->D_2 ."' AND IdDosen = '". $this->__helpers->SecretOpen( $__clean_data['__IdDosenAssesor'] ) ."' ORDER BY IdDosen DESC ");
                
                if ( !$__data_dosen->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Dosen Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_matakuliah_perolehan__ = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Data = 'Y' AND Id_Rpl_Pendaftaran_Berkas = '". $this->__helpers->SecretOpen( $__clean_data['__IdRplBerkas'] ) ."' ORDER BY Id_Rpl_Pendaftaran_Berkas DESC ");

                if ( !$__data_matakuliah_perolehan__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Pendaftaran Berkas Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_mk_perolehan = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_Perolehan AS Id, IdMk_Rpl_Perolehan AS IdMk, Matakuliah_Rpl_Perolehan AS Matakuliah, Sks_Rpl_Perolehan AS Sks, Nilai_Rpl_Perolehan AS Nilai, Huruf_Rpl_Perolehan AS Huruf, IdDosen_Rpl_Perolehan AS IdDosen, Ta_Rpl_Perolehan AS Ta, Semester_Rpl_Perolehan AS Semester, Prodi_Rpl_Perolehan AS Prodi, User_Rpl_Perolehan AS Users, Log_Rpl_Perolehan AS Logs, IdKampus, Kampus, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Pendaftaran_Berkas FROM Tbl_Rpl_Perolehan WHERE IdDosen_Rpl_Perolehan = '". $__data_dosen->Id ."' AND Ta_Rpl_Perolehan = '". $__calon_rpl__->Ta ."' AND Semester_Rpl_Perolehan = '". $__calon_rpl__->Semester ."' AND Prodi_Rpl_Perolehan = '". $__calon_rpl__->Prodi ."' AND Data = 'Y' AND Id_Rpl_Assesor = '". $__record_data__->Id ."' AND Id_Rpl_Pendaftaran = '". $__calon_rpl__->Id ."' AND Id_Rpl_Pendaftaran_Berkas = '". $__data_matakuliah_perolehan__->Id ."' AND Id_Rpl_Perolehan = '". $this->__helpers->SecretOpen( $__clean_data['__IdPerolehan'] ) ."' ORDER BY IdMk_Rpl_Perolehan DESC ");

                if ( !$__data_mk_perolehan->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Matakuliah Perolehan Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__session = [
                    'Nilai_Rpl_Perolehan'                   => $__clean_data['__NilaiMk'],
                    'Huruf_Rpl_Perolehan'                   => $__clean_data['__HurufMk'],
                    'User_Rpl_Perolehan'                    => $__data_dosen->Nama,
                    'Log_Rpl_Perolehan'                     => date('Y-m-d H:i:s'),
                    'Id_Rpl_Perolehan'                      => $__data_mk_perolehan->Id,
                    'Id_Rpl_Assesor'                        => $__record_data__->Id,
                    'Id_Rpl_Pendaftaran'                    => $__calon_rpl__->Id,
                    'Id_Rpl_Pendaftaran_Berkas'             => $__data_matakuliah_perolehan__->Id,
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__sql_nilai = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Perolehan SET
                                        Nilai_Rpl_Perolehan         = :Nilai_Rpl_Perolehan,
                                        Huruf_Rpl_Perolehan         = :Huruf_Rpl_Perolehan,
                                        User_Rpl_Perolehan          = :User_Rpl_Perolehan,
                                        Log_Rpl_Perolehan           = :Log_Rpl_Perolehan
                                    WHERE Id_Rpl_Perolehan          = :Id_Rpl_Perolehan
                                    AND Id_Rpl_Assesor              = :Id_Rpl_Assesor
                                    AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                                    AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                "
                            ) -> execute ( $__session );

                            unset( $_SESSION['__Form_Notifikasi__'],  $_SESSION['__Old__'] );
                                
                        $this->__db->commit();

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => $__clean_data['__Url_Success'],
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

        public function IndexDosen_Rpl_Cms_2_Hapus()
        {
            $__clean_data = [
                '__Url'     => url('/homedosen/rpl/cms_2?__Id=' . $_GET['__Id']),
                '__Id'      => isset($_GET['__Id']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__Id'], ENT_QUOTES))) : '',
                '__Id1'     => isset($_GET['__Id1']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__Id1'], ENT_QUOTES))) : '',
            ];

            $__id = isset($__clean_data['__Id']) ? intval($this->__helpers->SecretOpen($__clean_data['__Id'])) : 0;
            $__id_assesor = isset($__clean_data['__Id1']) ? intval($this->__helpers->SecretOpen($__clean_data['__Id1'])) : 0;

            if ( $__id <= 0 || $__id_assesor <= 0 ) {
                
                redirect($__clean_data['__Url'], '03', 'ID Tidak Valid !');
                exit();
                
            }

            $__session = [
                'Id_Rpl_Assesor'        => $__id,
                'Id_Rpl_Assesor_1'      => $__id_assesor,
            ];

            $__session_detail = [
                'Id_Rpl_Assesor_1'      => $__id_assesor,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__sql_2 = $this->__db->prepare( 
                            "
                                DELETE Tbl_Rpl_Assesor_2
                                WHERE Id_Rpl_Assesor        = :Id_Rpl_Assesor
                                AND Id_Rpl_Assesor_1        = :Id_Rpl_Assesor_1
                            "
                        ) -> execute ( $__session );

                        $__sql_2_hasil = $this->__db->prepare( 
                            "
                            DELETE Tbl_Rpl_Assesor_2_HasilEvaluasi
                                WHERE Id_Rpl_Assesor_1      = :Id_Rpl_Assesor_1
                            "
                        ) -> execute ( $__session_detail );

                        $__sql_2_nomor = $this->__db->prepare( 
                            "
                                DELETE Tbl_Rpl_Assesor_2_NomorDokumen
                                WHERE Id_Rpl_Assesor_1      = :Id_Rpl_Assesor_1
                            "
                        ) -> execute ( $__session_detail );

                    $this->__db->commit();

                        redirect($__clean_data['__Url'], '01', 'Berhasil Hapus Data');
                        exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }

        public function IndexDosen_Rpl_Cms_2_Perolehan_Hapus()
        {
            $__clean_data = [
                '__Url'         => url('/homedosen/rpl/cms_2/matakuliah_perolehan/detail?__Id=' . $_GET['__Id'] . '&__IdBerkas=' . $_GET['__IdBerkas']),
                '__Id'          => isset($_GET['__Id']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__Id'], ENT_QUOTES))) : '',
                '__IdBerkas'    => isset($_GET['__IdBerkas']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__IdBerkas'], ENT_QUOTES))) : '',
                '__IdDelete'    => isset($_GET['__IdDelete']) ? stripslashes(strip_tags(htmlspecialchars($_GET['__IdDelete'], ENT_QUOTES))) : '',
            ];

            $__id = isset($__clean_data['__Id']) ? intval($this->__helpers->SecretOpen($__clean_data['__Id'])) : 0;
            $__id_berkas = isset($__clean_data['__IdBerkas']) ? intval($this->__helpers->SecretOpen($__clean_data['__IdBerkas'])) : 0;
            $__id_delete = isset($__clean_data['__IdDelete']) ? intval($this->__helpers->SecretOpen($__clean_data['__IdDelete'])) : 0;
            
            if ( $__id <= 0 || $__id_berkas <= 0 || $__id_delete <= 0 ) {
                
                redirect($__clean_data['__Url'], '03', 'ID Tidak Valid !');
                exit();
                
            }

            $__session = [
                'Id_Rpl_Assesor'            => $__id,
                'Id_Rpl_Pendaftaran_Berkas' => $__id_berkas,
                'Id_Rpl_Perolehan'          => $__id_delete,
            ];
            
                try {

                    $this->__db->beginTransaction();

                        $__sql_perolehan = $this->__db->prepare( 
                            "
                                DELETE Tbl_Rpl_Perolehan
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                            "
                        ) -> execute ( $__session );

                        $__sql_perolehan_detail = $this->__db->prepare( 
                            "
                                DELETE Tbl_Rpl_Perolehan
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                            "
                        ) -> execute ( $__session );

                        $__sql_perolehan_hasil = $this->__db->prepare( 
                            "
                                DELETE Tbl_Rpl_Perolehan
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                            "
                        ) -> execute ( $__session );

                        $__sql_perolehan_nomor = $this->__db->prepare( 
                            "
                                DELETE Tbl_Rpl_Perolehan
                                WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                                AND Id_Rpl_Pendaftaran_Berkas   = :Id_Rpl_Pendaftaran_Berkas
                                AND Id_Rpl_Perolehan            = :Id_Rpl_Perolehan
                            "
                        ) -> execute ( $__session );

                    $this->__db->commit();

                        redirect($__clean_data['__Url'], '01', 'Berhasil Hapus Data');
                        exit();

                } catch (Exception $e) {

                    $this->__db->rollback();
                    
                    redirect($__clean_data['__Url'], '03', 'A Data Error Occurred: ' . $e->getMessage());
                    exit();
                    
                }
        }
    }