<?php
class AccountDao extends BaseDao{

  public function add_account($account){
    $sql = "INSERT INTO accounts (email, password, user_id) VALUES (:email, :password, :user_id)";
    $stmt= $this->connection->prepare($sql);
    $stmt->execute($account);
    $account["id"]= $this->connection->lastInsertId();
    return $account;
  }

  public function get_account_by_email($email){
      return $this->query_unique("SELECT * FROM accounts WHERE email = :email", ["email" => $email]);
  }

  public function update_account($id, $account){
    $this->update("accounts", $id, $account);
  }

  public function update_account_by_email($email, $account){
      $this->update("accounts", $email, $account, "email");
    }

}


?>
