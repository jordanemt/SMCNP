<?php

require_once 'PhpMailer/PHPMailerAutoload.php';

class Gmail {

    Const USERNAME = 'matriculaencnp@gmail.com';
    Const PSW = 'Cnp1974*';
    Const HOST = 'smtp.gmail.com';
    Const PORT = '587';
    Const AUTH = 'true';
    Const SECURE = 'tls';

    public function mail() {
        $mail = new phpmailer();
        $mail->isSMTP();
        $mail->Host = Gmail::HOST;
        $mail->SMTPAuth = Gmail::AUTH;
        $mail->SMTPSecure = Gmail::SECURE;
        $mail->Port = Gmail::PORT;
        $mail->Username = Gmail::USERNAME;
        $mail->Password = Gmail::PSW;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        return $mail;
    }

    public function sendMessage($FromUser, $FromName, $Subject, $Body, $AltBody, $archivos) {
        $mail = $this->mail();

//        $ruta = "";
        $mail->From = $FromUser;
        $mail->FromName = $FromName;
        $mail->AddAddress($FromUser);
        for ($i = 0; $i < count($archivos); $i++) {
            $mail->addAttachment($archivos[$i]);
        }
        $mail->Subject = $Subject;
        $mail->Body = $Body;
        $mail->AltBody = $AltBody;
        if (!$mail->send()) {
//            echo 'Message could not be sent.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
//            echo 'Message has been sent';
        }
    }

}
