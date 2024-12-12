<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(dirname(__DIR__)) . '/api/__bri.php';
    require_once dirname(__DIR__) . '/../helpers/__Keuangan.php';

    class HomerplPumbController
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
            return url('/homerpl/pumb');
        }
        
        public function IndexRpl_Pumb()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__pumb';

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

                $__data_pembayaran_biayakonversi__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND StatusBayar_Bri_Bayar = 'Y' ");

                if ( isset($__data_pembayaran_biayakonversi__) ) {

                    // ############################ //
                        $__total_biaya__ = 0;
                        $__tipekelas_mahasiswa__ = 'RPL';
                        $__tipekelas_mahasiswa_biaya__ = 'BARU KHUSUS';

                        $__data_biaya_rpl__ = $this->__db->queryid(" SELECT Id_Setting_Kul AS Id, Id_Peserta, Tipe_Kelas, Pengelolah AS Biaya, Universitas, Tgl_Set, User_Set, Total, Ta, Semester FROM Setting_Kul_Rpl_Baru WHERE Id_Peserta = '". $__authlogin__->Npm ."' OR Id_Peserta = '". $__authlogin__->Nomor ."' AND Tipe_Kelas = '". $__tipekelas_mahasiswa__ ."' ORDER BY Id_Setting_Kul DESC ");

                        if ( $__data_biaya_rpl__->Id == TRUE AND $__authlogin__->Npm == FALSE ) {
                        
                            $__data_biaya_pmb__ = $this->__db->queryid (" SELECT TOP 1 Ta, BiayaDaftar AS Biaya, G1, G2, G3, G4, BiayaKonversi, TglTutupPmb FROM SettingPMB WHERE Ta = '". $__authlogin__->Ta ."' AND AKTIF = 'Y' ORDER BY Ta DESC ");

                            $__data_biaya_alokasibiayakuliah1__ = $this->__db->query (" SELECT IdFakultas, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal AS Biaya, Aktif, Cuti, Reaktivasi, Stambuk, Prodi FROM AlokasiBiayaKuliah1 WHERE Ta = '". $__authlogin__->Ta ."' AND Semester = '". $__authlogin__->Semester ."' AND TipeKelas = '". $__tipekelas_mahasiswa_biaya__ ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND Stambuk = '". $__authlogin__->Ta ."' AND Prodi = '". $__authlogin__->Prodi ."' ORDER BY Nominal ASC ");

                            $__data_biaya_alokasiper1__ = $this->__db->query (" SELECT IdFakultas, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal AS Biaya, Stambuk, Prodi FROM AlokasiPer1 WHERE Ta = '". $__authlogin__->Ta ."' AND Semester = '". $__authlogin__->Semester ."' AND TipeKelas = '". $__tipekelas_mahasiswa_biaya__ ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND Stambuk = '". $__authlogin__->Ta ."' AND Prodi = '". $__authlogin__->Prodi ."' ORDER BY Nominal ASC ");

                            $__total_biaya__ += $__data_biaya_pmb__->Biaya + 0;
                            $__total_biaya__ += $__data_biaya_rpl__->Biaya + 0;

                            $__data_fulldiskon__ = $this->__db->queryid(" SELECT Id_Rpl_FullDiskon AS Id, Ta_Rpl_FullDiskon AS Ta, Semester_Rpl_FullDiskon, TglAwal_Rpl_FullDiskon AS TglAwal, TglAkhir_Rpl_FullDiskon AS TglAkhir, Nominal_Rpl_FullDiskon AS Nominal FROM Tbl_Rpl_FullDiskon WHERE Ta_Rpl_FullDiskon = '". $__authlogin__->Ta ."' AND Semester_Rpl_FullDiskon = '". $__authlogin__->Semester ."' AND TglAkhir_Rpl_FullDiskon >= '". date('Y-m-d') ."' ORDER BY Id_Rpl_FullDiskon DESC ");

                            // $__diskon__ = '0';
                            $__diskon__ = isset($__data_fulldiskon__->Nominal) ? $__data_fulldiskon__->Nominal + 0 : '0';

                        }
                    // ############################ //

                        if ( $__data_biaya_rpl__->Id == TRUE ) {

                            if ( $__authlogin__->Npm == FALSE ) {

                                $__check_pmbregistrasi__ = $this->__db->queryrow(" SELECT NoPeserta FROM PmbRegistrasi WHERE NoPeserta = '". $__authlogin__->Nomor ."' AND Ta = '". $__authlogin__->Ta ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND LunasPumb = 'Y' ");

                                if ( isset($__check_pmbregistrasi__) AND $__check_pmbregistrasi__ == TRUE ) {

                                    $__data_pembayaran_pumb__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ORDER BY Id_Bri_Bayar DESC ");

                                    if ( isset($__data_pembayaran_pumb__->Id) ) {

                                        redirect(url('/homerpl/pumb/pembayaran'), '02', 'Silahkan Melakukan Pembayaran RPL PUMB !');
                                        exit();

                                    } else {

                                        $__data_pmbregistrasi__ = $this->Data_PmbRegistrasi(['Nomor' => $__authlogin__->Nomor, 'Ta' => $__authlogin__->Ta]);

                                        $__data_mahasiswa__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama, Loginpassword, Prodi, IdKampus, TipeKelas FROM Mahasiswa WHERE Npm = '". $__data_pmbregistrasi__->Npm ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND StatusMhs = 'AKTIF' ORDER BY Npm DESC ");

                                        $__data_pembayaran_pumb_success__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ORDER BY Id_Bri_Bayar DESC ");

                                        require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

                                    } 

                                } else {

                                    redirect(url('/homerpl/pumb/pmbregistrasi'), '02', 'Silahkan Isi Data PUMB Registrasi Terlebih Dahulu !');
                                    exit();

                                }

                            } else {

                                redirect(url('/homerpl/pumb/npm'), '02', 'Silahkan Validasikan KRS Matakuliah Baru Kamu Karena Sudah Melakukan Konversi Ke RPL !');
                                exit();

                            }

                        } else {

                            redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Setting Biaya Pengelola !');
                            exit();

                        }

                } else {

                    redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Bayar Biaya Konversi !');
                    exit();

                }
            }
        }

        public function IndexRpl_Pumb_Npm()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__pumb_npm';

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


                $__check_sukses_pumb__ = $this->__db->queryrow(" SELECT Id_Rpl_Sk AS Id FROM Tbl_Rpl_Sk WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Ta_Rpl_Sk = '". $__authlogin__->Ta ."' AND Semester_Rpl_Sk = '". $__authlogin__->Semester ."' AND Kampus = '". $__authlogin__->Kampus ."' AND Selesai_Pumb = '1' ");

                if ( $__check_sukses_pumb__ == FALSE ) {

                    $__data_pembayaran_biayakonversi__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND StatusBayar_Bri_Bayar = 'Y' ");

                    if ( !isset($__data_pembayaran_biayakonversi__) ) {

                        redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Bayar Biaya Konversi !');
                        exit();

                    }

                    $__data_biaya_rpl__ = $this->__db->queryid(" SELECT Id_Setting_Kul AS Id, Id_Peserta, Tipe_Kelas, Pengelolah AS Biaya, Universitas, Tgl_Set, User_Set, Total, Ta, Semester FROM Setting_Kul_Rpl_Baru WHERE Id_Peserta = '". $__authlogin__->Npm ."' OR Id_Peserta = '". $__authlogin__->Nomor ."' AND Tipe_Kelas = '". __Aplikasi()['Tujuan'] ."' ORDER BY Id_Setting_Kul DESC ");

                    if ( !$__data_biaya_rpl__->Id ) {

                        redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Setting Biaya Pengelola !');
                        exit();

                    }

                    if ( $__authlogin__->Npm == '' ) {

                        redirect(url('/homerpl'), '03', 'Mohon Maaf Kamu Tidak Konversi Dari NPM !');
                        exit();

                    }

                    $__data_kelas__ = $this->__db->queryid(" SELECT Kelas FROM JadwalPrimary WHERE IdKampus = '". $__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND IdFakultas = '". $__authlogin__->NamaFakultas ."' AND Prodi = '". $__authlogin__->Prodi ."' AND Ta = '". $__authlogin__->Ta ."' AND Semester = '". $__authlogin__->Semester ."' AND Kurikulum = '". $__authlogin__->Kurikulum ."' AND Validasi = 'T' GROUP BY Kelas ORDER BY NEWID() ");

                    if ( !$__data_kelas__->Kelas ) {

                        redirect(url('/homerpl'), '03', 'Data Kelas Tidak Ada !');
                        exit();

                    }

                    $__total_awalsks__ = $this->__db->queryid(" SELECT SUM(Sks) AS Sks FROM JadwalPrimary WHERE IdKampus = '". $__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND IdFakultas = '". $__authlogin__->NamaFakultas ."' AND Prodi = '". $__authlogin__->Prodi ."' AND Ta = '". $__authlogin__->Ta ."' AND Semester = '". $__authlogin__->Semester ."' AND Kurikulum = '". $__authlogin__->Kurikulum ."' AND Validasi = 'T' AND Kelas = '". $__data_kelas__->Kelas ."' ");

                    if ( $__total_awalsks__->Sks > '24' ) {

                        redirect(url('/homerpl'), '03', 'SKS Di Jadwal Tidak Boleh Lebih Dari 24 SKS !');
                        exit();

                    }
                    
                    $__data_jadwalprimary__ = $this->__db->query(" SELECT A.IdPrimary AS Id, A.IdKampus, A.IdFakultas, A.Prodi, A.IdRuang, A.Ta, A.Semester, A.IdMk, A.IdDosen2, A.Kurikulum, A.JamMasuk, A.JamKeluar, A.Kelas, A.Sks, A.Hari, B.Matakuliah FROM JadwalPrimary A JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.IdKampus = '". $__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND A.IdFakultas = '". $__authlogin__->NamaFakultas ."' AND A.Prodi = '". $__authlogin__->Prodi ."' AND A.Ta = '". $__authlogin__->Ta ."' AND A.Semester = '". $__authlogin__->Semester ."' AND A.Kurikulum = '". $__authlogin__->Kurikulum ."' AND A.Validasi = 'T' AND B.ProdiMatakuliah = '". $__authlogin__->Prodi ."' AND A.Kelas = '". $__data_kelas__->Kelas ."' ORDER BY A.IdMk DESC ");

                } else {

                    $__data_mahasiswa__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama, Loginpassword, Prodi, IdKampus, TipeKelas FROM Mahasiswa WHERE Npm = '". $__authlogin__->Npm ."' ORDER BY Npm DESC ");

                }
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';
            }
        }

        public function IndexRpl_Pumb_Npm_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Npm'             => isset($data['__Npm']) ? stripslashes(strip_tags(htmlspecialchars($data['__Npm'], ENT_QUOTES))) : '',
                '__IdJadwal'        => isset($data['__IdJadwal']) ? $data['__IdJadwal'] : '',
                '__Sks'             => isset($data['__Sks']) ? stripslashes(strip_tags(htmlspecialchars($data['__Sks'], ENT_QUOTES))) : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( $__clean_data['__Sks'] < '1' OR $__clean_data['__Sks'] > '24' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf SKS Melebihi 24 SKS !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__jumlah__ = COUNT($__clean_data['__IdJadwal']);

                if ( $__jumlah__ == '0' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Jadwal Matakuliah Tidak Ada !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen($__clean_data['__Id']) );

                if ( !$__authlogin__->Id OR $__authlogin__->Npm != $this->__helpers->SecretOpen($__clean_data['__Npm']) ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Tujuan Tidak Ada',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                    try {

                        $this->__db->beginTransaction();

                            $__update_mahasiswa__ = [
                                'IdKampus'  => $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'],
                                'TipeKelas' => __Aplikasi()['Tujuan'],
                                'Npm'       => $__authlogin__->Npm,
                            ];

                            $__update_krs__ = [
                                'Npm_U'     => '-'. $__authlogin__->Npm,
                                'Npm'       => $__authlogin__->Npm,
                                'Ta'        => $__authlogin__->Ta,
                                'Semester'  => $__authlogin__->Semester,
                            ];

                            $__sql_update_mahasiswa__ = $this->__db->prepare( 
                                "
                                    UPDATE Mahasiswa SET
                                        IdKampus    = :IdKampus,
                                        TipeKelas   = :TipeKelas
                                    WHERE Npm       = :Npm
                                "
                            ) -> execute ( $__update_mahasiswa__ );

                            $__sql_update_krs__ = $this->__db->prepare( 
                                "
                                    UPDATE Krs SET
                                        IdKampus    = :IdKampus,
                                        TipeKelas   = :TipeKelas
                                    WHERE Npm       = :Npm
                                "
                            ) -> execute ( $__update_mahasiswa__ );

                            $__sql_update_krsdetail__ = $this->__db->prepare( 
                                "
                                    UPDATE KrsDetail SET
                                        Npm         = :Npm_U
                                    WHERE Npm       = :Npm
                                    AND Ta          = :Ta
                                    AND Semester    = :Semester
                                "
                            ) -> execute ( $__update_krs__ );

                            $__sql_update_mhskrsjadwaldetail__ = $this->__db->prepare( 
                                "
                                    UPDATE MhsKrsJadwalDetail SET
                                        Npm         = :Npm_U
                                    WHERE Npm       = :Npm
                                    AND Ta          = :Ta
                                    AND Semester    = :Semester
                                "
                            ) -> execute ( $__update_krs__ );

                                for ( $x = 0; $x < $__jumlah__; $x++ ) {

                                    $__data_jadawal__ = $this->__db->queryid(" SELECT IdPrimary AS Id, IdKampus, IdFakultas, Prodi, IdRuang, Ta, Semester, ItemNo, IdMk, IdDosen, Kurikulum, JamMasuk, JamKeluar, Kelas, IdDosen2, HariJadwal, Validasi, Gabungan, Sks, Hari FROM JadwalPrimary WHERE Ta = '". $__update_krs__['Ta'] ."' AND Semester = '". $__update_krs__['Semester'] ."' AND Validasi = 'T' AND Prodi = '". $__authlogin__->Prodi ."' AND IdKampus = '". $__update_mahasiswa__['IdKampus'] ."' AND IdPrimary = '". $this->__helpers->SecretOpen($__clean_data['__IdJadwal'][$x]) ."' ");

                                    if ( $__data_jadawal__->Id == TRUE ) {

                                        $__data_krssementara__ = [
                                            'Npm'           => $__authlogin__->Npm,
                                            'IdKampus'      => $__data_jadawal__->IdKampus,
                                            'IdFakultas'    => $__data_jadawal__->IdFakultas,
                                            'Prodi'         => $__data_jadawal__->Prodi,
                                            'Kurikulum'     => $__data_jadawal__->Kurikulum,
                                            'Ta'            => $__data_jadawal__->Ta,
                                            'Semester'      => $__data_jadawal__->Semester,
                                            'ItemNo'        => $__data_jadawal__->ItemNo,
                                            'Hari'          => $__data_jadawal__->Hari,
                                            'IdMk'          => $__data_jadawal__->IdMk,
                                            'IdRuang'       => $__data_jadawal__->IdRuang,
                                            'JamMasuk'      => $__data_jadawal__->JamMasuk,
                                            'JamKeluar'     => $__data_jadawal__->JamKeluar,
                                            'Sks'           => $__data_jadawal__->Sks,
                                            'Kelas'         => $__data_jadawal__->Kelas,
                                            'UserId'        => $__authlogin__->Npm,
                                        ];

                                        $__sql_insert_mhskrsjadwaldetail = $this->__db->prepare( 
                                            "
                                                INSERT INTO MhsKrsJadwalDetail
                                                (
                                                    Npm, IdKampus, IdFakultas, Prodi, Kurikulum, Ta, Semester, ItemNo, Hari, IdMk, IdRuang, JamMasuk, JamKeluar, Sks, Kelas, UserId
                                                )
                                                VALUES
                                                (
                                                    :Npm, :IdKampus, :IdFakultas, :Prodi, :Kurikulum, :Ta, :Semester, :ItemNo, :Hari, :IdMk, :IdRuang, :JamMasuk, :JamKeluar, :Sks, :Kelas, :UserId
                                                )
                                            "
                                        ) -> execute ( $__data_krssementara__ );

                                    }

                                }

                            $__insert_krsdetail = [
                                'Npm'           => $__update_krs__['Npm'],
                                'Ta'            => $__update_krs__['Ta'],
                                'Semester'      => $__update_krs__['Semester'],
                            ];

                            $__sql_insert_krsdetail = $this->__db->prepare( 
                                "
                                    INSERT INTO KRSDetail
                                    (
                                        NPM, TA, SEMESTER, KURIKULUM, IDKAMPUS, IDFAKULTAS, PRODI, ITEMNO, IDMK, SKS, USERID, KELAS, IDRUANG, JAM1, JAM2, HARI
                                    )
                                    (
                                        SELECT NPM, TA, SEMESTER, KURIKULUM, IDKAMPUS, IDFAKULTAS, PRODI, ITEMNO, IDMK, SKS, USERID, KELAS, IDRUANG, JAMMASUK, JAMKELUAR, HARI 
                                        FROM MhsKrsJadwalDetail
                                        WHERE Npm       = :Npm 
                                        AND Ta          = :Ta
                                        AND Semester    = :Semester
                                    )
                                "
                            ) -> execute ( $__insert_krsdetail );

                            $__update_rplsk__ = [
                                'Id_Rpl_Pendaftaran'    => $__authlogin__->Id,
                                'Ta_Rpl_Sk'             => $__authlogin__->Ta,
                                'Semester_Rpl_Sk'       => $__authlogin__->Semester,
                                'Kampus'                => $__authlogin__->Kampus,
                            ];

                            $__sql_update_rplsk = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Sk SET
                                        Selesai_Pumb            = '1'
                                    WHERE Id_Rpl_Pendaftaran    = :Id_Rpl_Pendaftaran
                                    AND Ta_Rpl_Sk               = :Ta_Rpl_Sk
                                    AND Semester_Rpl_Sk         = :Semester_Rpl_Sk
                                    AND Kampus                  = :Kampus
                                "
                            ) -> execute ( $__update_rplsk__ );

                            $__update_pmbregistrasi__ = [
                                'IdKampus'      => $__update_mahasiswa__['IdKampus'],
                                'Npm'           => $__insert_krsdetail['Npm'],
                                'Ta'            => $__insert_krsdetail['Ta'],
                            ];

                            $__sql_update_pmbregistrasi = $this->__db->prepare( 
                                "
                                    UPDATE PmbRegistrasi SET
                                        IdKampus    = :IdKampus
                                    WHERE Npm       = :Npm
                                    AND Ta          = :Ta
                                "
                            ) -> execute ( $__update_pmbregistrasi__ );

                        $this->__db->commit();

                        return [
                            'Error'     => '000',
                            'Message'   => 'Berhasil Simpan Data Matakuliah Konversi, Selamat Melaksanakan Perkuliahan '. $__authlogin__->Nama .' !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        return [
                            'Error'     => '999',
                            'Message'   => 'Error ' . $e,
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function __Query_BiayaKonversi( $data )
        {
            $data = $this->__db->queryid(" SELECT TOP 1 Id_Rpl_BiayaKonversi AS Id, Ta_Rpl_BiayaKonversi AS Ta, Semester_Rpl_BiayaKonversi AS Semester, Biaya_Rpl_BiayaKonversi AS Biaya, Tipe_Rpl_BiayaKonversi AS Tipe FROM Tbl_Rpl_BiayaKonversi WHERE Ta_Rpl_BiayaKonversi = '". $data['Ta'] ."' AND Semester_Rpl_BiayaKonversi = '". $data['Semester'] ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' ORDER BY Id_Rpl_BiayaKonversi DESC ");

            return $data;
        }

        public function __Check_Va__( array $data )
        {
            $__tgl__ = date('Y-m-d H:i:s');
            $__nomor_va__ = rand(0, 999999999) . date('s') . '10';

            if ( $__nomor_va__ == FALSE ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Nomor Pembayaran VA Tidak Terbuatkan !',
                    'Data'          => [],
                ];
                exit();

            }

            if ( strlen( $__nomor_va__ ) > '13' ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Nomor Pembayaran VA Tidak Terbuatkan !',
                    'Data'          => [],
                ];
                exit();

            }

            if ( strlen( $__nomor_va__ ) > '0' AND strlen( @$__nomor_va__ ) < '14' ) {

                $__check_nomor_va__ = $this->__db->queryrow(" SELECT CustCode_Bri_Bayar AS CC FROM Tbl_Bri_Bayar WHERE CustCode_Bri_Bayar = '". $__nomor_va__ ."' ");
        
                if ( $__check_nomor_va__ == TRUE ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf Nomor Pembayaran VA Sudah Terpakai, Silahkan Ulangi Kembali !',
                        'Data'          => [],
                    ];
                    exit();

                }

                $__check_duplikat__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $data['DataUser']['Id'] ."' AND Ta_Bri_Bayar = '". $data['DataUser']['Ta'] ."' AND Semester_Bri_Bayar = '". $data['DataUser']['Semester'] ."' AND StatusBayar_Bri_Bayar = 'N' AND Data = 'Y' ");

                if ( $__check_duplikat__ > 0 ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf Nomor Pembayaran VA Sudah Ada, Silahkan Lakukan Pembayaran !',
                        'Data'          => [],
                    ];
                    exit();

                }

                $__check_va_y__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $data['DataUser']['Id'] ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $data['DataUser']['Ta'] ."' AND Semester_Bri_Bayar = '". $data['DataUser']['Semester'] ."' AND Data = 'Y' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ");

                if ( $__check_va_y__ == TRUE ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf ' . $data['Nama'] . ', Nomor Pembayaran Virtual Account Bank Kamu Sudah Membayar, Silahkan Tinggalkan Halaman Ini Dan Lanjut Ke Tahap Selanjutnya Ya !',
                        'Data'          => [],
                    ];
                    exit();

                }

                $__check_va_exp__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $data['DataUser']['Id'] ."' AND TanggalExpired_Bri_Bayar >= '". $__tgl__ ."' AND Data = 'Y' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ");

                if ( $__check_va_exp__ == TRUE ) {

                    return [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf ' . $data['Nama'] . ', Nomor Pembayaran Virtual Account Bank Kamu Masih Ada dan Belum Habis Masa Aktifnya. Silahkan Melakukan Pembayaran Ya !',
                        'Data'          => [],
                    ];
                    exit();

                }

                return [
                    'Error'         => '000',
                    'Message'       => 'Sukses !',
                    'Data'          => [
                        'Va'        => $__nomor_va__,
                    ],
                ];
                exit();

            } else {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Nomor Pembayaran VA Harus Di Antara 1 - 13 Nomor Code Saja !',
                    'Data'          => [],
                ];
                exit();
                
            }
        }

        public function IndexRpl_PembayaranKonversi_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Biaya'           => isset($data['__Biaya']) ? stripslashes(strip_tags(htmlspecialchars($data['__Biaya'], ENT_QUOTES))) : '',
                '__Bank'            => isset($data['__Bank']) ? stripslashes(strip_tags(htmlspecialchars($data['__Bank'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Bank'            => $__clean_data['__Bank'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__data_user = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__Id'] ) );

                $__log__ = date('Y-m-d H:i:s');

                if ( $__clean_data['__Bank'] == 'BRI' ) {

                    $__data_token = $this->__Bri->__Token__();

                    if ( $__data_token['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_token['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__not_exp = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__data_user->Id ."' AND TanggalExpired_Bri_Bayar >= '". $__log__ ."' AND Data = 'Y' ");

                    if ( $__not_exp == TRUE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf ' . $this->__helpers->HurufAwalBesar( $__data_user->Nama ) . ', Nomor Pembayaran Virtual Account Bank Kamu Masih Ada dan Belum Habis Masa Aktifnya. Silahkan Melakukan Pembayaran Ya',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } 


                    $__session_check_data = [
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => 'RPL',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];


                    $__check_va__ = $this->__Check_Va__( $__session_check_data );

                    if ( $__check_va__['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__check_va__['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__create_va = [
                        'Token'         => $__data_token['Data']['Token'],
                        'Nama'          => substr( $this->__helpers->HurufAwalBesar( $__data_user->Nama ) , 0 , 40 ),
                        'Amount'        => $__clean_data['__Biaya'] + 0,
                        'Keterangan'    => 'Bayar Biaya Konversi RPL TA - ' . $__data_user->Ta . '/' . $__data_user->Semester,
                        'Va'            => $__check_va__['Data']['Va'],
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => 'RPL',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];

                    $__data_create_va = $this->__Bri->__Create_Va__( $__create_va );

                    if ( $__data_create_va['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_create_va['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__tgl__ = date('Y-m-d H:i:s');
            
                    $__session__ = [
                        'UserId_Bri_Bayar'              => $__data_user->Id,
                        'Ta_Bri_Bayar'                  => $__data_user->Ta,
                        'Semester_Bri_Bayar'            => $__data_user->Semester,
                        'InstitutionCode_Bri_Bayar'     => $this->__Bri->__Data_Bri__()['Institutioncode'],
                        'BrivaNo_Bri_Bayar'             => $this->__Bri->__Data_Bri__()['Brivano'],
                        'CustCode_Bri_Bayar'            => $__create_va['Va'],
                        'Nama_Bri_Bayar'                => $__create_va['Nama'],
                        'Amount_Bri_Bayar'              => $__create_va['Amount'],
                        'Diskon_Bri_Bayar'              => '0',
                        'Nominal_Bri_Bayar'             => $__create_va['Amount'],
                        'Keterangan_Bri_Bayar'          => $__create_va['Keterangan'],
                        'StatusBayar_Bri_Bayar'         => 'N',
                        'AccessToken_Bri_Bayar'         => $__create_va['Token'],
                        'TanggalBuat_Bri_Bayar'         => $__tgl__,
                        'TanggalExpired_Bri_Bayar'      => $this->__helpers->__TambahTanggal(),
                        'TanggalBayar_Bri_Bayar'        => $__tgl__,
                        'JenisBayar_Bri_Bayar'          => 'Full',
                        'Bank_Bri_Bayar'                => $__create_va['DataUser']['Bank'],
                        'Tujuan_Bri_Bayar'              => $__create_va['DataUser']['Tujuan'],
                        'User_Bri_Bayar'                => $__create_va['Nama'],
                        'Log_Bri_Bayar'                 => $__tgl__,
                        'IdKampus'                      => __Aplikasi()['IdKampus'],
                        'Kampus'                        => __Aplikasi()['Kampus'],
                        'Data'                          => 'Y',
                        'KeteranganDeskripsi_Bri_Bayar' => '',
                        'Deskripsi_Bri_Bayar'           => '',
                        'NominalDeskripsi_Bri_Bayar'    => '',
                        'TotalDeskripsi_Bri_Bayar'      => '',
                    ];

                    $__result = $this->__Insert_Bri_Bayar__( $__session__ );

                    return [
                        'Error'     => '999',
                        'Message'   => $__result['Message'],
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } else {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Bank Tidak Tersedia !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function __Insert_Bri_Bayar__( array $data )
        {
            $__session__ = [
                'UserId_Bri_Bayar'              => $data['UserId_Bri_Bayar'],
                'Ta_Bri_Bayar'                  => $data['Ta_Bri_Bayar'],
                'Semester_Bri_Bayar'            => $data['Semester_Bri_Bayar'],
                'InstitutionCode_Bri_Bayar'     => $data['InstitutionCode_Bri_Bayar'],
                'BrivaNo_Bri_Bayar'             => $data['BrivaNo_Bri_Bayar'],
                'CustCode_Bri_Bayar'            => $data['CustCode_Bri_Bayar'],
                'Nama_Bri_Bayar'                => $data['Nama_Bri_Bayar'],
                'Amount_Bri_Bayar'              => $data['Amount_Bri_Bayar'],
                'Diskon_Bri_Bayar'              => $data['Diskon_Bri_Bayar'],
                'Nominal_Bri_Bayar'             => $data['Nominal_Bri_Bayar'],
                'Keterangan_Bri_Bayar'          => $data['Keterangan_Bri_Bayar'],
                'StatusBayar_Bri_Bayar'         => $data['StatusBayar_Bri_Bayar'],
                'AccessToken_Bri_Bayar'         => $data['AccessToken_Bri_Bayar'],
                'TanggalBuat_Bri_Bayar'         => $data['TanggalBuat_Bri_Bayar'],
                'TanggalExpired_Bri_Bayar'      => $data['TanggalExpired_Bri_Bayar'],
                'TanggalBayar_Bri_Bayar'        => $data['TanggalBayar_Bri_Bayar'],
                'JenisBayar_Bri_Bayar'          => $data['JenisBayar_Bri_Bayar'],
                'Bank_Bri_Bayar'                => $data['Bank_Bri_Bayar'],
                'Tujuan_Bri_Bayar'              => $data['Tujuan_Bri_Bayar'],
                'User_Bri_Bayar'                => $data['User_Bri_Bayar'],
                'Log_Bri_Bayar'                 => $data['Log_Bri_Bayar'],
                'IdKampus'                      => $data['IdKampus'],
                'Kampus'                        => $data['Kampus'],
                'Data'                          => $data['Data'],
                'KeteranganDeskripsi_Bri_Bayar' => $data['KeteranganDeskripsi_Bri_Bayar'],
                'Deskripsi_Bri_Bayar'           => $data['Deskripsi_Bri_Bayar'],
                'NominalDeskripsi_Bri_Bayar'    => $data['NominalDeskripsi_Bri_Bayar'],
                'TotalDeskripsi_Bri_Bayar'      => $data['TotalDeskripsi_Bri_Bayar'],
            ];

            try {

                $this->__db->beginTransaction();

                    $__sql = $this->__db->prepare( 
                        "
                            INSERT INTO Tbl_Bri_Bayar
                            (
                                UserId_Bri_Bayar,
                                Ta_Bri_Bayar,
                                Semester_Bri_Bayar,
                                InstitutionCode_Bri_Bayar,
                                BrivaNo_Bri_Bayar,
                                CustCode_Bri_Bayar,
                                Nama_Bri_Bayar,
                                Amount_Bri_Bayar,
                                Diskon_Bri_Bayar,
                                Nominal_Bri_Bayar,
                                Keterangan_Bri_Bayar,
                                StatusBayar_Bri_Bayar,
                                AccessToken_Bri_Bayar,
                                TanggalBuat_Bri_Bayar,
                                TanggalExpired_Bri_Bayar,
                                TanggalBayar_Bri_Bayar,
                                JenisBayar_Bri_Bayar,
                                Bank_Bri_Bayar,
                                Tujuan_Bri_Bayar,
                                User_Bri_Bayar,
                                Log_Bri_Bayar,
                                IdKampus,
                                Kampus,
                                Data,
                                KeteranganDeskripsi_Bri_Bayar,
                                Deskripsi_Bri_Bayar,
                                NominalDeskripsi_Bri_Bayar,
                                TotalDeskripsi_Bri_Bayar
                            )
                        VALUES
                            (
                                :UserId_Bri_Bayar,
                                :Ta_Bri_Bayar,
                                :Semester_Bri_Bayar,
                                :InstitutionCode_Bri_Bayar,
                                :BrivaNo_Bri_Bayar,
                                :CustCode_Bri_Bayar,
                                :Nama_Bri_Bayar,
                                :Amount_Bri_Bayar,
                                :Diskon_Bri_Bayar,
                                :Nominal_Bri_Bayar,
                                :Keterangan_Bri_Bayar,
                                :StatusBayar_Bri_Bayar,
                                :AccessToken_Bri_Bayar,
                                :TanggalBuat_Bri_Bayar,
                                :TanggalExpired_Bri_Bayar,
                                :TanggalBayar_Bri_Bayar,
                                :JenisBayar_Bri_Bayar,
                                :Bank_Bri_Bayar,
                                :Tujuan_Bri_Bayar,
                                :User_Bri_Bayar,
                                :Log_Bri_Bayar,
                                :IdKampus,
                                :Kampus,
                                :Data,
                                :KeteranganDeskripsi_Bri_Bayar,
                                :Deskripsi_Bri_Bayar,
                                :NominalDeskripsi_Bri_Bayar,
                                :TotalDeskripsi_Bri_Bayar
                            )
                        "
                    ) -> execute ( $__session__ );

                    $this->__db->commit();

                    return [
                        'Error'   => '000',
                        'Message' => 'Berhasil Simpan Data Pembayaran !',
                        'Data'    => [],
                    ];
                    exit();

            } catch ( PDOException $e ) {

                $this->__db->rollback();

                return [
                    'Error'   => '999',
                    'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                    'Data'    => [],
                ];
                exit();

            }
        }

        public function IndexRpl_Pumb_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Biaya'           => isset($data['__Biaya']) ? stripslashes(strip_tags(htmlspecialchars($data['__Biaya'], ENT_QUOTES))) : '',
                '__Bank'            => isset($data['__Bank']) ? stripslashes(strip_tags(htmlspecialchars($data['__Bank'], ENT_QUOTES))) : '',
                '__Diskon'          => isset($data['__Diskon']) ? stripslashes(strip_tags(htmlspecialchars($data['__Diskon'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Bank'            => $__clean_data['__Bank'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__data_user = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__Id'] ) );

                $__log__ = date('Y-m-d H:i:s');

                if ( $__clean_data['__Bank'] == 'BRI' ) {

                    $__data_token = $this->__Bri->__Token__();

                    if ( $__data_token['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_token['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__not_exp = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__data_user->Id ."' AND TanggalExpired_Bri_Bayar >= '". $__log__ ."' AND Data = 'Y' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ");

                    if ( $__not_exp == TRUE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf ' . $this->__helpers->HurufAwalBesar( $__data_user->Nama ) . ', Nomor Pembayaran Virtual Account Bank Kamu Masih Ada dan Belum Habis Masa Aktifnya. Silahkan Melakukan Pembayaran Ya',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } 


                    $__session_check_data = [
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => __Aplikasi()['Tujuan'] . ' PUMB',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];


                    $__check_va__ = $this->__Check_Va__( $__session_check_data );

                    if ( $__check_va__['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__check_va__['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__create_va = [
                        'Token'         => $__data_token['Data']['Token'],
                        'Nama'          => substr( $this->__helpers->HurufAwalBesar( $__data_user->Nama ) , 0 , 40 ),
                        'Amount'        => $__clean_data['__Biaya'] + 0,
                        'Keterangan'    => 'Bayar RPL PUMB TA - ' . $__data_user->Ta . '/' . $__data_user->Semester,
                        'Va'            => $__check_va__['Data']['Va'],
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => __Aplikasi()['Tujuan'] . ' PUMB',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];

                    $__data_create_va = $this->__Bri->__Create_Va__( $__create_va );

                    if ( $__data_create_va['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_create_va['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__tgl__ = date('Y-m-d H:i:s');
            
                    $__session__ = [
                        'UserId_Bri_Bayar'              => $__data_user->Id,
                        'Ta_Bri_Bayar'                  => $__data_user->Ta,
                        'Semester_Bri_Bayar'            => $__data_user->Semester,
                        'InstitutionCode_Bri_Bayar'     => $this->__Bri->__Data_Bri__()['Institutioncode'],
                        'BrivaNo_Bri_Bayar'             => $this->__Bri->__Data_Bri__()['Brivano'],
                        'CustCode_Bri_Bayar'            => $__create_va['Va'],
                        'Nama_Bri_Bayar'                => $__create_va['Nama'],
                        'Amount_Bri_Bayar'              => $__create_va['Amount'],
                        'Diskon_Bri_Bayar'              => $__clean_data['__Diskon'],
                        'Nominal_Bri_Bayar'             => $__create_va['Amount'],
                        'Keterangan_Bri_Bayar'          => $__create_va['Keterangan'],
                        'StatusBayar_Bri_Bayar'         => 'N',
                        'AccessToken_Bri_Bayar'         => $__create_va['Token'],
                        'TanggalBuat_Bri_Bayar'         => $__tgl__,
                        'TanggalExpired_Bri_Bayar'      => $this->__helpers->__TambahTanggal(),
                        'TanggalBayar_Bri_Bayar'        => $__tgl__,
                        'JenisBayar_Bri_Bayar'          => 'Full',
                        'Bank_Bri_Bayar'                => $__create_va['DataUser']['Bank'],
                        'Tujuan_Bri_Bayar'              => $__create_va['DataUser']['Tujuan'],
                        'User_Bri_Bayar'                => $__create_va['Nama'],
                        'Log_Bri_Bayar'                 => $__tgl__,
                        'IdKampus'                      => __Aplikasi()['IdKampus'],
                        'Kampus'                        => __Aplikasi()['Kampus'],
                        'Data'                          => 'Y',
                        'KeteranganDeskripsi_Bri_Bayar' => '',
                        'Deskripsi_Bri_Bayar'           => '',
                        'NominalDeskripsi_Bri_Bayar'    => '',
                        'TotalDeskripsi_Bri_Bayar'      => '',
                    ];

                    $__result = $this->__Insert_Bri_Bayar__( $__session__ );

                    if ( $__result['Error'] == '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__result['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } else {

                        return [
                            'Error'     => '999',
                            'Message'   => $__result['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                } else {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Bank Tidak Tersedia !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function IndexRpl_Pumb_Pembayaran()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__pumb_pembayaran';

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

                $__data_pembayaran_biayakonversi__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND StatusBayar_Bri_Bayar = 'Y' ");

                if ( !isset($__data_pembayaran_biayakonversi__) ) {

                    redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Bayar Biaya Konversi !');
                    exit();

                }

                $__data_biaya_rpl__ = $this->__db->queryid(" SELECT Id_Setting_Kul AS Id, Id_Peserta, Tipe_Kelas, Pengelolah AS Biaya, Universitas, Tgl_Set, User_Set, Total, Ta, Semester FROM Setting_Kul_Rpl_Baru WHERE Id_Peserta = '". $__authlogin__->Npm ."' OR Id_Peserta = '". $__authlogin__->Nomor ."' AND Tipe_Kelas = '". __Aplikasi()['Tujuan'] ."' ORDER BY Id_Setting_Kul DESC ");

                if ( !$__data_biaya_rpl__->Id ) {

                    redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Setting Biaya Pengelola !');
                    exit();

                }

                $__data_pembayaran_pumb__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ORDER BY Id_Bri_Bayar DESC ");

                if ( !isset($__data_pembayaran_pumb__->Id) ) {

                    redirect(url('/homerpl'), '03', 'Mohon Maaf Tidak Ada Nomor Pembayaran PUMB Di Buatkan !');
                    exit();

                }

                $__data_carapembayaran = $this->__db->query(" SELECT * FROM Tbl_CaraPembayaranBriva ORDER BY Id_CaraPembayaranBriva ASC ");

                if ( $__data_pembayaran_pumb__->StatusBayar == 'Y' ) {
                    $__statusbayar__ = 'SUDAH BAYAR';
                    $__disabled__ = '';
                } else {
                    $__statusbayar__ = 'BELUM BAYAR';
                    $__disabled__ = 'disabled';
                }

                if ( date('Y-m-d H:i:s', strtotime(@$__data_pembayaran_pumb__->TglExp)) >= date('Y-m-d H:i:s') ) {

                    $__aktif__ = '000';

                //     $__load_pembayaran_ = [
                //         'Id'                      => $__authlogin__->Id,
                //         'Id_Bri_Bayar'            => $__data_pembayaran_pumb__->Id,
                //         'Ta_Bri_Bayar'            => $__data_pembayaran_pumb__->Ta,
                //         'Semester_Bri_Bayar'      => $__data_pembayaran_pumb__->Semester,
                //         'CustCode_Bri_Bayar'      => $__data_pembayaran_pumb__->CustCode,
                //     ];

                //     // $result = $this->__Load_Bri_Bayar__( $__load_pembayaran_ );

                } else {

                    $__aktif__ = '999';

                }

                $__db = $this->__db;
                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function IndexRpl_Pumb_Pembayaran_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__pumb_pembayaran_pdf';

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

                $__data_pembayaran_biayakonversi__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND StatusBayar_Bri_Bayar = 'Y' ");

                if ( !isset($__data_pembayaran_biayakonversi__) ) {

                    redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Bayar Biaya Konversi !');
                    exit();

                }

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' AND Id_Bri_Bayar = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( !isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    redirect('/homerpl', $result['Error'] === '000' ? '01' : '03', 'Tidak Ada Pembayaran Kamu !');
                    exit();

                }

                    $__kop_surat = $this->__universitas->__Detail_Universitas()['KopSurat'];

                    if ( $__data_pembayaran__->StatusBayar == 'Y' ) {
                        $__statusbayar__ = 'SUDAH BAYAR';
                        $__aktif__ = '000';
                    } else {
                        $__statusbayar__ = 'BELUM BAYAR';
                        $__aktif__ = '999';
                    }
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__cek_bri.php';
            }
        }

        public function __Load_Bri_Bayar__( array $data )
        {
            $__data_token = $this->__Bri->__Token__();

            if ( $__data_token['Error'] != '000' ) {

                return [
                    'Error'     => '999',
                    'Message'   => $__data_token['Message'],
                    'Data'      => [
                        'Data'      => [],
                    ],
                ];
                exit();

            }

            if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                    'Data'      => [
                        'Data'      => [],
                    ],
                ];
                exit();

            }
            
            $__load_va = [
                'Token'                         => $__data_token['Data']['Token'],
                'Id_User'                       => $data['Id_User'],
                'Id_Bri_Bayar'                  => $data['Id_Bri_Bayar'],
                'Ta_Bri_Bayar'                  => $data['Ta_Bri_Bayar'],
                'Semester_Bri_Bayar'            => $data['Semester_Bri_Bayar'],
                'CustCode_Bri_Bayar'            => $data['CustCode_Bri_Bayar'],
                'Tgl_1'                         => str_replace( "-", "", date('Y-m-d') ),
                'Tgl_2'                         => str_replace( "-", "", date('Y-m-d') ),
            ];

            $__data_load_va = $this->__Bri->__Load_Va__( $__load_va );

            if ( $__data_load_va['Error'] != '000' ) {

                return [
                    'Error'     => '000',
                    'Message'   => $__data_load_va['Message'],
                    'Data'      => [],
                ];
                exit();

            }

            $__success_load_bayar__ = $this->__Success_Bayar_Bri__( $__data_load_va['Data'] , $data );

            if ( $__success_load_bayar__['Error'] == '000' ) {

                return [
                    'Error'     => '000',
                    'Message'   => $__success_load_bayar__['Message'],
                    'Data'      => [],
                ];
                exit();

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => $__success_load_bayar__['Message'],
                    'Data'      => [],
                ];
                exit();

            }
        }

        public function __Success_Bayar_Bri__( array $data , array $datas )
        {
            $__datas_bayar__ = $this->__Keuangan->__Bri_Bayar__( $datas['Id_Bri_Bayar'] );

            $__json_bayar__ = json_decode($__datas_bayar__->TotalDesk, true);

            $__session_user = $this->__SessionController->__Data_Rpl__( $datas['Id'] );

            $__data_pmbregistrasi__ = $this->Data_PmbRegistrasi(['Nomor' => $__session_user->Nomor, 'Ta' => $__session_user->Ta]);

            if ( !$__datas_bayar__->Id OR !$__datas_bayar__->Id OR !$__data_pmbregistrasi__->NoPeserta ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Data Pembayaran dan User Tidak Ada !',
                    'Data'      => [],
                ];
                exit();

            }

            $__data_kelas__ = $this->__db->queryid(" SELECT Kelas FROM JadwalPrimary WHERE IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND IdFakultas = '". $__session_user->NamaFakultas ."' AND Prodi = '". $__session_user->Prodi ."' AND Ta = '". $__session_user->Ta ."' AND Semester = '". $__session_user->Semester ."' AND Kurikulum = '". $__session_user->Kurikulum ."' AND Validasi = 'T' GROUP BY Kelas HAVING SUM(Sks) < '25' ORDER BY NEWID() ");

            if ( !$__data_kelas__->Kelas ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Data Kelas Tidak Ada !',
                    'Data'      => [],
                ];
                exit();

            }

            $__total_sks__ = $this->__db->queryid(" SELECT SUM(Sks) AS Sks FROM JadwalPrimary WHERE IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND IdFakultas = '". $__session_user->NamaFakultas ."' AND Prodi = '". $__session_user->Prodi ."' AND Ta = '". $__session_user->Ta ."' AND Semester = '". $__session_user->Semester ."' AND Kurikulum = '". $__session_user->Kurikulum ."' AND Validasi = 'T' AND Kelas = '". $__data_kelas__->Kelas ."' ");

            if ( $__total_sks__->Sks > '24' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'SKS Di Jadwal Tidak Boleh Lebih Dari 24 SKS !',
                    'Data'      => [],
                ];
                exit();

            }
            
            $sysbol = $this->__db->queryid(" SELECT TOP 1 Beasiswa FROM TTBUKTISETORAN ");

            if ( $sysbol->Beasiswa == FALSE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Symbol Beasiswa Tidak Di Temukan !',
                    'Data'      => [],
                ];
                exit();

            }

            $__data_biaya_rpl__ = $this->__db->queryid(" SELECT Id_Setting_Kul AS Id, Id_Peserta, Tipe_Kelas, Pengelolah AS Biaya, Universitas, Tgl_Set, User_Set, Total, Ta, Semester FROM Setting_Kul_Rpl_Baru WHERE Id_Peserta = '". $__data_pmbregistrasi__->Npm ."' OR Id_Peserta = '". $__data_pmbregistrasi__->NoPeserta ."' AND Tipe_Kelas = '". $__data_pmbregistrasi__->TipeKelas ."' ORDER BY Id_Setting_Kul DESC ");

            if ( $__data_biaya_rpl__->Id == FALSE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Pembayaran Pengelolah Belum Di Setting !',
                    'Data'      => [],
                ];
                exit();

            }

            $__data_biaya_pmb__ = $this->__db->queryid (" SELECT TOP 1 Ta, BiayaDaftar AS Biaya, G1, G2, G3, G4, BiayaKonversi, TglTutupPmb FROM SettingPMB WHERE Ta = '". $__data_pmbregistrasi__->Ta ."' AND AKTIF = 'Y' ORDER BY Ta DESC ");

            if ( $__data_biaya_pmb__->Biaya == FALSE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Pembayaran Pengelolah Belum Di Setting !',
                    'Data'      => [],
                ];
                exit();

            }

            // ############# GENERATE NPM MAHASISWA ############# //
                $__session_prodifakultas = $this->__db->queryid(" SELECT TOP 1 KodeProdi AS KP FROM ProdiFakultas WHERE Prodi = '". $__session_user->Prodi ."' ORDER BY KodeProdi DESC ");

                $__total_urut_pmbregistrasi = $this->__db->queryid(" SELECT TOP 1 RIGHT( Npm , 4 ) AS Total FROM Mahasiswa WHERE LEFT( Npm , 6 ) = '".  substr( $__datas_bayar__->Ta , 2, 2 ) . $__session_user->NamaFakultas . $__session_prodifakultas->KP ."' AND Ta = '". $__datas_bayar__->Ta ."' ORDER BY Npm DESC ");

                if ( $__total_urut_pmbregistrasi->Total == '0' ) {
                    $__total_urut_pmbregistrasi_get = '1';
                } else {
                    $__total_urut_pmbregistrasi_get = $__total_urut_pmbregistrasi->Total + 1;
                }

                $__generate_npm = substr( $__datas_bayar__->Ta , 2, 2 ) . $__session_user->NamaFakultas . $__session_prodifakultas->KP . $this->__helpers->GenerateAkhirNpm( $__total_urut_pmbregistrasi_get );

                $__cek_npm_mahasiswa = $this->__db->queryrow(" SELECT Npm FROM Mahasiswa WHERE Npm = '". $__generate_npm ."' ");

                if ( $__cek_npm_mahasiswa == TRUE ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf NPM Sudah Ada, Silahkan Generate Ulang !',
                        'Data'      => [],
                    ];
                    exit();

                }
            // ############# GENERATE NPM MAHASISWA ############# //
                
                foreach ( $data AS $row => $report ) :

                    if ( $report['custCode'] == $datas['CustCode_Bri_Bayar'] ) {

                        $tgl_reportstr = substr($report['paymentDate'], 0, 16);

                        try {

                            $this->__db->beginTransaction();


                                // ############# PMB REGISTRASI ############# //
                                    $__datas_pmbregistrasi = [
                                        'NoVaPmb'               => $__datas_bayar__->CustCode, 
                                        'Lunas'                 => 'Y',
                                        'TglExpLunasPmb'        => $report['paymentDate'],
                                        'Posted'                => 'Y',
                                        'PostingDate'           => $report['paymentDate'],
                                        'TglLunasPmb'           => $report['paymentDate'],
                                        'Npm'                   => $__generate_npm,
                                        'TglLunasPumb'          => $tgl_reportstr . ':00',
                                        'LunasPumb'             => 'Y',
                                        'BiayaPumb'             => $report['amount'],
                                        'TglExpLunasPumb'       => $__datas_bayar__->TglExp,
                                        'NoVaPumb'              => $__datas_bayar__->CustCode,
                                        'JenisBank'             => $__datas_bayar__->Bank,
                                        'NoPeserta'             => $__session_user->Nomor,
                                    ];

                                        $__sql_pmbregistrasi = $this->__db->prepare( 
                                            "
                                                UPDATE PMBRegistrasi SET
                                                    NoVaPmb             = :NoVaPmb,
                                                    Lunas               = :Lunas,
                                                    TglExpLunasPmb      = :TglExpLunasPmb,
                                                    Posted              = :Posted,
                                                    PostingDate         = :PostingDate,
                                                    TglLunasPmb         = :TglLunasPmb,
                                                    Npm                 = :Npm,
                                                    TglLunasPumb        = :TglLunasPumb,
                                                    LunasPumb           = :LunasPumb,
                                                    BiayaPumb           = :BiayaPumb,
                                                    TglExpLunasPumb     = :TglExpLunasPumb,
                                                    NoVaPumb            = :NoVaPumb,
                                                    JenisBank           = :JenisBank
                                                WHERE NoPeserta         = :NoPeserta
                                            "
                                        )->execute( $__datas_pmbregistrasi );
                                // ############# PMB REGISTRASI ############# //   


                                // ############# MAHASISWA ############# //
                                    $__insert_mahasiswa = [
                                        'Npm'                   => $__generate_npm,
                                        'NpmAsal'               => '',
                                        'Nama'                  => $this->__helpers->HurufBesar( $__session_user->Nama ),
                                        'TempatLahir'           => $this->__helpers->HurufBesar( $__session_user->TempatLahir ),
                                        'TglMasuk'              => $__session_user->TglDaftar,
                                        'TglLahir'              => $__session_user->TglLahir,
                                        'Telepon'               => $__session_user->NoHp,
                                        'Hp'                    => $__session_user->NoWa,
                                        'Agama'                 => $__data_pmbregistrasi__->Agama,
                                        'Warga'                 => $__data_pmbregistrasi__->WargaNegara,
                                        'SumberBiaya'           => $__data_pmbregistrasi__->SumberBiaya,
                                        'JenisKelamin'          => $__data_pmbregistrasi__->JenisKelamin,
                                        'Status'                => $__data_pmbregistrasi__->Status,
                                        'Pindahan'              => 'Y',
                                        'Alamat'                => $__data_pmbregistrasi__->Alamat,
                                        'AlamatAsal'            => $__data_pmbregistrasi__->AlamatAsal,
                                        'Kecamatan'             => $__data_pmbregistrasi__->Kecamatan,
                                        'KecamatanAsal'         => $__data_pmbregistrasi__->KecamatanAsal,
                                        'Kabupaten'             => $__data_pmbregistrasi__->Kabupaten,
                                        'KabupatenAsal'         => $__data_pmbregistrasi__->KabupatenAsal,
                                        'LoginUsername'         => $__generate_npm,
                                        'LoginPassword'         => $__data_pmbregistrasi__->Pass,
                                        'EmailMahasiswa'        => $__data_pmbregistrasi__->Email,
                                        'NoPeserta'             => $__data_pmbregistrasi__->NoPeserta,
                                        'Kurikulum'             => $__data_pmbregistrasi__->Kurikulum,
                                        'IdKampus'              => $__data_pmbregistrasi__->IdKampus,
                                        'Idfakultas'            => $__data_pmbregistrasi__->IdFakultas,
                                        'Prodi'                 => $__data_pmbregistrasi__->Prodi,
                                        'Stambuk'               => $__data_pmbregistrasi__->Ta,
                                        'Semester'              => '1',
                                        'SemesterTipe'          => 'Ganjil',
                                        'Ta'                    => $__data_pmbregistrasi__->Ta,
                                        'Spp'                   => '0',
                                        'LunasSpp'              => '0',
                                        'TotalSks'              => '0',
                                        'MaxSks'                => '0',
                                        'Cuti'                  => '0',
                                        'UserId'                => $this->__helpers->HurufBesar( $__data_pmbregistrasi__->Nama ),
                                        'InputDate'             => date('Y-m-d H:i:s'),
                                        'LastUpdate'            => date('Y-m-d H:i:s'),
                                        'UpdateUserId'          => $this->__helpers->HurufBesar( $__data_pmbregistrasi__->Nama ),
                                        'AccPiutangAwal'        => '',
                                        'AccPiutang'            => '',
                                        'AccPenerimaan'         => '',
                                        'AccPendapatan'         => '',
                                        'JenisSekolah'          => $__data_pmbregistrasi__->JenisSekolah,
                                        'NamaSekolah'           => $__data_pmbregistrasi__->NamaSekolah,
                                        'AlamatSekolah'         => $__data_pmbregistrasi__->AlamatSekolah,
                                        'KecamatanSekolah'      => $__data_pmbregistrasi__->KecamatanSekolah,
                                        'KabupatenSekolah'      => $__data_pmbregistrasi__->KabupatenSekolah,
                                        'PropinsiSekolah'       => $__data_pmbregistrasi__->PropinsiSekolah,
                                        'JurusanSekolah'        => $__data_pmbregistrasi__->JurusanSekolah,
                                        'NoIjazah'              => $__data_pmbregistrasi__->NoIjazah,
                                        'Nem'                   => $__data_pmbregistrasi__->Nem,
                                        'TglIjazah'             => $__data_pmbregistrasi__->TglIjazah,
                                        'NamaAyah'              => $__data_pmbregistrasi__->NamaAyah,
                                        'NamaIbu'               => $__data_pmbregistrasi__->NamaIbu,
                                        'AlamatOrtu'            => $__data_pmbregistrasi__->AlamatOrtu,
                                        'KecamatanOrtu'         => $__data_pmbregistrasi__->KecamatanOrtu,
                                        'KabupatenOrtu'         => $__data_pmbregistrasi__->KabupatenOrtu,
                                        'PropinsiOrtu'          => $__data_pmbregistrasi__->PropinsiOrtu,
                                        'PekerjaanOrtu'         => $__data_pmbregistrasi__->PekerjaanOrtu,
                                        'PenghasilanOrtu'       => $__data_pmbregistrasi__->PenghasilanOrtu,
                                        'FormulirPmb'           => 'Y',
                                        'FormulirIjazah'        => 'T',
                                        'FormulirAkteLahir'     => 'T',
                                        'FormulirIdentitas'     => 'T',
                                        'PasFoto4x6'            => 'T',
                                        'PasFoto2x3'            => 'T',
                                        'PtAsal'                => $__data_pmbregistrasi__->KdPtAsal,
                                        'SksSelesai'            => NULL,
                                        'NoVoucher'             => NULL,
                                        'Printed'               => '0',
                                        'IdMahasiswa'           => $__generate_npm,
                                        'UkuranJaket'           => $__data_pmbregistrasi__->UkuranJaket,
                                        'IdDosen'               => NULL,
                                        'TipeKelas'             => $__data_pmbregistrasi__->TipeKelas,
                                        'StatusMhs'             => 'AKTIF',
                                        'SkStatusMhs'           => NULL,
                                        'TglSkStatusMhs'        => NULL,
                                        'SmtNow'                => NULL,
                                        'NpmBaru'               => NULL,
                                        'NilaiSkripsi'          => NULL,
                                        'JudulSkripsi'          => NULL,
                                        'IdDosenSkripsi'        => NULL,
                                        'IdDosenSkripsi2'       => NULL,
                                        'IdDosenPenguji1'       => NULL,
                                        'IdDosenPenguji2'       => NULL,
                                        'IdDosenPenguji3'       => NULL,
                                        'TglMejaHijau'          => NULL,
                                        'TglLulusMh'            => NULL,
                                        'Bekerja'               => 'T',
                                        'AlamatKerja'           => $__data_pmbregistrasi__->AlamatKerja,
                                        'KecamatanKerja'        => $__data_pmbregistrasi__->KecamatanKerja,
                                        'KabupatenKerja'        => $__data_pmbregistrasi__->KabupatenKerja,
                                        'Hobi'                  => $__data_pmbregistrasi__->Hobi,
                                        'TglSkripsi2'           => NULL,
                                        'TglAccJudul'           => NULL,
                                        'NamaOutput'            => $this->__helpers->HurufBesar( $__data_pmbregistrasi__->Nama ),
                                        'ProdiAsal'             => $__session_user->NamaProdiAsal,
                                        'KdPtAsal'              => $__session_user->IdPtAsal,
                                        'KdProdiAsal'           => $__session_user->IdProdiAsal,
                                        'IdLembaga'             => NULL,
                                        'IdMkSkripsi'           => NULL,
                                        'KodePos'               => NULL,
                                        'IdWil'                 => $__data_pmbregistrasi__->IdKecamatan,
                                        'Universitas'           => $__data_pmbregistrasi__->Universitas,
                                        'Id_Reg_Pd'             => NULL,
                                        'Id_Pd'                 => NULL,
                                        'MingguKe'              => NULL,
                                        'HeaderMingguTotal'     => NULL,
                                        'BulanKe'               => NULL,
                                        'StatusMinggu'          => NULL,
                                        'StatusMahasiswa'       => 'AKTIF',
                                        'KetStatus'             => 'T',
                                        'ThnLulusMejaHijau'     => NULL,
                                        'MahasiswaKip'          => 'NONKIP',
                                        'ProdiAsal2'            => NULL,
                                    ];
                                    $__sql_insert_mahasiswa = $this->__Keuangan->__Insert_Mahasiswa__( $__insert_mahasiswa );
                                // ############# MAHASISWA ############# //


                                // ############# JURNAL PMB ############# //
                                    $__pmb_debet = [
                                        'Ref'           => $__generate_npm . "." . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                        'Tgl'           => $report['paymentDate'],
                                        'NoUrut'        => '1',
                                        'Ta'            => $__data_pmbregistrasi__->Ta,
                                        'Semester'      => $__data_pmbregistrasi__->Semester,
                                        'Npm'           => $__generate_npm,
                                        'Kode'          => '1-121.1',
                                        'Debet'         => $__data_biaya_pmb__->Biaya + 0,
                                        'Kredit'        => '',
                                        'Keterangan'    => 'Jurnal RPL PMB',
                                        'Status'        => 'I',
                                        'IdKampus'      => $__data_pmbregistrasi__->IdKampus,
                                        'Tabel'         => 'JurnalTTSementaraD',
                                        'UserId'        => $__data_pmbregistrasi__->Nama,
                                        'Bank'          => $__datas_bayar__->Bank,
                                    ];
                                    $__sql_pmb_debet = $this->__Keuangan->__Jurnal_Piutang__( $__pmb_debet );

                                    $__pmb_kredit = [
                                        'Ref'           => $__generate_npm . "." . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                        'Tgl'           => $report['paymentDate'],
                                        'NoUrut'        => '1',
                                        'Ta'            => $__data_pmbregistrasi__->Ta,
                                        'Semester'      => $__data_pmbregistrasi__->Semester,
                                        'Npm'           => $__generate_npm,
                                        'Kode'          => '3-110.1',
                                        'Debet'         => '',
                                        'Kredit'        => $__data_biaya_pmb__->Biaya + 0,
                                        'Keterangan'    => 'Jurnal RPL PMB',
                                        'Status'        => 'I',
                                        'IdKampus'      => $__data_pmbregistrasi__->IdKampus,
                                        'Tabel'         => 'JurnalTTSementaraD',
                                        'UserId'        => $__data_pmbregistrasi__->Nama,
                                        'Bank'          => $__datas_bayar__->Bank,
                                    ];
                                    $__sql_pmb_kredit = $this->__Keuangan->__Jurnal_Piutang__( $__pmb_kredit );
                                // ############# JURNAL PMB ############# //


                                // ############# JURNAL PENGELOLA ############# //
                                    // $__jurnal_pengelola__ = [
                                    //     'Ref'           => $__generate_npm ."." . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                    //     'Tgl'           => $report['paymentDate'],
                                    //     'NoUrut'        => '1',
                                    //     'Ta'            => $__data_pmbregistrasi__->Ta,
                                    //     'Semester'      => $__data_pmbregistrasi__->Semester,
                                    //     'Npm'           => $__generate_npm,
                                    //     'Kode'          => '1-121.1',
                                    //     'Debet'         => $__data_biaya_rpl__->Biaya,
                                    //     'Kredit'        => '',
                                    //     'Keterangan'    => 'Biaya Marketing dan Operasional',
                                    //     'Status'        => 'I',
                                    //     'IdKampus'      => $__data_pmbregistrasi__->IdKampus,
                                    //     'Tabel'         => 'JurnalTTSementaraD',
                                    //     'UserId'        => $__data_pmbregistrasi__->Nama,
                                    //     'Bank'          => $__datas_bayar__->Bank,
                                    // ];
                                    // $__sql_jurnal_pengelola__ = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_pengelola__ );

                                    $__jurnal_pengelola_kredit__ = [
                                        'Ref'           => $__generate_npm ."." . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                        'Tgl'           => $report['paymentDate'],
                                        'NoUrut'        => '1',
                                        'Ta'            => $__data_pmbregistrasi__->Ta,
                                        'Semester'      => $__data_pmbregistrasi__->Semester,
                                        'Npm'           => $__generate_npm,
                                        'Kode'          => '4-116.6',
                                        'Debet'         => '',
                                        'Kredit'        => $__data_biaya_rpl__->Biaya,
                                        'Keterangan'    => 'Biaya Marketing dan Operasional',
                                        'Status'        => 'I',
                                        'IdKampus'      => $__data_pmbregistrasi__->IdKampus,
                                        'Tabel'         => 'JurnalTTSementaraD',
                                        'UserId'        => $__data_pmbregistrasi__->Nama,
                                        'Bank'          => $__datas_bayar__->Bank,
                                    ];
                                    $__sql_jurnal_pengelola_kredit__ = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_pengelola_kredit__ );
                                // ############# JURNAL PENGELOLA ############# //


                                // ############# JURNAL AWAL ############# //
                                    $__jurnal_debet_awal = [
                                        'Ref'           => 'RPLO+' . $__session_user->Nomor ."." . $__session_user->Ta . '.1',
                                        'Tgl'           => $report['paymentDate'],
                                        'NoUrut'        => '1',
                                        'Ta'            => $__session_user->Ta,
                                        'Semester'      => '1',
                                        'Npm'           => $__session_user->Nomor,
                                        'Kode'          => $this->__Keuangan->__Nomor_Debet__()['Kode'],
                                        'Debet'         => $report['amount'],
                                        'Kredit'        => '',
                                        'Keterangan'    => 'Jurnal RPL - ' . $__session_user->Nomor,
                                        'Status'        => 'I',
                                        'IdKampus'      => $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'],
                                        'Tabel'         => $this->__Keuangan->__Nomor_Debet__()['Table'],
                                        'UserId'        => $__session_user->Nama,
                                        'Bank'          => $__datas_bayar__->Bank,
                                    ];
                                    $__jurnal_debet_awal = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_debet_awal );

                                    $__jurnal_kredit_awal = [
                                        'Ref'           => 'RPLO+' . $__session_user->Nomor ."." . $__session_user->Ta . '.1',
                                        'Tgl'           => $report['paymentDate'],
                                        'NoUrut'        => '1',
                                        'Ta'            => $__session_user->Ta,
                                        'Semester'      => '1',
                                        'Npm'           => $__session_user->Nomor,
                                        'Kode'          => $this->__Keuangan->__Nomor_Kredit__()['Kode1'],
                                        'Debet'         => '',
                                        'Kredit'        => $report['amount'],
                                        'Keterangan'    => 'Jurnal RPL - ' . $__session_user->Nomor,
                                        'Status'        => 'I',
                                        'IdKampus'      => $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'],
                                        'Tabel'         => $this->__Keuangan->__Nomor_Kredit__()['Table'],
                                        'UserId'        => $__session_user->Nama,
                                        'Bank'          => $__datas_bayar__->Bank,
                                    ];
                                    $__jurnal_kredit_awal = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_kredit_awal );
                                // ############# JURNAL AWAL ############# //

                                
                                // ############# JURNAL PIUTANG 1 ############# //
                                    // $__jurnal_debet_piutang1 = [
                                    //     'Npm'               => $__generate_npm,
                                    //     'Stambuk'           => $__data_pmbregistrasi__->Ta,
                                    //     'TipeKelas'         => $__data_pmbregistrasi__->TipeKelas,
                                    //     'Ta'                => $__data_pmbregistrasi__->Ta,
                                    //     'Semester'          => '1',
                                    //     'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                    //     'IdFakultas'        => $__data_pmbregistrasi__->IdFakultas,
                                    //     'Prodi'             => $__data_pmbregistrasi__->Prodi,
                                    //     'Bank'              => $__datas_bayar__->Bank,
                                    // ];
                                    // $__sql_debet_piutang1 = $this->__Keuangan->__Jurnal_Piutang_1__( $__jurnal_debet_piutang1 );
                                    $__jurnal_alokasibiayakuliah__ = $this->__db->query(" SELECT IdFakultas, ItemNo, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal, Stambuk, Prodi FROM AlokasiBiayaKuliah1 WHERE Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND IdFakultas = '". $__data_pmbregistrasi__->IdFakultas ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' ");

                                        foreach ( $__jurnal_alokasibiayakuliah__ AS $data => $__biayakuliah__ ) :

                                            $__jurnal_alokasibiaya__ = [
                                                'Ref'           => $__generate_npm . '.' . $__biayakuliah__->Ta . $__biayakuliah__->Semester,
                                                'Tgl'           => $report['paymentDate'],
                                                'NoUrut'        => $__biayakuliah__->ItemNo,
                                                'Ta'            => $__biayakuliah__->Ta,
                                                'Semester'      => $__biayakuliah__->Semester,
                                                'Npm'           => $__generate_npm,
                                                'Kode'          => $__biayakuliah__->AccPendapatan,
                                                'Debet'         => '0',
                                                'Kredit'        => $__biayakuliah__->Nominal,
                                                'Keterangan'    => $__biayakuliah__->Alokasi,
                                                'Status'        => 'I',
                                                'IdKampus'      => $__biayakuliah__->IdKampus,
                                                'Tabel'         => 'Jurnal',
                                                'UserId'        => $__data_pmbregistrasi__->Nama,
                                                'Bank'          => $__datas_bayar__->Bank,
                                            ];
                                            $__sql_alokasibiaya__ = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_alokasibiaya__ );

                                        endforeach;
                                // ############# JURNAL PIUTANG 1 ############# //


                                // ############### INSERT JURNAL PIUTANG 2 ############### //
                                    // $__insert_jurnalpiutang_2 = [
                                    //     'Npm'               => $__generate_npm,
                                    //     'Stambuk'           => $__data_pmbregistrasi__->Ta,
                                    //     'TipeKelas'         => $__data_pmbregistrasi__->TipeKelas,
                                    //     'Ta'                => $__data_pmbregistrasi__->Ta,
                                    //     'Semester'          => '1',
                                    //     'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                    //     'IdFakultas'        => $__data_pmbregistrasi__->IdFakultas,
                                    //     'Prodi'             => $__data_pmbregistrasi__->Prodi,
                                    //     'Bank'              => $__datas_bayar__->Bank,
                                    // ];
                                    // $__sql_jurnalpiutang_2 = $this->__Keuangan->__Insert_JurnalPiutang_2__( $__insert_jurnalpiutang_2 );
                                    $__jurnal_alokasiper__ = $this->__db->query(" SELECT IdFakultas, ItemNo, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal, Stambuk, Prodi FROM AlokasiPer1 WHERE Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND IdFakultas = '". $__data_pmbregistrasi__->IdFakultas ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' ");

                                        foreach ( $__jurnal_alokasiper__ AS $data => $__alokasiper__ ) :

                                            $__jurnal_alokasiper__ = [
                                                'Ref'           => $__generate_npm . '.' . $__alokasiper__->Ta . $__alokasiper__->Semester,
                                                'Tgl'           => $report['paymentDate'],
                                                'NoUrut'        => $__alokasiper__->ItemNo,
                                                'Ta'            => $__alokasiper__->Ta,
                                                'Semester'      => $__alokasiper__->Semester,
                                                'Npm'           => $__generate_npm,
                                                'Kode'          => $__alokasiper__->AccPendapatan,
                                                'Debet'         => '0',
                                                'Kredit'        => $__alokasiper__->Nominal,
                                                'Keterangan'    => $__alokasiper__->Alokasi,
                                                'Status'        => 'I',
                                                'IdKampus'      => $__alokasiper__->IdKampus,
                                                'Tabel'         => 'Jurnal',
                                                'UserId'        => $__data_pmbregistrasi__->Nama,
                                                'Bank'          => $__datas_bayar__->Bank,
                                            ];
                                            $__sql_alokasiper__ = $this->__Keuangan->__Jurnal_Piutang__( $__jurnal_alokasiper__ );

                                        endforeach;
                                // ############### INSERT JURNAL PIUTANG 2 ############### //


                                // ############### INSERT JURNAL PIUTANG 3 ############### //
                                    $__total_alokasibiayakuliah__ = $this->__db->queryid(" SELECT SUM(Nominal) AS Total FROM AlokasiBiayaKuliah1 WHERE Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND IdFakultas = '". $__data_pmbregistrasi__->IdFakultas ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' ");

                                    $__total_alokasiper__ = $this->__db->queryid(" SELECT SUM(Nominal) AS Total FROM AlokasiPer1 WHERE Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND IdFakultas = '". $__data_pmbregistrasi__->IdFakultas ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' ");

                                    $__total_all__ = $__total_alokasibiayakuliah__->Total + $__total_alokasiper__->Total + $__data_biaya_rpl__->Biaya + 0;

                                    $__insert_jurnalpiutang_3_total_debet = [
                                        'Ref'               => $__generate_npm . '.' . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                        'Tgl'               => $report['paymentDate'],
                                        'NoUrut'            => '1',
                                        'Ta'                => $__data_pmbregistrasi__->Ta,
                                        'Semester'          => $__data_pmbregistrasi__->Semester,
                                        'Npm'               => $__generate_npm,
                                        'Kode'              => $this->__Keuangan->__Nomor_Debet__()['Kode1'],
                                        'Debet'             => $__total_all__,
                                        'Kredit'            => '0',
                                        'Keterangan'        => 'Jurnal RPL - ' . $__generate_npm,
                                        'Status'            => 'I',
                                        'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                        'Tabel'             => $this->__Keuangan->__Nomor_Debet__()['Table'],
                                        'UserId'            => $__data_pmbregistrasi__->Nama,
                                        'Bank'              => $__datas_bayar__->Bank,
                                    ];
                                    $__sql_jurnalpiutang_3_total_debet = $this->__Keuangan->__Jurnal_Piutang__( $__insert_jurnalpiutang_3_total_debet );
                                // ############### INSERT JURNAL PIUTANG 3 ############### //


                                // ############# KRS MAHASISWA ############# //
                                    $__data_jadwalprimary__ = $this->__db->query(" SELECT A.IdPrimary AS Id, A.IdKampus, A.IdFakultas, A.Prodi, A.IdRuang, A.Ta, A.Semester, A.IdMk, A.IdDosen2, A.Kurikulum, A.JamMasuk, A.JamKeluar, A.Kelas, A.Sks, A.Hari, A.ItemNo, B.Matakuliah FROM JadwalPrimary A JOIN Matakuliah B ON A.IdMk = B.IdMk WHERE A.IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND A.IdFakultas = '". $__data_pmbregistrasi__->IdFakultas ."' AND A.Prodi = '". $__data_pmbregistrasi__->Prodi ."' AND A.Ta = '". $__data_pmbregistrasi__->Ta ."' AND A.Semester = '". $__data_pmbregistrasi__->Semester ."' AND A.Kurikulum = '". $__data_pmbregistrasi__->Kurikulum ."' AND A.Validasi = 'T' AND B.ProdiMatakuliah = '". $__data_pmbregistrasi__->Prodi ."' AND A.Kelas = '". $__data_kelas__->Kelas ."' ORDER BY A.IdMk DESC ");

                                        foreach ( $__data_jadwalprimary__ AS $data => $jadwalall_perulangan ) :

                                            $__insert_mhskrsjadwaldetail = [
                                                'Npm'           => $__generate_npm,
                                                'IdKampus'      => $jadwalall_perulangan->IdKampus,
                                                'IdFakultas'    => $jadwalall_perulangan->IdFakultas,
                                                'Prodi'         => $jadwalall_perulangan->Prodi,
                                                'Kurikulum'     => $jadwalall_perulangan->Kurikulum,
                                                'Ta'            => $jadwalall_perulangan->Ta,
                                                'Semester'      => $jadwalall_perulangan->Semester,
                                                'ItemNo'        => $jadwalall_perulangan->ItemNo,
                                                'Hari'          => $jadwalall_perulangan->Hari,
                                                'IdMk'          => $jadwalall_perulangan->IdMk,
                                                'IdRuang'       => $jadwalall_perulangan->IdRuang,
                                                'JamMasuk'      => $jadwalall_perulangan->JamMasuk,
                                                'JamKeluar'     => $jadwalall_perulangan->JamKeluar,
                                                'Sks'           => $jadwalall_perulangan->Sks,
                                                'Kelas'         => $jadwalall_perulangan->Kelas,
                                                'UserId'        => $__data_pmbregistrasi__->Nama,
                                                'Validasi'      => NULL,
                                            ];
                                            $__sql_insert_mhskrsjadwaldetail = $this->__Keuangan->__Insert_MhsKrsJadwalDetail__( $__insert_mhskrsjadwaldetail );


                                            $__insert_mhskrsdetail = [
                                                'Npm'           => $__generate_npm,
                                                'Ta'            => $jadwalall_perulangan->Ta,
                                                'Semester'      => $jadwalall_perulangan->Semester,
                                                'Kurikulum'     => $jadwalall_perulangan->Kurikulum,
                                                'IdKampus'      => $jadwalall_perulangan->IdKampus,
                                                'IdFakultas'    => $jadwalall_perulangan->IdFakultas,
                                                'Prodi'         => $jadwalall_perulangan->Prodi,
                                                'ItemNo'        => $jadwalall_perulangan->ItemNo,
                                                'IdMk'          => $jadwalall_perulangan->IdMk,
                                                'Sks'           => $jadwalall_perulangan->Sks,
                                                'UserId'        => $__data_pmbregistrasi__->Nama,
                                                'Universitas'   => $setting_lokasikampus,
                                            ];
                                            $__sql_insert_mhskrsdetail = $this->__Keuangan->__Insert_MhsKrsDetail__ ( $__insert_mhskrsdetail );

                                            // @$__insert_mhskrsdetaillog = [
                                            //     'Npm'           => @$__generate_npm,
                                            //     'Ta'            => @$jadwalall_perulangan->Ta,
                                            //     'Semester'      => @$jadwalall_perulangan->Semester,
                                            //     'Kurikulum'     => @$jadwalall_perulangan->Kurikulum,
                                            //     'IdKampus'      => @$jadwalall_perulangan->IdKampus,
                                            //     'IdFakultas'    => @$jadwalall_perulangan->IdFakultas,
                                            //     'Prodi'         => @$jadwalall_perulangan->Prodi,
                                            //     'ItemNo'        => @$jadwalall_perulangan->ItemNo,
                                            //     'IdMk'          => @$jadwalall_perulangan->IdMk,
                                            //     'Sks'           => @$jadwalall_perulangan->Sks,
                                            //     'UserId'        => HurufBesar( @$__data_pmbregistrasi__->Nama ),
                                            //     'LogUpdate'     => date('Y-m-d H:i:s'),
                                            // ];

                                            // @$__query_insert_mhskrsdetaillog = __Query_Insert_MhsKrsDetailLog ( @$connection, @$__insert_mhskrsdetaillog );

                                            // if ( @$__query_insert_mhskrsdetaillog != '200' ) {

                                            //     @$__query_insert_mhskrsdetaillog;

                                            // }

                                        endforeach;

                                    $__insert_krsdetail = [
                                        'Npm'           => $__generate_npm,
                                        'IdKampus'      => $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'],
                                        'IdFakultas'    => $__data_pmbregistrasi__->IdFakultas,
                                        'Ta'            => $__data_pmbregistrasi__->Ta,
                                        'Semester'      => $__data_pmbregistrasi__->Semester,
                                    ];
                                    $__sql_insert_krsdetaill = $this->__Keuangan->__Insert_KrsDetail__( $__insert_krsdetail );
                                // ############# KRS MAHASISWA ############# //

                                
                                // ############### INSERT MAHASISWA KRS TEMP ############### //
                                    // @$__get_data_jadwalall_totalsks = queryid (" SELECT SUM( Sks ) AS Total FROM ALLJADWAL WHERE KELAS IN (SELECT SKK.Kelas FROM SettingKuotaKelas SKK LEFT OUTER JOIN SISAKUOTAPMB SP ON SKK.Kelas = SP.Kelas AND SKK.TA = SP.TA AND SKK.Prodi = SP.Prodi AND SKK.TipeKelas = SP.TipeKelas  AND SKK.JamKelas=SP.JamKelas WHERE SKK.Deleted = 0 AND SKK.TA = '". @$__session_user->Ta ."' AND SKK.Prodi = '". @$__session_user->Prodi ."' AND SKK.Jamkelas = '". @$__session_user->Kelas ."' AND SKK.TipeKelas = '". @$__tipe_kelas ."' AND SKK.MAXKUOTA-ISNULL(SP.JlhMhs,0) > 0) AND IDMK IN (SELECT IDMK FROM MATAKULIAH WHERE PRODIMATAKULIAH = '". @$__session_user->Prodi ."') AND SEMESTER = 1 AND TA = '". @$__session_user->Ta ."' AND PRODI= '". @$__session_user->Prodi ."' AND IDKAMPUS = '". @$__session_user->IdKampus ."' AND Kurikulum = '". @$__session_user->Kurikulum ."' AND KELAS = '". @$__get_data_kelas->Kelas ."' ");

                                    // @$__insert_mhskrstemp = [
                                    //     'Npm'               => @$__generate_npm,
                                    //     'Tgl'               => NULL,
                                    //     'Ta'                => @$__session_user->Ta,
                                    //     'Semester'          => '1',
                                    //     'NoReferensi'       => NULL,
                                    //     'IdKampus'          => @$__session_user->IdKampus,
                                    //     'IdFakultas'        => @$__session_user->IdFakultas,
                                    //     'Prodi'             => @$__session_user->Prodi,
                                    //     'Kurikulum'         => @$__session_user->Kurikulum,
                                    //     'Total'             => NULL,
                                    //     'MaxSks'            => NULL,
                                    //     'TotalSks'          => @$__get_data_jadwalall_totalsks->Total,
                                    //     'UserId'            => HurufBesar( @$__session_user->Nama ),
                                    //     'TaSmtNpm'          => @$__generate_npm . @$__session_user->Ta . '1',
                                    // ];
                                    // @$__query_insert_mhskrstemp = __Query_Insert_MhsKrsTemp ( @$connection, @$__insert_mhskrstemp );
                                // ############### INSERT MAHASISWA KRS TEMP ############### //

                            
                                // ############### INSERT MAHASISWA KRS TEMP SPP ############### //
                                    // @$__session_alokasiper1_lunas = query (" SELECT IdFakultas, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal, Stambuk, Prodi FROM AlokasiPer1 WHERE Ta = '". @$__session_user->Ta ."' AND Semester = '1' AND TipeKelas = '". @$__tipe_kelas ."' AND IdKampus = '". @$__session_user->IdKampus ."' AND Stambuk = '". @$__session_user->Ta ."' AND Prodi = '". @$__session_user->Prodi ."' ORDER BY Nominal ASC ");

                                    //     foreach ( $__session_alokasiper1_lunas AS $data => $__alokasiper1_lunas ) :

                                    //         @$__insert_mhskrstempspp = [
                                    //             'Npm'               => @$__generate_npm,
                                    //             'Ta'                => @$__alokasiper1_lunas->Ta,
                                    //             'Semester'          => '1',
                                    //             'IdKampus'          => @$__alokasiper1_lunas->IdKampus,
                                    //             'IdFakultas'        => @$__alokasiper1_lunas->IdFakultas,
                                    //             'Prodi'             => @$__alokasiper1_lunas->Prodi,
                                    //             'TipeKelas'         => @$__alokasiper1_lunas->TipeKelas,
                                    //             'ItemNo'            => '1',
                                    //             'Alokasi'           => @$__alokasiper1_lunas->Alokasi,
                                    //             'Biaya'             => @$__alokasiper1_lunas->Nominal,
                                    //             'UserId'            => @$__generate_npm,
                                    //         ];

                                    //         @$__query_insert_mhskrstempspp = __Query_Insert_MhsKrsTempSpp ( @$connection, @$__insert_mhskrstempspp );
                                            
                                    //         if ( @$__query_insert_mhskrstempspp != '200' ) {

                                    //             @$__query_insert_mhskrstempspp;

                                    //         }

                                    //     endforeach;
                                // ############### INSERT MAHASISWA KRS TEMP SPP ############### //


                                // ############### INSERT KRS ALOKASI BIAYA KULIAH ############### //
                                    $__session_alokasibiayakuliah1 = $this->__db->query(" SELECT IdFakultas, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal, Aktif, Cuti, Reaktivasi, Stambuk, Prodi FROM AlokasiBiayaKuliah1 WHERE Ta = '". $__session_user->Ta ."' AND Semester = '". $__session_user->Semester ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND Stambuk = '". $__session_user->Ta ."' AND Prodi = '". $__session_user->Prodi ."'ORDER BY Nominal ASC ");

                                        foreach ( $__session_alokasibiayakuliah1 AS $data => $__alokasibiayakuliah1 ) :

                                            $__insert_krsalokasibiayakuliah = [
                                                'Npm'               => $__generate_npm,
                                                'Ta'                => $__alokasibiayakuliah1->Ta,
                                                'Semester'          => '1',
                                                'Kurikulum'         => $__session_user->Kurikulum,
                                                'IdKampus'          => $__alokasibiayakuliah1->IdKampus,
                                                'IdFakultas'        => $__alokasibiayakuliah1->IdFakultas,
                                                'Prodi'             => $__alokasibiayakuliah1->Prodi,
                                                'ItemNo'            => '1',
                                                'Alokasi'           => $__alokasibiayakuliah1->Alokasi,
                                                'AccountPendapatan' => $__alokasibiayakuliah1->AccPendapatan,
                                                'AccDebet'          => $__alokasibiayakuliah1->AccDebet,
                                                'Jumlah'            => $__alokasibiayakuliah1->Nominal,
                                                'UserId'            => $__generate_npm,
                                            ];
                                            $__sql_insert_krsalokasibiayakuliah = $this->__Keuangan->__Insert_KrsAlokasiBiayaKuliah__ ( $__insert_krsalokasibiayakuliah );
                                            
                                        endforeach;
                                // ############### INSERT KRS ALOKASI BIAYA KULIAH ############### //


                                // ############### INSERT MAHASSIWA KRS TEMP SPP 2 ############### //
                                    $__insert_mhskrstempspp_2 = [
                                        'Npm'               => $__generate_npm,
                                        'Ta'                => $__data_pmbregistrasi__->Ta,
                                        'Semester'          => '1',
                                        'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                        'IdFakultas'        => $__data_pmbregistrasi__->IdFakultas,
                                        'Prodi'             => $__data_pmbregistrasi__->Prodi,
                                        'TipeKelas'         => $__data_pmbregistrasi__->TipeKelas,
                                        'Stambuk'           => $__data_pmbregistrasi__->Ta,
                                        'Bank'              => $__datas_bayar__->Bank,
                                    ];
                                    $__sql_mhskrstempspp_2 = $this->__Keuangan->__Insert_MhsKrsTempSpp__( $__insert_mhskrstempspp_2 );
                                // ############### INSERT MAHASSIWA KRS TEMP SPP 2 ############### //


                                // ############### INSERT KRS ALOKASI PER ############### //
                                    $__insert_krsalokasiper = [
                                        'Npm'               => $__generate_npm,
                                        'Ta'                => $__data_pmbregistrasi__->Ta,
                                        'Semester'          => '1',
                                        'Kurikulum'         => $__data_pmbregistrasi__->Kurikulum,
                                        'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                        'IdFakultas'        => $__data_pmbregistrasi__->IdFakultas,
                                        'Prodi'             => $__data_pmbregistrasi__->Prodi,
                                        'TipeKelas'         => $__data_pmbregistrasi__->TipeKelas,
                                        'Stambuk'           => $__data_pmbregistrasi__->Ta,
                                        'Bank'              => $__datas_bayar__->Bank,
                                    ];
                                    $__sql_krsalokasiper = $this->__Keuangan->__Insert_KrsAlokasiPer__( $__insert_krsalokasiper );
                                // ############### INSERT KRS ALOKASI PER ############### //


                                // ############### INSERT SPP TRANS BPP ############### //
                                    $__data_alokasi_biaya_kuliah1_bpp = $this->__db->queryid(" SELECT AccPendapatan, AccDebet, Nominal, Alokasi FROM AlokasiBiayaKuliah1 WHERE Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND IdFakultas  = '". $__data_pmbregistrasi__->IdFakultas ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' AND Alokasi = 'BPP' ");

                                        if ( $__data_alokasi_biaya_kuliah1_bpp->Alokasi == 'BPP' ) {

                                            $__data_alokasi_biaya_kuliah1_bpp_itemnokodetrans = $this->__db->queryid(" SELECT TOP 1 ItemNo, KodeTrans, KeteranganPembayaran, Account, Jenis, Nama FROM BiayaKuliahLinkRek WHERE Jenis = 'BPP' ORDER BY ItemNo DESC ");

                                            $__insert_spptrans_bpp = [
                                                'NoTT'              => $__data_pmbregistrasi__->IdKampus . '.T.' . $tgl_reportstr . '.' . $report['tellerid'] . '.' . $__datas_bayar__->CustCode,
                                                'NoBuktiBank'       => 'T.' . $tgl_reportstr . '.' . $report['tellerid'] . '.' . $__datas_bayar__->CustCode,
                                                'Npm'               => $__generate_npm, 
                                                'Tgl'               => $report['paymentDate'],
                                                'ItemNo'            => $__data_alokasi_biaya_kuliah1_bpp_itemnokodetrans->ItemNo, 
                                                'KodeTrans'         => $__data_alokasi_biaya_kuliah1_bpp_itemnokodetrans->KodeTrans, 
                                                'Jumlah'            => $__data_alokasi_biaya_kuliah1_bpp->Nominal + 0, 
                                                'UserId'            => $__generate_npm,
                                            ];
                                            $__sql_spptrans_bpp = $this->__Keuangan->__Insert_Spptrans__( $__insert_spptrans_bpp );

                                        }

                                    $__data_alokasi_per_1 = $this->__db->query(" SELECT AccPendapatan, AccDebet, Nominal, Alokasi FROM AlokasiPer1 WHERE Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND IdFakultas  = '". $__data_pmbregistrasi__->IdFakultas ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' ");

                                        if ( $__data_alokasi_per_1 == TRUE ) {

                                            foreach ( $__data_alokasi_per_1 AS $data => $alokasi_per_1 ) :

                                                $__data_alokasi_per_1_itemnokodetrans = $this->__db->queryid(" SELECT TOP 1 ItemNo, KodeTrans, KeteranganPembayaran, Account, Jenis, Nama FROM BiayaKuliahLinkRek WHERE Jenis = '". $alokasi_per_1->Alokasi ."' ORDER BY ItemNo DESC ");

                                                $__insert_spptrans_jaket = [
                                                    'NoTT'              => $__data_pmbregistrasi__->IdKampus . '.T.' . $tgl_reportstr . '.' . $report['tellerid'] . '.' . $__datas_bayar__->CustCode,
                                                    'NoBuktiBank'       => 'T.' . $tgl_reportstr . '.' . $report['tellerid'] . '.' . $__datas_bayar__->CustCode,
                                                    'Npm'               => $__generate_npm, 
                                                    'Tgl'               => $report['paymentDate'],
                                                    'ItemNo'            => $__data_alokasi_per_1_itemnokodetrans->ItemNo, 
                                                    'KodeTrans'         => $__data_alokasi_per_1_itemnokodetrans->KodeTrans,  
                                                    'Jumlah'            => $alokasi_per_1->Nominal + 0, 
                                                    'UserId'            => $__generate_npm,
                                                ];
                                                $__sql_spptrans_jaket = $this->__Keuangan->__Insert_Spptrans__( $__insert_spptrans_jaket );

                                            endforeach;

                                        }
                                // ############### INSERT SPP TRANS BPU ############### //


                                // ############### INSERT TTBUKTISETORAN ############### //'
                                    $__data_alokasibiayakuliah1_bpp = $this->__db->queryid(" SELECT Nominal AS Total FROM AlokasiBiayaKuliah1 WHERE Ta = '". $__data_pmbregistrasi__->Ta ."' AND Semester = '1' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' AND Alokasi = 'BPP' ORDER BY Nominal ASC ");

                                        if ( $__datas_bayar__->JenisBayar == 'Full' ) {
                                            $__data_alokasibiayakuliah1_bpp_get = $__data_alokasibiayakuliah1_bpp->Total + 0;
                                        } else {
                                            $__data_alokasibiayakuliah1_bpp_get = $__json_bayar__['Alokasi'] + 0;
                                        }

                                    
                                    $__data_alokasiper1_jaket = $this->__db->queryid(" SELECT Nominal AS Total FROM AlokasiPer1 WHERE Ta = '". $__data_pmbregistrasi__->Ta ."' AND Semester = '1' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' AND Alokasi = 'JAKET' ORDER BY Nominal ASC ");
                                        
                                        $__data_alokasiper1_jaket_get = $__data_alokasiper1_jaket->Total + 0;


                                    $__data_alokasiper1_kemahasiswaan = $this->__db->queryid(" SELECT Nominal AS Total FROM AlokasiPer1 WHERE Ta = '". $__data_pmbregistrasi__->Ta ."' AND Semester = '1' AND TipeKelas = '". $__data_pmbregistrasi__->TipeKelas ."' AND IdKampus = '". $__data_pmbregistrasi__->IdKampus ."' AND Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND Prodi = '". $__data_pmbregistrasi__->Prodi ."' AND Alokasi = 'KEMAHASISWAAN' ORDER BY Nominal ASC ");
                                        
                                        $__data_alokasiper1_kemahasiswaan_get = $__data_alokasiper1_kemahasiswaan->Total + 0;


                                        if ( $__data_pmbregistrasi__->BiayaDaftar > '0' ) {
                                            $__kurang_pmb = '300000';
                                        } else {
                                            $__kurang_pmb = '300000';
                                        }


                                    $__insert_ttbuktisetoran = [
                                        'NoBuktiBank'                   => 'T.' . $tgl_reportstr . '.' . $report['tellerid'] . '.' . $__datas_bayar__->CustCode,
                                        'NoTT'                          => $__data_pmbregistrasi__->IdKampus . '.T.' . $tgl_reportstr . '.' . $report['tellerid'] . '.' . $__datas_bayar__->CustCode,
                                        'Npm'                           => $__generate_npm,
                                        'Tgl'                           => $report['paymentDate'],
                                        'TglSetor'                      => $report['paymentDate'],
                                        'Bank'                          => $__datas_bayar__->Bank,
                                        'Jumlah'                        => '',
                                        'AccBank'                       => '1-112.16',
                                        'UserId'                        => $__data_pmbregistrasi__->Nama,
                                        'InputDate'                     => $report['paymentDate'],
                                        'LastUpdate'                    => $report['paymentDate'],
                                        'UpdateUserId'                  => $__data_pmbregistrasi__->Nama,
                                        'Printed'                       => '1',
                                        'SksDiambil'                    => '',
                                        'Semester'                      => '1',
                                        'Ta'                            => $__data_pmbregistrasi__->Ta,
                                        'Kurikulum'                     => $__data_pmbregistrasi__->Kurikulum,
                                        'Prodi'                         => $__data_pmbregistrasi__->Prodi,
                                        'IdFakultas'                    => $__data_pmbregistrasi__->IdFakultas,
                                        'Beasiswa'                      => $sysbol->Beasiswa,
                                        'NoVoucher'                     => '',
                                        'TglVoucher'                    => '',
                                        'JumlahSetor'                   => $report['amount'] - $__kurang_pmb,
                                        'AccDebet'                      => '',
                                        'AccKredit'                     => '',
                                        'NoSeri'                        => $report['no_rek'],
                                        'JumlahCash'                    => '',
                                        'JumlahVoucher'                 => '',
                                        'Keterangan'                    => $__datas_bayar__->Keterangan,
                                        'Idk'                           => $__data_pmbregistrasi__->IdKampus,
                                        'DiscCash'                      => '',
                                        'DiscBank'                      => '',
                                        'JumlahRedeemVoucher'           => '',
                                        'Discount'                      => $__datas_bayar__->Diskon,
                                        'BayarPiutangSks'               => '',
                                        'BayarPiutangBpp'               => $__data_alokasibiayakuliah1_bpp_get,
                                        'BayarPiutangBpu'               => '',
                                        'BayarPiutangKemahasiswaan'     => $__data_alokasiper1_kemahasiswaan_get,
                                        'BayarPiutangJacket'            => $__data_alokasiper1_jaket_get,
                                        'BayarPiutangKtm'               => '',
                                        'BayarPiutangLeges'             => '',
                                        'BayarPiutangLain'              => '',
                                        'BayarPiutangWisuda'            => '',
                                        'BayarPiutangPkl'               => '',
                                        'BayarPiutangMejaHijau'         => '',
                                        'BayarPiutangUjian'             => '',
                                        'BayarPiutangCuti'              => '',
                                    ];
                                    $__sql_insert_ttbuktisetoran = $this->__Keuangan->__Insert_TtBuktiSetoran__( $__insert_ttbuktisetoran );
                                // ############### INSERT TTBUKTISETORAN ############### //


                                // ############### INSERT KRS MAHASISWA ############### //
                                    $__data_cek_npm_krs = $this->__db->queryrow(" SELECT Npm FROM Krs WHERE Npm = '". $__generate_npm ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND Semester = '1' ");

                                    if ( $__data_cek_npm_krs == FALSE ) {

                                        if ( $__datas_bayar__->JenisBayar == 'Full' ) {
                                            $__data_persen_get = '100';
                                        } else {
                                            $__data_persen_get = $__json_bayar__['Persen'];
                                        }

                                        $__data_krs_sks_total = $this->__db->queryid(" SELECT SUM(Sks) AS Total_Sks FROM KrsDetail WHERE Npm = '". $__generate_npm ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND Semester = '1' ");

                                        $__insert_krs_mahasiswa = [
                                            'Npm'                   => $__generate_npm,
                                            'Tgl'                   => date('Y-m-d') . ' 00:00:00.000',
                                            'Ta'                    => $__data_pmbregistrasi__->Ta,
                                            'Semester'              => '1',
                                            'NoReferensi'           => $__data_pmbregistrasi__->Ta . '.' . $report['tellerid'],
                                            'IdKampus'              => $__data_pmbregistrasi__->IdKampus,
                                            'IdFakultas'            => $__data_pmbregistrasi__->IdFakultas,
                                            'Prodi'                 => $__data_pmbregistrasi__->Prodi,
                                            'Kurikulum'             => $__data_pmbregistrasi__->Kurikulum,
                                            'Total'                 => $__datas_bayar__->Nominal,
                                            'MaxSks'                => '24',
                                            'TotalSks'              => $__data_krs_sks_total->Total_Sks,
                                            'TotalSksAdjust'        => '0',
                                            'PerSks'                => '0',
                                            'TotalSpp'              => $report['amount'], 
                                            'SksPaket'              => '',
                                            'SksOptional'           => '',
                                            'IdDosen'               => '',
                                            'JenisKrs'              => '',
                                            'BiayaKk'               => '',
                                            'ChkExtra'              => '',
                                            'UangUjian'             => '0',
                                            'Cuti'                  => '',
                                            'TipeKelas'             => $__data_pmbregistrasi__->TipeKelas,
                                            'StatusMhs'             => 'Aktif',
                                            'Sks_Kumulatif'         => $__data_krs_sks_total->Total_Sks,
                                            'Ip_Kumulatif'          => '0',
                                            'KrsKe'                 => '1',
                                            'DiscountKrs'           => $__datas_bayar__->Diskon,
                                            'PiutangSks'            => '',
                                            'PiutangBpu'            => '',
                                            'PiutangBpp'            => $__data_alokasibiayakuliah1_bpp->Total + 0,
                                            'PiutangKemahasiswaan'  => $__data_alokasiper1_kemahasiswaan->Total + 0,
                                            'PiutangJacket'         => $__data_alokasiper1_jaket->Total + 0,
                                            'PiutangKtm'            => '',
                                            'PiutangLeges'          => '',
                                            'PiutangLain'           => '',
                                            'PiutangWisuda'         => '',
                                            'PiutangPkl'            => '',
                                            'PiutangMejaHijau'      => '',
                                            'PiutangUjian'          => '',
                                            'BayarPiutangSks'       => '',
                                            'BayarPiutangBpu'       => '',
                                            'BayarPiutangBpp'       => $__data_alokasibiayakuliah1_bpp_get, 
                                            'BayarPiutangKemahasiswaan' => $__data_alokasiper1_kemahasiswaan_get,
                                            'BayarPiutangJacket'    => $__data_alokasiper1_jaket_get,
                                            'BayarPiutangKtm'       => '',
                                            'BayarPiutangLeges'     => '',
                                            'BayarPiutangLain'      => '',
                                            'BayarPiutangWisuda'    => '',
                                            'BayarPiutangPkl'       => '',
                                            'BayarPiutangMejaHijau' => '',
                                            'BayarPiutangUjian'     => '',
                                            'JumlahSetor'           => $report['amount'], 
                                            'JumlahCash'            => '',
                                            'JumlahVoucher'         => '',
                                            'DiscCash'              => '',
                                            'DiscBank'              => '',
                                            'JumlahRedeemVoucher'   => '',
                                            'Discount'              => '0',
                                            'IpMhs'                 => '0',
                                            'AccountDiscount'       => '',
                                            'StatusPersen'          => $__data_persen_get,
                                            'PiutangUs'             => '',
                                            'BayarPiutangUs'        => '',
                                            'PiutangUpn'            => '',
                                            'BayarPiutangUpn'       => '',
                                            'PiutangDiksar'         => '',
                                            'BayarDiksar'           => '',
                                        ];
                                        $__sql_krs_mahasiswa = $this->__Keuangan->__Insert_Krs__( $__insert_krs_mahasiswa );
                                    }
                                // ############### INSERT KRS MAHASISWA ############### //


                                // ############# UPDATE BANK PEMBAYARAN ############# //
                                    $__update_pembayaran = [
                                        'Y'                         => 'Y',
                                        'TanggalBayar_Bri_Bayar'    => $report['paymentDate'],
                                        'User_Bri_Bayar'            => $this->__helpers->HurufBesar( $__session_user->Nama ),
                                        'Log_Bri_Bayar'             => $report['paymentDate'],
                                        'Id_Bri_Bayar'              => $__datas_bayar__->Id,
                                        'UserId_Bri_Bayar'          => $__session_user->Id,
                                        'Ta_Bri_Bayar'              => $__datas_bayar__->Ta,
                                        'Semester_Bri_Bayar'        => $__datas_bayar__->Semester,
                                        'CustCode_Bri_Bayar'        => $report['custCode'],
                                        'StatusBayar_Bri_Bayar'     => 'N',
                                        'Data'                      => 'Y',
                                    ];
                                    $__update_bri_bayar = $this->__Keuangan->__Success_Bri_Bayar__( $__update_pembayaran );
                                // ############# UPDATE BANK PEMBAYARAN ############# //


                                // ############# KRSM DAN KRSMPRIMARY ############# //
                                    $__data_konversi_mk__ = $this->__db->query(" SELECT DISTINCT A.IdMk_Pilih_Rpl_Assesor_2 AS IdMk, A.Matakuliah_Pilih_Rpl_Assesor_2 AS Mk, A.Sks_Pilih_Rpl_Assesor_2 AS Sks, B.IdMk_Rpl_Assesor_1 AS IdMk_Asal, B.Matakuliah_Rpl_Assesor_1 AS Mk_Asal, B.Sks_Rpl_Assesor_1 AS Sks_Asal, B.Huruf_Rpl_Assesor_1 AS Huruf, B.Nilai_Rpl_Assesor_1 AS Nilai FROM Tbl_Rpl_Assesor_2 A LEFT JOIN Tbl_Rpl_Assesor_1 B ON A.IdMk_Asal_Rpl_Assesor_2 = B.IdMk_Rpl_Assesor_1 WHERE A.Id_Rpl_Pendaftaran = '". $__session_user->Id ."' AND A.Ta_Rpl_Assesor_2 = '". $__session_user->Ta ."' AND A.Semester_Rpl_Assesor_2 = '". $__session_user->Semester ."' AND A.Prodi_Rpl_Assesor_2 = '". $__session_user->Prodi ."' AND A.Data = 'Y' AND A.Kampus = '". $__session_user->Kampus ."' AND B.Id_Rpl_Pendaftaran = '". $__session_user->Id ."' AND B.Ta_Rpl_Assesor_1 = '". $__session_user->Ta ."' AND B.Semester_Rpl_Assesor_1  = '". $__session_user->Semester ."' AND B.Prodi_Rpl_Assesor_1 = '". $__session_user->Prodi ."' AND B.Data = 'Y' AND B.Kampus = '". $__session_user->Kampus ."' ");
                                    
                                        if ( @$__data_konversi_mk__ == TRUE ) {

                                            foreach ( $__data_konversi_mk__ AS $data => $__konversi_mk__ ) {

                                                $__nomor = '0';
                                                $__datas_krsm = [
                                                    'Npm'               => $__generate_npm, 
                                                    'TglKrs'            => date('Y-m-d H:i:s'),
                                                    'Semester'          => $__session_user->Semester,
                                                    'Prodi'             => $__session_user->Prodi,
                                                    'Ta'                => $__session_user->Ta,
                                                    'Kurikulum'         => $__session_user->Kurikulum,
                                                    'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                                    'ItemNo'            => $__nomor++,
                                                    'IdMk'              => $__konversi_mk__->IdMk,
                                                    'Sks'               => $__konversi_mk__->Sks,
                                                    'NilaiAkhir'        => $__konversi_mk__->Huruf,
                                                    'DetailNilaiAkhir'  => $__konversi_mk__->Nilai,
                                                    'UserId'            => $__session_user->Nama,
                                                    'NilaiAwal'         => $__konversi_mk__->Huruf,
                                                    'IdMkAsal'          => $__konversi_mk__->IdMk_Asal,
                                                    'SksAsal'           => $__konversi_mk__->Sks_Asal,
                                                    'IdKampusAsal'      => $__session_user->IdPtAsal,
                                                    'ProdiAsal'         => $__session_user->IdProdiAsal,
                                                    'HasilPengakuan'    => 'Di Akui Lansung',
                                                    'StatusKonversi'    => 'F',
                                                    'Keterangan'        => 'CRUD',
                                                    'JumlahBobotNilai'  => '',
                                                    'Universitas'       => $__session_user->Kampus,
                                                ];

                                                $__sql_krsm = $this->__db->prepare( 
                                                    "
                                                        INSERT INTO Krsm
                                                        (
                                                            Npm, TglKrs, Semester, Prodi, Ta, Kurikulum, IdKampus, ItemNo, IdMk, Sks, NilaiAkhir, DetailNilaiAkhir, UserId, NilaiAwal, IdMkAsal, SksAsal, IdKampusAsal, ProdiAsal, HasilPengakuan, StatusKonversi, Keterangan, JumlahBobotNilai, Universitas
                                                        )
                                                        VALUES
                                                        (
                                                            :Npm, :TglKrs, :Semester, :Prodi, :Ta, :Kurikulum, :IdKampus, :ItemNo, :IdMk, :Sks, :NilaiAkhir, :DetailNilaiAkhir, :UserId, :NilaiAwal, :IdMkAsal, :SksAsal, :IdKampusAsal, :ProdiAsal, :HasilPengakuan, :StatusKonversi, :Keterangan, :JumlahBobotNilai, :Universitas
                                                        )
                                                    "
                                                )->execute( $__datas_krsm );

                                                $__datas_krsm_primary = [
                                                    'Npm'               => $__generate_npm, 
                                                    'TglKrs'            => date('Y-m-d H:i:s'),
                                                    'Semester'          => $__session_user->Semester,
                                                    'Prodi'             => $__session_user->Prodi,
                                                    'Ta'                => $__session_user->Ta,
                                                    'Kurikulum'         => $__session_user->Kurikulum,
                                                    'IdKampus'          => $__data_pmbregistrasi__->IdKampus,
                                                    'ItemNo'            => $__nomor++,
                                                    'IdMk'              => $__konversi_mk__->IdMk,
                                                    'MataKuliah'        => $__konversi_mk__->Mk,
                                                    'Sks'               => $__konversi_mk__->Sks,
                                                    'NilaiAkhir'        => $__konversi_mk__->Huruf,
                                                    'DetailNilaiAkhir'  => $__konversi_mk__->Nilai,
                                                    'UserId'            => $__session_user->Nama,
                                                    'NilaiAwal'         => $__konversi_mk__->Huruf,
                                                    'IdMkAsal'          => $__konversi_mk__->IdMk_Asal,
                                                    'MataKuliahAsal'    => $__konversi_mk__->Mk_Asal,
                                                    'SksAsal'           => $__konversi_mk__->Sks_Asal,
                                                    'IdKampusAsal'      => $__session_user->IdPtAsal,
                                                    'ProdiAsal'         => $__session_user->IdProdiAsal,
                                                    'HasilPengakuan'    => 'Di Akui Lansung',
                                                    'StatusKonversi'    => 'F',
                                                    'Keterangan'        => 'CRUD',
                                                    'Universitas'       => $__session_user->Kampus,
                                                    'IdMkPrimary'       => '',
                                                ];

                                                $__sql_krsm_primary = $this->__db->prepare( 
                                                    "
                                                        INSERT INTO KrsmPrimary
                                                        (
                                                            Npm, TglKrs, Semester, Prodi, Ta, Kurikulum, IdKampus, ItemNo, IdMk, MataKuliah, Sks, NilaiAkhir, DetailNilaiAkhir, UserId, NilaiAwal, IdMkAsal, MataKuliahAsal, SksAsal, IdKampusAsal, ProdiAsal, HasilPengakuan, StatusKonversi, Keterangan, Universitas, IdMkPrimary
                                                        )
                                                        VALUES
                                                        (
                                                            :Npm, :TglKrs, :Semester, :Prodi, :Ta, :Kurikulum, :IdKampus, :ItemNo, :IdMk, :MataKuliah, :Sks, :NilaiAkhir, :DetailNilaiAkhir, :UserId, :NilaiAwal, :IdMkAsal, :MataKuliahAsal, :SksAsal, :IdKampusAsal, :ProdiAsal, :HasilPengakuan, :StatusKonversi, :Keterangan, :Universitas, :IdMkPrimary
                                                        )
                                                    "
                                                )->execute( $__datas_krsm_primary );

                                            }

                                        }
                                // ############# KRSM DAN KRSMPRIMARY ############# //  


                                // ############# PEMBAYARAN UANG RPL ############# //  
                                    $__koordinator__ = $this->__helpers->prosesKoordinator($__session_user->NamaReferensi);
                                    $__session_rpl__ = [
                                        'Npm'               => $__generate_npm,
                                        'Tgl_Bayar'         => $report['paymentDate'],
                                        // 'Kordinator'        => $__session_user->Referensi . ' - ' . $__session_user->NamaReferensi,
                                        'Kordinator'        => $__koordinator__,
                                        'Bank'              => $__datas_bayar__->Bank,
                                        'Persen'            => '100',
                                        'TipeKelas'         => __Aplikasi()['Tujuan'],
                                    ];
                                    $__sql_rpl = $this->__db->prepare( 
                                        "
                                            INSERT INTO rpl_pembayaran_uang_kul
                                            (
                                                Npm,
                                                Tgl_Bayar,
                                                Kordinator,
                                                Bank,
                                                Persen,
                                                TipeKelas
                                            )
                                            VALUES
                                            (
                                                :Npm,
                                                :Tgl_Bayar,
                                                :Kordinator,
                                                :Bank,
                                                :Persen,
                                                :TipeKelas
                                            )
                                        "
                                    )->execute( $__session_rpl__ );
                                // ############# PEMBAYARAN UANG RPL ############# //  



                                // ############# JURNAL DISKON ############# //
                                    if ( $__datas_bayar__->Diskon == TRUE && $__datas_bayar__->Diskon > '0' ) {

                                        $__pmb_debet = [
                                            'Ref'           => $__generate_npm . "." . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                            'Tgl'           => $report['paymentDate'],
                                            'NoUrut'        => '1',
                                            'Ta'            => $__data_pmbregistrasi__->Ta,
                                            'Semester'      => $__data_pmbregistrasi__->Semester,
                                            'Npm'           => $__generate_npm,
                                            'Kode'          => $this->__Keuangan->__Nomor_Debet__()['Diskon'],
                                            'Debet'         => $__datas_bayar__->Diskon + 0,
                                            'Kredit'        => '',
                                            'Keterangan'    => 'Jurnal Diskon RPL PUMB',
                                            'Status'        => 'I',
                                            'IdKampus'      => $__data_pmbregistrasi__->IdKampus,
                                            'Tabel'         => $this->__Keuangan->__Nomor_Debet__()['Table'],
                                            'UserId'        => $__data_pmbregistrasi__->Nama,
                                            'Bank'          => $__datas_bayar__->Bank,
                                        ];
                                        $__sql_pmb_debet = $this->__Keuangan->__Jurnal_Piutang__( $__pmb_debet );

                                        $__pmb_kredit = [
                                            'Ref'           => $__generate_npm . "." . $__data_pmbregistrasi__->Ta . $__data_pmbregistrasi__->Semester,
                                            'Tgl'           => $report['paymentDate'],
                                            'NoUrut'        => '1',
                                            'Ta'            => $__data_pmbregistrasi__->Ta,
                                            'Semester'      => $__data_pmbregistrasi__->Semester,
                                            'Npm'           => $__generate_npm,
                                            'Kode'          => $this->__Keuangan->__Nomor_Kredit__()['Diskon'],
                                            'Debet'         => '',
                                            'Kredit'        => $__datas_bayar__->Diskon + 0,
                                            'Keterangan'    => 'Jurnal Diskon RPL PUMB',
                                            'Status'        => 'I',
                                            'IdKampus'      => $__data_pmbregistrasi__->IdKampus,
                                            'Tabel'         => $this->__Keuangan->__Nomor_Kredit__()['Table'],
                                            'UserId'        => $__data_pmbregistrasi__->Nama,
                                            'Bank'          => $__datas_bayar__->Bank,
                                        ];
                                        $__sql_pmb_kredit = $this->__Keuangan->__Jurnal_Piutang__( $__pmb_kredit );

                                    }
                                // ############# JURNAL DISKON ############# //
                                
                                
                            $this->__db->commit();
                                
                                unset( $_SESSION['__Form_Notifikasi__'] , $_SESSION['__Old__'] );

                                return [
                                    'Error'     => '000',
                                    'Message'   => 'Berhasil Melakukan Pembayaran PUMB RPL !',
                                    'Data'      => [],
                                ];
                                exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'A Data Error Occurred: ' . $e->getMessage(),
                                'Data'      => [],
                            ];
                            exit();

                        }

                    }

                endforeach;

                return [
                    'Error'     => '999',
                    'Message'   => 'Tidak Ada Report Pembaaran Pada BRI !',
                    'Data'      => [],
                ];
                exit();
        }

        public function IndexRpl_Pumb_Pembayaran_Cek( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__IdPembayaran'    => isset($data['__IdPembayaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPembayaran'], ENT_QUOTES))) : '',
                '__Tanggal'         => isset($data['__Tanggal']) ? stripslashes(strip_tags(htmlspecialchars($data['__Tanggal'], ENT_QUOTES))) : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( !$__clean_data['__Id'] OR !$__clean_data['__IdPembayaran'] OR !$__clean_data['__Tanggal'] ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Dengan Benar',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen($__clean_data['__Id']) );

                $__data_pembayaran_pumb__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' AND Id_Bri_Bayar = '". $this->__helpers->SecretOpen($__clean_data['__IdPembayaran']) ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( !$__authlogin__->Id OR !$__data_pembayaran_pumb__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Tujuan Tidak Ada',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }


                $__data_token = $this->__Bri->__Token__();

                if ( $__data_token['Error'] != '000' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => $__data_token['Message'],
                        'Data'      => [
                            'Data'      => [],
                        ],
                    ];
                    exit();

                }

                if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                        'Data'      => [
                            'Data'      => [],
                        ],
                    ];
                    exit();

                }

                $__load_va = [
                    'Token'                         => $__data_token['Data']['Token'],
                    'Id_User'                       => $__authlogin__->Id,
                    'Id_Bri_Bayar'                  => $__data_pembayaran_pumb__->Id,
                    'Ta_Bri_Bayar'                  => $__data_pembayaran_pumb__->Ta,
                    'Semester_Bri_Bayar'            => $__data_pembayaran_pumb__->Semester,
                    'CustCode_Bri_Bayar'            => $__data_pembayaran_pumb__->CustCode,
                    'Tgl_1'                         => str_replace( "-", "", $__clean_data['__Tanggal'] ),
                    'Tgl_2'                         => str_replace( "-", "", $__clean_data['__Tanggal'] ),
                ];

                
                $__data_load_va = $this->__Bri->__Load_Va__( $__load_va );

                if ( $__data_load_va['Error'] != '000' ) {

                    return [
                        'Error'     => '000',
                        'Message'   => $__data_load_va['Message'],
                        'Data'      => [],
                    ];
                    exit();

                }
                
                $__success_load_bayar__ = $this->__Success_Bayar_Bri__( $__data_load_va['Data'] , [
                    'Id'                      => $__authlogin__->Id,
                    'Id_Bri_Bayar'            => $__data_pembayaran_pumb__->Id,
                    'Ta_Bri_Bayar'            => $__data_pembayaran_pumb__->Ta,
                    'Semester_Bri_Bayar'      => $__data_pembayaran_pumb__->Semester,
                    'CustCode_Bri_Bayar'      => $__data_pembayaran_pumb__->CustCode,
                ] );

                if ( $__success_load_bayar__['Error'] == '000' ) {

                    return [
                        'Error'     => '000',
                        'Message'   => $__success_load_bayar__['Message'],
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                } else {

                    return [
                        'Error'     => '999',
                        'Message'   => $__success_load_bayar__['Message'],
                        'Data'      => [
                            // 'Url'   => $__clean_data['__Url'],
                            'Url'   => url('/homerpl'),
                        ],
                    ];
                    exit();

                }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function IndexRpl_Pumb_Pembayaran_Hapus( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__IdPembayaran'    => isset($data['__IdPembayaran']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdPembayaran'], ENT_QUOTES))) : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                if ( !$__clean_data['__Id'] OR !$__clean_data['__IdPembayaran'] ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Harap Mengisi Form Dengan Benar',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen($__clean_data['__Id']) );

                $__data_pembayaran_pumb__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'N' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' AND Id_Bri_Bayar = '". $this->__helpers->SecretOpen($__clean_data['__IdPembayaran']) ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( !$__authlogin__->Id OR !$__data_pembayaran_pumb__->Id ) {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Mohon Maaf Data Tujuan Tidak Ada',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

                $__session__ = [
                    'User_Bri_Bayar'    => $__authlogin__->Nama,
                    'Log_Bri_Bayar'     => date('Y-m-d H:i:s'),
                    'Data'              => 'N',
                    'Id_Bri_Bayar'      => $__data_pembayaran_pumb__->Id,
                    'UserId_Bri_Bayar'  => $__authlogin__->Id,
                ];

                try {

                    $this->__db->beginTransaction();

                        $__sql = $this->__db->prepare( 
                            "
                                UPDATE Tbl_Bri_Bayar SET
                                    User_Bri_Bayar      = :User_Bri_Bayar,
                                    Log_Bri_Bayar       = :Log_Bri_Bayar,
                                    Data                = :Data
                                WHERE Id_Bri_Bayar      = :Id_Bri_Bayar
                                AND UserId_Bri_Bayar    = :UserId_Bri_Bayar
                            "
                        ) -> execute ( $__session__ );

                        $this->__db->commit();

                        return [
                            'Error'   => '000',
                            'Message' => 'Berhasil Hapus Data Pembayaran PUMB RPL !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                } catch ( PDOException $e ) {

                    $this->__db->rollback();

                    return [
                        'Error'   => '999',
                        'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function IndexRpl_Pumb_PmbRegistrasi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__content      = '__pumb_pmbregistrasi';

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

                $__filter_jeniskelamin__ = array(
                    'LK' => 'LAKI - LAKI',
                    'PR' => 'PEREMPUAN',
                );

                $__data_pmbregistrasi__ = $this->Data_PmbRegistrasi(['Nomor' => $__authlogin__->Nomor, 'Ta' => $__authlogin__->Ta]);

                $__db = $this->__db;

                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';
            }
        }

        public function IndexRpl_Pumb_PmbRegistrasi_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Url_Success'     => isset($data['__Url_Success']) ? $data['__Url_Success'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__NoPeserta'       => isset($data['__NoPeserta']) ? stripslashes(strip_tags(htmlspecialchars($data['__NoPeserta'], ENT_QUOTES))) : '',
                '__pumb'            => isset($data['__pumb']) ? stripslashes(strip_tags(htmlspecialchars($data['__pumb'], ENT_QUOTES))) : '',
                '__Nik'             => isset($data['__Nik']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nik'], ENT_QUOTES))) : '',
                '__NamaLengkap'     => isset($data['__NamaLengkap']) ? stripslashes(strip_tags(htmlspecialchars($data['__NamaLengkap'], ENT_QUOTES))) : '',
                '__JenisKelamin'    => isset($data['__JenisKelamin']) ? stripslashes(strip_tags(htmlspecialchars($data['__JenisKelamin'], ENT_QUOTES))) : '',
                '__StatusMenikah'   => isset($data['__StatusMenikah']) ? stripslashes(strip_tags(htmlspecialchars($data['__StatusMenikah'], ENT_QUOTES))) : '',
                '__TempatLahir'     => isset($data['__TempatLahir']) ? stripslashes(strip_tags(htmlspecialchars($data['__TempatLahir'], ENT_QUOTES))) : '',
                '__TglLahir'        => isset($data['__TglLahir']) ? stripslashes(strip_tags(htmlspecialchars($data['__TglLahir'], ENT_QUOTES))) : '',
                '__Agama'           => isset($data['__Agama']) ? stripslashes(strip_tags(htmlspecialchars($data['__Agama'], ENT_QUOTES))) : '',
                '__WargaNegara'     => isset($data['__WargaNegara']) ? stripslashes(strip_tags(htmlspecialchars($data['__WargaNegara'], ENT_QUOTES))) : '',
                '__NoTlp'           => isset($data['__NoTlp']) ? stripslashes(strip_tags(htmlspecialchars($data['__NoTlp'], ENT_QUOTES))) : '',
                '__NoWa'            => isset($data['__NoWa']) ? stripslashes(strip_tags(htmlspecialchars($data['__NoWa'], ENT_QUOTES))) : '',

                '__Alamat'          => isset($data['__Alamat']) ? stripslashes(strip_tags(htmlspecialchars($data['__Alamat'], ENT_QUOTES))) : '',
                '__Provinsi'        => isset($data['__Provinsi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Provinsi'], ENT_QUOTES))) : '',
                '__Kabupaten'       => isset($data['__Kabupaten']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kabupaten'], ENT_QUOTES))) : '',
                '__Kecamatan'       => isset($data['__Kecamatan']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kecamatan'], ENT_QUOTES))) : '',
                '__IdKecamatan'     => isset($data['__IdKecamatan']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdKecamatan'], ENT_QUOTES))) : '',
                '__Kelurahan'       => isset($data['__Kelurahan']) ? stripslashes(strip_tags(htmlspecialchars($data['__Kelurahan'], ENT_QUOTES))) : '',
                
                '__SumberBiaya'         => isset($data['__SumberBiaya']) ? stripslashes(strip_tags(htmlspecialchars($data['__SumberBiaya'], ENT_QUOTES))) : '',
                '__NamaTempatKerja'     => isset($data['__NamaTempatKerja']) ? stripslashes(strip_tags(htmlspecialchars($data['__NamaTempatKerja'], ENT_QUOTES))) : '',
                '__AlamatTempatKerja'   => isset($data['__AlamatTempatKerja']) ? stripslashes(strip_tags(htmlspecialchars($data['__AlamatTempatKerja'], ENT_QUOTES))) : '',
                '__BeratBadan'          => isset($data['__BeratBadan']) ? stripslashes(strip_tags(htmlspecialchars($data['__BeratBadan'], ENT_QUOTES))) : '',
                '__TinggiBadan'         => isset($data['__TinggiBadan']) ? stripslashes(strip_tags(htmlspecialchars($data['__TinggiBadan'], ENT_QUOTES))) : '',
                '__Hobby'               => isset($data['__Hobby']) ? stripslashes(strip_tags(htmlspecialchars($data['__Hobby'], ENT_QUOTES))) : '',
                '__UkuranJaket'         => isset($data['__UkuranJaket']) ? stripslashes(strip_tags(htmlspecialchars($data['__UkuranJaket'], ENT_QUOTES))) : '',

                '__AsalSmu'             => isset($data['__AsalSmu']) ? stripslashes(strip_tags(htmlspecialchars($data['__AsalSmu'], ENT_QUOTES))) : '',
                '__Nisn'                => isset($data['__Nisn']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nisn'], ENT_QUOTES))) : '',
                '__NamaSekolah'         => isset($data['__NamaSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__NamaSekolah'], ENT_QUOTES))) : '',
                '__JurusanSekolah'      => isset($data['__JurusanSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__JurusanSekolah'], ENT_QUOTES))) : '',
                '__NomorIjazah'         => isset($data['__NomorIjazah']) ? stripslashes(strip_tags(htmlspecialchars($data['__NomorIjazah'], ENT_QUOTES))) : '',
                '__Nem'                 => isset($data['__Nem']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nem'], ENT_QUOTES))) : '',
                '__AlamatSekolah'       => isset($data['__AlamatSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__AlamatSekolah'], ENT_QUOTES))) : '',
                '__ProvinsSekolah'      => isset($data['__ProvinsSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__ProvinsSekolah'], ENT_QUOTES))) : '',
                '__KabupatenSekolah'    => isset($data['__KabupatenSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__KabupatenSekolah'], ENT_QUOTES))) : '',
                '__KecamatanSekolah'    => isset($data['__KecamatanSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__KecamatanSekolah'], ENT_QUOTES))) : '',
                '__IdKecamatanSekolah'  => isset($data['__IdKecamatanSekolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdKecamatanSekolah'], ENT_QUOTES))) : '',
                
                '__NamaAyah'            => isset($data['__NamaAyah']) ? stripslashes(strip_tags(htmlspecialchars($data['__NamaAyah'], ENT_QUOTES))) : '',
                '__NamaIbu'             => isset($data['__NamaIbu']) ? stripslashes(strip_tags(htmlspecialchars($data['__NamaIbu'], ENT_QUOTES))) : '',
                '__NoAyah'              => isset($data['__NoAyah']) ? stripslashes(strip_tags(htmlspecialchars($data['__NoAyah'], ENT_QUOTES))) : '',
                '__NoIbu'               => isset($data['__NoIbu']) ? stripslashes(strip_tags(htmlspecialchars($data['__NoIbu'], ENT_QUOTES))) : '',
                '__AlamatOrtu'          => isset($data['__AlamatOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__AlamatOrtu'], ENT_QUOTES))) : '',
                '__ProvinsOrtu'         => isset($data['__ProvinsOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__ProvinsOrtu'], ENT_QUOTES))) : '',
                '__KabupatenOrtu'       => isset($data['__KabupatenOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__KabupatenOrtu'], ENT_QUOTES))) : '',
                '__KecamatanOrtu'       => isset($data['__KecamatanOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__KecamatanOrtu'], ENT_QUOTES))) : '',
                '__IdKecamatanOrtu'     => isset($data['__IdKecamatanOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__IdKecamatanOrtu'], ENT_QUOTES))) : '',
                '__KelurahanOrtu'       => isset($data['__KelurahanOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__KelurahanOrtu'], ENT_QUOTES))) : '',
                '__PekerjaanOrtu'       => isset($data['__PekerjaanOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__PekerjaanOrtu'], ENT_QUOTES))) : '',
                '__PenghasilanOrtu'     => isset($data['__PenghasilanOrtu']) ? stripslashes(strip_tags(htmlspecialchars($data['__PenghasilanOrtu'], ENT_QUOTES))) : '',
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen($__clean_data['__Id']) );
                
                if ( $__clean_data['__pumb'] == '1' ) {

                    $_SESSION['__Old__'] = [
                        '__Nik'             => $__clean_data['__Nik'],
                        '__NamaLengkap'     => $__clean_data['__NamaLengkap'],
                        '__JenisKelamin'    => $__clean_data['__JenisKelamin'],
                        '__StatusMenikah'   => $__clean_data['__StatusMenikah'],
                        '__TempatLahir'     => $__clean_data['__TempatLahir'],
                        '__TglLahir'        => $__clean_data['__TglLahir'],
                        '__Agama'           => $__clean_data['__Agama'],
                        '__WargaNegara'     => $__clean_data['__WargaNegara'],
                        '__NoTlp'           => $__clean_data['__NoTlp'],
                        '__NoWa'            => $__clean_data['__NoWa'],
                    ];
                    
                    if ( !$__clean_data['__Id'] OR !$__clean_data['__pumb'] OR !$__clean_data['__Nik'] OR !$__clean_data['__NamaLengkap'] OR !$__clean_data['__JenisKelamin'] OR !$__clean_data['__StatusMenikah'] OR !$__clean_data['__TempatLahir'] OR !$__clean_data['__TglLahir'] OR !$__clean_data['__Agama'] OR !$__clean_data['__WargaNegara'] OR !$__clean_data['__NoTlp'] OR !$__clean_data['__NoWa'] ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Harap Mengisi Form Dengan Benar !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    if ( strlen($__clean_data['__Nik']) > '16' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'NIK Wajib 16 Karakter !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    if ( $__authlogin__->JenjangAkhir == 'SMA/SEDERAJAT' ) {

                        $__jenjangakhir__ = substr($__authlogin__->JenjangAkhir,0,3);

                    } else {
                        $__jenjangakhir__ = $__authlogin__->JenjangAkhir;

                    }

                    $__check_nik__ = $this->__db->queryrow(" SELECT NoPeserta FROM PMBRegistrasi WHERE NOT NoPeserta = '". $__authlogin__->Nomor ."' AND Nik = '". $__clean_data['__Nik'] ."' ");

                    if ( isset($__check_nik__) AND $__check_nik__ == TRUE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf NIK Sudah Terdaftar',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    
                    }

                    if ( !$__clean_data['__NoPeserta'] ) {

                        $__check_nopeserta__ = $this->__db->queryrow(" SELECT NoPeserta FROM PMBRegistrasi WHERE NoPeserta = '". $__authlogin__->Nomor ."' ");

                        if ( isset($__check_nopeserta__) AND $__check_nopeserta__ == TRUE ) {

                            return [
                                'Error'     => '999',
                                'Message'   => 'Mohon Maaf Nomor Peserta Sudah Terdaftar',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }
                        
                        $__session_insert = [
                            'Nik'               => $__clean_data['__Nik'],
                            'Status'            => $__clean_data['__StatusMenikah'],
                            'Agama'             => $__clean_data['__Agama'],
                            'WargaNegara'       => $__clean_data['__WargaNegara'],
                            'NamaOutput'        => $this->__helpers->HurufBesar($__clean_data['__NamaLengkap']),
                            'NoRegis'           => date('dmYHis') . rand(0,99999) . '_' . $__authlogin__->Nomor,
                            'NoPeserta'         => $__authlogin__->Nomor,
                            'Nama'              => $this->__helpers->HurufBesar($__clean_data['__NamaLengkap']),
                            'EmailRegis'        => $__authlogin__->Email,
                            'PassEmail'         => $__authlogin__->PasswordEmail,
                            'TglDaftar'         => $__authlogin__->TglDaftar,
                            'JenisKelamin'      => $__clean_data['__JenisKelamin'],
                            'TglLahir'          => $__clean_data['__TglLahir'],
                            'TempatLahir'       => $__clean_data['__TempatLahir'],
                            'AsalSmu'           => '',
                            'Telp'              => $__clean_data['__NoTlp'],
                            'Hp'                => $__clean_data['__NoWa'],
                            'TelpOrtu'          => '',
                            'Alamat'            => $__authlogin__->Alamat,
                            'Gelombang'         => $__authlogin__->Gelombang,
                            'IdKampus'          => $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'],
                            'Kurikulum'         => $__authlogin__->Kurikulum,
                            'IdFakultas'        => $__authlogin__->NamaFakultas,
                            'Prodi'             => $__authlogin__->Prodi,
                            'BiayaDaftar'       => '300000',
                            'Lunas'             => 'T',
                            'Ta'                => $__authlogin__->Ta,
                            'UserId'            => $__authlogin__->Nama,
                            'ReferensiName'     => $__authlogin__->Referensi,
                            'AtasReferensi'     => $__authlogin__->Referensi,
                            'Fee'               => '0',
                            'InputDate'         => date('Y-m-d H:i:s'),
                            'LastUpdate'        => date('Y-m-d H:i:s'),
                            'UpdateUserId'      => $__authlogin__->Nama,
                            'Pindahan'          => 'Y',
                            'SemesterPindah'    => '1',
                            'BiayaKonversi'     => '0',
                            'Kelas'             => $__authlogin__->JamPerkuliahan,
                            'NamaIbu'           => '',
                            'JenjangAkhir'      => $__jenjangakhir__,
                            'Universitas'       => __Aplikasi()['Kampus'],
                            'ShiftActive'       => 'Y',
                            'TipeKelas'         => 'RPL',
                            'RuanganKelas'      => '',
                            'Semester'          => $__authlogin__->Semester,
                            'IdDosenReferensi'  => $__authlogin__->Referensi,
                            'KdPtAsal'          => $__authlogin__->IdPtAsal,
                            'KdProdiAsal'       => $__authlogin__->IdProdiAsal,
                        ];

                    } else {

                        $__session_update = [
                            'Nik'               => $__clean_data['__Nik'],
                            'Nama'              => $this->__helpers->HurufBesar($__clean_data['__NamaLengkap']),
                            'JenisKelamin'      => $__clean_data['__JenisKelamin'],
                            'Status'            => $__clean_data['__StatusMenikah'],
                            'TempatLahir'       => $__clean_data['__TempatLahir'],
                            'TglLahir'          => $__clean_data['__TglLahir'],
                            'Agama'             => $__clean_data['__Agama'],
                            'WargaNegara'       => $__clean_data['__WargaNegara'],
                            'UserId'            => $this->__helpers->HurufBesar($__clean_data['__NamaLengkap']),
                            'InputDate'         => date('Y-m-d H:i:s'),
                            'LastUpdate'        => date('Y-m-d H:i:s'),
                            'UpdateUserId'      => $this->__helpers->HurufBesar($__clean_data['__NamaLengkap']),
                            'NamaOutput'        => $this->__helpers->HurufBesar($__clean_data['__NamaLengkap']),
                            'NoPeserta'         => $__authlogin__->Nomor,
                        ];

                    }

                    $__session = [
                        'Nama_Rpl_Pendaftaran'              => $__clean_data['__NamaLengkap'],
                        'JenisKelamin_Rpl_Pendaftaran'      => $__clean_data['__JenisKelamin'],
                        'TempatLahir_Rpl_Pendaftaran'       => $__clean_data['__TempatLahir'],
                        'TanggalLahir_Rpl_Pendaftaran'      => $__clean_data['__TglLahir'],
                        'NoHp_Rpl_Pendaftaran'              => $__clean_data['__NoTlp'],
                        'NoWa_Rpl_Pendaftaran'              => $__clean_data['__NoWa'],
                        'User_Rpl_Pendaftaran'              => $__authlogin__->Nama,
                        'Log_Rpl_Pendaftaran'               => date('Y-m-d H:i:s'),
                        'Id_Rpl_Pendaftaran'                => $__authlogin__->Id,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                if ( !$__clean_data['__NoPeserta'] ) {

                                    $__sql = $this->__db->prepare( 
                                        "
                                            INSERT INTO PMBRegistrasi
                                            (
                                                Nik, Status, Agama, WargaNegara, NamaOutput,
                                                NoRegis, NoPeserta, Nama, EmailRegis, PassEmail, TglDaftar, JenisKelamin,
                                                TglLahir, TempatLahir, AsalSmu, Telp, Hp, TelpOrtu, Alamat, Gelombang,
                                                IdKampus, Kurikulum, IdFakultas, Prodi, BiayaDaftar, Lunas, Ta,
                                                UserId, ReferensiName, AtasReferensi, Fee, InputDate, LastUpdate, UpdateUserId,
                                                Pindahan, SemesterPindah, BiayaKonversi, Kelas, 
                                                NamaIbu, JenjangAkhir, Universitas, ShiftActive,
                                                TipeKelas, RuanganKelas, Semester, IdDosenReferensi,
                                                KdPtAsal, KdProdiAsal
                                            )
                                            VALUES
                                            (
                                                :Nik, :Status, :Agama, :WargaNegara, :NamaOutput,
                                                :NoRegis, :NoPeserta, :Nama, :EmailRegis, :PassEmail, :TglDaftar, :JenisKelamin,
                                                :TglLahir, :TempatLahir, :AsalSmu, :Telp, :Hp, :TelpOrtu, :Alamat, :Gelombang,
                                                :IdKampus, :Kurikulum, :IdFakultas, :Prodi, :BiayaDaftar, :Lunas, :Ta,
                                                :UserId, :ReferensiName, :AtasReferensi, :Fee, :InputDate, :LastUpdate, :UpdateUserId,
                                                :Pindahan, :SemesterPindah, :BiayaKonversi, :Kelas, 
                                                :NamaIbu, :JenjangAkhir, :Universitas, :ShiftActive,
                                                :TipeKelas, :RuanganKelas, :Semester, :IdDosenReferensi,
                                                :KdPtAsal, :KdProdiAsal
                                            )
                                        "
                                    )->execute( $__session_insert );

                                } else {

                                    $__sql = $this->__db->prepare( 
                                        "
                                            UPDATE PmbRegistrasi SET
                                                Nik             = :Nik,
                                                Nama            = :Nama,
                                                JenisKelamin    = :JenisKelamin,
                                                Status          = :Status,
                                                TempatLahir     = :TempatLahir,
                                                TglLahir        = :TglLahir,
                                                Agama           = :Agama,
                                                WargaNegara     = :WargaNegara,
                                                UserId          = :UserId,
                                                InputDate       = :InputDate,
                                                LastUpdate      = :LastUpdate,
                                                UpdateUserId    = :UpdateUserId,
                                                NamaOutput      = :NamaOutput
                                            WHERE NoPeserta     = :NoPeserta
                                        "
                                    )->execute( $__session_update );

                                }

                                $__query_result = $this->__db->prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Pendaftaran SET
                                            Nama_Rpl_Pendaftaran            = :Nama_Rpl_Pendaftaran,
                                            JenisKelamin_Rpl_Pendaftaran    = :JenisKelamin_Rpl_Pendaftaran,
                                            TempatLahir_Rpl_Pendaftaran     = :TempatLahir_Rpl_Pendaftaran,
                                            TanggalLahir_Rpl_Pendaftaran    = :TanggalLahir_Rpl_Pendaftaran,
                                            NoHp_Rpl_Pendaftaran            = :NoHp_Rpl_Pendaftaran,
                                            NoWa_Rpl_Pendaftaran            = :NoWa_Rpl_Pendaftaran,
                                            User_Rpl_Pendaftaran            = :User_Rpl_Pendaftaran, 
                                            Log_Rpl_Pendaftaran             = :Log_Rpl_Pendaftaran
                                        WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                    "
                                ) -> execute ( $__session );

                            $this->__db->commit();

                            unset( $_SESSION['__Form_Notifikasi__'],$_SESSION['__Old__'] );

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error ' . $e,
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                } elseif ( $__clean_data['__pumb'] == '2' ) {

                    if ( !$__clean_data['__Id'] OR !$__clean_data['__NoPeserta'] OR !$__clean_data['__pumb'] OR !$__clean_data['__Alamat'] OR !$__clean_data['__Provinsi'] OR !$__clean_data['__Kabupaten'] OR !$__clean_data['__Kecamatan'] OR !$__clean_data['__IdKecamatan'] OR !$__clean_data['__Kelurahan'] ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Harap Mengisi Form Dengan Benar !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'] . '?pumb=' . $__clean_data['__pumb'],
                            ],
                        ];
                        exit();

                    }

                    $__provinsi_tinggal = $this->__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". $__clean_data['__Provinsi'] ."' ORDER BY IdPropinsi DESC ");

                    $__kabupaten_tinggal = $this->__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D FROM Kabupaten WHERE IdKabupaten = '". $__clean_data['__Kabupaten'] ."' AND IdPropinsi = '". $__provinsi_tinggal->Id ."' ORDER BY IdKabupaten DESC ");

                    $__kecamatan_tinggal = $this->__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D FROM Kecamatan WHERE IdKecamatan = '". $__clean_data['__IdKecamatan'] ."' AND IdKabupaten = '". $__kabupaten_tinggal->Id ."' ORDER BY IdKabupaten DESC ");

                    $__session_update = [
                        'AlamatAsal'        => $__clean_data['__Alamat'],
                        'KabupatenAsal'     => $__kabupaten_tinggal->D,
                        'KecamatanAsal'     => $__kecamatan_tinggal->D,
                        'IdKecamatanAsal'   => $__kecamatan_tinggal->Id,
                        'KelurahanAsal'     => $__clean_data['__Kelurahan'],
                        'Alamat'            => $__clean_data['__Alamat'],
                        'Kabupaten'         => $__kabupaten_tinggal->D,
                        'Kecamatan'         => $__kecamatan_tinggal->D,
                        'IdKecamatan'       => $__kecamatan_tinggal->Id,
                        'Kelurahan'         => $__clean_data['__Kelurahan'],
                        'UserId'            => $__authlogin__->Nama,
                        'InputDate'         => date('Y-m-d H:i:s'),
                        'LastUpdate'        => date('Y-m-d H:i:s'),
                        'UpdateUserId'      => $__authlogin__->Nama,
                        'NoPeserta'         => $__authlogin__->Nomor,
                    ];
                    
                    $__session = [
                        'Alamat_Rpl_Pendaftaran'            => $__clean_data['__Alamat'],
                        'User_Rpl_Pendaftaran'              => $__authlogin__->Nama,
                        'Log_Rpl_Pendaftaran'               => date('Y-m-d H:i:s'),
                        'Id_Rpl_Pendaftaran'                => $__authlogin__->Id,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE PmbRegistrasi SET
                                            AlamatAsal          = :AlamatAsal,
                                            KabupatenAsal       = :KabupatenAsal,
                                            KecamatanAsal       = :KecamatanAsal,
                                            IdKecamatanAsal     = :IdKecamatanAsal,
                                            KelurahanAsal       = :KelurahanAsal,
                                            Alamat              = :Alamat,
                                            Kabupaten           = :Kabupaten,
                                            Kecamatan           = :Kecamatan,
                                            IdKecamatan         = :IdKecamatan,
                                            Kelurahan           = :Kelurahan,
                                            UserId              = :UserId,
                                            InputDate           = :InputDate,
                                            LastUpdate          = :LastUpdate,
                                            UpdateUserId        = :UpdateUserId
                                        WHERE NoPeserta         = :NoPeserta
                                    "
                                )->execute( $__session_update );

                                $__query_result = $this->__db->prepare( 
                                    "
                                        UPDATE Tbl_Rpl_Pendaftaran SET
                                            Alamat_Rpl_Pendaftaran          = :Alamat_Rpl_Pendaftaran,
                                            User_Rpl_Pendaftaran            = :User_Rpl_Pendaftaran, 
                                            Log_Rpl_Pendaftaran             = :Log_Rpl_Pendaftaran
                                        WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                    "
                                ) -> execute ( $__session );

                            $this->__db->commit();

                            unset( $_SESSION['__Form_Notifikasi__'],$_SESSION['__Old__'] );

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error ' . $e,
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                } elseif ( $__clean_data['__pumb'] == '3' ) {

                    $_SESSION['__Old__'] = [
                        '__NamaTempatKerja'     => $__clean_data['__NamaTempatKerja'],
                        '__AlamatTempatKerja'   => $__clean_data['__AlamatTempatKerja'],
                        '__BeratBadan'          => $__clean_data['__BeratBadan'],
                        '__TinggiBadan'         => $__clean_data['__TinggiBadan'],
                        '__Hobby'               => $__clean_data['__Hobby'],
                    ];

                    if ( !$__clean_data['__Id'] OR !$__clean_data['__NoPeserta'] OR !$__clean_data['__pumb'] OR !$__clean_data['__SumberBiaya'] OR !$__clean_data['__NamaTempatKerja'] OR !$__clean_data['__AlamatTempatKerja'] OR !$__clean_data['__BeratBadan'] OR !$__clean_data['__TinggiBadan'] OR !$__clean_data['__Hobby'] OR !$__clean_data['__UkuranJaket'] ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Harap Mengisi Form Dengan Benar !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'] . '?pumb=' . $__clean_data['__pumb'],
                            ],
                        ];
                        exit();

                    }

                    $__session_update = [
                        'SumberBiaya'       => $__clean_data['__SumberBiaya'],
                        'NamaTempatKerja'   => $__clean_data['__NamaTempatKerja'],
                        'AlamatKerja'       => $__clean_data['__AlamatTempatKerja'],
                        'BeratBadan'        => $__clean_data['__BeratBadan'],
                        'TinggiBadan'       => $__clean_data['__TinggiBadan'],
                        'Hobi'              => $__clean_data['__Hobby'],
                        'UkuranJaket'       => $__clean_data['__UkuranJaket'],
                        'UserId'            => $__authlogin__->Nama,
                        'InputDate'         => date('Y-m-d H:i:s'),
                        'LastUpdate'        => date('Y-m-d H:i:s'),
                        'UpdateUserId'      => $__authlogin__->Nama,
                        'NoPeserta'         => $__authlogin__->Nomor,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE PmbRegistrasi SET
                                            SumberBiaya         = :SumberBiaya,
                                            NamaTempatKerja     = :NamaTempatKerja,
                                            AlamatKerja         = :AlamatKerja,
                                            BeratBadan          = :BeratBadan,
                                            TinggiBadan         = :TinggiBadan,
                                            Hobi                = :Hobi,
                                            UkuranJaket         = :UkuranJaket,
                                            UserId              = :UserId,
                                            InputDate           = :InputDate,
                                            LastUpdate          = :LastUpdate,
                                            UpdateUserId        = :UpdateUserId
                                        WHERE NoPeserta         = :NoPeserta
                                    "
                                )->execute( $__session_update );

                            $this->__db->commit();

                            unset( $_SESSION['__Form_Notifikasi__'],$_SESSION['__Old__'] );

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error ' . $e,
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                } elseif ( $__clean_data['__pumb'] == '4' ) {

                    $_SESSION['__Old__'] = [
                        '__Nisn'            => $__clean_data['__Nisn'],
                        '__NamaSekolah'     => $__clean_data['__NamaSekolah'],
                        '__NomorIjazah'     => $__clean_data['__NomorIjazah'],
                        '__Nem'             => $__clean_data['__Nem'],
                        '__AlamatSekolah'   => $__clean_data['__AlamatSekolah'],
                    ];
                    
                    if ( !$__clean_data['__Id'] OR !$__clean_data['__NoPeserta'] OR !$__clean_data['__pumb'] OR !$__clean_data['__AsalSmu'] OR !$__clean_data['__Nisn'] OR !$__clean_data['__NamaSekolah'] OR !$__clean_data['__JurusanSekolah'] OR !$__clean_data['__NomorIjazah'] OR !$__clean_data['__Nem'] OR !$__clean_data['__AlamatSekolah'] OR !$__clean_data['__ProvinsSekolah'] OR !$__clean_data['__KabupatenSekolah'] OR !$__clean_data['__KecamatanSekolah'] OR !$__clean_data['__IdKecamatanSekolah'] ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Harap Mengisi Form Dengan Benar !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'] . '?pumb=' . $__clean_data['__pumb'],
                            ],
                        ];
                        exit();

                    }

                    $__session_update = [
                        'JenisSekolah'          => $__clean_data['__AsalSmu'],
                        'AsalSmu'               => $__clean_data['__AsalSmu'],
                        'Nisn'                  => $__clean_data['__Nisn'],
                        'NamaSekolah'           => $__clean_data['__NamaSekolah'],
                        'AlamatSekolah'         => $__clean_data['__AlamatSekolah'],
                        'NoIjazah'              => $__clean_data['__NomorIjazah'],
                        'Noljazah'              => $__clean_data['__NomorIjazah'],
                        'Nem'                   => $__clean_data['__Nem'],
                        'IdKecamatanAsalSmu'    => $__clean_data['__IdKecamatanSekolah'],
                        'JurusanSekolah'        => $__clean_data['__JurusanSekolah'],
                        'UserId'                => $__authlogin__->Nama,
                        'InputDate'             => date('Y-m-d H:i:s'),
                        'LastUpdate'            => date('Y-m-d H:i:s'),
                        'UpdateUserId'          => $__authlogin__->Nama,
                        'NoPeserta'             => $__authlogin__->Nomor,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE PmbRegistrasi SET
                                            JenisSekolah        = :JenisSekolah,
                                            AsalSmu             = :AsalSmu,
                                            Nisn                = :Nisn,
                                            NamaSekolah         = :NamaSekolah,
                                            AlamatSekolah       = :AlamatSekolah,
                                            NoIjazah            = :NoIjazah,
                                            Noljazah            = :Noljazah,
                                            Nem                 = :Nem,
                                            IdKecamatanAsalSmu  = :IdKecamatanAsalSmu,
                                            JurusanSekolah      = :JurusanSekolah,
                                            UserId              = :UserId,
                                            InputDate           = :InputDate,
                                            LastUpdate          = :LastUpdate,
                                            UpdateUserId        = :UpdateUserId
                                        WHERE NoPeserta         = :NoPeserta
                                    "
                                )->execute( $__session_update );

                            $this->__db->commit();

                            unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error ' . $e,
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                } elseif ( $__clean_data['__pumb'] == '5' ) {

                    $_SESSION['__Old__'] = [
                        '__NamaAyah'        => $__clean_data['__NamaAyah'],
                        '__NamaIbu'         => $__clean_data['__NamaIbu'],
                        '__NoAyah'          => $__clean_data['__NoAyah'],
                        '__NoIbu'           => $__clean_data['__NoIbu'],
                        '__AlamatOrtu'      => $__clean_data['__AlamatOrtu'],
                        '__KelurahanOrtu'   => $__clean_data['__KelurahanOrtu'],
                    ];
                    
                    if ( !$__clean_data['__Id'] OR !$__clean_data['__NoPeserta'] OR !$__clean_data['__pumb'] OR !$__clean_data['__NamaAyah'] OR !$__clean_data['__NamaIbu'] OR !$__clean_data['__NoAyah'] OR !$__clean_data['__NoIbu'] OR !$__clean_data['__AlamatOrtu'] OR !$__clean_data['__ProvinsOrtu'] OR !$__clean_data['__KabupatenOrtu'] OR !$__clean_data['__KecamatanOrtu'] OR !$__clean_data['__IdKecamatanOrtu'] OR !$__clean_data['__KelurahanOrtu'] OR !$__clean_data['__PekerjaanOrtu'] OR !$__clean_data['__PenghasilanOrtu'] ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Harap Mengisi Form Dengan Benar !',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'] . '?pumb=' . $__clean_data['__pumb'],
                            ],
                        ];
                        exit();

                    }

                    $__check_ibu__ = $this->__db->queryrow(" SELECT NoPeserta FROM PMBRegistrasi WHERE NOT NoPeserta = '". $__authlogin__->Nomor ."' AND NamaIbu = '". $__clean_data['__NamaIbu'] ."' ");

                    if ( isset($__check_ibu__) AND $__check_ibu__ == TRUE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf Nama Ibu Sudah Terdaftar',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    
                    }

                    $__provinsi_tinggal = $this->__db->queryid(" SELECT TOP 1 IdPropinsi AS Id, Propinsi AS D FROM Propinsi WHERE IdPropinsi = '". $__clean_data['__ProvinsOrtu'] ."' ORDER BY IdPropinsi DESC ");

                    $__kabupaten_tinggal = $this->__db->queryid(" SELECT TOP 1 IdKabupaten AS Id, Kabupaten AS D FROM Kabupaten WHERE IdKabupaten = '". $__clean_data['__KabupatenOrtu'] ."' AND IdPropinsi = '". $__provinsi_tinggal->Id ."' ORDER BY IdKabupaten DESC ");

                    $__kecamatan_tinggal = $this->__db->queryid(" SELECT TOP 1 IdKecamatan AS Id, Kecamatan AS D FROM Kecamatan WHERE IdKecamatan = '". $__clean_data['__IdKecamatanOrtu'] ."' AND IdKabupaten = '". $__kabupaten_tinggal->Id ."' ORDER BY IdKabupaten DESC ");

                    $__session_update = [
                        'NamaAyah'              => $__clean_data['__NamaAyah'],
                        'NamaIbu'               => $__clean_data['__NamaIbu'],
                        'NoAyah'                => $__clean_data['__NoAyah'],
                        'NoIbu'                 => $__clean_data['__NoIbu'],
                        'AlamatOrtu'            => $__clean_data['__AlamatOrtu'],
                        'KabupatenOrtu'         => $__kabupaten_tinggal->D,
                        'KecamatanOrtu'         => $__kecamatan_tinggal->D,
                        'IdKecamatanOrtu'       => $__kecamatan_tinggal->Id,
                        'KelurahanOrtu'         => $__clean_data['__KelurahanOrtu'],
                        'TelpOrtu'              => $__clean_data['__NoAyah'],
                        'PekerjaanOrtu'         => $__clean_data['__PekerjaanOrtu'],
                        'PenghasilanOrtu'       => $__clean_data['__PenghasilanOrtu'],
                        'UserId'                => $__authlogin__->Nama,
                        'InputDate'             => date('Y-m-d H:i:s'),
                        'LastUpdate'            => date('Y-m-d H:i:s'),
                        'UpdateUserId'          => $__authlogin__->Nama,
                        'NoPeserta'             => $__authlogin__->Nomor,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE PmbRegistrasi SET
                                            NamaAyah            = :NamaAyah,
                                            NamaIbu             = :NamaIbu,
                                            NoAyah              = :NoAyah,
                                            NoIbu               = :NoIbu,
                                            AlamatOrtu          = :AlamatOrtu,
                                            KabupatenOrtu       = :KabupatenOrtu,
                                            KecamatanOrtu       = :KecamatanOrtu,
                                            IdKecamatanOrtu     = :IdKecamatanOrtu,
                                            KelurahanOrtu       = :KelurahanOrtu,
                                            TelpOrtu            = :TelpOrtu,
                                            PekerjaanOrtu       = :PekerjaanOrtu,
                                            PenghasilanOrtu     = :PenghasilanOrtu,
                                            UserId              = :UserId,
                                            InputDate           = :InputDate,
                                            LastUpdate          = :LastUpdate,
                                            UpdateUserId        = :UpdateUserId
                                        WHERE NoPeserta         = :NoPeserta
                                    "
                                )->execute( $__session_update );

                            $this->__db->commit();

                            unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error ' . $e,
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                } elseif ( $__clean_data['__pumb'] == '6' ) {

                    $__session_update = [
                        'PostingDate'           => date('Y-m-d H:i:s'),
                        'Posted'                => 'Y',
                        'PostedBy'              => date('Y-m-d H:i:s'),
                        'AccKasBank'            => '1-112.16',
                        'LunasPumb'             => 'Y',
                        'EmailScore'            => 'Y',
                        'NoVaPmb'               => rand(0,9999999999),
                        'TglExpLunasPmb'        => date('Y-m-d H:i:s'),
                        'NoVaPumb'              => rand(0,9999999999),
                        'TglExpLunasPumb'       => date('Y-m-d H:i:s'),
                        'BiayaPumb'             => '0',
                        'TglDaftarUlang'        => date('Y-m-d H:i:s'),
                        'TglLunasPumb'          => date('Y-m-d H:i:s'),
                        'TglLunasPmb'           => date('Y-m-d H:i:s'),
                        'UserId'                => $__authlogin__->Nama,
                        'InputDate'             => date('Y-m-d H:i:s'),
                        'LastUpdate'            => date('Y-m-d H:i:s'),
                        'UpdateUserId'          => $__authlogin__->Nama,
                        'NoPeserta'             => $__authlogin__->Nomor,
                    ];

                        try {

                            $this->__db->beginTransaction();

                                $__sql = $this->__db->prepare( 
                                    "
                                        UPDATE PmbRegistrasi SET
                                            PostingDate         = :PostingDate,
                                            Posted              = :Posted,
                                            PostedBy            = :PostedBy,
                                            AccKasBank          = :AccKasBank,
                                            LunasPumb           = :LunasPumb,
                                            EmailScore          = :EmailScore,
                                            NoVaPmb             = :NoVaPmb,
                                            TglExpLunasPmb      = :TglExpLunasPmb,
                                            NoVaPumb            = :NoVaPumb,
                                            TglExpLunasPumb     = :TglExpLunasPumb,
                                            BiayaPumb           = :BiayaPumb,
                                            TglDaftarUlang      = :TglDaftarUlang,
                                            TglLunasPumb        = :TglLunasPumb,
                                            TglLunasPmb         = :TglLunasPmb,
                                            UserId              = :UserId,
                                            InputDate           = :InputDate,
                                            LastUpdate          = :LastUpdate,
                                            UpdateUserId        = :UpdateUserId
                                        WHERE NoPeserta         = :NoPeserta
                                    "
                                )->execute( $__session_update );

                            $this->__db->commit();

                            unset( $_SESSION['__Form_Notifikasi__'], $_SESSION['__Old__'] );

                            return [
                                'Error'     => '000',
                                'Message'   => 'Berhasil Simpan Data !',
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url_Success'],
                                ],
                            ];
                            exit();

                        } catch ( PDOException $e ) {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error ' . $e,
                                'Data'      => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                        }

                } else {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Tidak Ada Eksekusi',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function Data_PmbRegistrasi( array $data )
        {   
            // return $this->__db->queryid(" SELECT NoRegis, NoPeserta, Nama, EmailRegis AS Email, PassEmail AS Pass, Ta, TglDaftar, JenisKelamin, TglLahir, TempatLahir, AsalSmu, Telp, Hp, TelpOrtu, Alamat, Gelombang, IdKampus, Kurikulum, IdFakultas, Prodi, BiayaDaftar, Lunas, ReferensiName, AtasReferensi, Fee, Pindahan, SemesterPindah, BiayaKonversi, Idm, Kelas, KdPtAsal, KdProdiAsal, NpmAsal, NamaIbu, JenjangAkhir, Universitas, ShiftActive, PostingDate, Posted, PostedBy, AccKasBank, Nik, NamaOutput, Status, Agama, WargaNegara, AlamatAsal, KelurahanAsal, KabupatenAsal, KecamatanAsal, Kelurahan, Kecamatan, Kabupaten, SumberBiaya, NamaTempatKerja, AlamatKerja, UkuranJaket, BeratBadan, TinggiBadan, JenisSekolah, NamaSekolah, AlamatSekolah, JurusanSekolah, NoIjazah, NamaAyah, NoAyah, NoIbu, AlamatOrtu, KecamatanOrtu, KelurahanOrtu, KabupatenOrtu, PekerjaanOrtu, PenghasilanOrtu, Hobi, NoIjazah, NoIbu, Nem, IdKecamatan, IdKecamatanAsal, IdKecamatanOrtu, LunasPumb, Npm, EmailScore, IdKecamatanAsalSmu, Nisn, NoVaPmb, TglExpLunasPmb, NoVaPumb, TglExpLunasPumb, BiayaPumb, TglDaftarUlang, TglLunasPumb, PayFull, TglLunasPmb, CreateNpm, IdDosenReferensi, TipeKelas, RuanganKelas, Semester FROM PMBRegistrasi WHERE NoPeserta = '". $data['Nomor'] ."' AND Ta = '". $data['Ta'] ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND LunasPumb = 'Y' ORDER BY NoPeserta DESC ");
            return $this->__db->queryid(" SELECT NoRegis, NoPeserta, Nama, EmailRegis AS Email, PassEmail AS Pass, Ta, TglDaftar, JenisKelamin, TglLahir, TempatLahir, AsalSmu, Telp, Hp, TelpOrtu, Alamat, Gelombang, IdKampus, Kurikulum, IdFakultas, Prodi, BiayaDaftar, Lunas, ReferensiName, AtasReferensi, Fee, Pindahan, SemesterPindah, BiayaKonversi, Idm, Kelas, KdPtAsal, KdProdiAsal, NpmAsal, NamaIbu, JenjangAkhir, Universitas, ShiftActive, PostingDate, Posted, PostedBy, AccKasBank, Nik, NamaOutput, Status, Agama, WargaNegara, AlamatAsal, KelurahanAsal, KabupatenAsal, KecamatanAsal, Kelurahan, Kecamatan, Kabupaten, SumberBiaya, NamaTempatKerja, AlamatKerja, UkuranJaket, BeratBadan, TinggiBadan, JenisSekolah, NamaSekolah, AlamatSekolah, JurusanSekolah, NoIjazah, NamaAyah, NoAyah, NoIbu, AlamatOrtu, KecamatanOrtu, KelurahanOrtu, KabupatenOrtu, PekerjaanOrtu, PenghasilanOrtu, Hobi, NoIjazah, NoIbu, Nem, IdKecamatan, IdKecamatanAsal, IdKecamatanOrtu, LunasPumb, Npm, EmailScore, IdKecamatanAsalSmu, Nisn, NoVaPmb, TglExpLunasPmb, NoVaPumb, TglExpLunasPumb, BiayaPumb, TglDaftarUlang, TglLunasPumb, PayFull, TglLunasPmb, CreateNpm, IdDosenReferensi, TipeKelas, RuanganKelas, Semester FROM PMBRegistrasi WHERE NoPeserta = '". $data['Nomor'] ."' AND Ta = '". $data['Ta'] ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' ORDER BY NoPeserta DESC ");
        }

        public function IndexRpl_Pumb_Cicilan()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__pumb_cicilan';

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

            } 

            $__result_sessionlogin = $this->__SessionController->__Session__();

            $__session_login__ = [
                '__Id'      => $__result_sessionlogin['__Id'],
                '__Nama'    => $__result_sessionlogin['__Nama'],
                '__Level'   => $__result_sessionlogin['__Level'],
                '__Log'     => $__result_sessionlogin['__Log'],
            ];

            $__authlogin__ = $this->__SessionController->__Data_Rpl__( $__session_login__['__Id'] );

            $__data_pmbregistrasi__ = $this->Data_PmbRegistrasi(['Nomor' => $__authlogin__->Nomor, 'Ta' => $__authlogin__->Ta]);

            if ( !isset($__authlogin__->Id) OR !isset($__data_pmbregistrasi__->NoPeserta) ) {

                redirect(url('/homerpl'), '03', 'Mohon Maaf Data RPL Pendaftaran, PMB Registrasi dan Mahasiswa Tidak Ada !');
                exit();

            }

            $__data_pembayaran_biayakonversi__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' AND StatusBayar_Bri_Bayar = 'Y' ");

            if ( !isset($__data_pembayaran_biayakonversi__) ) {

                redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Bayar Biaya Konversi !');
                exit();

            }

                // ############################ //
                    $__total_biaya__ = 0;
                    $__tipekelas_mahasiswa__ = 'RPL';
                    $__tipekelas_mahasiswa_biaya__ = 'BARU KHUSUS';

                    $__data_biaya_rpl__ = $this->__db->queryid(" SELECT Id_Setting_Kul AS Id, Id_Peserta, Tipe_Kelas, Pengelolah AS Biaya, Universitas, Tgl_Set, User_Set, Total, Ta, Semester FROM Setting_Kul_Rpl_Baru WHERE Id_Peserta = '". $__authlogin__->Npm ."' OR Id_Peserta = '". $__authlogin__->Nomor ."' AND Tipe_Kelas = '". $__tipekelas_mahasiswa__ ."' ORDER BY Id_Setting_Kul DESC ");

                    if ( $__data_biaya_rpl__->Id == TRUE AND $__authlogin__->Npm == FALSE ) {

                        $__persen__ = '50';
                    
                        $__data_biaya_pmb__ = $this->__db->queryid (" SELECT TOP 1 Ta, BiayaDaftar AS Biaya, G1, G2, G3, G4, BiayaKonversi, TglTutupPmb FROM SettingPMB WHERE Ta = '". $__authlogin__->Ta ."' AND AKTIF = 'Y' ORDER BY Ta DESC ");

                        $__data_biaya_alokasibiayakuliah1__ = $this->__db->query (" SELECT IdFakultas, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal AS Biaya, Aktif, Cuti, Reaktivasi, Stambuk, Prodi FROM AlokasiBiayaKuliah1 WHERE Ta = '". $__authlogin__->Ta ."' AND Semester = '". $__authlogin__->Semester ."' AND TipeKelas = '". $__tipekelas_mahasiswa_biaya__ ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND Stambuk = '". $__authlogin__->Ta ."' AND Prodi = '". $__authlogin__->Prodi ."' ORDER BY Nominal ASC ");

                        $__data_biaya_alokasiper1__ = $this->__db->query (" SELECT IdFakultas, Ta, Semester, TipeKelas, IdKampus, Alokasi, AccPendapatan, AccDebet, Nominal AS Biaya, Stambuk, Prodi FROM AlokasiPer1 WHERE Ta = '". $__authlogin__->Ta ."' AND Semester = '". $__authlogin__->Semester ."' AND TipeKelas = '". $__tipekelas_mahasiswa_biaya__ ."' AND IdKampus = '". $this->__universitas->__Detail_Universitas()['IdKampus_Rpl'] ."' AND Stambuk = '". $__authlogin__->Ta ."' AND Prodi = '". $__authlogin__->Prodi ."' ORDER BY Nominal ASC ");

                        $__total_biaya__ += $__data_biaya_pmb__->Biaya + 0;
                        $__total_biaya__ += $__data_biaya_rpl__->Biaya + 0;

                        $__diskon__ = '0';

                    } else {

                        redirect(url('/homerpl'), '03', 'Mohon Maaf Belum Setting Biaya Pengelola !');
                        exit();

                    }
                // ############################ //

            $__data_mahasiswa__ = $this->__db->queryid(" SELECT TOP 1 Npm, Nama, Loginpassword, Prodi, IdKampus, TipeKelas FROM Mahasiswa WHERE Npm = '". $__data_pmbregistrasi__->Npm ."' AND Ta = '". $__data_pmbregistrasi__->Ta ."' AND Stambuk = '". $__data_pmbregistrasi__->Ta ."' AND StatusMhs = 'AKTIF' ORDER BY Npm DESC ");

            require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';
        }

        public function IndexRpl_Pumb_Cicilan_Simpan( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Biaya'           => isset($data['__Biaya']) ? stripslashes(strip_tags(htmlspecialchars($data['__Biaya'], ENT_QUOTES))) : '',
                '__Bank'            => isset($data['__Bank']) ? stripslashes(strip_tags(htmlspecialchars($data['__Bank'], ENT_QUOTES))) : '',
                '__SubTotal'        => isset($data['__SubTotal']) ? stripslashes(strip_tags(htmlspecialchars($data['__SubTotal'], ENT_QUOTES))) : '',
                '__Alokasi'         => isset($data['__Alokasi']) ? stripslashes(strip_tags(htmlspecialchars($data['__Alokasi'], ENT_QUOTES))) : '',
                '__Pmb'             => isset($data['__Pmb']) ? stripslashes(strip_tags(htmlspecialchars($data['__Pmb'], ENT_QUOTES))) : '',
                '__Pengelolah'      => isset($data['__Pengelolah']) ? stripslashes(strip_tags(htmlspecialchars($data['__Pengelolah'], ENT_QUOTES))) : '',
                '__Persen'          => isset($data['__Persen']) ? stripslashes(strip_tags(htmlspecialchars($data['__Persen'], ENT_QUOTES))) : '',
            ];

            $_SESSION['__Old__'] = [
                '__Bank'            => $__clean_data['__Bank'],
            ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__data_user = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $__clean_data['__Id'] ) );

                $__log__ = date('Y-m-d H:i:s');

                if ( $__clean_data['__Bank'] == 'BRI' ) {

                    $__data_token = $this->__Bri->__Token__();

                    if ( $__data_token['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_token['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    if ( $__data_token['Data']['Token'] == FALSE OR $__data_token['Data']['Keterangan'] != 'ADA TOKEN' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf Tidak Mendapatkan Token',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__not_exp = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__data_user->Id ."' AND TanggalExpired_Bri_Bayar >= '". $__log__ ."' AND Data = 'Y' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' ");

                    if ( $__not_exp == TRUE ) {

                        return [
                            'Error'     => '999',
                            'Message'   => 'Mohon Maaf ' . $this->__helpers->HurufAwalBesar( $__data_user->Nama ) . ', Nomor Pembayaran Virtual Account Bank Kamu Masih Ada dan Belum Habis Masa Aktifnya. Silahkan Melakukan Pembayaran Ya',
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } 


                    $__session_check_data = [
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => __Aplikasi()['Tujuan'] . ' PUMB',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];


                    $__check_va__ = $this->__Check_Va__( $__session_check_data );

                    if ( $__check_va__['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__check_va__['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__create_va = [
                        'Token'         => $__data_token['Data']['Token'],
                        'Nama'          => substr( $this->__helpers->HurufAwalBesar( $__data_user->Nama ) , 0 , 40 ),
                        'Amount'        => $__clean_data['__Biaya'] + 0,
                        'Keterangan'    => 'Bayar RPL PUMB TA - ' . $__data_user->Ta . '/' . $__data_user->Semester,
                        'Va'            => $__check_va__['Data']['Va'],
                        'DataUser'      => [
                            'Id'        => $__data_user->Id,
                            'Ta'        => $__data_user->Ta,
                            'Semester'  => $__data_user->Semester,
                            'Bank'      => 'BRI',
                            'Tujuan'    => __Aplikasi()['Tujuan'] . ' PUMB',
                            'Url'       => $__clean_data['__Url'],
                        ],
                    ];

                    $__data_create_va = $this->__Bri->__Create_Va__( $__create_va );

                    if ( $__data_create_va['Error'] != '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__data_create_va['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                    $__tgl__ = date('Y-m-d H:i:s');

                    $__keterangan__ = [
                        'Biaya'         => $__clean_data['__Biaya'],
                        'SubTotal'      => $__clean_data['__SubTotal'],
                        'Alokasi'       => $__clean_data['__Alokasi'],
                        'Pmb'           => $__clean_data['__Pmb'],
                        'Pengelolah'    => $__clean_data['__Pengelolah'],
                        'Persen'        => $__clean_data['__Persen'],
                    ];
                    $__json_keterangan__ = json_encode($__keterangan__);
            
                    $__session__ = [
                        'UserId_Bri_Bayar'              => $__data_user->Id,
                        'Ta_Bri_Bayar'                  => $__data_user->Ta,
                        'Semester_Bri_Bayar'            => $__data_user->Semester,
                        'InstitutionCode_Bri_Bayar'     => $this->__Bri->__Data_Bri__()['Institutioncode'],
                        'BrivaNo_Bri_Bayar'             => $this->__Bri->__Data_Bri__()['Brivano'],
                        'CustCode_Bri_Bayar'            => $__create_va['Va'],
                        'Nama_Bri_Bayar'                => $__create_va['Nama'],
                        'Amount_Bri_Bayar'              => $__create_va['Amount'],
                        'Diskon_Bri_Bayar'              => '0',
                        'Nominal_Bri_Bayar'             => $__create_va['Amount'],
                        'Keterangan_Bri_Bayar'          => $__create_va['Keterangan'],
                        'StatusBayar_Bri_Bayar'         => 'N',
                        'AccessToken_Bri_Bayar'         => $__create_va['Token'],
                        'TanggalBuat_Bri_Bayar'         => $__tgl__,
                        'TanggalExpired_Bri_Bayar'      => $this->__helpers->__TambahTanggal(),
                        'TanggalBayar_Bri_Bayar'        => $__tgl__,
                        'JenisBayar_Bri_Bayar'          => 'Cicilan',
                        'Bank_Bri_Bayar'                => $__create_va['DataUser']['Bank'],
                        'Tujuan_Bri_Bayar'              => $__create_va['DataUser']['Tujuan'],
                        'User_Bri_Bayar'                => $__create_va['Nama'],
                        'Log_Bri_Bayar'                 => $__tgl__,
                        'IdKampus'                      => __Aplikasi()['IdKampus'],
                        'Kampus'                        => __Aplikasi()['Kampus'],
                        'Data'                          => 'Y',
                        'KeteranganDeskripsi_Bri_Bayar' => '',
                        'Deskripsi_Bri_Bayar'           => '',
                        'NominalDeskripsi_Bri_Bayar'    => '',
                        'TotalDeskripsi_Bri_Bayar'      => $__json_keterangan__,
                    ];

                    $__result = $this->__Insert_Bri_Bayar__( $__session__ );

                    if ( $__result['Error'] == '000' ) {

                        return [
                            'Error'     => '999',
                            'Message'   => $__result['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    } else {

                        return [
                            'Error'     => '999',
                            'Message'   => $__result['Message'],
                            'Data'      => [
                                'Url'   => $__clean_data['__Url'],
                            ],
                        ];
                        exit();

                    }

                } else {

                    return [
                        'Error'     => '999',
                        'Message'   => 'Pilihan Bank Tidak Tersedia !',
                        'Data'      => [
                            'Url'   => $__clean_data['__Url'],
                        ],
                    ];
                    exit();

                }

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => 'Token Tidak Sama Antara Tanggal dan Jam',
                    'Data'      => [
                        'Url'   => $__clean_data['__Url'],
                    ],
                ];
                exit();

            }
        }

        public function IndexRpl_Pumb_Kwitansi()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;

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

            } 

                $__result_sessionlogin = $this->__SessionController->__Session__();

                $__session_login__ = [
                    '__Id'      => $__result_sessionlogin['__Id'],
                    '__Nama'    => $__result_sessionlogin['__Nama'],
                    '__Level'   => $__result_sessionlogin['__Level'],
                    '__Log'     => $__result_sessionlogin['__Log'],
                ];

                $__authlogin__ = $this->__SessionController->__Data_Rpl__( $__session_login__['__Id'] );

                $__data_pembayaran__ = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ." PUMB' AND Id_Bri_Bayar = '". $this->__helpers->SecretOpen( $_GET['__Id'] ) ."' ORDER BY Id_Bri_Bayar DESC ");

                if ( isset($__data_pembayaran__->Id) AND $__data_pembayaran__->Id == TRUE ) {

                    $__kop_surat = $this->__universitas->__Detail_Universitas()['KopSurat'];

                    if ( $__data_pembayaran__->StatusBayar == 'Y' ) {
                        $__statusbayar__ = 'SUDAH BAYAR';
                    } else {
                        $__statusbayar__ = 'BELUM BAYAR';
                    }
                    
                    require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sukses_bri.php';

                }  else {
                
                    redirect('/homerpl/pumb', $result['Error'] === '000' ? '01' : '03', 'Tidak Ada Melakukan Pembayaran !');
                    exit();

                }
        }
    }