<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class AccountService extends BaseService{
  private $userDao;

  public function __construct(){
      $this->dao = new AccountDao();
      $this->userDao = new UserDao();

  }
  public function get_accounts($search, $offset, $limit, $order){
    if($search){
        return $this->dao->get_account($search, $offset, $limit, $order);
    }
    else{
      return $this->dao->get_all($offset, $limit, $order);
    }
  }

 public function add($account){
    // vadlidation
    if(!isset($account['email'])) throw new Exception("email is missing");

    return parent::add($account);
  }






}

?>
