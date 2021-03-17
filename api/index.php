<?php
require_once dirname(__FILE__)."/dao/AccountDao.class.php";
require_once dirname(__FILE__).'/../vendor/autoload.php';

//$dao = new AccountDao(); // cant do this has to be flight class!!
Flight::register('accountDao', 'AccountDao'); //like this

require_once dirname(__FILE__).'/routes/accounts.php';

?>
