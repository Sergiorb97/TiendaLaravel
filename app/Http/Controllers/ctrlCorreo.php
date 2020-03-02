<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PDF;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

class ctrlCorreo extends Controller
{
    public static function enviar($receptor, $asunto, $body, $facturaid)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.office365.com';                      // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'TiendaOnlineMarisma@hotmail.com';                     // SMTP username
            $mail->Password   = 'sergiorb97';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('TiendaOnlineMarisma@hotmail.com', 'Sergio');
            $mail->addAddress($receptor);               // Name is optional

            // // Attachments
            
            // PDF::setOptions(['chroot' => public_path('Assets/pdf/')]);
            $pdf = public_path('Assets/pdf/') . 'factura' . $facturaid . '.pdf';
            $mail->addAttachment($pdf, 'factura' . $facturaid . '.pdf');         // Add attachments

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $body;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            echo 'Mesaje enviado correctamente.';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public static function correoCustom($receptor, $asunto, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.office365.com';                      // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'TiendaOnlineMarisma@hotmail.com';                     // SMTP username
            $mail->Password   = 'sergiorb97';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('TiendaOnlineMarisma@hotmail.com', 'Sergio');
            $mail->addAddress($receptor);               // Name is optional

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $body;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            echo 'Mesaje enviado correctamente.';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    // public function correoCustom(Request $request)
    // {
    //     $this->enviar($request->get('receptor'), $request->get('asunto'), $request->get('body'));
    //     return back();
    // }

    // public function correoPrueba()
    // {
    //     $this->enviar(
    //         's-ergio-97@hotmail.com',
    //         'Este es un mensaje de prueba',
    //         'Cuerpo del mensaje de prueba'
    //     );
    // }
}
