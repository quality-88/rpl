<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once dirname(__DIR__) . '/../models/administrator/InformasiFile.php';
    require_once __DIR__ . '/__SessionController.php';

    class HomedosenInformasiFileController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__InformasiFileModel;
        protected $__SessionController;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__InformasiFileModel = new __InformasiFileModel( $this->__db );
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
        }

        public function __Header()
        {
            return 'Dosen | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homedosen/informasi_file');
        }

        public function __Routes_Mod_File__()
        {
            return __Base_Url() . 'src/storages/__file/';
        }
        
        public function IndexDosen_InformasiFile()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homedosen');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__informasi_file';

            $__base_file    = self::__Routes_Mod_File__();

            $__active_informasi         = 'active';
            $__active_informasi_file    = 'active';

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

                $__record_data__ = $this->__InformasiFileModel->read();
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/dosen/__data.php';

            }
        }
    }