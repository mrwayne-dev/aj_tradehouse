<?php
define('API_ACCESS', true);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);


$mail->SMTPDebug = 2;
$mail->Debugoutput = 'error_log';

$mail->isSMTP();
$mail->Host       = SMTP_HOST;
$mail->SMTPAuth   = true;
$mail->Username   = SMTP_USERNAME;
$mail->Password   = SMTP_PASSWORD;
$mail->SMTPSecure = SMTP_SECURE;
$mail->Port       = SMTP_PORT;

$mail->setFrom(SMTP_FROM_EMAIL, 'SMTP Test');
$mail->addAddress(SMTP_FROM_EMAIL);

$mail->Subject = 'SMTP TEST – Richie Forex';
$mail->Body    = 'Titan SMTP is working correctly.';

$mail->send();

echo 'SMTP OK';
