<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    protected $mail;

    private $_username, $_name;


    public function __construct($username = 'mhd.abd51@gmail.com', $password = 'hwahfupowjrtvuna', $name = 'Mohammad Salah') {
        $this->_username = $username;
        $this->_name = $name;
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;

        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
        $this->mail->Username = $this->_username;
        $this->mail->Password = $password;

        $this->mail->isHTML(true);
    }

    public function sendEmail($to, $subject, $body) {
        try {
            $this->mail->setFrom($this->_username, $this->_name);
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
