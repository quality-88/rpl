<?php

    class AdminController
    {
        protected $__db;
        protected $__secret_key;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
        }
        
        public function __Header()
        {
            return 'Administrator | ';
        }

        public function Index()
        {
            $__data_session__ = self::__DataSession__();
        
            if ( !isset($__data_session__['__Id']) OR $__data_session__['__Id'] == FALSE )
            {
                @$_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Mohon Maaf Username Atau Email Yang Di Masukkan Tidak Pernah Terdaftar !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();
            }

            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            
            $__active       = 'active';

            $__authlogin__ = $this->__db->queryid(" SELECT Id_Akun AS Id, Nama_Akun AS Nama, Email_Akun AS Email, User_Akun AS Users, Pass_Akun AS Pass, Hp_Akun AS Hp, Level_Akun AS Level, Status_Akun AS Status, Log_Akun AS Logs FROM Tbl_Akun WHERE Id_Akun = '". $__data_session__['__Id'] ."' ORDER BY Id_Akun DESC LIMIT 1 ");

            @require_once dirname(dirname(__DIR__)) . '/public/administrator/__data.php';
        }

        public function __DataSession__(  )
        {
            $__clean_data = [
                '__Id'      => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__SessionUser__']['__Id'], 221, 77) )[1],
                '__Nama'    => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__SessionUser__']['__Nama'], 221, 77) )[1],
                '__Level'   => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__SessionUser__']['__Level'], 221, 77) )[1],
                '__Log'     => $_SESSION['__SessionUser__']['__Log'],
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

        public function Logout()
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
    }