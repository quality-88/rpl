<?php

    class __Universitas
    {
        public function __Url_Universitas ()
        {
            $__base_app = __Aplikasi();
            
            if ( $__base_app['Kampus'] == 'UQM' ) {

                $__data = [
                    'Website'       => 'https://www.universitasquality.ac.id/',
                    'Pmb'           => 'https://portaluniversitasquality.ac.id:3440/uq/pmb/',
                    'Rpl'           => 'https://portaluniversitasquality.ac.id:3440/uq/rpl/',
                    'Portal'        => 'https://portaluniversitasquality.ac.id:3440/uq/portal-mahasiswa/',
                ];

            } elseif ( $__base_app['Kampus'] == 'UQB' ) {

                $__data = [
                    'Website'       => 'https://www.uqb.ac.id/',
                    'Pmb'           => 'https://portaluniversitasquality.ac.id:3440/uqb/pmb/',
                    'Rpl'           => 'https://portaluniversitasquality.ac.id:3440/uqb/rpl/',
                    'Portal'        => 'https://portaluniversitasquality.ac.id:3440/uqb/portal-mahasiswa/',
                ];

            } else {

                $__data = [
                    'Website'       => 'https://www.universitasquality.ac.id/',
                    'Pmb'           => 'https://portaluniversitasquality.ac.id:3440/uq/pmb/',
                    'Rpl'           => 'https://portaluniversitasquality.ac.id:3440/uq/rpl/',
                    'Portal'        => 'https://portaluniversitasquality.ac.id:3440/uq/portal-mahasiswa/',
                ];
                
            }

            return $__data;
        }
        
        public function __Detail_Universitas ()
        {
            $__base_app = __Aplikasi();
            
            if ( $__base_app['Kampus'] == 'UQM' ) {

                $__data = [
                    'Logo'              => __Base_Url() . 'resources/libary/logo/logo-uq.png',
                    'KopSurat'          => './resources/libary/kop-surat/UQ/KOP-UQ.jpg',
                    'Logo_Kampus'       => './resources/libary/logo/logo-uq.png',
                    'Nama'              => 'Universitas Quality',
                    'Singkat'           => 'UQ',
                    'Email'             => 'uqbackup88@gmail.com',
                    'Pass'              => 'KeamananUQ!#*',
                    'PassEmail'         => 'iqdb tcpz gxdv odsp',
                    'IdKampus_Rpl'      => '21',
                ];

            } elseif ( $__base_app['Kampus'] == 'UQB' ) {

                $__data = [
                    'Logo'              => __Base_Url() . 'resources/libary/logo/logo-uqb.png',
                    'KopSurat'          => './resources/libary/kop-surat/UQB/KOP-UQB.jpg',
                    'Logo_Kampus'       => './resources/libary/logo/logo-uqb.png',
                    'Nama'              => 'Universitas Quality Berastagi',
                    'Singkat'           => 'UQB',
                    'Email'             => 'uqbackup88@gmail.com',
                    'Pass'              => 'KeamananUQ!#*',
                    'PassEmail'         => 'iqdb tcpz gxdv odsp',
                    'IdKampus_Rpl'      => '17',
                ];

            } else {

                $__data = [
                    'Logo'              => '',
                    'KopSurat'          => '',
                    'Logo_Kampus'       => '',
                    'Nama'              => 'Universitas Anomymous',
                    'Singkat'           => '',
                    'Email'             => '',
                    'Pass'              => '',
                    'PassEmail'         => '',
                    'IdKampus_Rpl'      => '',
                ];
                
            }
            
            return $__data;
        }

        public function __Sosmed_Universitas () 
        {
            $__base_app = __Aplikasi();
            
            if ( $__base_app['Kampus'] == 'UQM' ) {

                $__data = [
                    'Instagram' => 'https://www.instagram.com/uqberastagi/',
                    'Facebook'  => 'https://www.facebook.com/www.uqb.ac.id',
                    'Youtube'   => 'https://www.youtube.com/channel/UCSRDfgCPmOKhbXs3ofx2j-w',
                    'Tiktok'    => 'https://www.tiktok.com/@uqberastagi',
                    'Email'     => 'info@uqb.ac.id',
                    'Whastapp'  => '6282361861717',
                ];

            } elseif ( $__base_app['Kampus'] == 'UQB' ) {

                $__data = [
                    'Instagram' => 'https://www.instagram.com/uqberastagi/',
                    'Facebook'  => 'https://www.facebook.com/www.uqb.ac.id',
                    'Youtube'   => 'https://www.youtube.com/channel/UCSRDfgCPmOKhbXs3ofx2j-w',
                    'Tiktok'    => 'https://www.tiktok.com/@uqberastagi',
                    'Email'     => 'info@uqb.ac.id',
                    'Whastapp'  => '6282361861717',
                ];

            } else {

                $__data = [
                    'Instagram' => 'https://www.instagram.com/uqberastagi/',
                    'Facebook'  => 'https://www.facebook.com/www.uqb.ac.id',
                    'Youtube'   => 'https://www.youtube.com/channel/UCSRDfgCPmOKhbXs3ofx2j-w',
                    'Tiktok'    => 'https://www.tiktok.com/@uqberastagi',
                    'Email'     => 'info@uqb.ac.id',
                    'Whastapp'  => '6282361861717',
                ];
                
            }

            return $__data;
        }

        public function __Kop_Universitas ()
        {
            $__base_app = __Aplikasi();
            
            if ( $__base_app['Kampus'] == 'UQM' ) {

                if ( $__base_app['Aktif'] == 'N' ) {

                    $__data = __Base_Url() . 'storage/kop-surat/UQ/KOP-UQ.jpg';

                } else {

                    $__data = './storage/kop-surat/UQ/KOP-UQ.jpg';

                }

            } elseif ( $__base_app['Kampus'] == 'UQB' ) {

                if ( $__base_app['Aktif'] == 'N' ) {

                    $__data = __Base_Url() . 'storage/kop-surat/UQB/KOP-UQB.jpg';

                } else {

                    $__data = './storage/kop-surat/UQB/KOP-UQB.jpg';

                }

            } else {

                if ( $__base_app['Aktif'] == 'N' ) {

                    $__data = __Base_Url() . 'storage/kop-surat/UQ/KOP-UQ.jpg';

                } else {

                    $__data = './storage/kop-surat/UQ/KOP-UQ.jpg';

                }
                
            }

            return $__data;
        }

        public function __QueryNot_Universitas ()
        {
            $__base_app = __Aplikasi();
            
            if ( $__base_app['Kampus'] == 'UQM' ) {

                $__data = 'NOT';

            } elseif ( $__base_app['Kampus'] == 'UQB' ) {

                $__data = '';

            } else {

                $__data = 'NOT';
                
            }
            
            return $__data;
        }

        public function __Konversi_Prodi ( array $data )
        {
            if ( $data['Prodi'] == 'PGSD' OR $data['Prodi'] == 'PGSD UQB' ) {

                $result = 'Pendidikan Guru Sekolah Dasar';

            } elseif ( $data['Prodi'] == 'PPKN' OR $data['Prodi'] == 'PPKN UQB' ) {

                $result = 'Pendidikan Pancasila Dan Kewarganegaraan';
                
            } elseif ( $data['Prodi'] == 'POR' OR $data['Prodi'] == 'POR UQB' ) {
                
                @$request   = 'Pendidikan Olahraha';
                
            } elseif ( $data['Prodi'] == 'PBING' OR $data['Prodi'] == 'PBING UQB' ) {

                @$request   = 'Pendidikan Bahasa Inggris';

            } elseif ( $data['Prodi'] == 'MATEMATIKA' OR $data['Prodi'] == 'MATEMATIKA UQB' ) {

                @$request   = 'Pendidikan Matematika';

            } else {

                $result = $data['Prodi'];

            }

            return $result;
        }

        public function __Konversi_Fakultas ( array $data )
        {
            if ( $data['Prodi'] == 'PGSD' OR $data['Prodi'] == 'PGSD UQB' OR $data['Prodi'] == 'PPKN' OR $data['Prodi'] == 'PPKN UQB' OR $data['Prodi'] == 'POR' OR $data['Prodi'] == 'POR UQB' OR $data['Prodi'] == 'PBING' OR $data['Prodi'] == 'PBING UQB' OR $data['Prodi'] == 'MATEMATIKA' OR $data['Prodi'] == 'MATEMATIKA UQB' ) {

                $result = 'KEGURUAN DAN ILMU PENDIDIKAN';

            } elseif ( $data['Prodi'] == 'HUKUM' OR $data['Prodi'] == 'HUKUM UQB' OR $data['Prodi'] == 'MANAJEMEN' OR $data['Prodi'] == 'MANAJEMEN UQB' ) {

                $result = 'SOSAL DAN HUKUM';

            } elseif ( $data['Prodi'] == 'AGROTEKNOLOGI' OR $data['Prodi'] == 'AGROTEKNOLOGI UQB' OR $data['Prodi'] == 'AGRIBISINIS' OR $data['Prodi'] == 'AGRIBISINIS UQB' OR $data['Prodi'] == 'ARSITEKTUR' OR $data['Prodi'] == 'ARSITEKTUR UQB' OR $data['Prodi'] == 'TEKNIK SIPIL' OR $data['Prodi'] == 'TEKNIK SIPIL UQB' ) {

                $result = 'SAINTEK DAN TEKNOLOGI';

            }

            return $result;
        }

        public function __Kop_Dekan__ ( array $data )
        {
            $__base_app = __Aplikasi();
            
            if ( $__base_app['Kampus'] == 'UQM' ) {

                if ( $__base_app['Aktif'] == 'N' ) {

                    if ( $data['Fakultas'] == 'FKIP' ) {

                        $__data = './resources/libary/kop-surat/UQ/KOP-FKIP-UQ.jpg';
                        
                    } elseif ( $data['Fakultas'] == 'SAINTEK' ) {

                        $__data = './resources/libary/kop-surat/UQ/KOP-SAINTEK-UQ.jpg';

                    } elseif ( $data['Fakultas'] == 'SOSHUM' ) {
                        
                        $__data = './resources/libary/kop-surat/UQ/KOP-SOSHUM-UQ.jpg';

                    } else {

                        $__data = './resources/libary/kop-surat/UQ/KOP-UQ.jpg';

                    }

                } else {

                    if ( $data['Fakultas'] == 'FKIP' ) {

                        $__data = './resources/libary/kop-surat/UQ/KOP-FKIP-UQ.jpg';
                        
                    } elseif ( $data['Fakultas'] == 'SAINTEK' ) {

                        $__data = './resources/libary/kop-surat/UQ/KOP-SAINTEK-UQ.jpg';

                    } elseif ( $data['Fakultas'] == 'SOSHUM' ) {
                        
                        $__data = './resources/libary/kop-surat/UQ/KOP-SOSHUM-UQ.jpg';

                    } else {

                        $__data = './resources/libary/kop-surat/UQ/KOP-UQ.jpg';

                    }

                }

            } elseif ( $__base_app['Kampus'] == 'UQB' ) {

                if ( $__base_app['Aktif'] == 'N' ) {

                    if ( $data['Fakultas'] == 'FKIP' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-FKIP-UQB.jpg';
                        
                    } elseif ( $data['Fakultas'] == 'SAINTEK' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-SAINTEK-UQB.jpg';

                    } elseif ( $data['Fakultas'] == 'SOSHUM' ) {
                        
                        $__data = './resources/libary/kop-surat/UQB/KOP-SOSHUM-UQB.jpg';

                    } else {

                        $__data = './resources/libary/kop-surat/UQB/KOP-UQB.jpg';

                    }

                } else {

                    if ( $data['Fakultas'] == 'FKIP' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-FKIP-UQB.jpg';
                        
                    } elseif ( $data['Fakultas'] == 'SAINTEK' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-SAINTEK-UQB.jpg';

                    } elseif ( $data['Fakultas'] == 'SOSHUM' ) {
                        
                        $__data = './resources/libary/kop-surat/UQB/KOP-SOSHUM-UQB.jpg';

                    } else {

                        $__data = './resources/libary/kop-surat/UQB/KOP-UQB.jpg';

                    }

                }

            } else {

                if ( $__base_app['Aktif'] == 'N' ) {

                    if ( $data['Fakultas'] == 'FKIP' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-FKIP-UQB.jpg';
                        
                    } elseif ( $data['Fakultas'] == 'SAINTEK' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-SAINTEK-UQB.jpg';

                    } elseif ( $data['Fakultas'] == 'SOSHUM' ) {
                        
                        $__data = './resources/libary/kop-surat/UQB/KOP-SOSHUM-UQB.jpg';

                    } else {

                        $__data = './resources/libary/kop-surat/UQB/KOP-UQB.jpg';

                    }

                } else {

                    if ( $data['Fakultas'] == 'FKIP' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-FKIP-UQB.jpg';
                        
                    } elseif ( $data['Fakultas'] == 'SAINTEK' ) {

                        $__data = './resources/libary/kop-surat/UQB/KOP-SAINTEK-UQB.jpg';

                    } elseif ( $data['Fakultas'] == 'SOSHUM' ) {
                        
                        $__data = './resources/libary/kop-surat/UQB/KOP-SOSHUM-UQB.jpg';

                    } else {

                        $__data = './resources/libary/kop-surat/UQB/KOP-UQB.jpg';

                    }

                }
                
            }

            return $__data;
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
    }

    // @$__helpers_universitas = new __Universitas();