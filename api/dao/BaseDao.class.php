<?php

require_once dirname(__FILE__)."/../config.php";

class BaseDao{
protected $connection; //connection is protected!!
private $table;

  public function __construct($table)
  {
    $this->table= $table;
    try {
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      throw $e;
    }
  }

  protected function insert($table, $entity){
    $query = "INSERT INTO ${table} (";
    foreach($entity as $name => $value){ // foreach to get every column that is there to post to db
      $query.=$name.", ";
    }
    $query= substr($query, 0, -2);
    $query .=" ) VALUES ( ";
      foreach($entity as $name => $value){
        $query.= ":".$name.", ";
      }

    $query= substr($query, 0, -2);
    $query .=" )";

    $stmt= $this->connection->prepare($query);
    $stmt->execute($entity);
    $entity["id"]= $this->connection->lastInsertId(); //automaticly gives last id
    return $entity;
  }

  protected function query($query, $params){

    $stmt = $this->connection->prepare($query);
    $stmt -> execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //this will fetch all columns in a form of assotiative array
  }

  protected function query_unique($query, $params){
    $results = $this->query($query, $params);
    return reset($results);
  }

  protected function update($table, $id, $entity, $id_column = "id"){ //id is default value
    $query = "UPDATE ${table} SET ";
    foreach($entity as $name => $value){
      $query.=$name."= :".$name. ", "; //insert statment is in a form of name = :name!! value is after :
    }

    $query= substr($query, 0, -2);
    $query .=" WHERE ${id_column} = :id"; // to add to query statament put . before =

    $stmt= $this->connection->prepare($query);
    $entity['id']= $id;
    $stmt->execute($entity);
  }

  public function add($entity){
    return $this->insert($this->table, $entity);
  }

  public function update_by_id($id, $entity){
    $this->update($this->table, $id, $entity);
  }

  public function get_by_name($name){
    return $this->query_unique("SELECT * FROM " .$this->table. " WHERE name = :name", ["name" => $name]);
 }

}


?>
