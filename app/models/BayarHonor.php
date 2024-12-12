<?php

    class __BayarHonorModel
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
                        INSERT INTO Tbl_Rpl_BayarHonor
                        (
                            Id_Rpl_Pendaftaran, Id_Rpl_Assesor, Id_Rpl_Sk, IdDosen, Ta_Rpl_BayarHonor, Semester_Rpl_BayarHonor, Prodi_Rpl_BayarHonor, Nominal_Rpl_BayarHonor, User_Rpl_BayarHonor, Log_Rpl_BayarHonor, IdKampus, Kampus, Data
                        )
                        VALUES
                        (
                            :Id_Rpl_Pendaftaran, :Id_Rpl_Assesor, :Id_Rpl_Sk, :IdDosen, :Ta_Rpl_BayarHonor, :Semester_Rpl_BayarHonor, :Prodi_Rpl_BayarHonor, :Nominal_Rpl_BayarHonor, :User_Rpl_BayarHonor, :Log_Rpl_BayarHonor, :IdKampus, :Kampus, :Data
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }