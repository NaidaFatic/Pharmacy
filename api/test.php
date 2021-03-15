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


$querry= $account_dao->get_all();


echo json_encode($querry, JSON_PRETTY_PRINT);


?>
