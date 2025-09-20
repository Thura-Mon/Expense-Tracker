<?php

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'expense.medical.org@gmail.com'; // Your Gmail address
$mail->Password = 'vzub okgi addd dxeu'; // Your Gmail app password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('expense.medical.org@gmail.com', 'Medical BudgetExpense');
$mail->addAddress($_POST['email']); // Recipient's email address

$mail->isHTML(true);

$mail->Subject = 'OTP Verification';
$mail->Body    ='<p>Your OTP is <b>'.$_POST['message'].'</b>';

if(!$mail->send()) {
    echo 'Email could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Email sent successfully.';
}
?>