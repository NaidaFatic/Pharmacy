<?php
require_once dirname(__FILE__)."/BaseDao.class.php";
require_once dirname(__FILE__)."/CartDao.class.php";

class PurchaseDao extends BaseDao{

 function __construct(){
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
    return $this->query("SELECT p.id, p.city, p.zip, p.phone_number, p.date, a.email, m.name, c.quantity FROM purchases p, carts c, accounts a, medicines m
                                                                 WHERE p.account_id = a.id AND p.cart_id = c.id AND c.medicine_id = m.id AND p.account_id = :id", ["id" => $search]);
 }

 public function get_carts($purchase){
   $ids = $this->query("SELECT * FROM carts WHERE account_id = :id AND status = :status", ["id" => $purchase["account_id"], "status" => "BOUGHT"]);
   return $ids;
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

 public function get_total_price_by_account($id){
    $data = $this->query_unique("SELECT SUM(m.price * c.quantity) AS total FROM carts c, medicines m
                         WHERE c.medicine_id= m.id AND account_id = :id AND status = :status", ["id" => $id, "status" => "BOUGHT"]);
    if($data['total'] == null)
       return "0.00";
   else return  $data['total'];
 }

 public function get_chart_all(){
   $no = 1;
   return $this->query("SELECT DATE_FORMAT(DATE, '%Y-%m') mont, COUNT(*) cn FROM purchases WHERE 1 = :no GROUP BY DATE_FORMAT(DATE, '%Y-%m')", ["no" => $no]);
 }

 public function get_all_purchase($offset=0, $limit=25, $order="-id", $total= FALSE){

  list($order_column, $order_direction) = parent::parse_order($order);

  if($total){
     return $this->query_unique("SELECT COUNT(*) AS total FROM purchases",[]);
  }else{
    return $this->query("SELECT p.id, p.city, p.zip, p.phone_number, p.date, a.email, m.name, c.quantity FROM purchases p, carts c, accounts a, medicines m
                                                                 WHERE p.account_id = a.id AND p.cart_id = c.id AND c.medicine_id = m.id ORDER BY ${order_column} ${order_direction}
                                                                 LIMIT ${limit} OFFSET ${offset}", []);
  }
}

}

?>
