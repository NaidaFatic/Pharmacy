<?php
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class UserService extends BaseService{
  private $accountDao;
  public function __construct(){
      $this->dao = new UserDao();
      $this->accountDao = new AccountDao();
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
          "password" => $account['password'],
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
    // email is not added because u_k but user is!!!!!!
  //send email with some token

  return $user;
}

public function confirm($token){
  $account = $this->accountDao->get_user_by_token($token);

  if(!isset($account['id'])) throw Exception("invalid token");

  $this->accountDao->update_account_by_email($account['email'], ["status" => "ACTIVE"]);

  //TODO send email to customer
}


}

?>
