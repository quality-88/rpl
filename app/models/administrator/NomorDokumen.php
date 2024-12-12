<?php

    class __NomorDokumenModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null)
        {
            if ( isset($data['Id']) ) {

                $result = $this->__db->queryid(" SELECT Id_Rpl_Cms_NomorDokumen AS Id, Kode_Rpl_Cms_NomorDokumen AS Kode, Nama_Rpl_Cms_NomorDokumen AS Nama, User_Rpl_Cms_NomorDokumen AS Users, Log_Rpl_Cms_NomorDokumen AS Logs, IdKampus, Kampus, Data AS Datas FROM Tbl_Rpl_Cms_NomorDokumen WHERE Id_Rpl_Cms_NomorDokumen = '". $data['Id'] ."' ORDER BY Kode_Rpl_Cms_NomorDokumen ASC ");

            } else {

                $result = $this->__db->query(" SELECT Id_Rpl_Cms_NomorDokumen AS Id, Kode_Rpl_Cms_NomorDokumen AS Kode, Nama_Rpl_Cms_NomorDokumen AS Nama, User_Rpl_Cms_NomorDokumen AS Users, Log_Rpl_Cms_NomorDokumen AS Logs, IdKampus, Kampus, Data AS Datas FROM Tbl_Rpl_Cms_NomorDokumen ORDER BY Kode_Rpl_Cms_NomorDokumen ASC ");

            }

            return $result;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Cms_NomorDokumen
                        (
                            Kode_Rpl_Cms_NomorDokumen, Nama_Rpl_Cms_NomorDokumen, User_Rpl_Cms_NomorDokumen, Log_Rpl_Cms_NomorDokumen, IdKampus, Kampus, Data
                        )
                    VALUES
                        (
                            :Kode_Rpl_Cms_NomorDokumen , :Nama_Rpl_Cms_NomorDokumen, :User_Rpl_Cms_NomorDokumen, :Log_Rpl_Cms_NomorDokumen, :IdKampus, :Kampus, :Data
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
                        UPDATE Tbl_Rpl_Cms_NomorDokumen SET
                            Kode_Rpl_Cms_NomorDokumen   = :Kode_Rpl_Cms_NomorDokumen,
                            Nama_Rpl_Cms_NomorDokumen   = :Nama_Rpl_Cms_NomorDokumen,
                            User_Rpl_Cms_NomorDokumen   = :User_Rpl_Cms_NomorDokumen, 
                            Log_Rpl_Cms_NomorDokumen    = :Log_Rpl_Cms_NomorDokumen
                        WHERE Id_Rpl_Cms_NomorDokumen   = :Id_Rpl_Cms_NomorDokumen
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
                        DELETE FROM Tbl_Rpl_Cms_NomorDokumen
                        WHERE Id_Rpl_Cms_NomorDokumen = :Id_Rpl_Cms_NomorDokumen
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }