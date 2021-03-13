<?php
require_once dirname(__FILE__). "/dao/UserDao.class.php";
require_once dirname(__FILE__). "/dao/AccountsDao.class.php";
require_once dirname(__FILE__). "/dao/MedicineDao.class.php";
require_once dirname(__FILE__). "/dao/CartDao.class.php";
require_once dirname(__FILE__). "/dao/PurchaseDao.class.php";

$user_dao= new UserDao();
$account_dao= new AccountDao();
$medicine_dao= new MedicineDao();
$cart= new CartDao();
$purchase= new PurchaseDao();

$user1= [
  "city" => "Sarajevo",
  "zip" => "71000",
  "phone_number" => "0337",
  "date" =>  date('Y-m-d H:i:s'),
  "account_id" => 2,
  "cart_id" => 3
];

$querry= $purchase->add($user1);

print_r($querry);


?>
