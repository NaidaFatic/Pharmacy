<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../../vendor/autoload.php';

class SMTPClient{

  private $mailer;

  public function __construct(){
    // Create the Transport
  $transport = (new  Swift_SmtpTransport("smtp.gmail.com", "587", 'tls'))
      ->setUsername(Config::SMTP_USER())
      ->setPassword(Config::SMTP_PASSWORD());

    // Create the Mailer using your created Transport
    $this->mailer = new Swift_Mailer($transport);

  }

  public function send_register_user_token($account){
    $message = (new Swift_Message('Confirm your account'))
      ->setFrom([Config::SMTP_USER() => 'Pharmacy'])
      ->setTo([$account['email']])
      ->setBody('Here is the confirmation token: '.$account['token']);

     $this->mailer->send($message);
  }

  public function send_recovery_user_token($account){
    $message = (new Swift_Message('Reset Your password'))
      ->setFrom([Config::SMTP_USER() => 'Pharmacy'])
      ->setTo([$account['email']])
      ->setBody('Here is the recovery link: https://pharmacy-dfr2g.ondigitalocean.app/login.html?token='.$account['token']);

     $this->mailer->send($message);
  }

  public function send_user_purchase($purchase, $account, $order, $price){
    $message = (new Swift_Message('Your purchase'))
      ->setFrom([Config::SMTP_USER() => 'Pharmacy'])
      ->setTo([$account['email']])
      ->setBody('Here is the order: City: '.$purchase['city'].', Zip: '.$purchase['zip'].
                ', Phone number: '.$purchase['phone_number'].', Medicine_id => quantity: '.$order.', Total price: '.$price);

     $this->mailer->send($message);
  }

}

?>
