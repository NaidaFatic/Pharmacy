<?php
require_once dirname(__FILE__)."/BaseDao.class.php";
require_once dirname(__FILE__)."/CartDao.class.php";

class PurchaseDao extends BaseDao
{
  function __construct()
  {
    parent:: __construct("purchases");
    $this->cartDao = new CartDao();
  }

 public function add_purchase($purchase){
   $ids = $this->query("SELECT id FROM carts WHERE account_id = :id AND status = :status", ["id" => $purchase["account_id"], "status" => "BOUGHT"]);

   foreach($ids as $i){
     $purchase["cart_id"] = $i['id'];
     parent::add($purchase);
     $this->cartDao->update_status($purchase["account_id"], "PURCHASED");
    }
   }

 public function get_purchase_by_id($search){
    return $this->get_by_id($search);
 }

 public function remove_by_id($id){
   $data = $this->query_unique("SELECT * FROM purchases WHERE id = :id", ["id" => $id]);

   if($data){
     $query = "DELETE FROM purchases WHERE id = :id";
     $stmt = $this->connection->prepare($query);
     $params=["id" => $id];
     $stmt -> execute($params);
   } else {
     throw new \Exception("There is no purchase with this id", 404);
   }
 }

}

?>
