<?php
require_once dirname(__FILE__)."/../dao/CartDao.class.php";

class CartService extends BaseService{

 public function __construct(){
      $this->dao = new CartDao();
  }

 public function get_accounts_medicines($account){
   return $this->dao->get_medicine_in_cart_by_account($account);
 }

 public function add($medicine){
    try{
      $data = [
       "quantity" => $medicine["quantity"],
       "STATUS" => "IN_CART",
       "medicine_id" => $medicine["medicine_id"],
       "account_id" => $medicine["account_id"]
         ];
     return parent::add($data);
    }catch(\Exception $e){
     throw new \Exception($e->getMessage(), 400, $e);
     }
 }

 public function remove_medicine($account, $id){
   $this->dao->alter_cart_by_account($account, $id);
 }

 public function get_total($account){
  return $this->dao->get_total_price_by_account($account);
 }

 public function buy_medicine($account){
   $status = "BOUGHT";
   $this->dao->change_quantity($account);
  return $this->dao->update_status($account, $status);
 }

 public function get_medicine_id($id){
   return $this->dao->get_medicine_by_cart($id);
 }

 public function get_carts(){
   return $this->dao->get_carts();
 }

 public function get_cart($id){
   return $this->dao->get_by_id($id);
 }

 public function update($id, $data){
   return parent::update($id, $data);
 }
}

?>
