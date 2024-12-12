<?php


    class __Libary
    {
        public static function Tanggal($tanggal) {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('d M Y', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function Waktu($waktu) {
            $format_waktu = strtotime($waktu);
            $hasil_waktu = date('H : i : s', $format_waktu);
            return $hasil_waktu;
        }
    
        public static function TanggalWaktu($tanggal) {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('d M Y - H:i:s', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function DataTanggal($tanggal) {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('d M Y', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function PotongTanggal($tanggal) {
            $format_tanggal = strtotime($tanggal);
            $hasil_tanggal = date('Y-m-d', $format_tanggal);
            return $hasil_tanggal;
        }
    
        public static function HurufAwalBesar($huruf) {
            $ubah_nama = strtolower($huruf);
            $new_nama = ucwords($ubah_nama);
            return $new_nama;
        }
    
        public static function HurufBesar($huruf) {
            $new_nama = strtoupper($huruf);
            return $new_nama;
        }
    
        public static function HurufKecil($huruf) {
            $new_nama = strtolower($huruf);
            return $new_nama;
        }
    
        public static function Jumlah($jumlah) {
            $hasil_jumlah = number_format($jumlah, 0);
            return $hasil_jumlah;
        }
    
        public static function Uang($uang) {
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
    
        public static function UbahHariInggris($hari) {
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
    
        public static function TanggalIndonesia($tgl) {
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
    
        public static function RomawiBulan($bln) {
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
    
        public static function RomawiNomor($no) {
            $rom = ['', "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
            return $rom[$no];
        }
    
        public static function FormatAwalNol($nomor, $jumlahNol = 5, $char = '0') {
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
    }



    // @$__helpers_libary = new __Libary;