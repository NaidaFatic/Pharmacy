<?php
require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__)."/services/AccountService.class.php";
require_once dirname(__FILE__)."/services/UserService.class.php";

//$dao = new AccountDao(); // cant do this has to be flight class!!
Flight::register('accountDao', 'AccountDao'); //like this

require_once dirname(__FILE__).'/routes/accounts.php';

// utility function for reading query parameters from url

Flight::map('query', function($name, $defaul_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $defaul_value;
  return $query_param;

//  Flight::json(Flight::accountDao()->get_all());
});


/* register Bussiness Logic layer services */
Flight::register('accountService', 'AccountService');
Flight::register('userService', 'UserService');

/* include all routes */
require_once dirname(__FILE__)."/routes/accounts.php";
require_once dirname(__FILE__)."/routes/users.php";

Flight::start();

?>
