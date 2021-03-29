<?php
require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../config.php';

class SMTPClient{

  private $mailer;

  public function __construct(){
    // Create the Transport
    $transport = (new Swift_SmtpTransport(Config::SMTP_HOST,Config::SMTP_PORT, 'tls'))
      ->setUsername(Config::SMTP_USER)
      ->setPassword(Config::SMTP_PASSWORD)
    ;

    // Create the Mailer using your created Transport
    $this->mailer = new Swift_Mailer($transport);

  }

  public function send_register_user_token($account){
    // Create a message
    $message = (new Swift_Message('Confirm your account'))
      ->setFrom(['naidafatic@gmail.com' => 'Pharmacy'])
      ->setTo([$account['email']])
      ->setBody('Here is the confirmation link: http://localhost/project/Pharmacy/api/accounts/confirm/'.$account['token']);

    // Send the message
     $this->mailer->send($message);
  }

  public function send_recovery_user_token($account){
    // Create a message
    $message = (new Swift_Message('Reset Your password'))
      ->setFrom(['naidafatic@gmail.com' => 'Pharmacy'])
      ->setTo([$account['email']])
      ->setBody('Here is the recovery token: '.$account['token']);

    // Send the message
     $this->mailer->send($message);
  }
}

?>
