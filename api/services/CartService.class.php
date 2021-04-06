<?php
require_once dirname(__FILE__)."/../dao/CartDao.class.php";

class CartService extends BaseService{

  public function __construct(){
      $this->dao = new CartDao();
  }

 public function get_accounts_medicines($aid){
   return $this->dao->get_medicine_in_cart_by_account($aid);
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
 }

?>
