<?php
require_once dirname(__FILE__). "/dao/UserDao.class.php";
require_once dirname(__FILE__). "/dao/AccountsDao.class.php";
require_once dirname(__FILE__). "/dao/MedicineDao.class.php";
require_once dirname(__FILE__). "/dao/CartDao.class.php";

$user_dao= new UserDao();
$account_dao= new AccountDao();
$medicine_dao= new MedicineDao();
$cart= new CartDao();

//$account = $account_dao -> get_account_by_email("naida.fatic@gmail.com");

$user1= [
  "email" => "lamija@gmail.com",
  "password" => "123",
  "user_id" => "7"
];

//$query= $user_dao->add_user($user1);

$querry= $account_dao->add_account($user1);

//print_r($query);

//$user = $account_dao->update_account(6, $user1);

//$medicine = $medicine_dao-> update_medicine_by_name("Brufen", $user1);

//$medicine= $medicine_dao -> get_all_medicine();

//print_r($medicine);

//($query);

//$user = $user_dao -> get_user_by_name("Naida");

//print_r($user);

?>
