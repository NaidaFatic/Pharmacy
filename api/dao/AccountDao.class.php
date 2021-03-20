<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{

  public function __construct(){
    parent::__construct("accounts");
  }

  public function update_account_by_email($email, $account){
      $this->update("accounts", $email, $account, "email");
  }

  public function get_account($search, $offset, $limit, $order = "-id"){
    switch (substr($order, 0, 1)) {
      case '-': $order_direction = "ASC";
        break;

      case '+': $order_direction = "DESC";
        break;
      default: throw new Exception("invail format. First character!");
    }

    $order_column = substr($order, 1);

    return $this->query("SELECT *
                         FROM accounts
                         WHERE LOWER(email) LIKE CONCAT('%', :email, '%')
                         ORDER BY ${order_column} ${order_direction}
                         LIMIT ${limit} OFFSET ${offset}",
                         ["email" => strtolower($search)]);
  }

  public function get_user_by_token($token){
    return $this->query_unique("SELECT * FROM accounts WHERE token = :token", ["token" => $token]);
  }

}


?>
