<?php

    class __Helpers
    {
        protected $__secret_key;
        // protected $__universitas;

        public function __construct()
        {
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            // $this->__universitas = new __Universitas();
        }

        public static function Tanggal($tanggal) 
        {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('d M Y', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function Waktu($waktu) 
        {
            $format_waktu = strtotime($waktu);
            $hasil_waktu = date('H : i : s', $format_waktu);
            return $hasil_waktu;
        }
    
        public static function TanggalWaktu($tanggal) 
        {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('d M Y - H:i:s', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function DataTanggal($tanggal) 
        {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('d M Y', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function PotongTanggal($tanggal) 
        {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('Y-m-d', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function HurufAwalBesar($huruf) 
        {
            $ubah_nama = strtolower($huruf);
            $new_nama = ucwords($ubah_nama);
            return $new_nama;
        }
    
        public static function HurufBesar($huruf) 
        {
            $new_nama = strtoupper($huruf);
            return $new_nama;
        }
    
        public static function HurufKecil($huruf) 
        {
            $new_nama = strtolower($huruf);
            return $new_nama;
        }
    
        public static function Jumlah($jumlah) 
        {
            $hasil_jumlah = number_format($jumlah, 0);
            return $hasil_jumlah;
        }
    
        public static function Uang($uang) 
        {
            $rp = "";
            $digit = strlen($uang);
            while ($digit > 3) {
                $rp = "." . substr($uang, -3) . $rp;
                $lebar = strlen($uang) - 3;
                $uang = substr($uang, 0, $lebar);
                $digit = strlen($uang);
            }
            $rp = $uang . $rp . ",-";
            return $rp;
        }
    
        public static function UbahHariInggris($hari) 
        {
            switch ($hari) {
                case 'Monday':
                    $hasil_hari = 'Senin';
                    break;
                case 'Tuesday':
                    $hasil_hari = 'Selasa';
                    break;
                case 'Wednesday':
                    $hasil_hari = 'Rabu';
                    break;
                case 'Thursday':
                    $hasil_hari = 'Kamis';
                    break;
                case 'Friday':
                    $hasil_hari = 'Jumat';
                    break;
                case 'Saturday':
                    $hasil_hari = 'Sabtu';
                    break;
                case 'Sunday':
                    $hasil_hari = 'Minggu';
                    break;
            }
            return $hasil_hari;
        }
    
        public static function TanggalIndonesia($tgl) 
        {
            $tanggal = explode('-', $tgl);
            $kdbl = $tanggal[1];
    
            switch ($kdbl) {
                case '01':
                    $nbln = 'Januari';
                    break;
                case '02':
                    $nbln = 'Februari';
                    break;
                case '03':
                    $nbln = 'Maret';
                    break;
                case '04':
                    $nbln = 'April';
                    break;
                case '05':
                    $nbln = 'Mei';
                    break;
                case '06':
                    $nbln = 'Juni';
                    break;
                case '07':
                    $nbln = 'Juli';
                    break;
                case '08':
                    $nbln = 'Agustus';
                    break;
                case '09':
                    $nbln = 'September';
                    break;
                case '10':
                    $nbln = 'Oktober';
                    break;
                case '11':
                    $nbln = 'November';
                    break;
                case '12':
                    $nbln = 'Desember';
                    break;
                default:
                    $nbln = '';
                    break;
            }
    
            $tgl_ind = $tanggal[0] . " " . $nbln . " " . $tanggal[2];
            return $tgl_ind;
        }
    
        public static function RomawiBulan($bln) 
        {
            switch ($bln) {
                case 1:
                    return "I";
                    break;
                case 2:
                    return "II";
                    break;
                case 3:
                    return "III";
                    break;
                case 4:
                    return "IV";
                    break;
                case 5:
                    return "V";
                    break;
                case 6:
                    return "VI";
                    break;
                case 7:
                    return "VII";
                    break;
                case 8:
                    return "VIII";
                    break;
                case 9:
                    return "IX";
                    break;
                case 10:
                    return "X";
                    break;
                case 11:
                    return "XI";
                    break;
                case 12:
                    return "XII";
                    break;
            }
        }
    
        public static function RomawiNomor($no) 
        {
            $rom = ['', "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
            return $rom[$no];
        }
    
        public static function FormatAwalNol($nomor, $jumlahNol = 5, $char = '0') 
        {
            $jumlahNomor = strlen((string) $nomor);
            $ulangNol = $jumlahNol - $jumlahNomor;
            return str_repeat($char, $ulangNol) . $nomor;
        }

        public static function Generate_Random( $data = 64 )
        {
            return bin2hex(random_bytes($data / 2));
        }

        public static function Password_Random( $data = 10 )
        {
            return bin2hex(random_bytes($data / 2));
        }

        public static function __Barcode( $data )
        {
            @$__qrvalues               = @$data;  
            @$__tempDirs               = "../../../storage/__barcode/";
            @$__codeContentss          = @$__qrvalues;
            @$__fileNames              = str_replace(" ","_",@$__qrvalues).'.png'; 
            @$__pngAbsoluteFilePaths   = @$__tempDirs . @$__fileNames; 
            @$__urlRelativeFilePath    = @$__tempDirs . @$__fileNames; 
            @$__quality                = 'H';
            @$__ukuran                 = '5';
            @$__padding                = '1';
                if ( !file_exists( @$__pngAbsoluteFilePaths ) ) { 
                    QRcode::png( @$__codeContentss, @$__pngAbsoluteFilePaths, @$__quality, @$__ukuran, @$__padding ); 
                }

            return $__fileNames;
        }
        
        public function SecretOpen( $__id )
        {
            return explode("|\|", $this->__secret_key->Decrypt( $__id, 221, 77) )[1];
        }

        public function SecretEncrypt( $__id )
        {
            return $this->__secret_key->Encrypt(date('sHis') . '|\|' . $__id . '|\|' . time(), 221, 5);
        }

        public function isTokenValid( $token ): bool
        {
            try {

                $decrypted  = $this->__secret_key->Decrypt($token, 221, 77);
                $parts      = explode("|\|", $decrypted);
                
                return $parts[1] == date('YmdH');

            } catch (Exception $e) {

                return false;

            }
        }

        public function __GetData_File( $__folder , $__url , $__name , $__size , $__type , $__tmp , $__file_lama , array $__rpl = null )
        {
            @$__uploads_file_media          = dirname(dirname(__DIR__)) . '/src/storages/__' . $__folder . '/';

            @$__nama_file_media             = explode('.', $__name);
            @$__ekstensi_file_media         = strtolower(end($__nama_file_media));

            @$__extensions_file_media       = array('pdf' , 'PDF');

            if ( $__rpl['Nama'] == TRUE ) {
                @$__nama_baru_file              = $__rpl['Nama'] . "_" . date('dmYHis') . "_" . rand(0,99999) . "." . @$__ekstensi_file_media;
            } else {
                @$__nama_baru_file              = date('dmY') . "_" . date('His') . "_" . rand(0,99999) . "." . @$__ekstensi_file_media;
            }

            @$__path_file_file_media        = $__uploads_file_media . $__nama_baru_file;

            @$__extension_file_media       = array_pop($__nama_file_media);
            @$__file_explode_ekstensi      = explode("/", $__type);

            if ( @$__file_explode_ekstensi[1] == 'pdf' OR @$__file_explode_ekstensi[1] == 'PDF' ) {
                @$__hasil_ekstensi_file     = 'PDF';
            } else {
                @$__hasil_ekstensi_file     = 'Tidak Dapat Ekstensi';
            }


            if ( @$__hasil_ekstensi_file == 'Tidak Dapat Ekstensi' OR !in_array($__extension_file_media, $__extensions_file_media) ) {

                return [
                    '__Error'       => '99',
                    '__Message'     => 'Format Haruslah PDF',
                    '__Nama_File'   => '',
                    '__Format_File' => '',
                    '__Ukuran_File' => '',
                    '__Path_File'   => '',
                    '__Tmp_File'    => '',
                ];

            }


            $valid_mime_types = [
                'pdf' => 'application/pdf',
            ];

            $file_mime = mime_content_type($__tmp);
            if (!isset($valid_mime_types[$__extension_file_media]) || $valid_mime_types[$__extension_file_media] !== $file_mime) {
                return [
                    '__Error' => '99',
                    '__Message' => 'MIME type tidak sesuai dengan ekstensi!',
                    '__Data' => [],
                ];
            }

            if ($__extension_file_media === 'pdf') {
                $file_contents = file_get_contents($__tmp);
                $magic_number = bin2hex(substr($file_contents, 0, 4)); 

                $valid_magic_numbers = [
                    'pdf' => '25504446',
                ];

                if (substr($magic_number, 0, strlen($valid_magic_numbers['pdf'])) !== $valid_magic_numbers['pdf']) {
                    return [
                        '__Error' => '99',
                        '__Message' => 'Magic number tidak cocok dengan format file!',
                        '__Data' => [],
                    ];
                }
            }


            if ( $__size > 20000000 ) {

                return [
                    '__Error'       => '99',
                    '__Message'     => 'Ukuran Tidak Boleh Lebih Dari 10 MB !',
                    '__Nama_File'   => '',
                    '__Format_File' => '',
                    '__Ukuran_File' => '',
                    '__Path_File'   => '',
                    '__Tmp_File'    => '',
                ];

            }

            @unlink('src/storages/__' . $__folder . '/' . @$__file_lama);
            return [
                '__Error'       => '00',
                '__Message'     => '',
                '__Nama_File'   => @$__nama_baru_file,
                '__Format_File' => @$__hasil_ekstensi_file,
                '__Ukuran_File' => @$__size,
                '__Path_File'   => @$__path_file_file_media,
                '__Tmp_File'    => @$__tmp,
            ];
        }

        public function __GetData_Gambar( $__folder , $__url , $__name , $__size , $__type , $__tmp , $__file_lama )
        {
            $__uploads_file_media          = dirname(dirname(__DIR__)) . '/src/storages/__' . $__folder . '/';

            $__nama_file_media             = explode('.', $__name);
            $__ekstensi_file_media         = strtolower(end($__nama_file_media));

            $__extensions_file_media       = array('jpg', 'jpeg', 'png' , 'JPG', 'JPEG', 'PNG');
            $__nama_baru_file              = date('dmY') . "_" . date('His') . "_" . rand(0,99999) . "." . $__ekstensi_file_media;
            $__path_file_file_media        = $__uploads_file_media . $__nama_baru_file;

            $__extension_file_media       = array_pop($__nama_file_media);
            $__file_explode_ekstensi      = explode("/", $__type);

            if ( $__file_explode_ekstensi[1] == 'jpg' OR $__file_explode_ekstensi[1] == 'JPG' ) {
                $__hasil_ekstensi_file     = 'JPG';
            } elseif ( $__file_explode_ekstensi[1] == 'jpeg' OR $__file_explode_ekstensi[1] == 'JPEG' ) {
                $__hasil_ekstensi_file     = 'JPEG';
            } elseif ( $__file_explode_ekstensi[1] == 'png' OR $__file_explode_ekstensi[1] == 'PNG' ) {
                $__hasil_ekstensi_file     = 'PNG';
            } else {
                $__hasil_ekstensi_file     = 'Tidak Dapat Ekstensi';
            }


            if ( $__hasil_ekstensi_file == 'Tidak Dapat Ekstensi' OR !in_array($__extension_file_media, $__extensions_file_media) ) {

                return [
                    '__Error'       => '99',
                    '__Message'     => 'Format Haruslah JPG, JPEG, PNG',
                    '__Nama_File'   => '',
                    '__Format_File' => '',
                    '__Ukuran_File' => '',
                    '__Path_File'   => '',
                    '__Tmp_File'    => '',
                ];

            }


            $valid_mime_types = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
            ];

            $file_mime = mime_content_type($__tmp);
            if (!isset($valid_mime_types[$__extension_file_media]) || $valid_mime_types[$__extension_file_media] !== $file_mime) {
                return [
                    '__Error' => '99',
                    '__Message' => 'MIME type tidak sesuai dengan ekstensi!',
                    '__Data' => [],
                ];
            }

            if (in_array($__extension_file_media, ['jpg', 'jpeg', 'png'])) {
                $file_contents = file_get_contents($__tmp);
                $magic_number = bin2hex(substr($file_contents, 0, 4)); 
                $valid_magic_numbers = [
                    'jpg' => 'ffd8ff',
                    'jpeg' => 'ffd8ff',
                    'png' => '89504e47',
                ];

                if (substr($magic_number, 0, strlen($valid_magic_numbers[$__extension_file_media])) !== $valid_magic_numbers[$__extension_file_media]) {
                    return [
                        '__Error' => '99',
                        '__Message' => 'Magic number tidak cocok dengan format file!',
                        '__Data' => [],
                    ];
                }
            }
            

            if ( $__size > 2000000 ) {

                return [
                    '__Error'       => '99',
                    '__Message'     => 'Ukuran Tidak Boleh Lebih Dari 2 MB !',
                    '__Nama_File'   => '',
                    '__Format_File' => '',
                    '__Ukuran_File' => '',
                    '__Path_File'   => '',
                    '__Tmp_File'    => '',
                ];

            }

            unlink('src/storages/__' . $__folder . '/' . $__file_lama);
            return [
                '__Error'       => '00',
                '__Message'     => '',
                '__Nama_File'   => $__nama_baru_file,
                '__Format_File' => $__hasil_ekstensi_file,
                '__Ukuran_File' => $__size,
                '__Path_File'   => $__path_file_file_media,
                '__Tmp_File'    => $__tmp,
            ];
        }

        public static function __Slugs( $data )
        {
            $data = strtolower($data);
            $data = preg_replace('/[^a-z0-9]+/', '-', $data);
            $data = trim($data, '-');
            
            return $data;
        }

        public static function __Explode_Data( $data )
        {
            return explode( "~||~" , $data );
        }

        public static function __TambahTanggal()
        {
            $tgl = date('Y-m-d', strtotime('+2 days' , strtotime( date('Y-m-d') )));
            return $tgl . ' ' . date('H:i:s');
        }

        public static function __Semester( $data )
        {
            if ( $data == '1' ) {
                $result = 'Ganjil';
            } elseif ( $data == '2' ) {
                $result = 'Genap';
            } elseif ( $data == '3' ) {
                $result = 'Antara';
            } else {
                $result = 'Kosong';
            }
            return $result;
        }

        public function __GetData_File_Dokumen( $__folder , $__url , $__name , $__size , $__type , $__tmp , $__file_lama , $__format , $__ukuran , $__nama )
        {
            $__uploads_file_media          = dirname(dirname(__DIR__)) . '/src/storages/__' . $__folder . '/';

            $__nama_file_media             = explode('.', $__name);
            $__ekstensi_file_media         = strtolower(end($__nama_file_media));

            if ( $__format == 'GAMBAR' ) {
                $__extensions_file_media       = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
            } elseif ( $__format == 'PDF' ) {
                $__extensions_file_media       = array('pdf' , 'PDF');
            } else {
                $__extensions_file_media       = array( $__format );
            }
            // $__nama_baru_file              = "__File_" . date('dmYHis') . "_" . rand(0,99999) . "." . $__ekstensi_file_media;
            // $__nama_baru_file              = date('dmY') . "_" . date('His') . "_" . rand(0,99999) . "." . $__ekstensi_file_media;
            $__nama_baru_file              = $__nama . "_" . date('dmY') . "_" . date('His') . "_" . rand(0,99999) . "." . $__ekstensi_file_media;
            $__path_file_file_media        = $__uploads_file_media . $__nama_baru_file;

            $__extension_file_media       = array_pop($__nama_file_media);
            $__file_explode_ekstensi      = explode("/", $__type);

            if ( $__file_explode_ekstensi[1] == 'pdf' OR $__file_explode_ekstensi[1] == 'PDF' ) {
                $__hasil_ekstensi_file     = 'PDF';
            } elseif ( $__file_explode_ekstensi[1] == 'jpg' OR $__file_explode_ekstensi[1] == 'JPG' ) {
                $__hasil_ekstensi_file     = 'JPG';
            } elseif ( $__file_explode_ekstensi[1] == 'jpeg' OR $__file_explode_ekstensi[1] == 'JPEG' ) {
                $__hasil_ekstensi_file     = 'JPEG';
            } elseif ( $__file_explode_ekstensi[1] == 'png' OR $__file_explode_ekstensi[1] == 'PNG' ) {
                $__hasil_ekstensi_file     = 'PNG';
            } else {
                $__hasil_ekstensi_file     = 'Tidak Dapat Ekstensi';
            }

            if ( $__hasil_ekstensi_file == 'Tidak Dapat Ekstensi' OR !in_array($__extension_file_media, $__extensions_file_media) ) {

                return [
                    '__Error'       => '99',
                    '__Message'     => 'Format Haruslah PDF',
                    '__Nama_File'   => '',
                    '__Format_File' => '',
                    '__Ukuran_File' => '',
                    '__Path_File'   => '',
                    '__Tmp_File'    => '',
                ];

            }

            
            $valid_mime_types = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'pdf' => 'application/pdf',
            ];

            $file_mime = mime_content_type($__tmp);
            if (!isset($valid_mime_types[$__extension_file_media]) || $valid_mime_types[$__extension_file_media] !== $file_mime) {
                return [
                    '__Error' => '99',
                    '__Message' => 'MIME type tidak sesuai dengan ekstensi!',
                    '__Data' => [],
                ];
            }

            if (in_array($__extension_file_media, ['jpg', 'jpeg', 'png'])) {
                $file_contents = file_get_contents($__tmp);
                $magic_number = bin2hex(substr($file_contents, 0, 4)); 
                $valid_magic_numbers = [
                    'jpg' => 'ffd8ff',
                    'jpeg' => 'ffd8ff',
                    'png' => '89504e47',
                ];

                if (substr($magic_number, 0, strlen($valid_magic_numbers[$__extension_file_media])) !== $valid_magic_numbers[$__extension_file_media]) {
                    return [
                        '__Error' => '99',
                        '__Message' => 'Magic number tidak cocok dengan format file!',
                        '__Data' => [],
                    ];
                }
            }

            if ($__extension_file_media === 'pdf') {
                $file_contents = file_get_contents($__tmp);
                $magic_number = bin2hex(substr($file_contents, 0, 4)); 

                $valid_magic_numbers = [
                    'pdf' => '25504446',
                ];

                if (substr($magic_number, 0, strlen($valid_magic_numbers['pdf'])) !== $valid_magic_numbers['pdf']) {
                    return [
                        '__Error' => '99',
                        '__Message' => 'Magic number tidak cocok dengan format file!',
                        '__Data' => [],
                    ];
                }
            }


            if ( $__size > $__ukuran . '000000' ) {

                return [
                    '__Error'       => '99',
                    '__Message'     => 'Ukuran Tidak Boleh Lebih Dari ' . $__ukuran . ' MB !',
                    '__Nama_File'   => '',
                    '__Format_File' => '',
                    '__Ukuran_File' => '',
                    '__Path_File'   => '',
                    '__Tmp_File'    => '',
                ];

            }

            unlink('src/storages/__' . $__folder . '/' . $__file_lama);
            return [
                '__Error'       => '00',
                '__Message'     => '',
                '__Nama_File'   => $__nama_baru_file,
                '__Format_File' => $__hasil_ekstensi_file,
                '__Ukuran_File' => $__size,
                '__Path_File'   => $__path_file_file_media,
                '__Tmp_File'    => $__tmp,
            ];
        }

        public function __Progres_Assesor( $_1 , $_2 , $_3 )
        {
            if ( $_1 == 'Y' ) {
                $__progress_1 = '100';
            } else {
                $__progress_1 = '50';
            }

            if ( $_1 == 'Y' AND $_2 == 'Y' ) {
                $__progress_2 = '100';
            } else {
                if ( $_1 == 'Y' ) {
                    $__progress_2 = '75';
                } else {
                    $__progress_2 = '25';
                }
            }

            if ( $_1 == 'Y' AND $_2 == 'Y' AND $_3 == 'Y' ) {
                $__progress_3 = '100';
            } else {
                if ( $_1 == 'Y' AND $_2 == 'Y' ) {
                    $__progress_3 = '50';
                } elseif ( $_2 == 'Y' ) {
                    $__progress_3 = '35';
                } else {
                    $__progress_3 = '0';
                }
            }

            return [
                '1' => $__progress_1,
                '2' => $__progress_2,
                '3' => $__progress_3,
            ];
        }

        public function __Singkat_Fakultas( $data )
        {
            if ( $data == 'SAINS DAN TEKNOLOGI' OR $data == 'SAINS DAN TEKNOLOGI UQB' ) {
                $__ket = 'SAINTEK';
            } elseif ( $data == 'SOSIAL DAN HUKUM' OR $data == 'SOSIAL DAN HUKUM UQB' ) {
                $__ket = 'SOSHUM';
            } elseif ( $data == 'KEGURUAN DAN ILMU PENDIDIKAN' OR $data == 'KEGURUAN DAN ILMU PENDIDIKAN UQB' ) {
                $__ket = 'FKIP';
            } else {
                $__ket = '-';
            }

            return $__ket;
        }

        public static function FormatNomorSurat($nomor, $jumlahNol = 4, $char = '0') 
        {
            $jumlahNomor = strlen((string) $nomor);
            $ulangNol = $jumlahNol - $jumlahNomor;
            return str_repeat($char, $ulangNol) . $nomor;
        }

        public function GenerateAkhirNpm ( $nomor, $jumlahNol = 4, $char = '0' ) {

            $jumlahNomor	= strlen((string) $nomor);
            $ulangNol		= $jumlahNol - $jumlahNomor;

            return str_repeat($char, $ulangNol) . $nomor;
            
        }

        public function prosesKoordinator($koordinator) {
            // Cek apakah ada tanda ~||~ dalam string
            if (strpos($koordinator, '~||~') !== false) {
                // Jika ada, explode string berdasarkan tanda ~||~
                $explodedData = explode('~||~', $koordinator);
                // Ambil bagian pertama setelah explode
                return $explodedData[0];
            } else {
                // Jika tidak ada tanda ~||~, ambil hanya 50 karakter pertama
                return substr($koordinator, 0, 50);
            }
        }
    }