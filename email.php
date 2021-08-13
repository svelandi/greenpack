<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/PHPMailer/class.phpmailer.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/PHPMailer/class.smtp.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/db/env.php";
$host = "greenpack.teenustest.com";
$greeting = date("a") == "am" ? "Dias" : "Tardes";
$email = $ENV["email_contact"];
  // envio de email
  $mail = new PHPMailer(true);
  
    //$mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV["smtpPort"];
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";
    // VALORES A MODIFICAR //
    $mail->Host = $_ENV["smtpHost"];
    $mail->Username = $_ENV["smtpEmail"];
    $mail->Password = $_ENV["smtpPass"];
    $mail->SMTPSecure = 'tls';
    $mail->SMTPDebug= SMTP::DEBUG_SERVER;
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    $mail->From = $_ENV["smtpEmail"]; // Email desde donde envio el correo.
    $mail->FromName = 'GreenPack';
    $mail->AddAddress($email);
    $mail->Subject = $POST["subject"]; // Este es el titulo del email.
   
    
    $mail->Body = "as";
    if (!$mail->send()) {
      echo $mail->ErrorInfo;
      http_response_code(500);
      exit;
    } else {
      http_response_code(200);
      header("location: /#contact");
      exit;
    }
  
