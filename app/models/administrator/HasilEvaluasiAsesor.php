<?php

    class __HasilevaluasiasesorModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( $id = null )
        {
            if ( isset($id['Id2']) AND $id['Id2'] == TRUE ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Cms_HasilEvaluasiAsesor AS Id, Judul_Rpl_Cms_HasilEvaluasiAsesor AS Judul, Singkatan_Rpl_Cms_HasilEvaluasiAsesor AS Singkatan, Isi_Rpl_Cms_HasilEvaluasiAsesor AS Isi, User_Rpl_Cms_HasilEvaluasiAsesor AS Users, Log_Rpl_Cms_HasilEvaluasiAsesor AS Logs, Kampus, Data AS Datas, Id_Rpl_Cms_EvaluasiDiri FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $id['Id'] ."' AND Id_Rpl_Cms_HasilEvaluasiAsesor = '". $id['Id2'] ."' ORDER BY Id_Rpl_Cms_HasilEvaluasiAsesor ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_Cms_HasilEvaluasiAsesor AS Id, Judul_Rpl_Cms_HasilEvaluasiAsesor AS Judul, Singkatan_Rpl_Cms_HasilEvaluasiAsesor AS Singkatan, Isi_Rpl_Cms_HasilEvaluasiAsesor AS Isi, User_Rpl_Cms_HasilEvaluasiAsesor AS Users, Log_Rpl_Cms_HasilEvaluasiAsesor AS Logs, Kampus, Data AS Datas, Id_Rpl_Cms_EvaluasiDiri FROM Tbl_Rpl_Cms_HasilEvaluasiAsesor WHERE Id_Rpl_Cms_EvaluasiDiri = '". $id['Id'] ."' ORDER BY Id_Rpl_Cms_HasilEvaluasiAsesor ASC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Cms_HasilEvaluasiAsesor
                            (
                                Judul_Rpl_Cms_HasilEvaluasiAsesor, Singkatan_Rpl_Cms_HasilEvaluasiAsesor, Isi_Rpl_Cms_HasilEvaluasiAsesor, User_Rpl_Cms_HasilEvaluasiAsesor, Log_Rpl_Cms_HasilEvaluasiAsesor, Kampus, Data, Id_Rpl_Cms_EvaluasiDiri
                            )
                        VALUES
                            (
                                :__Judul , :__Singkatan, :__Isi, :__User, :__Log, :__Kampus, :__Data, :__Id_EvaluasiDiri
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
                        UPDATE Tbl_Rpl_Cms_HasilEvaluasiAsesor SET
                            Judul_Rpl_Cms_HasilEvaluasiAsesor       = :__Judul,
                            Singkatan_Rpl_Cms_HasilEvaluasiAsesor   = :__Singkatan,
                            Isi_Rpl_Cms_HasilEvaluasiAsesor         = :__Isi, 
                            User_Rpl_Cms_HasilEvaluasiAsesor        = :__User, 
                            Log_Rpl_Cms_HasilEvaluasiAsesor         = :__Log
                        WHERE Id_Rpl_Cms_HasilEvaluasiAsesor        = :__Id2
                        AND Id_Rpl_Cms_EvaluasiDiri                 = :__Id
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