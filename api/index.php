<?php
require_once dirname(__FILE__)."/dao/AccountDao.class.php";
require dirname(__FILE__).'/../vendor/autoload.php';

//$dao = new AccountDao(); // cant do this has to be flight class!!
Flight::register('accountDao', 'AccountDao'); //like this

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('POST /accounts', function(){
    $request=Flight::request();             // where is the data stored before the class metod
    $data = $request->data->getData();
    Flight::json(Flight::accountDao()->add($data));
});

Flight::route('GET /accounts', function(){
  Flight::json(Flight::accountDao()->get_all());
});

Flight::route('PUT /accounts/@email', function($email){
  $request = Flight::request();
  $data = $request->data->getData();
  $account1 = Flight::accountDao()->update_account_by_email($email, $data);
  $account = Flight::accountDao() ->get_account_by_email($email);
  //print_r($data); //when we print in json when in print_r?
  Flight::json($account);
});

Flight::start();

?>
