<?php

    class __Secret_Keys {
        
        private $encrypt_method = "AES-256-CBC";
        private $secret_key;
        private $secret_iv;

        public function __construct($key, $iv) {
            $this->secret_key = hash('sha256', $key);
            $this->secret_iv = substr(hash('sha256', $iv), 0, 16);
        }

        public function Encrypt($string) {
            return base64_encode(openssl_encrypt($string, $this->encrypt_method, $this->secret_key, 0, $this->secret_iv));
        }

        public function Decrypt($string) {
            return openssl_decrypt(base64_decode($string), $this->encrypt_method, $this->secret_key, 0, $this->secret_iv);
        }
        
    }

    // @$__secret_key = new __Secret_Keys('Secret key', 'Secret iv');