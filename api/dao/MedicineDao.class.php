<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class MedicineDao extends BaseDao{

  public function __construct(){
    parent::__construct("medicines");
  }

  public function get_medicine_by_price($price){
    return $this->query("SELECT * FROM medicines WHERE price = :price", ["price" => $price]);
  }

  public function get_medicines_by_name($name, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);
    $params = ["name" => $name];

    $query = "SELECT * FROM medicines
                        WHERE name = :name ";
    if(isset($search)){
      $query .="OR (LOWER(description) LIKE CONCAT('%', :search, '%'))
                  OR LOWER(company_name) LIKE CONCAT('%', :search, '%') ";

      $params['search'] = strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }

  public function update_medicine_by_name($name, $entity){
    $this->update("medicines", $name, $entity, "name");
  }


}

?>
