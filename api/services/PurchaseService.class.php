<?php
require_once dirname(__FILE__)."/../dao/PurchaseDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../clients/SMTPClient.class.php";

class PurchaseService extends BaseService{

  public function __construct(){
      $this->dao = new PurchaseDao();
      $this->accountDao = new AccountDao();
      $this->SMTPmailer = new SMTPClient();
  }

 public function add($purchase){
   $account = $this->accountDao->get_by_id($purchase['account_id']);

   try{
     $data = [
      "city" => $purchase["city"],
      "zip" => $purchase["zip"],
      "phone_number" => $purchase["phone_number"],
      "date" => date(Config::DATE_FORMAT),
      "account_id" => $purchase["account_id"]
        ];
    $this->dao->add_purchase($data);
  // $this->SMTPmailer->send_user_purchase($purchase, $account);
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
