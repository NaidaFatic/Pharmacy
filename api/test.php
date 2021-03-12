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
  "medicine_id" => 1,
  "account_id" => 2
];

$query= $cart->update_status(2,1, "BOUGHT");

//print_r($query);

//$user = $account_dao->update_account(6, $user1);

//$medicine = $medicine_dao-> update_medicine_by_name("Brufen", $user1);

//$medicine= $medicine_dao -> get_all_medicine();

//print_r($medicine);

//($query);

//$user = $user_dao -> get_user_by_name("Naida");

//print_r($user);

?>
