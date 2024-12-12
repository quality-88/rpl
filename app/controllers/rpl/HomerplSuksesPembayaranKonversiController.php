<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(dirname(__DIR__)) . '/api/__bri.php';
    require_once dirname(__DIR__) . '/../helpers/__Keuangan.php';

    class HomerplSuksesPembayaranKonversiController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__Bri;
        protected $__Keuangan;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__Bri = new __Bri( $this->__db , $this->__secret_key , $this->__universitas , $this->__helpers );
            $this->__Keuangan = new __Keuangan( $this->__db );
        }

        public function __Header()
        {
            return 'RPL | ';
        }

        public function __Routes_Mod__()
        {
            return url('/homerpl/pembayarankonversi/suksespembayaran');
        }
        
        public function IndexRpl_SuksesPembayaranKonversi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__pembayarankonversi/suksespembayaran';

            $__active       = 'active';

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

                $__record_data_biayakonversi__ = self::__Query_BiayaKonversi( $__datas = ['Ta' => $__authlogin__->Ta, 'Semester' => $__authlogin__->Semester] );

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';
                    
                }  else {
                
                    redirect('/homerpl', $result['Error'] === '000' ? '01' : '03', 'Tidak Ada Sukses Pada Pembayaran Kamu !');
                    exit();

                }
                
            }
        }

        public function __Query_BiayaKonversi( $data )
        {
            $data = $this->__db->queryid("SELECT TOP 1 Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, Tipe_Rpl_BiayaKonversi AS Tipe FROM Tbl_Rpl_BiayaKonversi WHERE Ta_Rpl_BiayaKonversi = '". $data['Ta'] ."' AND Semester_Rpl_BiayaKonversi = '". $data['Semester'] ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY Id_Rpl_BiayaKonversi DESC ");

            return $data;
        }

        public function IndexRpl_SuksesPembayaranKonversi_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = url('/homerpl/pembayarankonversi/suksespembayaran/pdf');
            $__content      = '__pembayarankonversi/suksespembayaran/pdf';

            $__active       = 'active';

            if ( !isset($_SESSION['__Rpl__']) OR $_GET['__Id'] == FALSE ) {

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

                $__record_data_biayakonversi__ = self::__Query_BiayaKonversi( $__datas = ['Ta' => $__authlogin__->Ta, 'Semester' => $__authlogin__->Semester] );

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND Id_Bri_Bayar = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    $__kop_surat = $this->__universitas->__Detail_Universitas()['KopSurat'];

                    if ( $__data_pembayaran__->StatusBayar == 'Y' ) {
                        $__statusbayar__ = 'SUDAH BAYAR';
                    } else {
                        $__statusbayar__ = 'BELUM BAYAR';
                    }
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sukses_bri.php';

                }  else {
                
                    redirect('/homerpl/pembayarankonversi', $result['Error'] === '000' ? '01' : '03', 'Tidak Ada Melakukan Pembayaran !');
                    exit();

                }
                
            }
        }
    }