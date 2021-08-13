<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/dao/ClientDao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/PHPMailer/class.phpmailer.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/PHPMailer/class.smtp.php";

$response = new stdClass();
header('Content-Type: application/json');

if (
  isset($_POST["text"]) && isset($_POST["checkboxClient"]) && isset($_POST["checkboxSubs"])
  && isset($_POST["subject"])
) {
  $checkboxClient = json_decode($_POST["checkboxClient"]);
  $checkboxSubs = json_decode($_POST["checkboxSubs"]);
  $clientDao = new ClientDao();
  $subject = $_POST["subject"];
  $content = $_POST["text"];

  $destinataries = [];
  if ($checkboxClient) {
    $clients = $clientDao->findAll();
    foreach ($clients as $client) {
      array_push($destinataries, $client->email);
    }
  }
  if ($checkboxSubs) {
    $suscribers = $clientDao->findAllSuscribers();
    foreach ($suscribers as $suscriber) {
      array_push($destinataries, $suscriber->email);
    }
  }
  

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

  // agregado de todos los correos de los clientes y suscriptores
  foreach ($destinataries as  $destinatary) {
    $mail->addBCC($destinatary);
  }
  $mail->Subject = $subject; // Este es el titulo del email.
  $mail->Body = $content;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    $response->status = false;
    $response->error = $mail->ErrorInfo;
  } else {
    $response->status = true;
  }
  echo json_encode($response);
} else {
  http_response_code(400);
}
