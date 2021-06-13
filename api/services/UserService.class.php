<?php
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../clients/SMTPClient.class.php";

class UserService extends BaseService{
  private $accountDao;

  private $SMTPClient;

  public function __construct(){
      $this->dao = new UserDao();
      $this->accountDao = new AccountDao();
      $this->SMTPClient = new SMTPClient();
  }

  public function register($account){
    try{
      $this->accountDao->beginTransaction();
      if(!isset($account['password'])) throw new Exception("password is missing");

    $user = parent::add([
          "name" => $account['name'],
          "surname" => $account['surname']
        ]);

    $account = $this->accountDao->add([
          "email" => $account['email'],
          "password" => md5($account['password']),
          "status" => "PENDING",
          "role" => "USER",
          "user_id" => $user['id'],
          "token" => md5(random_bytes(16))
        ]);
        $this->accountDao->commit();
    }
    catch(\Exception $e) {
      $this->accountDao->rollBack();
      if(strpos($e->getMessage(), 'uk_accounts_email')){
        throw new Exception("Account with same email exists!", 400, $e);
      }else{
        throw $e;
      }
    }
    $this->SMTPClient->send_register_user_token($account);

   return $user;
  }

  public function get_user_by_name($id){
  return $this->dao->get_by_name($id);
 }

}

?>
