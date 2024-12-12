<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    // require_once dirname(__DIR__) . '/../models/administrator/InformasiFile.php';
    require_once __DIR__ . '/__SessionController.php';

    class HomerplRplController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        // protected $__InformasiFileModel;
        protected $__SessionController;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            // $this->__InformasiFileModel = new __InformasiFileModel( $this->__db );
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
        }

        public function __Header()
        {
            return 'RPL | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homerpl/rpl');
        }
        
        public function IndexRpl_Rpl()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__rpl';

            $__active_rpl   = 'active';

            if ( !isset($_SESSION['__Rpl__']) ) {

                $_SESSION = array();
                session_unset();
                session_destroy();
                
                session_start();
                $_SESSION['__Notifikasi'] = [
                    'Error'     => '03',
                    'Message'   => 'Akses Login Di Tolak, Silahkan Login terlebih Dahulu !',
                    'Data'      => [],
                ];

                header("Location: ". __Base_Url());
                exit();

            } else {

                $__result_sessionlogin = $this->__SessionController->__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $__session_login__['__Id'] );

                $__req_filter = [
                    'Prodi'     => $__authlogin__->Prodi,
                    'Kurikulum' => $__authlogin__->Kurikulum,
                    'Kampus'    => $__authlogin__->IdKampus,
                ];
                $__record_data__ = self::__Filter_ListMatakuliah( $__req_filter );

                $__nomor = '1';
                $__record__data__ = [];
                foreach ( $__record_data__ AS $data => $__record__ ) : 

                    $data_matakuliah = $this->__db->queryid(" SELECT TOP 1 IdPrimary AS Id, IdMk, Matakuliah, Semester, Sks, Tipe, Skripsi, ProdiMatakuliah, Pkl, Id_Mk AS IdMk_Feeder, Rpl FROM Matakuliah WHERE IdMk = '". $__record__->IdMk ."' ORDER BY IdMk DESC ");

                    $__record__data__[] = [
                        'Nomor'         => $__nomor++,
                        'IdMk'          => $data_matakuliah->IdMk,
                        'Matakuliah'    => $data_matakuliah->Matakuliah,
                        'Sks'           => $data_matakuliah->Sks,
                        'Ta'            => $__record__->Ta,
                        'Semester'      => $__record__->Semester,
                        'Rpl'           => $data_matakuliah->Rpl,
                    ];

                endforeach;

                $__total_sks            = self::__GetData_Count( 'SKS' , $__req_filter );
                $__total_matakuliah     = self::__GetData_Count( 'MATAKULIAH' , $__req_filter );
                $__total_minsem         = self::__GetData_Count( 'MIN SEMESTER' , $__req_filter );
                $__total_maxmin         = self::__GetData_Count( 'MAX SEMESTER' , $__req_filter );
                $__total_minsks         = self::__GetData_Count( 'MIN SKS' , $__req_filter );
                $__total_maxsks         = self::__GetData_Count( 'MAX SKS' , $__req_filter );
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function __Filter_ListMatakuliah( $data )
        {
            $explode = $this->__helpers->__Explode_Data($data['Kampus']);
            
            $data = $this->__db->query(" SELECT IdPrimary AS Id, Kurikulum, IdKampus, IdFakultas, Prodi, IdMk, Sks, Semester, Ta, MkPilihan FROM ProdiMk WHERE Prodi = '". $data['Prodi'] ."' AND Kurikulum = '". $data['Kurikulum'] ."' AND IdKampus = '". $explode[0] ."' ORDER BY Semester ASC ");
            
            return $data;
        }

        public function __GetData_Count( $__status , $__data )
        {
            if ( $__status == 'SKS' ) {
                
                @$__query = "SUM( Sks ) AS Count";

            } elseif ( $__status == 'MATAKULIAH' ) {

                @$__query = "COUNT( IdMk ) AS Count";

            } elseif ( $__status == 'MAX SEMESTER' ) {

                @$__query = "MAX( Semester ) AS Count";

            } elseif ( $__status == 'MIN SEMESTER' ) {

                @$__query = "MIN( Semester ) AS Count";

            } elseif ( $__status == 'MAX SKS' ) {

                @$__query = "MAX( Sks ) AS Count";

            } elseif ( $__status == 'MIN SKS' ) {

                @$__query = "MIN( Sks ) AS Count";

            } 

            $explode = $this->__helpers->__Explode_Data($__data['Kampus']);

            $data = $this->__db->queryid(" SELECT ". $__query ." FROM ProdiMk WHERE Prodi = '". $__data['Prodi'] ."' AND Kurikulum = '". $__data['Kurikulum'] ."' AND IdKampus = '". $explode[0] ."' ");

            return $data->Count;
        }
    }