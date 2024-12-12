<?php

    class __SkRplModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( isset($data['Id']) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_SkRpl AS Id, Ta_Rpl_SkRpl AS Ta, Semester_Rpl_SkRpl AS Semester, Nomor_Rpl_SkRpl AS Nomor, TglBuat_Rpl_SkRpl AS Tgl, User_Rpl_SkRpl AS Users, Log_Rpl_SkRpl AS Logs, Idkampus, Kampus, Data AS Datas, Id_Rpl_Pendaftaran FROM Tbl_Rpl_SkRpl WHERE Id_Rpl_SkRpl = '". $data['Id'] ."' ORDER BY Id_Rpl_SkRpl DESC ");

            } else {

                $data = $this->__db->queryid(" SELECT Id_Rpl_SkRpl AS Id, Ta_Rpl_SkRpl AS Ta, Semester_Rpl_SkRpl AS Semester, Nomor_Rpl_SkRpl AS Nomor, TglBuat_Rpl_SkRpl AS Tgl, User_Rpl_SkRpl AS Users, Log_Rpl_SkRpl AS Logs, Idkampus, Kampus, Data AS Datas, Id_Rpl_Pendaftaran FROM Tbl_Rpl_SkRpl WHERE Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' ORDER BY Id_Rpl_SkRpl DESC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_SkRpl
                        (
                            Ta_Rpl_SkRpl, Semester_Rpl_SkRpl, Nomor_Rpl_SkRpl, TglBuat_Rpl_SkRpl,
                            User_Rpl_SkRpl, Log_Rpl_SkRpl, IdKampus, Kampus,
                            Data, Id_Rpl_Pendaftaran
                        ) 
                        VALUES 
                        (
                            :Ta_Rpl_SkRpl, :Semester_Rpl_SkRpl, :Nomor_Rpl_SkRpl, :TglBuat_Rpl_SkRpl,
                            :User_Rpl_SkRpl, :Log_Rpl_SkRpl, :IdKampus, :Kampus,
                            :Data, :Id_Rpl_Pendaftaran
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