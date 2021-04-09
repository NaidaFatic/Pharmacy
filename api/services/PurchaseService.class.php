<?php
require_once dirname(__FILE__)."/../dao/PurchaseDao.class.php";
require_once dirname(__FILE__)."/MedicineService.class.php";

class PurchaseService extends BaseService{

  public function __construct(){
      $this->dao = new PurchaseDao();
      $this->medicineDao = new MedicineDao();
  }

 public function add($purchase){
    $this->dao->add_purchase($purchase);
    $this->reduce_quantity($purchase['cart_id']);
 }

 public function get_purchase($offset, $limit, $search, $order){
   if($search){
       return $this->dao->get_purchase_by_id($search);
   }
   else{
     return $this->dao->get_all($offset, $limit, $order);
   }
 }

 public function remove($id){
   $this->dao->remove_by_id($id);
 }

private function reduce_quantity($cart){
  
}


}

?>
