<?php

    class __InformasiFileModel
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
                        INSERT INTO Tbl_Rpl_File
                            (
                                File_Rpl_File, Judul_Rpl_File, Format_Rpl_File, Slugs_Rpl_File, User_Rpl_File, Log_Rpl_File, Kampus, Data
                            )
                        VALUES
                            (
                                :__File, :__Judul , :__Format , :__Slugs, :__User, :__Log, :__Kampus, :__Data
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

                $data = $this->__db->queryid(" SELECT Id_Rpl_File AS Id, File_Rpl_File AS Files, Judul_Rpl_File AS Judul, Format_Rpl_File AS Format, Slugs_Rpl_File AS Slugs, User_Rpl_File AS Users, Log_Rpl_File AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_File WHERE Id_Rpl_File = '". $id ."' ORDER BY Id_Rpl_File ASC ");

            } else {

                $data = $this->__db->query(" SELECT Id_Rpl_File AS Id, File_Rpl_File AS Files, Judul_Rpl_File AS Judul, Format_Rpl_File AS Format, Slugs_Rpl_File AS Slugs, User_Rpl_File AS Users, Log_Rpl_File AS Logs, Kampus, Data AS Datas FROM Tbl_Rpl_File ORDER BY Id_Rpl_File ASC ");

            }

            return $data;
        }

        public function update($id, $file, $judul, $format, $slugs, $user, $log, $kampus, $data)
        {
            try {
                $sql = "UPDATE Tbl_Rpl_File SET File_Rpl_File = :file, Judul_Rpl_File = :judul, Format_Rpl_File = :format, Slugs_Rpl_File = :slugs, 
                        User_Rpl_File = :user, Log_Rpl_File = :log, Kampus = :kampus, Data = :data WHERE Id = :id";

                $stmt = $this->__db->prepare($sql);
                $stmt->bindParam(':file', $file);
                $stmt->bindParam(':judul', $judul);
                $stmt->bindParam(':format', $format);
                $stmt->bindParam(':slugs', $slugs);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':log', $log);
                $stmt->bindParam(':kampus', $kampus);
                $stmt->bindParam(':data', $data);
                $stmt->bindParam(':id', $id);

                $stmt->execute();

                return ['Error' => '000', 'Message' => 'Data successfully updated.'];
            } catch (PDOException $e) {
                return ['Error' => '099', 'Message' => 'Database error: ' . $e->getMessage()];
            }
        }

        public function delete( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        DELETE FROM Tbl_Rpl_File
                        WHERE Id_Rpl_File = :__Id
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }