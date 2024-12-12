<?php

    if ( !function_exists('BrivaGenerateSignature') ) {
        function BrivaGenerateSignature($path, $verb, $token, $timestamp, $body, $secret)
        {
            $payload = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$body";
            $signPayload = hash_hmac('sha256', $payload, $secret, true);
            return base64_encode($signPayload);
        }
    }
    
    if ( !function_exists('CurlHeader') ) {
        function CurlHeader ( $urlPost, $payload, $datas, $path, $verb, $tokens, array $data ) 
        {
            
                $client_id          = $data['C'];
                $secret_id          = $data['S'];

                $timestamp          = gmdate("Y-m-d\TH:i:s.000\Z");
                $secret             = $secret_id;

                $token 				= $tokens;
                $base64sign 		= BrivaGenerateSignature ( $path, $verb, $token, $timestamp, $payload, $secret ) ;
            

                if ( $verb == "GET" || $verb == "DELETE" ) {
                    $request_headers = array(
                        "Authorization:Bearer " . $token,
                        "BRI-Timestamp:" . $timestamp,
                        "BRI-Signature:" . $base64sign,
                    );
                } else {
                    $request_headers = array(
                        "Content-Type:"."application/json",
                        "Authorization:Bearer " . $token,
                        "BRI-Timestamp:" . $timestamp,
                        "BRI-Signature:" . $base64sign,
                    );
                }


                $chPost 			= curl_init();
                curl_setopt($chPost, CURLOPT_URL, $urlPost);
                curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
                curl_setopt($chPost, CURLOPT_CUSTOMREQUEST, $verb); 
                curl_setopt($chPost, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
                curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);

                $resultPost 		= curl_exec($chPost);
                $httpCodePost 		= curl_getinfo($chPost, CURLINFO_HTTP_CODE);
                curl_close($chPost);

                return $resultPost;
            
        }
    }

    class __Bri
    {
        protected $__db;
        protected $__secret_key;
        protected $__universitas;
        protected $__helpers;

        public function __construct()
        {
            $this->__db = new __Database;
            $this->__secret_key = new __Secret_Keys('Secret key', 'Secret iv');
            $this->__universitas = new __Universitas();
            $this->__helpers = new __Helpers();
        }

        public function __Aktif__()
        {
            return 'Y';
        }

        public function __Data_Bri__()
        {
            if ( $this->__Aktif__() == 'N' ) {

                $data = [
                    'Client'            => 'fYjcBA2paJmos8e3mDJfWcYsNCBNAbfp',
                    'Secret'            => 'AYzT4pjIGTpAClsF',
                    'Institutioncode'   => 'J104408',
                    'Brivano'           => '77777',
                    'Endpoint'          => 'https://sandbox.partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials',
                    'Url'               => 'https://sandbox.partner.api.bri.co.id/v1/briva',
                ];

            } else {

                $data = [
                    'Client'            => 'DDl03pYS8o6pK1Oq72dxWyAXS6wScmMH',
                    'Secret'            => 'YmbAlrXfEAA9wUA1',
                    'Institutioncode'   => 'SCYCX42890C',
                    'Brivano'           => '10311',
                    'Endpoint'          => 'https://partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials',
                    'Url'               => 'https://partner.api.bri.co.id/v1/briva',
                ];

            }

            return $data;
        }

        public function BrivaGenerateSignature($path, $verb, $token, $timestamp, $body, $secret)
        {
            $payload = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$body";
            $signPayload = hash_hmac('sha256', $payload, $secret, true);
            return base64_encode($signPayload);
        }

        public function CurlHeader($urlPost, $payload, $path, $verb, $token)
        {
            $client_id  = $this->__Data_Bri__()['Client'];
            $secret_id  = $this->__Data_Bri__()['Secret'];
            $timestamp  = gmdate("Y-m-d\TH:i:s.000\Z");
            $secret     = $secret_id;
            $base64sign = $this->BrivaGenerateSignature ( $path, $verb, $token, $timestamp, $payload, $secret );

            if ( $verb == "GET" || $verb == "DELETE" ) {
                $request_headers = array(
                    "Authorization:Bearer " . $token,
                    "BRI-Timestamp:" . $timestamp,
                    "BRI-Signature:" . $base64sign,
                );
            } else {
                $request_headers = array(
                    "Content-Type:"."application/json",
                    "Authorization:Bearer " . $token,
                    "BRI-Timestamp:" . $timestamp,
                    "BRI-Signature:" . $base64sign,
                );
            }

            $chPost = curl_init();
            curl_setopt($chPost, CURLOPT_URL, $urlPost);
            curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
            curl_setopt($chPost, CURLOPT_CUSTOMREQUEST, $verb);
            curl_setopt($chPost, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
            curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);

            $resultPost = curl_exec($chPost);
            $httpCodePost = curl_getinfo($chPost, CURLINFO_HTTP_CODE);
            curl_close($chPost);

            return $resultPost;
        }

        private function __CreateToken__()
        {
            $cliend_id              = self::__Data_Bri__()['Client'];
            $secret_id              = self::__Data_Bri__()['Secret'];

            $data_tkn               = "client_id=".$cliend_id."&client_secret=".$secret_id;

            $ch_tkn                 = curl_init();
            curl_setopt($ch_tkn, CURLOPT_URL, self::__Data_Bri__()['Endpoint']);
            curl_setopt($ch_tkn, CURLOPT_POST, true);
            curl_setopt($ch_tkn, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch_tkn, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch_tkn, CURLOPT_POSTFIELDS, $data_tkn);
            $result_tkn             = curl_exec($ch_tkn);
            $httpCode_tkn           = curl_getinfo($ch_tkn, CURLINFO_HTTP_CODE);
            curl_close($ch_tkn);
            $jsontoken              = json_decode($result_tkn, true);

            if ( $jsontoken['access_token'] == FALSE ) {

                $data = [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Tidak Berhasil Untuk Membuat Token Virtual Account Untuk Pembayaran Yang Telah Dibuatkan Karena Tidak Mendapatkan Access Token, Mohon Untuk Di Coba Kembali !',
                    'Data'          => '',
                ]; 

            } else {

                $datas_token_insert = [
                    'Token'     => $jsontoken['access_token'],
                    'Log'       => date('Y-m-d H:i:s'),
                    'Time'      => '48',
                    'Aplikasi'  => 'RPL',
                ];

                try {

                    $this->__db->beginTransaction();

                        $__query_result = $this->__SimpanToken__( $datas_token_insert );

                        if ( $__query_result['Error'] === '000' ) {
                            
                            $this->__db->commit();

                            return [
                                'Error'   => '000',
                                'Message' => 'Berhasil Simpan Data !',
                                'Data'    => [
                                    'Token'   => $datas_token_insert['Token'],
                                ],
                            ];
                            exit();

                        } else {

                            $this->__db->rollback();
                            
                            return [
                                'Error'   => '999',
                                'Message' => 'Error Query',
                                'Data'    => '',
                            ];
                            exit();

                        }

                } catch ( PDOException $e ) {

                    $this->__db->rollback();

                    return [
                        'Error'   => '999',
                        'Message' => 'A Data Error Occurred: ' . $e->getMessage(),
                        'Data'    => '',
                    ];
                    exit();

                }

            }
        }

        private function __SimpanToken__( $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO BrivaTokenValidation
                            (
                                tokenid, createdate, intervalexpired, Aplikasi
                            )
                        VALUES
                            (
                                :Token, :Log, :Time, :Aplikasi
                            )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Token__()
        {
            $log = date('Y-m-d H:i:s');
            
            $cek_datatoken = $this->__db->queryid(" SELECT TokenId FROM BrivaTokenValidation WHERE TglExp >= '". $log ."' ");

            if ( $cek_datatoken->TokenId == TRUE ) {

                $data = [
                    'Error'         => '000',
                    'Message'       => 'Token Masih Aktif',
                    'Data'          => [
                        'Token'         => $cek_datatoken->TokenId,
                        'Keterangan'    => 'ADA TOKEN',
                    ],
                ];

            } else {

                $row_data_id_aksestoken = $this->__db->queryrow(" SELECT TokenId FROM BrivaTokenValidation WHERE TokenId = '". @$cek_datatoken->TokenId ."' ");

                if ( @$row_data_id_aksestoken == TRUE ) {

                    $data = [
                        'Error'         => '999',
                        'Message'       => 'Mohon Maaf Nomor ID Token sudah Terdaftar. Silahkan Melakukan Buat Nomor Pembayaran Lagi Ya !',
                        'Data'          => '',
                    ];

                } else {

                    $__get_token = self::__CreateToken__();

                    if ( $__get_token['Error'] == '000' ) {

                        $data = [
                            'Error'         => '000',
                            'Message'       => 'Berhasil Membuat Token Baru !',
                            'Data'          => [
                                'Token'         => $__get_token['Data']['Token'],
                                'Keterangan'    => 'ADA TOKEN',
                            ],
                        ];

                    } else {

                        $data = [
                            'Error'         => '999',
                            'Message'       => $__get_token['Message'],
                            'Data'          => '',
                        ];

                    }

                }

            }

            return $data;
        }

        public function __Create_Va__( array $data )
        {
            $datas_briva = array(
                'institutionCode'   => $this->__Data_Bri__()['Institutioncode'],
                'brivaNo'           => $this->__Data_Bri__()['Brivano'],
                'custCode'          => $data['Va'],
                'nama'              => substr( $this->__helpers->HurufAwalBesar( $data['Nama'] ), 0, 40),
                'amount'            => $data['Amount'],
                'keterangan'        => $data['Keterangan'],
                'expiredDate'       => $this->__helpers->__TambahTanggal(),
            );

            if ( $datas_briva == FALSE ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Data Request Array Respon JSON Rest API Tidak Ada !',
                    'Data'          => [],
                ];
                exit();

            }

            $payload            = json_encode($datas_briva, TRUE);
            $path               = "/v1/briva";
            $verb               = "POST";
            $urlPost            = $this->__Data_Bri__()['Url'];

            $__briva__          = ['C' => $this->__Data_Bri__()['Client'], 'S' => $this->__Data_Bri__()['Secret']];

            $resultPost         = CurlHeader( $urlPost, $payload, $datas_briva, $path, $verb, $data['Token'], $__briva__ );

            $respon_post        = json_encode($resultPost);
            $json               = json_decode($resultPost, TRUE);

            if ( ( $json['responseDescription'] != 'Success' ) OR ( $json['responseCode'] != '00' ) ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Request Rest API JSON Data Tidak Ada Pada Bank !',
                    'Data'          => [],
                ];
                
            }

            return [
                'Error'     => '000',
                'Message'   => 'Berhasil Buat Virtual Account BRI !',
                'Data'      => [],
            ];
            exit();
        }

        public function __Load_Va__( array $data )
        {
            $payload            = NULL;
            $path               = "/v1/briva" . "/" . $this->__Data_Bri__()['Institutioncode'] . "/" . $this->__Data_Bri__()['Brivano'] . "/" . $data['CustCode_Bri_Bayar'];
            $verb               = "GET";
            $urlPost            = $this->__Data_Bri__()['Url'] . "/" . $this->__Data_Bri__()['Institutioncode'] . "/" . $this->__Data_Bri__()['Brivano'] . "/" . $data['CustCode_Bri_Bayar'];

            $__briva__          = ['C' => $this->__Data_Bri__()['Client'], 'S' => $this->__Data_Bri__()['Secret']];

            $resultPost         = CurlHeader( $urlPost, $payload, '', $path, $verb, $data['Token'], $__briva__ );

            $respon_post        = json_encode($resultPost);
            $json               = json_decode($resultPost, TRUE);

            if ( ( $json['responseDescription'] != 'Success' ) OR ( $json['responseCode'] != '00' ) ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Request Rest API JSON Data Tidak Ada Pada Bank !',
                    'Data'          => [],
                ];
                
            }

            if ( $json['data']['statusBayar'] != 'Y' ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Belum Melakukan Pembayaran !',
                    'Data'          => [],
                ];

            }

            $__report_bri__ = $this->__Load_Va_Report( $data );

            if ( $__report_bri__['Error'] == '000' ) {

                return [
                    'Error'     => '000',
                    'Message'   => $__report_bri__['Message'],
                    'Data'      => $__report_bri__['Data'],
                ];
                exit();

            } else {

                return [
                    'Error'     => '999',
                    'Message'   => $__report_bri__['Message'],
                    'Data'      => [],
                ];
                exit();

            }
        }

        public function __Load_Va_Report( array $data )
        {
            $startDate_reports  = $data['Tgl_1'];
            $endDate_reports    = $data['Tgl_2'];
            $payload            = NULL;
            $path               = "/v1/briva/report" . "/" . $this->__Data_Bri__()['Institutioncode'] . "/" . $this->__Data_Bri__()['Brivano'] . "/" . $startDate_reports . "/" . $endDate_reports;
            $verb               = "GET";
            $urlPost            = $this->__Data_Bri__()['Url'] . "/report/" . $this->__Data_Bri__()['Institutioncode'] . "/" . $this->__Data_Bri__()['Brivano'] . "/".$startDate_reports . "/" . $endDate_reports;

            $__briva__          = ['C' => $this->__Data_Bri__()['Client'], 'S' => $this->__Data_Bri__()['Secret']];

            $resultPost         = CurlHeader( $urlPost, $payload, '', $path, $verb, $data['Token'], $__briva__ );

            $respon_post        = json_encode($resultPost);
            $json               = json_decode($resultPost, TRUE);

            if ( ( $json['responseDescription'] != 'Success' ) OR ( $json['responseCode'] != '00' ) ) {

                return [
                    'Error'         => '999',
                    'Message'       => 'Mohon Maaf Request Rest API JSON Data Tidak Ada Pada Bank !',
                    'Data'          => [],
                ];
                
            }

            return [
                'Error'     => '000',
                'Message'   => 'Berhasil Report Load Pembayaran Virtual Account BRI !',
                'Data'      => $json['data'],
            ];
            exit();
        }
    }