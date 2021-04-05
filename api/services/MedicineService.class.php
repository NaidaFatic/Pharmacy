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
      $medicine['added_at'] = date(Config::DATE_FORMAT);
      return parent::add($medicine);
    }catch(\Exception $e){
    throw new \Exception($e);

    }
  }




}

?>
