<?php
require_once dirname(__FILE__)."/../dao/MedicineDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class MedicineService extends BaseService{
  private $userDao;

  public function __construct(){
    $this->dao = new MedicineDao();
  }

  public function get_medicines($offset, $limit, $search, $order){
    if($search){
        return $this->dao->get_medicines_by_name($offset, $limit, $search, $order);
    }
    else{
      return $this->dao->get_all($offset, $limit, $order);
    }
  }

  public function add($medicine){
    try{
      $data = [
        "name" => $medicine["name"],
        "company_name" => $medicine["company_name"],
        "price" => $medicine["price"],
        "description" => $medicine["description"],
        "added_at" => date(Config::DATE_FORMAT),
        "quantity" => $medicine["quantity"]
      ];
    return parent::add($data);
    }catch(\Exception $e){
    throw new \Exception($e->getMessage(), 400, $e);

    }
  }

}

?>
