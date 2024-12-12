<?php

    class __Assesor3Model
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( isset($data['Id'] ) AND $data['Id'] == TRUE ) {
                    
                $data = $this->__db->queryid(" SELECT Id_Rpl_Assesor_3 AS Id, Tgl_Rpl_Assesor_3 AS Tgl, Judul_Rpl_Assesor_3 AS Judul, Keterangan_Rpl_Assesor_3 AS Keterangan, File_Rpl_Assesor_3 AS Files, Format_Rpl_Assesor_3 AS Format, Slugs_Rpl_Assesor_3 AS Slugs, User_Rpl_Assesor_3 AS Users, Log_Rpl_Assesor_3 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_3 AS IdDosen, Ta_Rpl_Assesor_3 AS Ta, Semester_Rpl_Assesor_3 AS Semester, Prodi_Rpl_Assesor_3 AS Prodi FROM Tbl_Rpl_Assesor_3 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_3 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_3 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_3 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_3 = '". $data['Prodi'] ."' AND Id_Rpl_Assesor_3 = '". $data['Id'] ."' ORDER BY Id_Rpl_Assesor_3 DESC ");

            } else {

                $data = $this->__db->queryid(" SELECT Id_Rpl_Assesor_3 AS Id, Tgl_Rpl_Assesor_3 AS Tgl, Judul_Rpl_Assesor_3 AS Judul, Keterangan_Rpl_Assesor_3 AS Keterangan, File_Rpl_Assesor_3 AS Files, Format_Rpl_Assesor_3 AS Format, Slugs_Rpl_Assesor_3 AS Slugs, User_Rpl_Assesor_3 AS Users, Log_Rpl_Assesor_3 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_3 AS IdDosen, Ta_Rpl_Assesor_3 AS Ta, Semester_Rpl_Assesor_3 AS Semester, Prodi_Rpl_Assesor_3 AS Prodi FROM Tbl_Rpl_Assesor_3 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_3 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_3 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_3 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_3 = '". $data['Prodi'] ."' ORDER BY Id_Rpl_Assesor_3 DESC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Assesor_3
                        (
                            Tgl_Rpl_Assesor_3, Judul_Rpl_Assesor_3, Keterangan_Rpl_Assesor_3, File_Rpl_Assesor_3, Format_Rpl_Assesor_3, Slugs_Rpl_Assesor_3, User_Rpl_Assesor_3, Log_Rpl_Assesor_3, IdKampus, Kampus, Data, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_3, Ta_Rpl_Assesor_3, Semester_Rpl_Assesor_3, Prodi_Rpl_Assesor_3
                        )
                        VALUES
                        (
                            :Tgl_Rpl_Assesor_3, :Judul_Rpl_Assesor_3, :Keterangan_Rpl_Assesor_3, :File_Rpl_Assesor_3, :Format_Rpl_Assesor_3, :Slugs_Rpl_Assesor_3, :User_Rpl_Assesor_3, :Log_Rpl_Assesor_3, :IdKampus, :Kampus, :Data, :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :IdDosen_Rpl_Assesor_3, :Ta_Rpl_Assesor_3, :Semester_Rpl_Assesor_3, :Prodi_Rpl_Assesor_3
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
                        UPDATE Tbl_Rpl_Assesor_3 SET
                            Tgl_Rpl_Assesor_3           = :Tgl_Rpl_Assesor_3,
                            Judul_Rpl_Assesor_3         = :Judul_Rpl_Assesor_3,
                            Keterangan_Rpl_Assesor_3    = :Keterangan_Rpl_Assesor_3,
                            File_Rpl_Assesor_3          = :File_Rpl_Assesor_3,
                            Format_Rpl_Assesor_3        = :Format_Rpl_Assesor_3,
                            Slugs_Rpl_Assesor_3         = :Slugs_Rpl_Assesor_3,
                            User_Rpl_Assesor_3          = :User_Rpl_Assesor_3, 
                            Log_Rpl_Assesor_3           = :Log_Rpl_Assesor_3
                        WHERE Id_Rpl_Assesor            = :Id_Rpl_Assesor
                        AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                        AND IdDosen_Rpl_Assesor_3       = :IdDosen_Rpl_Assesor_3
                        AND Ta_Rpl_Assesor_3            = :Ta_Rpl_Assesor_3
                        AND Semester_Rpl_Assesor_3      = :Semester_Rpl_Assesor_3
                        AND Prodi_Rpl_Assesor_3         = :Prodi_Rpl_Assesor_3
                        AND Id_Rpl_Assesor_3            = :Id_Rpl_Assesor_3
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
                        DELETE FROM Tbl_Rpl_Assesor_2
                        WHERE Id_Rpl_Assesor_2          = :Id_Rpl_Assesor_2
                        AND Id_Rpl_Assesor_1            = :Id_Rpl_Assesor_1
                        AND Id_Rpl_Assesor              = :Id_Rpl_Assesor
                        AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                        AND IdDosen_Rpl_Assesor_2       = :IdDosen
                        AND Ta_Rpl_Assesor_2            = :Ta
                        AND Semester_Rpl_Assesor_2      = :Semester
                        AND Prodi_Rpl_Assesor_2         = :Prodi
                        AND IdMk_Asal_Rpl_Assesor_2     = :IdMk_Asal
                        AND IdMk_Pilih_Rpl_Assesor_2    = :IdMk_Pilih
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }