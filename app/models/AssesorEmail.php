<?php

    class __AssesorEmailModel
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            $data = $this->__db->query(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi, Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_1 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_1 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_1 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_1 = '". $data['Prodi'] ."' ORDER BY Id_Rpl_Assesor_1 DESC ");

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_AssesorEmail
                        (
                            Id_Rpl_Pendaftaran, IdDosen, Status, User_Rpl_AssesorEmail, Log_Rpl_AssesorEmail, Kampus
                        )
                        VALUES
                        (
                            :Id_Rpl_Pendaftaran, :IdDosen, :Status, :User_Rpl_AssesorEmail, :Log_Rpl_AssesorEmail, :Kampus
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
                        UPDATE Tbl_Rpl_AssesorEmail SET
                            Status                  = :Status,
                            User_Rpl_AssesorEmail   = :User_Rpl_AssesorEmail, 
                            Log_Rpl_AssesorEmail    = :Log_Rpl_AssesorEmail
                        WHERE Id_Rpl_AssesorEmail   = :Id_Rpl_AssesorEmail
                        AND IdDosen                 = :IdDosen
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
                        DELETE FROM Tbl_Rpl_AssesorEmail
                        WHERE Id_Rpl_AssesorEmail  = :Id_Rpl_AssesorEmail
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }