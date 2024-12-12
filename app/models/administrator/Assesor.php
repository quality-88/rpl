<?php

    class __AssesorModel
    {
        private $__db;
        private $__universitas;

        public function __construct($db)
        {
            $this->__db = $db;
            $this->__universitas = new __Universitas();
        }

        public function read( $id = null )
        {
            if ( isset($id) ) {

                $data = $this->__db->queryid(" SELECT Id_Rpl_KuotaAssesor AS Id, Ta_Rpl_KuotaAssesor AS Ta, Semester_Rpl_KuotaAssesor AS Semester, IdDosen_Rpl_KuotaAssesor AS IdDosen, Prodi_Rpl_KuotaAssesor AS Prodi, Kuota_Rpl_KuotaAssesor AS Kuota, Kuotas_Rpl_KuotaAssesor AS Kuotas, User_Rpl_KuotaAssesor AS Users, Log_Rpl_KuotaAssesor AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_KuotaAssesor WHERE Id_Rpl_KuotaAssesor = '". $id ."' ORDER BY Id_Rpl_KuotaAssesor ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_KuotaAssesor AS Id, Ta_Rpl_KuotaAssesor AS Ta, Semester_Rpl_KuotaAssesor AS Semester, IdDosen_Rpl_KuotaAssesor AS IdDosen, Prodi_Rpl_KuotaAssesor AS Prodi, Kuota_Rpl_KuotaAssesor AS Kuota, Kuotas_Rpl_KuotaAssesor AS Kuotas, User_Rpl_KuotaAssesor AS Users, Log_Rpl_KuotaAssesor AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_KuotaAssesor WHERE ". $this->__universitas->__QueryNot_Universitas() ." Prodi_Rpl_KuotaAssesor LIKE '%UQB%' ORDER BY Id_Rpl_KuotaAssesor ASC ");

            }

            return $data;
        }

        public function create( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Tbl_Rpl_KuotaAssesor
                        (
                            Ta_Rpl_KuotaAssesor, Semester_Rpl_KuotaAssesor, IdDosen_Rpl_KuotaAssesor, Prodi_Rpl_KuotaAssesor, Kuota_Rpl_KuotaAssesor, Kuotas_Rpl_KuotaAssesor, User_Rpl_KuotaAssesor, Log_Rpl_KuotaAssesor, Kampus, Data
                        )
                    VALUES
                        (
                            :__Ta , :__Semester, :__Assesor, :__Prodi, :__Kuota, :__Kuotas, :__User, :__Log, :__Kampus, :__Data
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
                        WHERE Id_Rpl_KuotaAssesor          = :__Id
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
                        DELETE FROM Tbl_Rpl_KuotaAssesor
                        WHERE Id_Rpl_KuotaAssesor = :__Id
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }