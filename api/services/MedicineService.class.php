<?php
require_once dirname(__FILE__)."/../dao/MedicineDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class MedicineService extends BaseService{
  private $userDao;

  public function __construct(){
    $this->dao = new MedicineDao();
  }

  public function get_medicines($name, $offset, $limit, $search, $order){
    return $this->dao->get_medicines_by_name($name, $offset, $limit, $search, $order);
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
