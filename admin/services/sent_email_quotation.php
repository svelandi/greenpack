<?php
require_once dirname(dirname(__DIR__)) . "/vendor/PHPMailer/class.phpmailer.php";
require_once dirname(dirname(__DIR__)) . "/vendor/PHPMailer/class.smtp.php";
require_once dirname(dirname(__DIR__)) . "/db/env.php";
$host = "greenpack.teenustest.com";
$greeting = date("a") == "am" ? "Dias" : "Tardes";
if ($_GET["email"]) {
  $email = $_GET["email"];
  // envio de email
  $mail = new PHPMailer();
  //$mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->Port = $_ENV["smtpPort"];
  $mail->IsHTML(true);
  $mail->CharSet = "utf-8";
  // VALORES A MODIFICAR //
  $mail->Host = $_ENV["smtpHost"];
  $mail->Username = $_ENV["smtpEmail"];
  $mail->Password = $_ENV["smtpPass"];

  $mail->From = $_ENV["smtpEmail"]; // Email desde donde envio el correo.
  $mail->FromName = 'GreenPack';
  $mail->AddAddress($email);
  $mail->Subject = "Nueva Cotización"; // Este es el titulo del email.
  $mail->Body = "<!DOCTYPE html>
  <html>
  <head>
  <meta charset=utf-8 />
  <title>Notificación de Nueva cotizacion</title>
  </head>
  <body>
  <img src='https://$host/images/greenpack_logo_verde.png'>
    <p>Muy Buenos $greeting</p>
    <p>Se te ha sido asignado una nueva cotización para tu gestión.
    Por el compromiso de atencion rápida para nuestros clientes, recuerda que tienes 3 horas para darle respuesta o sera asiganda a otro vendedor</p>

    <p><a href='https://" . $_SERVER["HTTP_HOST"] . "/admin'>Gestiona tu Cotización</a></p>
    <p>Coordialmente,</p>
  <br>
  <p><strong>Equipo Greenpack</strong></p>
  <p style='color: #61bd4f'>Comprometidos para que nuestro medio ambiente siga siendo verde</p>
  <img width='100' src='https://$host/images/logo_biodegrdable_1.png'>
  <img src='https://$host/images/empaques_verdes_logo_verde.png'>
  <img src='https://$host/images/greenbags_logo_verde.png'>
  </body>
  </html>";
  $mail->SMTPSecure = 'tls';
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    http_response_code(500);
    exit;
  } else {
    http_response_code(200);
    exit;
  }
}
