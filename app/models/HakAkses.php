<?php

    class __HakAksesModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( isset($data['Id']) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_HakAkses AS Id, IdUser_Rpl_HakAkses AS IdUser, Ket_Rpl_HakAkses AS Ket, Status_Rpl_HakAkses AS Status, User_Rpl_HakAkses AS Users, Log_Rpl_HakAkses AS Logs, Kampus, Data FROM Tbl_Rpl_HakAkses WHERE Id_Rpl_HakAkses = '". $data['Id'] ."' ORDER BY Id_Rpl_HakAkses DESC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_HakAkses AS Id, IdUser_Rpl_HakAkses AS IdUser, Ket_Rpl_HakAkses AS Ket, Status_Rpl_HakAkses AS Status, User_Rpl_HakAkses AS Users, Log_Rpl_HakAkses AS Logs, Kampus, Data FROM Tbl_Rpl_HakAkses ORDER BY Id_Rpl_HakAkses DESC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_HakAkses
                        (
                            IdUser_Rpl_HakAkses, Ket_Rpl_HakAkses, Status_Rpl_HakAkses, User_Rpl_HakAkses, Log_Rpl_HakAkses, Kampus, Data
                        )
                        VALUES
                        (
                            :IdUser_Rpl_HakAkses, :Ket_Rpl_HakAkses, :Status_Rpl_HakAkses, :User_Rpl_HakAkses, :Log_Rpl_HakAkses, :Kampus, :Data
                        )
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
                        DELETE FROM Tbl_Rpl_HakAkses
                        WHERE Id_Rpl_HakAkses = :__Id
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }