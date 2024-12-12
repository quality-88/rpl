<?php

    class __EvaluasiDiriModel
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
                        INSERT INTO Tbl_Rpl_Cms_EvaluasiDiri
                            (
                                Judul_Rpl_Cms_EvaluasiDiri, Isi_Rpl_Cms_EvaluasiDiri, User_Rpl_Cms_EvaluasiDiri, Log_Rpl_Cms_EvaluasiDiri, Kampus, Data
                            )
                        VALUES
                            (
                                :__Judul , :__Isi, :__User, :__Log, :__Kampus, :__Data
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
            if ( isset($id) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri WHERE Id_Rpl_Cms_EvaluasiDiri = '". $id ."' ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_Cms_EvaluasiDiri AS Id, Judul_Rpl_Cms_EvaluasiDiri AS Judul, Isi_Rpl_Cms_EvaluasiDiri AS Isi, User_Rpl_Cms_EvaluasiDiri AS Users, Log_Rpl_Cms_EvaluasiDiri AS Logs, Kampus, Data AS Datas, Keterangan_Rpl_Cms_EvaluasiDiri AS Keterangan FROM Tbl_Rpl_Cms_EvaluasiDiri ORDER BY Id_Rpl_Cms_EvaluasiDiri ASC ");

            }

            return $data;
        }

        public function update( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        UPDATE Tbl_Rpl_Cms_EvaluasiDiri SET
                            Judul_Rpl_Cms_EvaluasiDiri  = :__Judul,
                            Isi_Rpl_Cms_EvaluasiDiri    = :__Isi, 
                            User_Rpl_Cms_EvaluasiDiri   = :__User, 
                            Log_Rpl_Cms_EvaluasiDiri    = :__Log,
                            Keterangan_Rpl_Cms_EvaluasiDiri = :__Keterangan
                        WHERE Id_Rpl_Cms_EvaluasiDiri   = :__Id
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