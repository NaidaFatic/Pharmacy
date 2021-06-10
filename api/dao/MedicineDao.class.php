<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class MedicineDao extends BaseDao{

  public function __construct(){
    parent::__construct("medicines");
  }

  public function get_medicines_by_name($offset, $limit, $search, $order, $total = FALSE){
    list($order_column, $order_direction) = self::parse_order($order);
    $params = [];
    if($total){
      $query = "SELECT COUNT(*) AS total ";
    }else{
      $query = "SELECT * ";
    }
    $query .= "FROM medicines
              WHERE 1 = 1 ";

    if (isset($search)){
      $query .= "AND ( LOWER(name) LIKE CONCAT('%', :search, '%') OR LOWER(description) LIKE CONCAT('%', :search, '%'))";
      $params['search'] = strtolower($search);
    }

    if($total){
      return $this->query_unique($query, $params);
    }else{
      $query .="ORDER BY ${order_column} ${order_direction} ";
      $query .="LIMIT ${limit} OFFSET ${offset}";

      return $this->query($query, $params);
    }
  }

  public function update_quantity($id, $quantity){
    $query = "UPDATE medicines SET quantity = :quantity
               WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $params=["id" => $id, "quantity" => $quantity];
    $stmt -> execute($params);
  }

  public function get_quantity($id){
    return $this->query_unique("SELECT quantity FROM medicines WHERE id = :id", ["id" => $id]);
  }

  public function get_chart_all(){
    $no = 1;
    return $this->query("SELECT DATE_FORMAT(added_at, '%Y-%m') mon, COUNT(*) cnt FROM medicines WHERE 1 = :no GROUP BY DATE_FORMAT(added_at, '%Y-%m')", ["no" => $no]);
  }

  public function get_chart_company(){
    $no = 1;
    return $this->query("SELECT company_name label, SUM(quantity) value FROM medicines WHERE 1 = :no GROUP BY company_name", ["no" => $no]);
  }

}

?>
