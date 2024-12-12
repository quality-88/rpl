<?php
    
    if ( !function_exists('redirect') ) {
        function redirect( $url, $errorCode, $message ) {
            $_SESSION['__Notifikasi'] = [
                'Error'     => $errorCode,
                'Message'   => $message,
                'Data'      => [],
            ];
            header("Location: " . $url);
            exit();
        }
    }

    if (!function_exists('url')) {
        function url($path) {
            return rtrim(__Path(), '/') . '/' . ltrim($path, '/');
        }
    }
    
    if ( !function_exists('loadController') ) {
        function loadController($controllerName) {
            session_start();
            if ((isset($_SESSION['__Administrator__']) && isset($_SESSION['__Rpl__']) && isset($_SESSION['__Dosen__'])) || 
                (isset($_SESSION['__Administrator__']) && isset($_SESSION['__Rpl__'])) || 
                (isset($_SESSION['__Administrator__']) && isset($_SESSION['__Dosen__'])) || 
                (isset($_SESSION['__Rpl__']) && isset($_SESSION['__Dosen__']))) {
                session_unset();
                session_destroy();
            }

            $directories = [];

            if (isset($_SESSION['__Administrator__'])) {
                $directories[] = '/../app/controllers/administrator/';
            } elseif (isset($_SESSION['__Rpl__'])) {
                $directories[] = '/../app/controllers/rpl/';
            } elseif (isset($_SESSION['__Dosen__'])) {
                $directories[] = '/../app/controllers/dosen/';
            }

            $directories[] = '/../app/controllers/';
            
            foreach ($directories as $directory) {
                $filePath = __DIR__ . $directory . $controllerName . '.php';
                if (file_exists($filePath)) {
                    require_once $filePath;
                    return true;
                }
            }
            
            return false;
        }
    }
    
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestUri = str_replace(__Path(), '', $requestUri);

    $routes = [
        '/' => ['HomeController', 'IndexLogin'],
        '/login' => ['HomeController', 'IndexLogin'],
        '/lupapassword' => ['AuthController', 'IndexLupapassword'],
        '/lupapassword/simpan' => ['AuthController', 'IndexLupapasswordSimpan'],
        '/logout' => ['AuthController', 'IndexLogout'],

        '/admin' => ['AuthController', 'IndexAdmin'],
        '/admin/login' => ['AuthController', 'IndexAdminLogin'],

        '/homeadmin' => ['HomeadminController', 'IndexHomeadmin'],
        '/homeadmin/informasi_file' => ['HomeadminInformasiFileController', 'IndexAdmin_InformasiFile'],
        '/homeadmin/informasi_file/simpan' => ['HomeadminInformasiFileController', 'IndexAdmin_InformasiFile_Simpan'],
        '/homeadmin/informasi_file/hapus' => ['HomeadminInformasiFileController', 'IndexAdmin_InformasiFile_Hapus'],
        '/homeadmin/settingdata_evaluasidiri' => ['HomeadminSettingdataEvaluasidiriController', 'IndexAdmin_EvaluasiDiri'],
        '/homeadmin/settingdata_evaluasidiri/simpan' => ['HomeadminSettingdataEvaluasidiriController', 'IndexAdmin_EvaluasiDiri_Simpan'],
        '/homeadmin/settingdata_evaluasidiri/ubah' => ['HomeadminSettingdataEvaluasidiriController', 'IndexAdmin_EvaluasiDiri_Ubah'],
        '/homeadmin/settingdata_evaluasidiri/ubah/simpan' => ['HomeadminSettingdataEvaluasidiriController', 'IndexAdmin_EvaluasiDiri_Ubah_Simpan'],
        '/homeadmin/settingdata_profesiensi' => ['HomeadminSettingdataProfesiensiController', 'IndexAdmin_Profesiensi'],
        '/homeadmin/settingdata_profesiensi/simpan' => ['HomeadminSettingdataProfesiensiController', 'IndexAdmin_Profesiensi_Simpan'],
        '/homeadmin/settingdata_profesiensi/ubah' => ['HomeadminSettingdataProfesiensiController', 'IndexAdmin_Profesiensi_Ubah'],
        '/homeadmin/settingdata_profesiensi/ubah/simpan' => ['HomeadminSettingdataProfesiensiController', 'IndexAdmin_Profesiensi_Ubah_Simpan'],
        '/homeadmin/settingdata_hasilevaluasiasesor' => ['HomeadminSettingdataHasilevaluasiasesorController', 'IndexAdmin_HasilEvaluasiAsesor'],
        '/homeadmin/settingdata_hasilevaluasiasesor/simpan' => ['HomeadminSettingdataHasilevaluasiasesorController', 'IndexAdmin_HasilEvaluasiAsesor_Simpan'],
        '/homeadmin/settingdata_hasilevaluasiasesor/ubah' => ['HomeadminSettingdataHasilevaluasiasesorController', 'IndexAdmin_HasilEvaluasiAsesor_Ubah'],
        '/homeadmin/settingdata_hasilevaluasiasesor/ubah/simpan' => ['HomeadminSettingdataHasilevaluasiasesorController', 'IndexAdmin_HasilEvaluasiAsesor_Ubah_Simpan'],
        '/homeadmin/settingdata_keterangandokumen' => ['HomeadminSettingdataKeterangandokumenController', 'IndexAdmin_Keterangandokumen'],
        '/homeadmin/settingdata_keterangandokumen/simpan' => ['HomeadminSettingdataKeterangandokumenController', 'IndexAdmin_Keterangandokumen_Simpan'],
        '/homeadmin/settingdata_keterangandokumen/ubah' => ['HomeadminSettingdataKeterangandokumenController', 'IndexAdmin_Keterangandokumen_Ubah'],
        '/homeadmin/settingdata_keterangandokumen/ubah/simpan' => ['HomeadminSettingdataKeterangandokumenController', 'IndexAdmin_Keterangandokumen_Ubah_Simpan'],
        '/homeadmin/rpl_listmatakuliah' => ['HomeadminRplListmatakuliahController', 'IndexAdmin_Listmatakuliah'],
        '/homeadmin/rpl_formulirpendaftaran' => ['HomeadminRplFormulirPendaftaranController', 'IndexAdmin_FormulirPendaftaran'],
        '/homeadmin/rpl_formulirpendaftaran/pdf' => ['HomeadminRplFormulirPendaftaranController', 'IndexAdmin_FormulirPendaftaran_Pdf'],
        '/homeadmin/settingdata_biayakonversi' => ['HomeadminSettingdataBiayakonversiController', 'IndexAdmin_BiayaKonversi'],
        '/homeadmin/settingdata_biayakonversi/simpan' => ['HomeadminSettingdataBiayakonversiController', 'IndexAdmin_BiayaKonversi_Simpan'],
        '/homeadmin/settingdata_biayakonversi/ubah' => ['HomeadminSettingdataBiayakonversiController', 'IndexAdmin_BiayaKonversi_Ubah'],
        '/homeadmin/settingdata_biayakonversi/ubah/simpan' => ['HomeadminSettingdataBiayakonversiController', 'IndexAdmin_BiayaKonversi_Ubah_Simpan'],
        '/homeadmin/settingdata_biayakonversi/honorassesor' => ['HomeadminSettingdataBiayakonversiController', 'IndexAdmin_BiayaKonversi_HonorAssesor'],
        '/homeadmin/settingdata_biayakonversi/honorassesor/simpan' => ['HomeadminSettingdataBiayakonversiController', 'IndexAdmin_BiayaKonversi_HonorAssesor_Simpan'],
        '/homeadmin/settingdata_assesor' => ['HomeadminSettingdataAssesorController', 'IndexAdmin_Assesor'],
        '/homeadmin/settingdata_assesor/simpan' => ['HomeadminSettingdataAssesorController', 'IndexAdmin_Assesor_Simpan'],
        '/homeadmin/settingdata_assesor/ubah' => ['HomeadminSettingdataAssesorController', 'IndexAdmin_Assesor_Ubah'],
        '/homeadmin/settingdata_assesor/ubah/simpan' => ['HomeadminSettingdataAssesorController', 'IndexAdmin_Assesor_Ubah_Simpan'],
        '/homeadmin/settingdata_nomordokumen' => ['HomeadminSettingdataNomorDokumenController', 'IndexAdmin_NomorDokumen'],
        '/homeadmin/settingdata_nomordokumen/simpan' => ['HomeadminSettingdataNomorDokumenController', 'IndexAdmin_NomorDokumen_Simpan'],
        '/homeadmin/settingdata_nomordokumen/ubah' => ['HomeadminSettingdataNomorDokumenController', 'IndexAdmin_NomorDokumen_Ubah'],
        '/homeadmin/settingdata_nomordokumen/ubah/simpan' => ['HomeadminSettingdataNomorDokumenController', 'IndexAdmin_NomorDokumen_Ubah_Simpan'],
        '/homeadmin/settingdata_prodi' => ['HomeadminSettingdataProdiController', 'IndexAdmin_Prodi'],
        '/homeadmin/settingdata_prodi/simpan' => ['HomeadminSettingdataProdiController', 'IndexAdmin_Prodi_Simpan'],
        '/homeadmin/settingdata_prodi/hapus' => ['HomeadminSettingdataProdiController', 'IndexAdmin_Prodi_Hapus'],
        '/homeadmin/settingdata_honorassesor' => ['HomeadminSettingdataHonorAssesorController', 'IndexAdmin_HonorAssesor'],
        '/homeadmin/settingdata_honorassesor/pdf' => ['HomeadminSettingdataHonorAssesorController', 'IndexAdmin_HonorAssesor_Pdf'],
        '/homeadmin/settingdata_honorassesor/excel' => ['HomeadminSettingdataHonorAssesorController', 'IndexAdmin_HonorAssesor_Excel'],
        '/homeadmin/settingdata_honorassesor/simpan' => ['HomeadminSettingdataHonorAssesorController', 'IndexAdmin_HonorAssesor_Simpan'],
        '/homeadmin/maintance' => ['HomeadminMaintanceController', 'IndexAdmin_Maintance'],
        '/homeadmin/maintance/simpan' => ['HomeadminMaintanceController', 'IndexAdmin_Maintance_Simpan'],

        '/homeadmin/settingdata_diskonfull' => ['HomeadminSettingdataDiskonFullController', 'IndexAdmin_DiskonFull'],
        '/homeadmin/settingdata_diskonfull/simpan' => ['HomeadminSettingdataDiskonFullController', 'IndexAdmin_DiskonFull_Simpan'],
        '/homeadmin/settingdata_diskonfull/ubah' => ['HomeadminSettingdataDiskonFullController', 'IndexAdmin_DiskonFull_Ubah'],
        '/homeadmin/settingdata_diskonfull/ubah/simpan' => ['HomeadminSettingdataDiskonFullController', 'IndexAdmin_DiskonFull_Ubah_Simpan'],

        '/homeadmin/rpl_report' => ['HomeadminRplReportController', 'IndexAdmin_Report'],
        '/homeadmin/rpl_report/excel' => ['HomeadminRplReportController', 'IndexAdmin_Report_Excel'],
        '/homeadmin/rpl_report/detail' => ['HomeadminRplReportController', 'IndexAdmin_Report_Detail'],
        '/homeadmin/rpl_report/detail/pdf' => ['HomeadminRplReportController', 'IndexAdmin_Report_Detail_Pdf'],
        '/homeadmin/rpl_report/detail/pdf_lampiran' => ['HomeadminRplReportController', 'IndexAdmin_Report_Detail_Lampiran'],

        '/homeadmin/hakakses' => ['HomeadminHakAksesController', 'IndexAdmin_HakAkses'],
        '/homeadmin/hakakses/simpan' => ['HomeadminHakAksesController', 'IndexAdmin_HakAkses_Simpan'],
        '/homeadmin/hakakses/hapus' => ['HomeadminHakAksesController', 'IndexAdmin_HakAkses_Hapus'],

        '/homeadmin/rpl_hapuspendaftaran' => ['HomeadminRplHapusPendaftaranController', 'IndexAdmin_HapusPendaftaran'],
        '/homeadmin/rpl_hapuspendaftaran/hapus' => ['HomeadminRplHapusPendaftaranController', 'IndexAdmin_HapusPendaftaran_Hapus'],

        '/homeadmin/kesalahan_bukavalidasi' => ['HomeadminKesalahanBukaValidasiController', 'IndexAdmin_Kesalahan_BukaValidasi'],
        '/homeadmin/kesalahan_bukavalidasi/buka' => ['HomeadminKesalahanBukaValidasiController', 'IndexAdmin_Kesalahan_BukaValidasi_Buka'],

        '/login/proses' => ['AuthController', 'IndexLoginProses'],
        
        '/homerpl' => ['HomerplController', 'IndexHomerpl'],
        '/homerpl/sk_mendaftar_pdf' => ['HomerplController', 'IndexHomerpl_SkMendaftar_Pdf'],
        '/homerpl/berkas' => ['HomerplBerkasController', 'IndexRpl_Berkas'],
        '/homerpl/berkas/ktp' => ['HomerplBerkasController', 'IndexRpl_Berkas_Ktp'],
        '/homerpl/berkas/kk' => ['HomerplBerkasController', 'IndexRpl_Berkas_Kk'],
        '/homerpl/berkas/nilai' => ['HomerplBerkasController', 'IndexRpl_Berkas_Nilai'],
        '/homerpl/berkas/2' => ['HomerplBerkasController', 'IndexRpl_Berkas_2'],
        '/homerpl/berkas/2/pendukung' => ['HomerplBerkasController', 'IndexRpl_Berkas_2_Pendukung'],
        '/homerpl/berkas/2/hapus' => ['HomerplBerkasController', 'IndexRpl_Berkas_2_Hapus'],
        '/homerpl/biodatadiri' => ['HomerplController', 'IndexHomerpl_BiodataDiri'],
        '/homerpl/informasi_file' => ['HomerplInformasiFileController', 'IndexRpl_InformasiFile'],
        '/homerpl/rpl' => ['HomerplRplController', 'IndexRpl_Rpl'],
        '/homerpl/pembayarankonversi' => ['HomerplPembayarankonversiController', 'IndexRpl_PembayaranKonversi'],
        '/homerpl/pembayarankonversi/simpan' => ['HomerplPembayarankonversiController', 'IndexRpl_PembayaranKonversi_Simpan'],
        '/homerpl/pembayarankonversi/cekpembayaran' => ['HomerplCekPembayarankonversiController', 'IndexRpl_CekPembayaranKonversi'],
        '/homerpl/pembayarankonversi/cekpembayaran/pdf' => ['HomerplCekPembayarankonversiController', 'IndexRpl_CekPembayaranKonversi_Pdf'],
        '/homerpl/pembayarankonversi/cekpembayaran/hapus' => ['HomerplCekPembayarankonversiController', 'IndexRpl_CekPembayaranKonversi_Hapus'],
        '/homerpl/pembayarankonversi/suksespembayaran' => ['HomerplSuksesPembayarankonversiController', 'IndexRpl_SuksesPembayaranKonversi'],
        '/homerpl/pembayarankonversi/suksespembayaran/pdf' => ['HomerplSuksesPembayarankonversiController', 'IndexRpl_SuksesPembayaranKonversi_Pdf'],
        '/homerpl/assesor' => ['HomerplAssesorController', 'IndexRpl_Assesor'],
        '/homerpl/assesor/pdf' => ['HomerplAssesorController', 'IndexRpl_Assesor_Pdf'],
        '/homerpl/assesor/pdf_lampiran' => ['HomerplAssesorController', 'IndexRpl_Assesor_Pdf_Lampiran'],

        '/homerpl/pumb' => ['HomerplPumbController', 'IndexRpl_Pumb'],

        '/homerpl/pumb/kwitansi' => ['HomerplPumbController', 'IndexRpl_Pumb_Kwitansi'],

        '/homerpl/pumb/cicilan' => ['HomerplPumbController', 'IndexRpl_Pumb_Cicilan'],
        '/homerpl/pumb/cicilan/simpan' => ['HomerplPumbController', 'IndexRpl_Pumb_Cicilan_Simpan'],

        '/homerpl/pumb/pmbregistrasi' => ['HomerplPumbController', 'IndexRpl_Pumb_PmbRegistrasi'],
        '/homerpl/pumb/pmbregistrasi/simpan' => ['HomerplPumbController', 'IndexRpl_Pumb_PmbRegistrasi_Simpan'],
        
        '/homerpl/pumb/simpan' => ['HomerplPumbController', 'IndexRpl_Pumb_Simpan'],
        '/homerpl/pumb/pembayaran' => ['HomerplPumbController', 'IndexRpl_Pumb_Pembayaran'],
        '/homerpl/pumb/pembayaran/pdf' => ['HomerplPumbController', 'IndexRpl_Pumb_Pembayaran_Pdf'],
        '/homerpl/pumb/pembayaran/cek' => ['HomerplPumbController', 'IndexRpl_Pumb_Pembayaran_Cek'],
        '/homerpl/pumb/pembayaran/hapus' => ['HomerplPumbController', 'IndexRpl_Pumb_Pembayaran_Hapus'],

        '/homerpl/pumb/npm' => ['HomerplPumbController', 'IndexRpl_Pumb_Npm'],
        '/homerpl/pumb/npm/simpan' => ['HomerplPumbController', 'IndexRpl_Pumb_Npm_Simpan'],

        '/logindosen' => ['AuthController', 'IndexLoginDosen'],
        '/logindosen/login' => ['AuthController', 'IndexLoginDosenProses'],

        '/homedosen' => ['HomedosenController', 'IndexHomedosen'],
        '/homedosen/informasi_file' => ['HomedosenInformasiFileController', 'IndexDosen_InformasiFile'],
        '/homedosen/rpl' => ['HomedosenRplController', 'IndexDosen_Rpl'],
        '/homedosen/rpl/2' => ['HomedosenRplController', 'IndexDosen_Rpl_2'],
        '/homedosen/rpl/3' => ['HomedosenRplController', 'IndexDosen_Rpl_3'],
        '/homedosen/rpl/4' => ['HomedosenRplController', 'IndexDosen_Rpl_4'],
        '/homedosen/rpl/4/validasi' => ['HomedosenRplController', 'IndexDosen_Rpl_4_Validasi'],
        '/homedosen/rpl/cms_1' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_1'],
        '/homedosen/rpl/cms_1/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_1_Simpan'],
        '/homedosen/rpl/cms_1/hapus' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_1_Hapus'],
        '/homedosen/rpl/cms_1/validasi' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_1_Validasi'],
        '/homedosen/rpl/cms_2' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2'],
        '/homedosen/rpl/cms_2/matakuliah' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah'],
        '/homedosen/rpl/cms_2/matakuliah/upload' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Upload'],
        '/homedosen/rpl/cms_2/matakuliah/upload/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Upload_Simpan'],
        '/homedosen/rpl/cms_2/matakuliah/ubah' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Ubah'],
        '/homedosen/rpl/cms_2/matakuliah/ubah/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Ubah_Simpan'],
        '/homedosen/rpl/cms_2/validasi' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Validasi'],
        '/homedosen/rpl/cms_3' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_3'],
        '/homedosen/rpl/cms_3/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_3_Simpan'],
        '/homedosen/rpl/cms_3/validasi' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_3_Validasi'],
        '/homedosen/rpl/pdf' => ['HomedosenRplController', 'IndexDosen_Rpl_Pdf'],
        '/homedosen/rpl/pdf_lampiran' => ['HomedosenRplController', 'IndexDosen_Rpl_Pdf_Lampiran'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Simpan'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Simpan'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/konversi' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/konversi/upload' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/konversi/upload/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Simpan'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/konversi/upload/ubah' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Ubah'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/konversi/upload/ubah/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Ubah_Simpan'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/nilai' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Nilai'],
        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/nilai/simpan' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Nilai_Simpan'],

        '/homedosen/rpl/cms_2/hapus' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Hapus'],

        '/homedosen/rpl/cms_2/matakuliah_perolehan/detail/hapus' => ['HomedosenRplController', 'IndexDosen_Rpl_Cms_2_Perolehan_Hapus'],
    ];
    

    try {

        if (array_key_exists($requestUri, $routes)) {

            $route = $routes[$requestUri];
            list($controllerName, $method) = $route;

            if (loadController($controllerName)) {

                $controller = new $controllerName();

                if (method_exists($controller, $method)) {

                    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && in_array($method, ['IndexLupapasswordSimpan', 'IndexAdminLogin', 'IndexLogout', 'IndexAdmin_InformasiFile_Simpan', 'IndexAdmin_EvaluasiDiri_Simpan', 'IndexAdmin_EvaluasiDiri_Ubah_Simpan', 'IndexAdmin_Profesiensi_Simpan', 'IndexAdmin_Profesiensi_Ubah_Simpan', 'IndexAdmin_HasilEvaluasiAsesor_Simpan', 'IndexAdmin_HasilEvaluasiAsesor_Ubah_Simpan', 'IndexAdmin_Keterangandokumen_Simpan', 'IndexAdmin_Keterangandokumen_Ubah_Simpan', 'IndexAdmin_BiayaKonversi_Simpan', 'IndexAdmin_BiayaKonversi_Ubah_Simpan', 'IndexAdmin_Assesor_Simpan', 'IndexLoginProses', 'IndexRpl_PembayaranKonversi_Simpan', 'IndexRpl_CekPembayaranKonversi_Hapus', 'IndexAdmin_Assesor_Ubah_Simpan', 'IndexLoginDosenProses', 'IndexDosen_Rpl_Cms_1_Simpan', 'IndexDosen_Rpl_Cms_2_Matakuliah_Upload_Simpan', 'IndexAdmin_NomorDokumen_Simpan', 'IndexAdmin_NomorDokumen_Ubah_Simpan', 'IndexDosen_Rpl_Cms_2_Matakuliah_Ubah_Simpan', 'IndexDosen_Rpl_Cms_3_Simpan', 'IndexAdmin_Prodi_Simpan', 'IndexAdmin_BiayaKonversi_HonorAssesor_Simpan', 'IndexHomerpl_BiodataDiri', 'IndexRpl_Berkas_Ktp', 'IndexRpl_Berkas_Kk', 'IndexRpl_Berkas_Nilai', 'IndexRpl_Berkas_2_Pendukung', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Simpan', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Simpan', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Konversi_Upload_Ubah_Simpan', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Nilai_Simpan', 'IndexDosen_Rpl_Cms_2_Matakuliah_Perolehan_Detail_Simpan', 'IndexAdmin_Maintance_Simpan', 'IndexAdmin_HonorAssesor_Simpan','IndexRpl_Pumb_Simpan','IndexRpl_Pumb_Pembayaran_Cek','IndexRpl_Pumb_Npm_Simpan','IndexRpl_Pumb_Pembayaran_Hapus','IndexRpl_Pumb_PmbRegistrasi_Simpan','IndexRpl_Pumb_PmbRegistrasi','IndexAdmin_Report','IndexRpl_Pumb_Cicilan_Simpan','IndexAdmin_HakAkses_Simpan','IndexAdmin_HapusPendaftaran','IndexAdmin_DiskonFull_Simpan','IndexAdmin_DiskonFull_Ubah_Simpan']) ) {

                        $result = $controller->$method($_POST);
                        redirect($result['Data']['Url'], $result['Error'] === '000' ? '01' : '03', $result['Message']);

                    } elseif ( $_SERVER['REQUEST_METHOD'] === 'GET' OR $_SERVER['REQUEST_METHOD'] === 'POST' && in_array($method, ['IndexAdmin_Listmatakuliah', 'IndexAdmin_FormulirPendaftaran', 'IndexDosen_Rpl', 'IndexDosen_Rpl_Cms_2_Matakuliah', 'IndexAdmin_HonorAssesor', 'IndexAdmin_Kesalahan_BukaValidasi']) ) {
                        
                        $controller->$method();

                    } else {

                        redirect(__Base_Url(), '03', 'Invalid Request Method');

                    }

                } else {

                    http_response_code(404);
                    redirect(__Base_Url(), '03', 'Method Not Found');
                    
                }

            } else {

                http_response_code(404);
                redirect(__Base_Url(), '03', 'Controller Not Found');

            }
            
        } else {

            http_response_code(404);
            redirect(__Base_Url(), '03', '404 Not Found');

        }

    } catch (Exception $e) {

        http_response_code(500);
        // redirect('/', '03', 'Server Error: ' . $e->getMessage());
        include __DIR__ . '/../public/__error.php';
        exit();

    }