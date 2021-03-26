<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class AccountService extends BaseService{

  public function __construct(){
      $this->dao = new AccountDao();

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
    $account['token'] = md5(random_bytes(16));
    return parent::add($account);
  }

  public function get_account_by_id($id){
    return $this->dao->get_by_id($id);
  }




}

?>
