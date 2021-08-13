<?php
require_once dirname(dirname(__DIR__)) . "/vendor/PHPMailer/class.phpmailer.php";
require_once dirname(dirname(__DIR__)) . "/vendor/PHPMailer/class.smtp.php";
require_once dirname(dirname(__DIR__)) . "/db/env.php";
$host = "greenpack.teenustest.com";
$greeting = date("a") == "am" ? "Dias" : "Tardes";
if ($_GET["email"]) {
  $email = $_GET["email"];
  $name = $_GET["name"];
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
  $mail->FromName = 'Greenpack';
  $mail->AddAddress($email);
  $mail->Subject = "Nueva Cotización"; // Este es el titulo del email.
  $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
  $mail->Body = "<!DOCTYPE html>
  <html>
  <head>
  <meta charset=utf-8 />
  <title>Notificación de nueva cotizacion</title>
  </head>
  <body>
    <img src='https://$host/images/greenpack_logo_verde.png'>
    <p>Muy Buenos $greeting</p>
    <p>$name, Que gusto saludarle y esperamos que todo le este saliendo de maravilla. Muchas gracias por su interés en nuestros productos. Acabamos de recibir su solicitud de cotización, en breve una de nuestras vendedoras le contactara.</p>
    <p>Le enviamos un cordial saludo</p>
    <p>Coordialmente,</p>
    <p><strong>Equipo Greenpack</strong></p>
  <p style='color: #61bd4f'>Comprometidos para que nuestro medio ambiente siga siendo verde</p>
  <img width='100' src='https://$host/images/logo_biodegrdable_1.png'>
  <img src='https://$host/images/empaques_verdes_logo_verde.png'>
  <img src='https://$host/images/greenbags_logo_verde.png'>
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
