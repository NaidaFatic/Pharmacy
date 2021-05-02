<?php
phpinfo();/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/config.php';

// Create the Transport
$transport = (new Swift_SmtpTransport(Config::SMTP_HOST, Config::SMTP_PORT, 'tls'))
  ->setUsername(Config::SMTP_USER)
  ->setPassword(Config::SMTP_PASSWORD)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom([Config::SMTP_USER => 'HELLOO'])
  ->setTo(['naidafatic@gmail.com'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);

print_r($result);*/


?>
