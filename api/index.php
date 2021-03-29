<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__)."/services/AccountService.class.php";
require_once dirname(__FILE__)."/services/UserService.class.php";
require_once dirname(__FILE__)."/services/MedicineService.class.php";

//$dao = new AccountDao(); // cant do this has to be flight class!!
Flight::set('flight.log.errors', TRUE);

 /*error handling for our API *//*
Flight::map('error', function(Exception $ex){
  Flight::json(["message" => $ex->getMessage()], $ex->getCode()? $ex->getCode(): 500);
});
*/

// utility function for reading query parameters from url

Flight::map('query', function($name, $defaul_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $defaul_value;
  return $query_param;

//  Flight::json(Flight::accountDao()->get_all());
});

//swagger documentation
Flight::route('GET /swagger', function(){
  $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

Flight::route('GET /', function(){
  Flight::redirect('/docs');
});



/* register Bussiness Logic layer services */
Flight::register('accountService', 'AccountService');
Flight::register('userService', 'UserService');
Flight::register('medicineService', 'MedicineService');

/* include all routes */
require_once dirname(__FILE__)."/routes/accounts.php";
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/medicines.php";


Flight::start();

?>
