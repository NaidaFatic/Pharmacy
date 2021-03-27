<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/config.php';

try {
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
      ->setUsername('')
      ->setPassword('')
    ;

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $body = 'Hello, <p>Email sent through <span style="color:red;">Swift Mailer</span>.</p>';

    $message = (new Swift_Message('Email Through Swift Mailer'))
      ->setFrom(['naidafatic@gmail.com' => 'NAIDA FATIC'])
      ->setTo(['naida.fatic@stu.ibu.edu.ba'])
      ->setBody($body)
      ->setContentType('text/html')
    ;

    // Send the message
    $mailer->send($message);

    echo 'Email has been sent.';
} catch(Exception $e) {
    echo $e->getMessage();
}
?>
