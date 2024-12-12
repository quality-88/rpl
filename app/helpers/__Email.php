<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'resources/assets/mail/vendor/autoload.php';

    class Mailer
    {
        private $mail;
        protected $__universitas;

        public function __construct()
        {
            $this->__universitas = new __Universitas();
            
            // Create an instance; passing `true` enables exceptions
            $this->mail = new PHPMailer(true);

            // Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $this->mail->isSMTP();                       // Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;              // Enable SMTP authentication
            $this->mail->Username   = $this->__universitas->__Detail_Universitas()['Email']; // SMTP username
            $this->mail->Password   = $this->__universitas->__Detail_Universitas()['PassEmail']; // SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable implicit TLS encryption
            $this->mail->Port       = 587;               // TCP port to connect to
        }

        public function setFrom($email, $name)
        {
            $this->mail->setFrom($email, $name);
        }

        public function addAddress($email, $name)
        {
            $this->mail->addAddress($email, $name);
        }

        public function setSubject($subject)
        {
            $this->mail->Subject = $subject;
        }

        public function setBody($body)
        {
            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Body = $body;
        }

        public function addAttachment($filePath, $fileName = '')
        {
            $this->mail->addAttachment($filePath, $fileName);
        }

        public function send()
        {
            try {
                $this->mail->send();
                return true;
            } catch (Exception $e) {
                // Log or handle the error as needed
                // For example: error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
                return false;
            }
        }
    }



    $mailer = new Mailer();

    // Set email properties
    $mailer->setFrom($__helpers_universitas->__Detail_Universitas()['Email'], 'FORGET PASSWORD MAHASISWA RPL TAHUN AJARAN ' . date('Y'));
    $mailer->addAddress(@$__datarpl->Email, @$__datarpl->Nama);
    $mailer->setSubject("Berhasil Deteksi Lupa Password Mahasiswa RPL Di Kampus " . $__helpers_universitas->__Detail_Universitas()['Nama']);
    $mailer->setBody("Selamat, Anda Berhasil Melakukan Pendaftaran Mahasiswa Baru RPL Dengan Akun Melalui Email. <br>
    Email : ".@$__datarpl->Email." <br> Password : ".@$__datarpl->PassEmail." <br>
    Password Email Di Generate Secara Otomatis.");

    // Optionally add attachments
    // $mailer->addAttachment('/path/to/file.jpg', 'file.jpg');

    // Send the email
    // if ($mailer->send()) {
    //     echo 'Message has been sent';
    // } else {
    //     echo 'Message could not be sent';
    // }