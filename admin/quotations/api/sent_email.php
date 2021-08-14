<?php
require_once dirname(dirname(dirname(__DIR__))) . "/vendor/dompdf/autoload.inc.php";
require_once dirname(dirname(dirname(__DIR__))) . "/vendor/PHPMailer/class.phpmailer.php";
require_once dirname(dirname(dirname(__DIR__))) . "/vendor/PHPMailer/class.smtp.php";
require_once dirname(dirname(dirname(__DIR__))) . "/db/env.php";
require_once dirname(dirname(dirname(__DIR__))) . "/dao/QuotationDao.php";
require_once dirname(dirname(dirname(__DIR__))) . "/dao/AdminDao.php";

session_start();

use Dompdf\Dompdf;

if (isset($_POST["id"]) && isset($_POST["content"])) {
  $quotationDao = new QuotationDao();
  $quotation = $quotationDao->findById($_POST["id"]);
  $file = "http://" . $_SERVER["HTTP_HOST"] . "/services/generate-quotation.php?id=" . $_POST["id"];
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $file
  ]);
  $content = curl_exec($curl);
  curl_close($curl);
  $dompdf = new Dompdf(array('enable_remote' => true));
  $dompdf->loadHtml($content, "UTF-8");
  $dompdf->setPaper('letter');
  $dompdf->render();
  $pdf = $dompdf->output();
  $email = $quotation->getEmail();
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
  //$mail->addStringAttachment($pdf, "cotizacion.pdf");
  $mail->Subject = "Envio de Cotización"; // Este es el titulo del email.
  $mail->Body = $_POST["content"] . `<a href="$file" target="_blank">Clic aquí para ver la Cotización</a>`;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    http_response_code(501);
    echo $mail->ErrorInfo;
    exit;
  } else {
    $admin = unserialize($_SESSION["admin"]);
    $quotation->setIdAdminSolved($admin->getId());
    $quotation->setDateSolved(date('Y-m-d H:i:s'));
    $quotation->setSolved(true);
    if ($quotationDao->update($quotation) > 0) {
      http_response_code(200);
      exit;
    } else {
      http_response_code(500);
      exit;
    }
  }
} else {
  http_response_code(400);
  exit;
}
