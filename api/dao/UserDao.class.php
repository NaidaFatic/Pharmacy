<?php
require_once dirname(__FILE__). "/BaseDao.class.php";

class UserDao extends BaseDao{

  public function __construct(){
    parent::__construct("users");
  }

  public function get_user_by_id($id){
    return $this->query_unique("SELECT * FROM users WHERE id= :id", ["id" => $id]);
  }

  public function get_by_name($name){
    return $this->query_unique("SELECT * FROM users WHERE name= :name", ["name" => $name]);
  }

}

?>
