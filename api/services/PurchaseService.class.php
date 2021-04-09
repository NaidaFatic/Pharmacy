<?php
require_once dirname(__FILE__)."/../dao/PurchaseDao.class.php";

class PurchaseService extends BaseService{

  public function __construct(){
      $this->dao = new PurchaseDao();
  }

 public function add($purchase){
   try{
     $data = [
      "city" => $purchase["city"],
      "zip" => $purchase["zip"],
      "phone_number" => $purchase["phone_number"],
      "date" => date(Config::DATE_FORMAT),
      "account_id" => $purchase["account_id"],
        ];
    $this->dao->add_purchase($data);
   } catch(\Exception $e) {
    throw new \Exception($e->getMessage(), 400, $e);
  }
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


}

?>
