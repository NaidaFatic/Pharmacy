<?php
require_once dirname(__FILE__)."/../dao/MedicineDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class MedicineService extends BaseService{
  private $userDao;

  public function __construct(){
    $this->dao = new MedicineDao();
  }

  public function get_medicines($name, $offset, $limit, $search){
    return $this->dao->get_medicines_by_name($name, $offset, $limit, $search);
  }

  public function add($medicine){
    try{
      return parent::add($medicine);
    }catch(\Exception $e){
    throw new \Exception($e);

    }
  }




}

?>
