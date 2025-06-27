<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '96f44ab3e38ee3';
        $mail->Password = '566ce30c9fca45';

        $mail->setFrom('cuentas@invitemanager.com');
        $mail->addAddress('cuentas@invitemanager.com', 'invitemanager.com');
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        // Configurar el email
        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>,</p>";
        $contenido .= "<p>Has creado tu cuenta en nuestra plataforma, solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p><a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no creaste esta cuenta, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();

    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '96f44ab3e38ee3';
        $mail->Password = '566ce30c9fca45';

        $mail->setFrom('cuentas@invitemanager.com');
        $mail->addAddress('cuentas@invitemanager.com', 'invitemanager.com');
        $mail->Subject = 'Reestablece tu contraseña';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        //Configurar el email
        $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Parece que has olvidado tu password, sigue el siguiente enlace para recuperarlo</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Recuperar Password </a></p>";
            $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
            $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();

    }
}


?>