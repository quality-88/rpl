<?php

    class __Assesor1Model
    {
        private $__db;

        public function __construct($db)
        {
            $this->__db = $db;
        }

        public function read( array $data = null )
        {
            if ( is_array($data) && !empty($data) ) {

                if ( isset($data['Id'] ) AND $data['Id'] == TRUE AND isset($data['IdMk'] ) AND $data['IdMk'] == TRUE ) {

                    $data = $this->__db->queryid(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi, Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor_1 = '". $data['Id'] ."' AND Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_1 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_1 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_1 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_1 = '". $data['Prodi'] ."' AND IdMk_Rpl_Assesor_1 = '". $data['IdMk'] ."' ORDER BY Id_Rpl_Assesor_1 DESC ");

                } elseif ( isset($data['Id'] ) AND $data['Id'] == TRUE ) {

                    $data = $this->__db->queryid(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi, Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor_1 = '". $data['Id'] ."' AND Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_1 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_1 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_1 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_1 = '". $data['Prodi'] ."' ORDER BY Id_Rpl_Assesor_1 DESC ");

                } else {

                    $data = $this->__db->query(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi, Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_1 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_1 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_1 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_1 = '". $data['Prodi'] ."' ORDER BY Id_Rpl_Assesor_1 DESC ");

                }

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_Assesor_1 AS Id, IdMk_Rpl_Assesor_1 AS IdMk, Matakuliah_Rpl_Assesor_1 AS Matakuliah, Sks_Rpl_Assesor_1 AS Sks, Nilai_Rpl_Assesor_1 AS Nilai, User_Rpl_Assesor_1 AS Users, Log_Rpl_Assesor_1 AS Logs, IdKampus, Kampus, Data AS Datas, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1 AS IdDosen, Ta_Rpl_Assesor_1 AS Ta, Semester_Rpl_Assesor_1 AS Semester, Prodi_Rpl_Assesor_1 AS Prodi, Huruf_Rpl_Assesor_1 AS Huruf FROM Tbl_Rpl_Assesor_1 WHERE Id_Rpl_Assesor = '". $data['Id_Rpl_Assesor'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND IdDosen_Rpl_Assesor_1 = '". $data['IdDosen'] ."' AND Ta_Rpl_Assesor_1 = '". $data['Ta'] ."' AND Semester_Rpl_Assesor_1 = '". $data['Semester'] ."' AND Prodi_Rpl_Assesor_1 = '". $data['Prodi'] ."' ORDER BY Id_Rpl_Assesor_1 DESC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_Assesor_1
                        (
                            IdMk_Rpl_Assesor_1, Matakuliah_Rpl_Assesor_1, Sks_Rpl_Assesor_1, Nilai_Rpl_Assesor_1, User_Rpl_Assesor_1, Log_Rpl_Assesor_1, IdKampus, Kampus, Data, Id_Rpl_Assesor, Id_Rpl_Pendaftaran, IdDosen_Rpl_Assesor_1, Ta_Rpl_Assesor_1, Semester_Rpl_Assesor_1, Prodi_Rpl_Assesor_1, Huruf_Rpl_Assesor_1
                        )
                        VALUES
                        (
                            :__IdMk, :__NamaMk, :__Sks, :__NilaiMk, :__User, :__Log, :__IdKampus, :__Kampus, :__Data, :__Id_Assesor, :__Id_Rpl, :__IdDosen, :__Ta, :__Semester, :__Prodi, :__HurufMk
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
                        UPDATE Tbl_Rpl_KuotaAssesor SET
                            Kuota_Rpl_KuotaAssesor         = :__Kuota,
                            Kuotas_Rpl_KuotaAssesor        = :__Kuotas,
                            User_Rpl_KuotaAssesor          = :__User, 
                            Log_Rpl_KuotaAssesor           = :__Log
                        WHERE Id_Rpl_Assesor_1          = :__Id
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
                        DELETE FROM Tbl_Rpl_Assesor_1
                        WHERE Id_Rpl_Assesor_1  = :__Id_Assesor
                        AND Id_Rpl_Assesor      = :__Id_Rpl
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }