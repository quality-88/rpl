<?php

    class __ProdiModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( isset($data['Id']) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Prodi AS Id, Prodi_Rpl_Prodi AS Prodi, Ta_Rpl_Prodi AS Ta, Semester_Rpl_Prodi AS Semester, User_Rpl_Prodi AS Users, Log_Rpl_Prodi AS Logs, IdKampus, Kampus, Data AS Datas FROM Tbl_Rpl_Prodi WHERE Id_Rpl_Prodi = '". $data['Id'] ."' ORDER BY Id_Rpl_Prodi ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_Prodi AS Id, Prodi_Rpl_Prodi AS Prodi, Ta_Rpl_Prodi AS Ta, Semester_Rpl_Prodi AS Semester, User_Rpl_Prodi AS Users, Log_Rpl_Prodi AS Logs, IdKampus, Kampus, Data AS Datas FROM Tbl_Rpl_Prodi ORDER BY Id_Rpl_Prodi ASC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Prodi
                        (
                            Prodi_Rpl_Prodi, Ta_Rpl_Prodi, Semester_Rpl_Prodi, User_Rpl_Prodi, Log_Rpl_Prodi, IdKampus, Kampus, Data
                        )
                    VALUES
                        (
                            :Prodi_Rpl_Prodi, :Ta_Rpl_Prodi , :Semester_Rpl_Prodi, :User_Rpl_Prodi, :Log_Rpl_Prodi, :IdKampus, :Kampus, :Data
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
                        UPDATE Tbl_Rpl_Prodi SET
                            Prodi_Rpl_Prodi         = :Prodi_Rpl_Prodi,
                            User_Rpl_Prodi          = :User_Rpl_Prodi, 
                            Log_Rpl_Prodi           = :Log_Rpl_Prodi
                        WHERE Id_Rpl_Prodi          = :Id_Rpl_Prodi
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
                        DELETE FROM Tbl_Rpl_Prodi
                        WHERE Id_Rpl_Prodi = :Id_Rpl_Prodi
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }