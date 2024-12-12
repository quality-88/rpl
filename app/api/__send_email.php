<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    @require 'resources/assets/mail/vendor/autoload.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $this->__universitas->__Detail_Universitas()['Email'];                //SMTP username
        $mail->Password   = $this->__universitas->__Detail_Universitas()['PassEmail'];                 //SMTP password                   
        $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom($this->__universitas->__Detail_Universitas()['Email'], 'INFORMASI ASSESOR TAHUN AJARAN ' . @$data['Rpl']['Ta'] . '/' . @$data['Rpl']['Semester'] );
        $mail->addAddress(@$__dosen__->EmailPribadi, @$__dosen__->Nama);

        $mail->isHTML(true);      
        $mail->Subject = "Berhasil Menjadi Assesor Mahasiswa RPL " . @$data['Rpl']['Ta'] . '/' . @$data['Rpl']['Semester'];
        $mail->Body = "
            <h1>
                <center>
                    ". $this->__universitas->__Detail_Universitas()['Nama'] ."
                </center>
            </h1>

            <br>

            Hallo, <strong>". @$__dosen__->Nama ."</strong>

            <br>
            <br>

            Selamat, anda berhasil mendapatkan beban sebagai Assesor dalam tugas Calon Mahasiswa RPL (Rekognisi Pembelajaran Lampau) Tahun Ajaran ". @$data['Rpl']['Ta'] ."/". @$data['Rpl']['Semester'] ."

            <br>
            <br>

            Terimakasih telah menjadikan Assesor dan diharapkan menyelesaikan Kontribusi sebagai Assesor ". @$__dosen__->Assesor ." dengan batas pengerjaan sampai pada Tanggal ". $this->__helpers->TanggalWaktu( $data['Hapus_1'] ) ." dengan pendaftaran Mahasiswa Baru dengan kategori RPL di ". $this->__universitas->__Detail_Universitas()['Nama'] .". 

            <br>
            <br>
            
            Berikut Adalah Informasi Calon Mahasiswa RPL (Rekognisi Pembelajaran Lampau) :

            <br>

            <h4>
                <strong>
                    Data Mahasiswa RPL (Rekognisi Pembelajaran Lampau)
                </strong>

                <br>

                Nomor Peserta : <strong>". @$__data_rpl_pendaftaran__->Nomor ."</strong>
                <br>
                Nama Peserta : <strong>". @$__data_rpl_pendaftaran__->Nama ."</strong>
                <br>
                No Hp/Wa : <strong>". @$__data_rpl_pendaftaran__->NoHp ." / ". @$__data_rpl_pendaftaran__->NoWa ."</strong>
                <br>
                Email : <strong>". @$__data_rpl_pendaftaran__->Email ."</strong>
                <br>
                Fakultas : <strong>". @$__data_rpl_pendaftaran__->IdFakultas ."</strong>
                <br>
                Prodi : <strong>". @$__data_rpl_pendaftaran__->Prodi ."</strong>
                <br>
                <br>

                Tipe Jenis : <strong>". @$__data_rpl_pendaftaran__->TipeJenis ."</strong>

                <hr>

                <a href='". $this->__universitas->__Url_Universitas()['Rpl'] ."' target='_Blank'>
                    Link Aplikasi RPL
                </a>
            </h4>

            <br>

            <strong>
                NB :
            </strong>
            <br>
            Silahkan segera melakukan menyelesaikan tugas yang sudah di bebankan kepada Assesor ya.
            <br>
            <br>
            Terimakasih.

            <br>
        ";
        $mail->send();

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }