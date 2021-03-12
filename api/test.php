<?php
require_once dirname(__FILE__). "/dao/UserDao.class.php";
require_once dirname(__FILE__). "/dao/AccountsDao.class.php";

$user_dao= new UserDao();
$account_dao= new AccountDao();

//$account = $account_dao -> get_account_by_email("naida.fatic@gmail.com");

$user1= [
  "email" => "sanida@gmail.com",
  "password" => "123",
  "user_id" => "2"
];


$user = $account_dao->add_account($user1);


//$user = $user_dao -> get_user_by_name("Naida");

print_r($user);

?>
