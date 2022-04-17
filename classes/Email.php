<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $mail;
    public $name;
    public $token;

    public function __construct($mail, $name, $token){
        $this->mail = $mail;
        $this->name = $name;
        $this->token = $token;

    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendConfirmation(){
        // new email object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'f7542f3e4b0852';
        $mail->Password = '10cfd7cb36da32';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;




        // email content
        $mail->setFrom('cuentas@app-barber.com');
        $mail->addAddress($this->mail, 'AppBarber.com');
        $mail->Subject = "Confirm your account";
        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = '<html lang="en">';
        $content .= '<head>';
        $content .= '<link rel="preconnect" href="https://fonts.googleapis.com">';
        $content .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
        $content .= '<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">';
        $content .= '<style>';
        $content .= "h1{ font-family: 'Roboto', sans-serif;}";
        $content .= "p{font-family: 'Roboto', sans-serif;}";
        $content .= "a{font-family: 'Roboto', sans-serif;}";
        $content .= 'h1{ text-align: center; }';
        $content .= 'h1{ color: #0d706d;}';
        $content .= 'p{ color: #272a63;}';
        $content .= 'p{ font-weight: 300;}';
        $content .= 'a{ color: #88248a;}';
        $content .= 'span{ color: #141517;}';
        $content .= 'span{ font-weight: 500;}';
        $content .= '</style>';
        $content .= '</head>';
        $content .= '<body>';
        $content .= "<h1><strong>Has Recibido un email:</strong></h1>";
        $content .= "<p>hello <span>" . $this->name . "</span>,</p>";
        $content .= "<p>Thanks for create your account, please validate your account with the link.</p>";
        $content .= "<p>Click in the link:</p>";
        $content .= "<a href='https://desolate-eyrie-96468.herokuapp.com/confirm-account?token=" . $this->token ."'>Confirm my account</a>";
        $content .= "<p>If you didn't ask for this account, please ignore this email.</p>";
        $content .= '</body>';
        $content .= '</html>';

        $mail->Body = $content;
        $mail->AltBody = 'alternative text';

        // send email
        $mail->send();


    }

    //send instructions
    public function sendInstructions(){
        // new email object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'f7542f3e4b0852';
        $mail->Password = '10cfd7cb36da32';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;


        // email content
        $mail->setFrom('cuentas@app-barber.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppBarber.com');
        $mail->Subject = "Confirm your account";
        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = '<html lang="en">';
        $content .= '<head>';
        $content .= '<link rel="preconnect" href="https://fonts.googleapis.com">';
        $content .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
        $content .= '<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">';
        $content .= '<style>';
        $content .= "h1{ font-family: 'Roboto', sans-serif;}";
        $content .= "p{font-family: 'Roboto', sans-serif;}";
        $content .= "a{font-family: 'Roboto', sans-serif;}";
        $content .= 'h1{ text-align: center; }';
        $content .= 'h1{ color: #0d706d;}';
        $content .= 'p{ color: #272a63;}';
        $content .= 'p{ font-weight: 300;}';
        $content .= 'a{ color: #88248a;}';
        $content .= 'span{ color: #141517;}';
        $content .= 'span{ font-weight: 500;}';
        $content .= '</style>';
        $content .= '</head>';
        $content .= '<body>';
        $content .= "<h1><strong>Recover your password</strong></h1>";
        $content .= "<p>hello <span>" . $this->name . "</span>,</p>";
        $content .= "<p>Click in the link to reset your password:</p>";
        $content .= "<a href='https://desolate-eyrie-96468.herokuapp.com/recover-password?token=" . $this->token ."'>Reset my account</a>";
        $content .= "<p>If you didn't ask for this account, please ignore this email.</p>";
        $content .= '</body>';
        $content .= '</html>';

        $mail->Body = $content;
        $mail->AltBody = 'alternative text';

        // send email
        $mail->send();
    }
}
