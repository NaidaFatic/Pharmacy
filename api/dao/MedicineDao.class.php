<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class MedicineDao extends BaseDao{

  public function __construct(){
    parent::__construct("medicines");
  }

  public function get_all_medicine(){
    return $this->query("SELECT * FROM medicines", []); //[] no parameters to pass
  }

  public function get_medicine_by_price($price){
    return $this->query("SELECT * FROM medicines WHERE price = :price", ["price" => $price]);
  }

  public function update_medicine_by_name($name, $entity){
    $this->update("medicines", $name, $entity, "name");
  }

}

?>
