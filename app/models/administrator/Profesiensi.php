<?php

    class __ProfesiensiModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Cms_Profesiensi
                            (
                                Judul_Rpl_Cms_Profesiensi, Isi_Rpl_Cms_Profesiensi, User_Rpl_Cms_Profesiensi, Log_Rpl_Cms_Profesiensi, Kampus, Data, 
                                Id_Rpl_Cms_EvaluasiDiri
                            )
                        VALUES
                            (
                                :__Judul , :__Isi, :__User, :__Log, :__Kampus, :__Data,
                                :__Id_EvaluasiDiri
                            )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function read( $id = null )
        {
            if ( isset($id['Id2']) AND $id['Id2'] == TRUE ) {
                
                $data = $this->__db->queryid(" SELECT Id_Rpl_Cms_Profesiensi AS Id, Judul_Rpl_Cms_Profesiensi AS Judul, Isi_Rpl_Cms_Profesiensi AS Isi, User_Rpl_Cms_Profesiensi AS Users, Log_Rpl_Cms_Profesiensi AS Logs, Kampus, Data AS Datas, Id_Rpl_Cms_EvaluasiDiri FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_EvaluasiDiri = '". $id['Id'] ."' AND Id_Rpl_Cms_Profesiensi = '". $id['Id2'] ."' ORDER BY Id_Rpl_Cms_Profesiensi ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_Cms_Profesiensi AS Id, Judul_Rpl_Cms_Profesiensi AS Judul, Isi_Rpl_Cms_Profesiensi AS Isi, User_Rpl_Cms_Profesiensi AS Users, Log_Rpl_Cms_Profesiensi AS Logs, Kampus, Data AS Datas, Id_Rpl_Cms_EvaluasiDiri FROM Tbl_Rpl_Cms_Profesiensi WHERE Id_Rpl_Cms_EvaluasiDiri = '". $id['Id'] ."' ORDER BY Id_Rpl_Cms_Profesiensi ASC ");

            }

            return $data;
        }

        public function update( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        UPDATE Tbl_Rpl_Cms_Profesiensi SET
                            Judul_Rpl_Cms_Profesiensi  = :__Judul,
                            Isi_Rpl_Cms_Profesiensi    = :__Isi, 
                            User_Rpl_Cms_Profesiensi   = :__User, 
                            Log_Rpl_Cms_Profesiensi    = :__Log
                        WHERE Id_Rpl_Cms_Profesiensi   = :__Id2
                        AND Id_Rpl_Cms_EvaluasiDiri    = :__Id
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