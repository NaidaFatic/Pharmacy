<?php

require_once dirname(__FILE__). "/BaseDao.class.php";

class UserDao extends BaseDao{

  public function get_user_by_name($name){
    return $this->query_unique("SELECT * FROM users WHERE name = :name", ["name" => $name]);
}

  public function get_user_by_id($id){
    return $this->query_unique("SELECT * FROM users WHERE id= :id", ["id" => $id]);
  }

  public function add_user($entity){
    $this->insert("users", $entity);
  }

  public function update_user($id, $user){
    $this->update("users", $id, $user);
  }


}

?>
