<?php

    class __SkModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( isset($data['Id']) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Sk AS Id, Ta_Rpl_Sk AS Ta, Semester_Rpl_Sk AS Semester, Nomor_Rpl_Sk AS Nomor, TglBuat_Rpl_Sk AS Tgl, User_Rpl_Sk AS Users, Log_Rpl_Sk AS Logs, Idkampus, Kampus, Data AS Datas, Id_Rpl_Pendaftaran, Id_Rpl_Assesor FROM Tbl_Rpl_Sk WHERE Id_Rpl_Sk = '". $data['Id'] ."' ORDER BY Id_Rpl_Sk DESC ");

            } else {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Sk AS Id, Ta_Rpl_Sk AS Ta, Semester_Rpl_Sk AS Semester, Nomor_Rpl_Sk AS Nomor, TglBuat_Rpl_Sk AS Tgl, User_Rpl_Sk AS Users, Log_Rpl_Sk AS Logs, Idkampus, Kampus, Data AS Datas, Id_Rpl_Pendaftaran, Id_Rpl_Assesor FROM Tbl_Rpl_Sk WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' ORDER BY Id_Rpl_Sk DESC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Sk
                        (
                            Ta_Rpl_Sk, Semester_Rpl_Sk, Nomor_Rpl_Sk, TglBuat_Rpl_Sk,
                            User_Rpl_Sk, Log_Rpl_Sk, IdKampus, Kampus,
                            Data, Id_Rpl_Pendaftaran, Id_Rpl_Assesor
                        ) 
                        VALUES 
                        (
                            :Ta_Rpl_Sk, :Semester_Rpl_Sk, :Nomor_Rpl_Sk, :TglBuat_Rpl_Sk,
                            :User_Rpl_Sk, :Log_Rpl_Sk, :IdKampus, :Kampus,
                            :Data, :Id_Rpl_Pendaftaran, :Id_Rpl_Assesor
                        ) 
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function update( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        UPDATE Tbl_Rpl_KuotaAssesor SET
                            Kuota_Rpl_KuotaAssesor         = :__Kuota,
                            Kuotas_Rpl_KuotaAssesor        = :__Kuotas,
                            User_Rpl_KuotaAssesor          = :__User, 
                            Log_Rpl_KuotaAssesor           = :__Log
                        WHERE Id_Rpl_Assesor_1          = :__Id
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function delete( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        DELETE FROM Tbl_Rpl_Assesor_1
                        WHERE Id_Rpl_Assesor_1  = :__Id_Assesor
                        AND Id_Rpl_Assesor      = :__Id_Rpl
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }