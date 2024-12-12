<?php

    class __SessionController
    {
        private $__db;
        private $__secret_key;
        private $__universitas;

        public function __construct( $db , $__secret_key , $__universitas )
        {
            $this->__db = $db;
            $this->__universitas = $__universitas;
            $this->__secret_key = $__secret_key;
        }

        public function __Session__()
        {
            $__clean_data = [
                '__Id'      => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Dosen__']['__Id'], 221, 77) )[1],
                '__Nama'    => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Dosen__']['__Nama'], 221, 77) )[1],
                '__Level'   => explode("|\|", $this->__secret_key->Decrypt( $_SESSION['__Dosen__']['__Level'], 221, 77) )[1],
                '__Log'     => $_SESSION['__Dosen__']['__Log'],
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
        
        public function __Data_Dosen__( $id )
        {
            $data = $this->__db->queryid(" SELECT TOP 1 IdDosen AS Id, NamaGelar AS Nama, 'Dosen' AS Level FROM Dosen WHERE IdDosen = '". $id ."' ORDER BY IdDosen DESC ");

            return $data;
        } 
    }