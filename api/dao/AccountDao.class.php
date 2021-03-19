<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{

  public function __construct(){
    parent::__construct("accounts");
  }

  public function update_account_by_email($email, $account){
      $this->update("accounts", $email, $account, "email");
  }

  public function get_account($search, $offset, $limit){
    return $this->query("SELECT *
                         FROM accounts
                         WHERE LOWER(email) LIKE CONCAT('%', :email, '%')
                         LIMIT ${limit} OFFSET ${offset}", ["email" => strtolower($search)]);
  }

}


?>
