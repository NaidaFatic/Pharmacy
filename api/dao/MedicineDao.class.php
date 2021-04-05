<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class MedicineDao extends BaseDao{

  public function __construct(){
    parent::__construct("medicines");
  }
  
  public function get_medicines_by_name($offset, $limit, $name, $order){
    list($order_column, $order_direction) = self::parse_order($order);
    $params = ["name" => strtolower($name)];

    $query = "SELECT * FROM medicines
                        WHERE LOWER(name) = :name ";
    if(isset($search)){
      $query .="OR (LOWER(description) LIKE CONCAT('%', :name, '%'))
                  OR LOWER(name) LIKE CONCAT('%', :name, '%') ";

      $params['name'] = strtolower($name);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }

}

?>
