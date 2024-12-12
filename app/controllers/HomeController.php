<?php

    class HomeController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
        }
        
        public function __Header()
        {
            return 'Login | ';
        }

        public function IndexLogin()
        {
            $__header = $this->__Header();
            $__secret_key = $this->__secret_key;
            $__universitas = $this->__universitas;

            $__check_maintance__ = $this->__db->queryrow(" SELECT Id FROM Maintance WHERE App = '". __Aplikasi()['Aplikasi'] ."' AND Status = 'Y' ");

            if ( $__check_maintance__ == FALSE ) {

                @require_once dirname(dirname(__DIR__)) . '/public/auth/login/__data.php';

            } else {

                @require_once dirname(dirname(__DIR__)) . '/public/__maintance.php';

            }
        }
    }