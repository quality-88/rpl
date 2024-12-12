<?php

    class __Assesor2Model
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( is_array($data) && !empty($data) ) {

                if ( isset($data['Id'] ) AND $data['Id'] == TRUE ) {
                    
                    $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor_2 AS Id, IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Pilih, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Pilih, Sks_Pilih_Rpl_Assesor_2 AS Sks_Pilih, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen, File_Rpl_Assesor_2 AS Files, Judul_Rpl_Assesor_2 AS Judul, Format_Rpl_Assesor_2 AS Format, Slugs_Rpl_Assesor_2 AS Slugs, User_Rpl_Assesor_2 AS Users, Log_Rpl_Assesor_2 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2 AS IdDosen, Ta_Rpl_Assesor_2 AS Ta, Semester_Rpl_Assesor_2 AS Semester, Prodi_Rpl_Assesor_2 AS Prodi, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_2 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_2 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_2 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_2 = '". $data['Prodi'] ."' AND Id_Rpl_Assesor_1 = '". $data['Assesor_1'] ."' AND Id_Rpl_Assesor_2 = '". $data['Id'] ."' ORDER BY Id_Rpl_Assesor_2 DESC ");

                } elseif ( $data['Show'] == TRUE ) {

                    $result = $this->__db->queryid(" SELECT Id_Rpl_Assesor_2 AS Id, IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Pilih, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Pilih, Sks_Pilih_Rpl_Assesor_2 AS Sks_Pilih, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen, File_Rpl_Assesor_2 AS Files, Judul_Rpl_Assesor_2 AS Judul, Format_Rpl_Assesor_2 AS Format, Slugs_Rpl_Assesor_2 AS Slugs, User_Rpl_Assesor_2 AS Users, Log_Rpl_Assesor_2 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2 AS IdDosen, Ta_Rpl_Assesor_2 AS Ta, Semester_Rpl_Assesor_2 AS Semester, Prodi_Rpl_Assesor_2 AS Prodi, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_2 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_2 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_2 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_2 = '". $data['Prodi'] ."' AND IdMk_Asal_Rpl_Assesor_2 = '". $data['IdMk_Asal'] ."' AND IdMk_Pilih_Rpl_Assesor_2 = '". $data['IdMk_Pilih'] ."' AND Id_Rpl_Assesor_1 = '". $data['Id_Rpl_Assesor_1'] ."' ORDER BY Id_Rpl_Assesor_2 DESC ");

                } elseif ( isset($data['Id_Rpl_Assesor'] ) AND $data['Id_Rpl_Pendaftaran'] == TRUE ) {
                    
                    // $result = $this->__db->query(" SELECT IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' GROUP BY IdMk_Asal_Rpl_Assesor_2, Matakuliah_Asal_Rpl_Assesor_2, Sks_Asal_Rpl_Assesor_2, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Assesor_1 ORDER BY IdMk_Asal_Rpl_Assesor_2 DESC ");
                    $result = $this->__db->query(" SELECT IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Pilih_Rpl_Assesor_2 AS Sks_Asal, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Assesor_1, IdMk_Pilih_Rpl_Assesor_2 AS IdMk, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah, Sks_Pilih_Rpl_Assesor_2 AS Sks FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' GROUP BY IdMk_Pilih_Rpl_Assesor_2, Matakuliah_Pilih_Rpl_Assesor_2, Sks_Pilih_Rpl_Assesor_2, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, Id_Rpl_Assesor_1 ORDER BY IdMk_Pilih_Rpl_Assesor_2 DESC ");

                } else {

                    $result = $this->__db->query(" SELECT Id_Rpl_Assesor_2 AS Id, IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Pilih, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Pilih, Sks_Pilih_Rpl_Assesor_2 AS Sks_Pilih, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen, File_Rpl_Assesor_2 AS Files, Judul_Rpl_Assesor_2 AS Judul, Format_Rpl_Assesor_2 AS Format, Slugs_Rpl_Assesor_2 AS Slugs, User_Rpl_Assesor_2 AS Users, Log_Rpl_Assesor_2 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2 AS IdDosen, Ta_Rpl_Assesor_2 AS Ta, Semester_Rpl_Assesor_2 AS Semester, Prodi_Rpl_Assesor_2 AS Prodi, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_2 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_2 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_2 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_2 = '". $data['Prodi'] ."' AND Id_Rpl_Assesor_1 = '". $data['Assesor_1'] ."' ORDER BY Id_Rpl_Assesor_2 DESC ");

                }

            } else {

                $result = $this->__db->query(" SELECT Id_Rpl_Assesor_2 AS Id, IdMk_Asal_Rpl_Assesor_2 AS IdMk_Asal, Matakuliah_Asal_Rpl_Assesor_2 AS Matakuliah_Asal, Sks_Asal_Rpl_Assesor_2 AS Sks_Asal, IdMk_Pilih_Rpl_Assesor_2 AS IdMk_Pilih, Matakuliah_Pilih_Rpl_Assesor_2 AS Matakuliah_Pilih, Sks_Pilih_Rpl_Assesor_2 AS Sks_Pilih, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen, File_Rpl_Assesor_2 AS Files, Judul_Rpl_Assesor_2 AS Judul, Format_Rpl_Assesor_2 AS Format, Slugs_Rpl_Assesor_2 AS Slugs, User_Rpl_Assesor_2 AS Users, Log_Rpl_Assesor_2 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2 AS IdDosen, Ta_Rpl_Assesor_2 AS Ta, Semester_Rpl_Assesor_2 AS Semester, Prodi_Rpl_Assesor_2 AS Prodi, Id_Rpl_Assesor_1 FROM Tbl_Rpl_Assesor_2 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_2 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_2 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_2 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_2 = '". $data['Prodi'] ."' AND Id_Rpl_Assesor_1 = '". $data['Assesor_1'] ."' ORDER BY Id_Rpl_Assesor_2 DESC ");

            }

            return $result;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Assesor_2
                        (
                            IdMk_Asal_Rpl_Assesor_2, Matakuliah_Asal_Rpl_Assesor_2, Sks_Asal_Rpl_Assesor_2, 
                            IdMk_Pilih_Rpl_Assesor_2, Matakuliah_Pilih_Rpl_Assesor_2, Sks_Pilih_Rpl_Assesor_2, 
                            Id_Cpmk, Id_Rpl_Cms_Profesiensi, Id_Rpl_Cms_KeteranganDokumen,
                            File_Rpl_Assesor_2, Judul_Rpl_Assesor_2, Format_Rpl_Assesor_2, Slugs_Rpl_Assesor_2,
                            User_Rpl_Assesor_2, Log_Rpl_Assesor_2, IdKampus, Kampus, Data, 
                            Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_2, Ta_Rpl_Assesor_2, Semester_Rpl_Assesor_2, Prodi_Rpl_Assesor_2, Id_Rpl_Assesor_1
                        )
                        VALUES
                        (
                            :IdMk_Asal_Rpl_Assesor_2, :Matakuliah_Asal_Rpl_Assesor_2, :Sks_Asal_Rpl_Assesor_2, 
                            :IdMk_Pilih_Rpl_Assesor_2, :Matakuliah_Pilih_Rpl_Assesor_2, :Sks_Pilih_Rpl_Assesor_2, 
                            :Id_Cpmk, :Id_Rpl_Cms_Profesiensi, :Id_Rpl_Cms_KeteranganDokumen,
                            :File_Rpl_Assesor_2, :Judul_Rpl_Assesor_2, :Format_Rpl_Assesor_2, :Slugs_Rpl_Assesor_2,
                            :User_Rpl_Assesor_2, :Log_Rpl_Assesor_2, :IdKampus, :Kampus, :Data, 
                            :Id_Rpl_Assesor, :Id_Rpl_Pendaftaran, :IdDosen_Rpl_Assesor_2, :Ta_Rpl_Assesor_2, :Semester_Rpl_Assesor_2, :Prodi_Rpl_Assesor_2, :Id_Rpl_Assesor_1
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function create_hasilevaluasi( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Assesor_2_HasilEvaluasi
                        (
                            Id_Rpl_Cms_HasilEvaluasiAsesor, User_Rpl_Assesor_2_HasilEvaluasi, Log_Rpl_Assesor_2_HasilEvaluasi, IdKampus, Kampus, Data, Id_Rpl_Assesor_1, Id_Rpl_Assesor_2
                        )
                        VALUES
                        (
                            :Id_Rpl_Cms_HasilEvaluasiAsesor, :User_Rpl_Assesor_2_HasilEvaluasi, :Log_Rpl_Assesor_2_HasilEvaluasi, :IdKampus, :Kampus, :Data, :Id_Rpl_Assesor_1, :Id_Rpl_Assesor_2
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function create_nomordokumen( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Assesor_2_NomorDokumen
                        (
                            Id_Rpl_Cms_NomorDokumen, Kode_Rpl_Cms_NomorDokumen, Nama_Rpl_Cms_NomorDokumen, User_Rpl_Assesor_2_NomorDokumen, Log_Rpl_Assesor_2_NomorDokumen, IdKampus, Kampus, Data, Id_Rpl_Assesor_1, Id_Rpl_Assesor_2
                        )
                        VALUES
                        (
                            :Id_Rpl_Cms_NomorDokumen, :Kode_Rpl_Cms_NomorDokumen, :Nama_Rpl_Cms_NomorDokumen, :User_Rpl_Assesor_2_NomorDokumen, :Log_Rpl_Assesor_2_NomorDokumen, :IdKampus, :Kampus, :Data, :Id_Rpl_Assesor_1, :Id_Rpl_Assesor_2
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
                        UPDATE Tbl_Rpl_Assesor_2 SET
                            Id_Rpl_Cms_Profesiensi      = :Id_Rpl_Cms_Profesiensi,
                            User_Rpl_Assesor_2          = :User_Rpl_Assesor_2, 
                            Log_Rpl_Assesor_2           = :Log_Rpl_Assesor_2
                        WHERE IdMk_Asal_Rpl_Assesor_2   = :IdMk_Asal_Rpl_Assesor_2
                        AND Id_Cpmk                     = :Id_Cpmk
                        AND Id_Rpl_Assesor              = :Id_Rpl_Assesor
                        AND Id_Rpl_Pendaftaran          = :Id_Rpl_Pendaftaran
                        AND IdDosen_Rpl_Assesor_2       = :IdDosen_Rpl_Assesor_2
                        AND Ta_Rpl_Assesor_2            = :Ta_Rpl_Assesor_2
                        AND Semester_Rpl_Assesor_2      = :Semester_Rpl_Assesor_2
                        AND Prodi_Rpl_Assesor_2         = :Prodi_Rpl_Assesor_2
                        AND Id_Rpl_Assesor_1            = :Id_Rpl_Assesor_1
                        AND Id_Rpl_Assesor_2            = :Id_Rpl_Assesor_2
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

        public function delete_hasilevaluasi( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        DELETE FROM Tbl_Rpl_Assesor_2_HasilEvaluasi
                        WHERE Id_Rpl_Assesor_1  = :Id_Rpl_Assesor_1
                        AND Id_Rpl_Assesor_2    = :Id_Rpl_Assesor_2
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function delete_nomordokumen( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        DELETE FROM Tbl_Rpl_Assesor_2_NomorDokumen
                        WHERE Id_Rpl_Assesor_1  = :Id_Rpl_Assesor_1
                        AND Id_Rpl_Assesor_2    = :Id_Rpl_Assesor_2
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }