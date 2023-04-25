<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Extends PHPMailer to send mail
class Mailer extends PHPMailer{

    private string $EM_ID;
    private string $EM_PASS;
    private string $EM_SMTP;
    private string $EM_SEC;
    private string $EM_PORT;

    // Assign SMTP Credentials From .ENV file
    public function __construct()
    {
        $this->EM_ID   = (array_key_exists('EM_ID', $_ENV))   ? $_ENV['EM_ID']   : '';
        $this->EM_PASS = (array_key_exists('EM_PASS', $_ENV)) ? $_ENV['EM_PASS'] : '';
        $this->EM_SMTP = (array_key_exists('EM_SMTP', $_ENV)) ? $_ENV['EM_SMTP'] : '';
        $this->EM_SEC  = (array_key_exists('EM_SEC', $_ENV))  ? $_ENV['EM_SEC']  : '';
        $this->EM_PORT = (array_key_exists('EM_PORT', $_ENV)) ? $_ENV['EM_PORT'] : '';
    }


    // Sends Simple mail
    public function SendMail(string $to, string $subject, string $message, string $headers = null):bool
    {
        try {

            $mail = new PHPMailer();

            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                           //Send using SMTP
            $mail->Host       = $this->EM_SMTP;        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                  //Enable SMTP authentication
            $mail->Username   = $this->EM_ID;          //SMTP username
            $mail->Password   = $this->EM_PASS;        //SMTP password
            $mail->SMTPSecure = $this->EM_SEC;         //Enable implicit TLS encryption
            $mail->Port       = $this->EM_PORT;        //TCP port to connect to; use 587 if you have set `tls`

            //Recipients
            $mail->setFrom($this->EM_ID, 'Mailer');
            $mail->addAddress($to, 'Joe User');        //Add a recipient
            

            //Content
            $mail->isHTML(true);                       //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
            //echo 'Message has been sent';
        } catch (Exception $e) {
            return false;
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        exit;
    }
}