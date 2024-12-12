<?php

    require_once dirname(__DIR__) . '/../helpers/__Helpers.php';
    require_once __DIR__ . '/__SessionController.php';
    require_once dirname(__DIR__) . '/../models/dosen/SkRpl.php';

    class HomerplController
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;
        protected $__SessionController;
        protected $__SkRplModel;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
            $this->__SessionController = new __SessionController( $this->__db , $this->__secret_key , $this->__universitas );
            $this->__SkRplModel = new __SkRplModel($this->__db);
        }

        public function __Option_JenisKelamin__()
        {
            return array(
                'LK' => 'LAKI - LAKI',
                'PR' => 'PEREMPUAN',
            );
        }

        public function __Header()
        {
            return 'RPL | ';
        }
        
        public function IndexHomerpl()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            $__content      = '__home';

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
                $__authlogin_berkas__ = $this->__SessionController->__Data_Rpl_Berkas__( $__session_login__['__Id'] );

                $__sukses_pembayaran__ = $this->__db->queryrow(" SELECT Id_Bri_Bayar AS Id FROM Tbl_Bri_Bayar WHERE UserId_Bri_Bayar = '". $__authlogin__->Id ."' AND StatusBayar_Bri_Bayar = 'Y' AND Ta_Bri_Bayar = '". $__authlogin__->Ta ."' AND Semester_Bri_Bayar = '". $__authlogin__->Semester ."' AND Data = 'Y' AND Kampus = '". __Aplikasi()['Kampus'] ."' AND Tujuan_Bri_Bayar = '". __Aplikasi()['Tujuan'] ."' ");

                if ( $__authlogin__->Nomor == FALSE ) {

                    $__result = $this->__Generate_Nomor__( $__authlogin__->Id );

                    if ( $__result['Error'] == '000' ) {

                        redirect(url('/homerpl'), $__result['Error'] === '000' ? '01' : '03', $__result['Message']);
                        exit();

                    } else {

                        redirect(url('/homerpl'), $__result['Error'] === '000' ? '01' : '03', $__result['Message']);
                        exit();

                    }

                }

                $__url_file = $this->__SessionController->__Url_File__();
                $__url_file_penunjang = $this->__SessionController->__Url_File_Penunjang__();

                $__total_berkas_pendukung = $this->__db->queryid(" SELECT COUNT( Id_Rpl_Pendaftaran_Berkas ) AS Total FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Data = 'Y' ");

                $__filter_jeniskelamin__ = $this->__Option_JenisKelamin__();

                $__check_assesor_1__ = $this->__db->queryrow(" SELECT Id_Rpl_Assesor AS Id FROM Tbl_Rpl_Assesor WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND As1_Status_Rpl_Assesor = 'Y' ");


                $__data_sk_rpl = $this->__db->queryrow(" SELECT Id_Rpl_Sk AS Id FROM Tbl_Rpl_Sk WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Ta_Rpl_Sk = '". $__authlogin__->Ta ."' AND Semester_Rpl_Sk = '". $__authlogin__->Semester ."' ");

                
                require_once dirname(dirname(dirname(__DIR__))) . '/public/rpl/__data.php';

            }
        }

        public function __Generate_Nomor__( $__id )
        {
            $__tambah__ = $__id + 1;
            $__nomor_peserta__ = date('y-m-d') . '.' . date('s') . '.' . $this->__helpers->FormatAwalNol( $__tambah__ );

            $__session = [
                'Nomor_Rpl_Pendaftaran' => $__nomor_peserta__,
                'Id_Rpl_Pendaftaran'    => $__id,
            ];

            try {

                $this->__db->beginTransaction();

                    $__sql = $this->__db->prepare( 
                        "
                            UPDATE Tbl_Rpl_Pendaftaran SET
                                Nomor_Rpl_Pendaftaran   = :Nomor_Rpl_Pendaftaran
                            WHERE Id_Rpl_Pendaftaran    = :Id_Rpl_Pendaftaran
                        "
                    ) -> execute ( $__session );

                    $this->__db->commit();

                    return [
                        'Error'   => '000',
                        'Message' => 'Berhasil Generate Nomor Pendafaran RPL Data !',
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

        public function IndexHomerpl_BiodataDiri( array $data )
        {
            $__clean_data = [
                '__Token'           => isset($data['__Token']) ? stripslashes(strip_tags(htmlspecialchars($data['__Token'], ENT_QUOTES))) : '',
                '__Url'             => isset($data['__Url']) ? $data['__Url'] : '',
                '__Id'              => isset($data['__Id']) ? stripslashes(strip_tags(htmlspecialchars($data['__Id'], ENT_QUOTES))) : '',
                '__Nama'            => isset($data['__Nama']) ? stripslashes(strip_tags(htmlspecialchars($data['__Nama'], ENT_QUOTES))) : '',
                '__JenisKelamin'    => isset($data['__JenisKelamin']) ? stripslashes(strip_tags(htmlspecialchars($data['__JenisKelamin'], ENT_QUOTES))) : '',
                '__Tempat'          => isset($data['__Tempat']) ? stripslashes(strip_tags(htmlspecialchars($data['__Tempat'], ENT_QUOTES))) : '',
                '__TglLahir'        => isset($data['__TglLahir']) ? stripslashes(strip_tags(htmlspecialchars($data['__TglLahir'], ENT_QUOTES))) : '',
                '__Alamat'          => isset($data['__Alamat']) ? stripslashes(strip_tags(htmlspecialchars($data['__Alamat'], ENT_QUOTES))) : '',
                '__Hp'              => isset($data['__Hp']) ? stripslashes(strip_tags(htmlspecialchars($data['__Hp'], ENT_QUOTES))) : '',
                '__Wa'              => isset($data['__Wa']) ? stripslashes(strip_tags(htmlspecialchars($data['__Wa'], ENT_QUOTES))) : '',
            ];

            // $_SESSION['__Old__'] = [
            //     '__Ta'              => $__clean_data['__Ta'],
            //     '__Semester'        => $__clean_data['__Semester'],
            //     '__Biaya'           => $__clean_data['__Biaya'],
            //     '__Tipe'            => $__clean_data['__Tipe'],
            // ];

            if ( $this->__helpers->isTokenValid($__clean_data['__Token']) ) {

                $__session = [
                    'Nama_Rpl_Pendaftaran'              => $__clean_data['__Nama'],
                    'JenisKelamin_Rpl_Pendaftaran'      => $__clean_data['__JenisKelamin'],
                    'TempatLahir_Rpl_Pendaftaran'       => $__clean_data['__Tempat'],
                    'TanggalLahir_Rpl_Pendaftaran'      => $__clean_data['__TglLahir'],
                    'Alamat_Rpl_Pendaftaran'            => $__clean_data['__Alamat'],
                    'NoHp_Rpl_Pendaftaran'              => $__clean_data['__Hp'],
                    'NoWa_Rpl_Pendaftaran'              => $__clean_data['__Wa'],
                    'User_Rpl_Pendaftaran'              => $this->__helpers->SecretOpen( $_SESSION['__Rpl__']['__Nama'] ),
                    'Log_Rpl_Pendaftaran'               => date('Y-m-d H:i:s'),
                    'Id_Rpl_Pendaftaran'                => $this->__helpers->SecretOpen( $__clean_data['__Id'] ),
                ];

                    try {

                        $this->__db->beginTransaction();

                            $__query_result = $this->__db->prepare( 
                                "
                                    UPDATE Tbl_Rpl_Pendaftaran SET
                                        Nama_Rpl_Pendaftaran            = :Nama_Rpl_Pendaftaran,
                                        JenisKelamin_Rpl_Pendaftaran    = :JenisKelamin_Rpl_Pendaftaran,
                                        TempatLahir_Rpl_Pendaftaran     = :TempatLahir_Rpl_Pendaftaran,
                                        TanggalLahir_Rpl_Pendaftaran    = :TanggalLahir_Rpl_Pendaftaran,
                                        Alamat_Rpl_Pendaftaran          = :Alamat_Rpl_Pendaftaran,
                                        NoHp_Rpl_Pendaftaran            = :NoHp_Rpl_Pendaftaran,
                                        NoWa_Rpl_Pendaftaran            = :NoWa_Rpl_Pendaftaran,
                                        User_Rpl_Pendaftaran            = :User_Rpl_Pendaftaran, 
                                        Log_Rpl_Pendaftaran             = :Log_Rpl_Pendaftaran
                                    WHERE Id_Rpl_Pendaftaran            = :Id_Rpl_Pendaftaran
                                "
                            ) -> execute ( $__session );

                            $this->__db->commit();

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Url'   => $__clean_data['__Url'],
                                ],
                            ];
                            exit();

                    } catch ( PDOException $e ) {

                        $this->__db->rollback();

                        return [
                            'Error'   => '999',
                            'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                            'Data'    => [
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

        public function IndexHomerpl_SkMendaftar_Pdf()
        {
            $__header       = $this->__Header();
            $__secret_key   = $this->__secret_key;
            $__universitas  = $this->__universitas;
            $__helpers      = $this->__helpers;
            $__routes       = url('/homerpl');
            // $__routes_mod   = self::__Routes_Mod__();
            $__content      = '__assesor';

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

                $__authlogin__ = $__session_login__['__Id'];

                // $__data_sk_rpl = $this->__SkModel->read(['Id' => $this->__helpers->SecretOpen( $_GET['__Id'] )]);

                // $__data_assesor = $this->__Assesor__( ['Show' => '1', 'Id_Rpl_Pendaftaran' => $__authlogin__] );
                
                $__data_calon_rpl = $this->__SessionController->__Data_Rpl__( $this->__helpers->SecretOpen( $_GET['__Id'] ) );

                if ( $__authlogin__ == TRUE AND $__data_calon_rpl->Id == TRUE ) {

                    $__data_sk_keterangan_rpl__ = $this->__SkRplModel->read([
                        'Id_Rpl_Pendaftaran' => $__data_calon_rpl->Id,
                    ]);

                    if ( $__data_sk_keterangan_rpl__->Id == TRUE ) {
                
                        $__logo_kampus  = $this->__universitas->__Detail_Universitas()['Logo_Kampus'];
                        // $__kop_kampus   = $this->__universitas->__Detail_Universitas()['KopSurat'];

                        $__fakultas__ = $__helpers->__Singkat_Fakultas( $__data_calon_rpl->IdFakultas );
                        $__kop_kampus = $this->__universitas->__Kop_Dekan__(['Fakultas' => $__fakultas__]);

                        $__data_dekan = $this->__db->queryid(" SELECT TOP 1 B.IdDosen AS Id, B.NamaGelar AS Nama, B.NidnNtbDos AS Nidn, A.Fakultas FROM Fakultas A LEFT JOIN Dosen B ON A.IdDekan = B.IdDosen WHERE A.IdFakultas = '". $__data_calon_rpl->NamaFakultas ."' ORDER BY A.IdFakultas DESC ");

                        $__jeniskelamin__ = $__data_calon_rpl->JenisKelamin == 'JK' ? 'LAKI - LAKI' : 'PEREMPUAN';

                        $__db = $this->__db;
                        
                        require_once dirname(dirname(dirname(__DIR__))) . '/src/storages/__pdf/__sk_daftar.php';

                    } else {

                        $__nomor_sk = [
                            'Id_Rpl_Pendaftaran'    => $__data_calon_rpl->Id,
                            'Ta'                    => $__data_calon_rpl->Ta,
                            'Semester'              => $__data_calon_rpl->Semester,
                        ];

                        $__result_nomor_sk__ = $this->Nomor_SkRpl( $__nomor_sk );

                        if ( $__result_nomor_sk__['Error'] == '000' ) {

                            redirect($__routes, '03', 'Berhasil Generate Nomor SK Pendaftaran RPL');
                            exit();

                        } else {

                            redirect($__routes, '03', $__result_nomor_sk__['Message']);
                            exit();

                        }

                    }

                } else {

                    redirect($__routes, '03', 'Data Request Tidak Ditemukan !');
                    exit();

                }
                
            }
        }

        public function Nomor_SkRpl( array $data )
        {
            $__check_nomor = $this->__db->queryrow(" SELECT Id_Rpl_SkRpl AS Id FROM Tbl_Rpl_SkRpl WHERE Ta_Rpl_SkRpl = '". $data['Ta'] ."' AND Semester_Rpl_SkRpl = '". $data['Semester'] ."' AND Id_Rpl_Pendaftaran = '". $data['Id_Rpl_Pendaftaran'] ."' AND Data = 'Y' ");

            if ( $__check_nomor == TRUE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Nomor Surat Telah Terbuat !',
                    'Data'      => '',
                ];

            }

            $__data_rpl__ = $this->__SessionController->__Data_Rpl__( $data['Id_Rpl_Pendaftaran'] );

            if ( $__data_rpl__->Id == FALSE ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Data RPL Pendaftaran Tidak Di Temukan !',
                    'Data'      => '',
                ];

            }

            $tanggal_nomor        = explode("-", date('Y-m-d'));
            $tahun_nomor          = $tanggal_nomor[0];
            $bulan_ambil          = $tanggal_nomor[1];
            $bulan_nomor          = $this->__helpers->RomawiBulan($bulan_ambil);

            $query_number         = $this->__db->queryid(" SELECT MAX(number) AS maxKode FROM Tbl_StartNumber WHERE lokasi = '". __Aplikasi()['Kampus'] ."' ");
            $noidnilai_1          = $query_number->maxKode + 1;
            $noidnilai            = $this->__helpers->FormatNomorSurat($noidnilai_1);

            if ( $noidnilai == FALSE OR $noidnilai == '0' OR $noidnilai < '1' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Nomor Surat Baru Tidak Ada !',
                    'Data'      => '',
                ];

            }

            $__ket = $this->__helpers->__Singkat_Fakultas( $__data_rpl__->IdFakultas );

            if ( $__ket == '-' ) {

                return [
                    'Error'     => '999',
                    'Message'   => 'Mohon Maaf Keterangan FAKULTAS Tidak Ada !',
                    'Data'      => '',
                ];

            }

                try {

                    $this->__db->beginTransaction();

                        if ( __Aplikasi()['Kampus'] == 'UQM' ) {
                            $alokasi_uq = 'UQ';
                        } elseif ( __Aplikasi()['Kampus'] == 'UQB' ) {
                            $alokasi_uq = 'UQB';
                        } else {
                            $alokasi_uq = 'UQ';
                        } 

                        $__skt__ = 'SKT';
                        $__rpl__ = $__ket;


                        $nomor_surat = $noidnilai."/".$__skt__."/".$__rpl__."/".$alokasi_uq."/".$bulan_nomor."/".$tahun_nomor;
                        
                        $__update_startnumber = [
                            'number'    => $noidnilai,
                            'lokasi'    => __Aplikasi()['Kampus'],
                        ];

                        $__sql_statunumber = $this->__db->prepare( 
                            "
                                UPDATE Tbl_StartNumber SET
                                    number      = :number
                                WHERE lokasi    = :lokasi
                            "
                        ) -> execute ( $__update_startnumber );
                        

                        $__insert_detail_surat = [
                            'id_surat'          => $noidnilai,
                            'id_naskah'         => $__skt__,
                            'perihal'           => 'SURAT KETERANGAN',
                            'kepada'            => 'MAHASISWA RPL',
                            'id_penandatangan'  => $__rpl__, 
                            'tgl_permohonan'    => date('Y-m-d'), 
                            'gambar_ori'        => '', 
                            'gambar'            => '', 
                            'Status'            => 'Selesai', 
                            'UserId'            => $__data_rpl__->Nama, 
                            'JenisSurat'        => 'Biasa', 
                            'gambar_revisi'     => '', 
                            'lokasi'            => __Aplikasi()['Kampus'],
                        ];

                        $__sql_detailsurat = $this->__db->prepare( 
                            "
                                INSERT INTO Tbl_detail_surat 
                                (
                                    id_surat, id_naskah, perihal, kepada, 
                                    id_penandatangan, tgl_permohonan, gambar_ori, gambar, Status, 
                                    UserId, JenisSurat, gambar_revisi, lokasi
                                ) 
                                VALUES 
                                (
                                    :id_surat, :id_naskah, :perihal, :kepada, 
                                    :id_penandatangan, :tgl_permohonan, :gambar_ori, :gambar, :Status, 
                                    :UserId, :JenisSurat, :gambar_revisi, :lokasi
                                ) 
                            "
                        ) -> execute ( $__insert_detail_surat );


                        $__insert_surat = [
                            'id_surat'          => $noidnilai,
                            'no_surat'          => $noidnilai,
                            'keterangan'        => $nomor_surat,
                            'lokasi'            => __Aplikasi()['Kampus'],
                        ];

                        $__sql_surat = $this->__db->prepare( 
                            "
                                INSERT INTO Tbl_Surat 
                                (
                                    id_surat, no_surat, keterangan, lokasi
                                ) 
                                VALUES 
                                (
                                    :id_surat, :no_surat, :keterangan, :lokasi
                                ) 
                            "
                        ) -> execute ( $__insert_surat );


                        $__insert_sk = [
                            'Ta_Rpl_SkRpl'             => $data['Ta'],
                            'Semester_Rpl_SkRpl'       => $data['Semester'],
                            'Nomor_Rpl_SkRpl'          => $nomor_surat,
                            'TglBuat_Rpl_SkRpl'        => date('Y-m-d H:i:s'),
                            'User_Rpl_SkRpl'           => $__data_rpl__->Nama,
                            'Log_Rpl_SkRpl'            => date('Y-m-d H:i:s'),
                            'IdKampus'                  => __Aplikasi()['IdKampus'],
                            'Kampus'                    => __Aplikasi()['Kampus'],
                            'Data'                      => 'Y',
                            'Id_Rpl_Pendaftaran'        => $__data_rpl__->Id,
                        ];

                        $__sql_sk = $this->__SkRplModel->create( $__insert_sk );

                        if ( $__sql_sk['Error'] === '000' ) {

                            $this->__db->commit();

                            return [
                                'Error'     => '000',
                                'Message'   => 'SUKSES',
                                'Data'      => '',
                            ];

                        } else {

                            $this->__db->rollback();

                            return [
                                'Error'     => '999',
                                'Message'   => 'Error SK: ' . $e->getMessage(),
                                'Data'      => '',
                            ];

                        }

                } catch (Exception $e) {

                    $this->__db->rollback();

                    return [
                        'Error'     => '999',
                        'Message'   => 'A Data Error Occurred SK: ' . $e->getMessage(),
                        'Data'      => '',
                    ];
                    
                }
        }

        public function FolderFile_Simpan( array $data )
        {
            $__session = [
                'IdUser'        => $data['IdUser'],
                'NamaUser'      => $data['NamaUser'],
                'Status'        => $data['Status'],
                'Nomor'         => $data['Nomor'],
                'Download'      => $data['Download'],
                'Url'           => $data['Url'],
                'Folder'        => $data['Folder'],
                'Keterangan'    => $data['Keterangan'],
                'Aplikasi'      => $data['Aplikasi'],
                'Tgl'           => $data['Tgl'],
                'Kampus'        => $data['Kampus'],
            ];

            try {

                $this->__db->beginTransaction();

                    $__sql = $this->__db->prepare( 
                        "
                            INSERT INTO Tbl_FolderFile 
                            (
                                IdUser, NamaUser, Status, Nomor, Download, Url, Folder, Keterangan, Aplikasi, Tgl, Kampus
                            )
                            VALUES
                            (
                                :IdUser, :NamaUser, :Status, :Nomor, :Download, :Url, :Folder, :Keterangan, :Aplikasi, :Tgl, :Kampus
                            )
                        "
                    ) -> execute ( $__session );

                    $this->__db->commit();

            } catch ( PDOException $e ) {

                $this->__db->rollback();

            }
        }
    }