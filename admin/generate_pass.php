<?php
require_once dirname(__DIR__) . "/db/DBOperator.php";
require_once dirname(__DIR__) . "/db/env.php";
require_once dirname(__DIR__) . "/vendor/PHPMailer/class.phpmailer.php";
require_once dirname(__DIR__) . "/vendor/PHPMailer/class.smtp.php";
$token = bin2hex(openssl_random_pseudo_bytes(256));
$db = new DBOperator($_ENV["db_host"], $_ENV["db_user"], $_ENV["db_name"], $_ENV["db_pass"]);
if (isset($_POST["email"])) {
  $user = $db->consult("SELECT * FROM `admins` WHERE `email` = '" . $_POST["email"] . "'", "yes");
  if (count($user) > 0) {
    $email = $_POST["email"];
    $user = $user[0];
    $db->consult("UPDATE `admins` SET `token_password` = '$token' WHERE `admins`.`id_admins` = " . $user["id_admins"]);

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
    $mail->FromName = 'greenpack';
    $mail->AddAddress($email);

    $mail->Subject = "Recuperación de contraseña"; // Este es el titulo del email.
    $mail->Body = "
    <html>
    <body>
    <p>Has solicitado un cambio de contraseña, ingresa al siguiente enlace para recuperar la cuentas</p>
    <p><a href='https://" . $_SERVER["HTTP_HOST"] . "/admin/recover_pass.php?id=" . $user["id_admins"] . "&token=" . $token . "'>Recuperar Cuenta</a></p>
    </body>
    </html>
    ";
    $mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      ));
    if (!$mail->send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo "Message sent!";
    }
  } else {
    echo "no existe este usuario";
  }
} else {
  http_response_code(400);
}
