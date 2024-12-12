<?php

    class __KeteranganDokumenModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( $id = null )
        {
            if ( isset($id) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Cms_KeteranganDokumen AS Id, Judul_Rpl_Cms_KeteranganDokumen AS Judul, Format_Rpl_Cms_KeteranganDokumen AS Format, Ukuran_Rpl_Cms_KeteranganDokumen AS Ukuran, Isi_Rpl_Cms_KeteranganDokumen AS Isi, User_Rpl_Cms_KeteranganDokumen AS Users, Log_Rpl_Cms_KeteranganDokumen AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_Cms_KeteranganDokumen WHERE Id_Rpl_Cms_KeteranganDokumen = '". $id ."' ORDER BY Id_Rpl_Cms_KeteranganDokumen ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_Cms_KeteranganDokumen AS Id, Judul_Rpl_Cms_KeteranganDokumen AS Judul, Format_Rpl_Cms_KeteranganDokumen AS Format, Ukuran_Rpl_Cms_KeteranganDokumen AS Ukuran, Isi_Rpl_Cms_KeteranganDokumen AS Isi, User_Rpl_Cms_KeteranganDokumen AS Users, Log_Rpl_Cms_KeteranganDokumen AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_Cms_KeteranganDokumen ORDER BY Id_Rpl_Cms_KeteranganDokumen ASC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Cms_KeteranganDokumen
                        (
                            Judul_Rpl_Cms_KeteranganDokumen, Format_Rpl_Cms_KeteranganDokumen, Ukuran_Rpl_Cms_KeteranganDokumen, Isi_Rpl_Cms_KeteranganDokumen, User_Rpl_Cms_KeteranganDokumen, Log_Rpl_Cms_KeteranganDokumen, Kampus, Data
                        )
                    VALUES
                        (
                            :__Judul , :__Format, :__Ukuran, :__Isi, :__User, :__Log, :__Kampus, :__Data
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
                        UPDATE Tbl_Rpl_Cms_KeteranganDokumen SET
                            Judul_Rpl_Cms_KeteranganDokumen         = :__Judul,
                            Format_Rpl_Cms_KeteranganDokumen        = :__Format,
                            Ukuran_Rpl_Cms_KeteranganDokumen        = :__Ukuran,
                            Isi_Rpl_Cms_KeteranganDokumen           = :__Isi, 
                            User_Rpl_Cms_KeteranganDokumen          = :__User, 
                            Log_Rpl_Cms_KeteranganDokumen           = :__Log
                        WHERE Id_Rpl_Cms_KeteranganDokumen          = :__Id
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