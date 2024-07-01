<?php

use Config\Services;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function send_email($toEmail, $subject, $params, $template,$fromEmail = 'help@printbizz.in', $name = 'PrintBizz')
{

    $view = Services::renderer();

    $view->setData($params);

    $send = $view->render($template);

    $mail = new PHPMailer(true);
    try {

        $mail->isSMTP();
        $mail->Host         = 'smtp.hostinger.com'; //smtp.google.com
        $mail->SMTPAuth     = true;
        $mail->Username     = 'help@printbizz.in';
        $mail->Password     = 'Printbizz@#2024';
        $mail->SMTPSecure   = 'tls';
        $mail->Port         = 587;
        $mail->Subject      = $subject;
        $mail->Body         = $send;
        $mail->setFrom($fromEmail, $name);

        $mail->addAddress($toEmail);
        $mail->isHTML(true);

        if (!$mail->send()) {
            echo "Something went wrong. Please try again.";
        } else {
            echo "Email sent successfully.";
        }
    } catch (Exception $e) {
        echo "Something went wrong. Please try again.";
    }
}
