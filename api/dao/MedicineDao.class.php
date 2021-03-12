<?php

class MedicineDao extends BaseDao{

  public function add_medicine($entity){
    $this->insert("medicines", $entity);
  }

  public function get_medicine_by_name($name){
    return $this->query_unique("SELECT * FROM medicines WHERE name = :name", ["name" => $name]); //parameter values are in array["" => $]
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
