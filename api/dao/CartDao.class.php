<?php
require_once dirname(__FILE__)."/BaseDao.class.php";
require_once dirname(__FILE__)."/MedicineDao.class.php";

class CartDao extends BaseDao
{
  public function __construct(){
    parent::__construct("carts");
    $this->medicineDao = new MedicineDao();
  }

  public function get_medicine_in_cart_by_account($id){
    return $this->query("SELECT * FROM carts
                          WHERE status != :status AND account_id = :id", ["id" => $id, "status" => "BOUGHT"]); //show only one that is not bought!!!
  }

  public function get_total_price_by_account($id){
     $data = $this->query_unique("SELECT SUM(m.price * c.quantity) AS total FROM carts c, medicines m
                          WHERE c.medicine_id= m.id AND account_id = :id AND status = :status", ["id" => $id, "status" => "IN_CART"]);
     if($data['total'] == null)
        return "0.00";
    else return $data['total'];
  }

   public function alter_cart_by_account($account, $medicine){
    $data = $this->get_medicine($account, $medicine);

    if($data != null){                                                                                          //user can remove his itmes
        $query = "DELETE FROM carts WHERE account_id= :account_id AND medicine_id= :medicine_id";
        $stmt = $this->connection->prepare($query);
        $params=["account_id" => $account, "medicine_id" => $medicine];
        $stmt -> execute($params);
    } else {
      throw new \Exception("Not found in cart", 404);
    }
  }

 public function update_status($account, $status){                                                               //change status to bought
   $data = $this->query_unique("SELECT * FROM carts
                         WHERE account_id = :id", ["id" => $account]);
    if($data != null){
      $query = "UPDATE carts SET status = :status WHERE account_id= :account_id";
      $stmt = $this->connection->prepare($query);
      $params=["status" => $status, "account_id" => $account];
      $stmt -> execute($params);
      //send email in purchaseService
    } else {
      throw new \Exception("Nothing in cart", 404);

    }

  }

private function get_medicine($account, $medicine){
  return $data = $this->query_unique("SELECT * FROM carts
                        WHERE medicine_id = :medicine AND account_id = :id", ["id" => $account, "medicine" => $medicine]);
 }

 public function get_medicine_by_cart($id){
   return $this->query_unique("SELECT medicine_id FROM carts WHERE id = :id", ["id" => $id]);
 }

 public function change_quantity($account){
   $ids = $this->get_medicine_in_cart_by_account($account);

   foreach($ids as $id){

     $quantity = $this->medicineDao->get_quantity($id['medicine_id']);
     $new = $quantity['quantity'] - $id['quantity'];
     if($new < 0)
         $new = 0;
     $this->medicineDao->update_quantity($id['medicine_id'], $new);
   }
 }


}

?>
