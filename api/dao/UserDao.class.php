<?php

require_once dirname(__FILE__). "/BaseDao.class.php";

class UserDao extends BaseDao{

  public function __construct(){
    parent::__construct("users");
  }

  public function get_user_by_name($name){
    return $this->get_by_name($name);
}

  public function get_user_by_id($id){
    return $this->query_unique("SELECT * FROM users WHERE id= :id", ["id" => $id]);
  }

  public function add_user($entity){
    $this->add($entity);
  }

  public function update_user_by_id($id, $user){
    $this->update_by_id($id, $user);
  }


}

?>
