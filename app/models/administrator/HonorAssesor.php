<?php

    class __HonorAssesorModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( $id = null )
        {
            if ( isset($id) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, User_Rpl_BiayaKonversi AS Users, Log_Rpl_BiayaKonversi AS Logs, Kampus, Data AS Datas, Tipe_Rpl_BiayaKonversi AS Tipe FROM Tbl_Rpl_BiayaKonversi WHERE Id_Rpl_BiayaKonversi = '". $id ."' ORDER BY Id_Rpl_BiayaKonversi ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, User_Rpl_BiayaKonversi AS Users, Log_Rpl_BiayaKonversi AS Logs, Kampus, Data AS Datas, Tipe_Rpl_BiayaKonversi AS Tipe FROM Tbl_Rpl_BiayaKonversi ORDER BY Id_Rpl_BiayaKonversi ASC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_BiayaKonversi
                        (
                            Ta_Rpl_BiayaKonversi, Semester_Rpl_BiayaKonversi, Biaya_Rpl_BiayaKonversi, User_Rpl_BiayaKonversi, Log_Rpl_BiayaKonversi, Kampus, Data, Tipe_Rpl_BiayaKonversi
                        )
                    VALUES
                        (
                            :__Ta , :__Semester, :__Biaya, :__User, :__Log, :__Kampus, :__Data, :__Tipe
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
                        UPDATE Tbl_Rpl_BiayaKonversi SET
                            Biaya_Rpl_BiayaKonversi         = :__Biaya,
                            User_Rpl_BiayaKonversi          = :__User, 
                            Log_Rpl_BiayaKonversi           = :__Log
                        WHERE Id_Rpl_BiayaKonversi          = :__Id
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
                        DELETE FROM Tbl_Rpl_Cms_EvaluasiDiri
                        WHERE Id_Rpl_Cms_EvaluasiDiri = :__Id
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }