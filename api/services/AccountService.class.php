<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/UserService.class.php";
require_once dirname(__FILE__)."/../clients/SMTPClient.class.php";

class AccountService extends BaseService{

  public function __construct(){
      $this->dao = new AccountDao();
      $this->userDao = new UserDao();
      $this->SMTPmailer = new SMTPClient();

  }
  public function get_accounts($search, $offset, $limit, $order){
    if($search){
        return $this->dao->get_account($search, $offset, $limit, $order);
    }
    else{
      return $this->dao->get_all($offset, $limit, $order);
    }
  }

  public function reset($account){
    $db_user = $this->dao->get_user_by_token($account['token']);

    if(!isset($db_user['id'])) throw new Exception("Invalid token", 400);

    $this->dao->update_account_by_email($db_user['email'], ['password' => md5($account['password'])]);


  }

  public function forgot($account){
    $db_user = $this->dao->get_account_by_email($account['email']);

    if(!isset($db_user['id'])) throw new Exception("User doesn't exists", 400);

   //generate token - and save it to db
    $db_user = $this->update($db_user['id'], ['token' => md5(random_bytes(16))]);

    // send email
    //$this->SMTPmailer->send_recovery_user_token($db_user);
  }

  public function login($account){
    $db_user = $this->dao->get_account_by_email($account['email']);

    if(!isset($db_user['id'])) throw new Exception("User does not exist", 400);

    if($db_user['status'] != 'ACTIVE') throw new Exception("Account is not active", 400);

    if($db_user['password'] != md5($account['password'])) throw new Exception("Invalid password", 400);

    return $db_user;
  }

 public function add($account){
    // vadlidation
    if(!isset($account['email'])) throw new Exception("email is missing");
    $account['token'] = md5(random_bytes(16));
    return parent::add($account);
  }

  public function get_account_by_id($id){
    return $this->dao->get_by_id($id);
  }




}

?>
