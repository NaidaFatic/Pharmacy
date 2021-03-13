<?php

class CartDao extends BaseDao
{
  public function __construct(){
    parent::__construct("carts");
  }

  public function get_medicine_in_cart_by_account($id){
    return $this->query_unique("SELECT m.name FROM carts c, medicines m
                          WHERE c.medicine_id= m.id AND account_id= :id", ["id" => $id]);
  }

  public function get_total_price_by_account($id){
    return $this->query_unique("SELECT SUM(m.price) FROM carts c, medicines m
                          WHERE c.medicine_id= m.id AND account_id = :id", ["id" => $id]);
  }

  public function alter_cart_by_account($account, $medicine){ //will not use this
    $query = "DELETE FROM carts WHERE account_id= :account_id AND medicine_id= :medicine_id";
    $stmt = $this->connection->prepare($query);
    $params=["account_id" => $account, "medicine_id" => $medicine];
    $stmt -> execute($params);
  }

  public function update_status($account, $medicine, $status){ //change status insted of delete
    $query = "UPDATE carts SET status = :status WHERE account_id= :account_id AND medicine_id= :medicine_id";
    $stmt = $this->connection->prepare($query);
    $params=["status" => $status, "account_id" => $account, "medicine_id" => $medicine];
    $stmt -> execute($params);
  }

  }




?>
