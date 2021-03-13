<?php

class AccountDao extends BaseDao{

  public function __construct(){
    parent::__construct("accounts");
  }

  public function get_account_by_email($email){
    return $this->query_unique("SELECT * FROM accounts WHERE email = :email", ["email" => $email]);
  }

  public function update_account_by_email($email, $account){
      $this->update("accounts", $email, $account, "email");
  }

}


?>
