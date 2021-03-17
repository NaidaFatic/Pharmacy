<?php

Flight::route('POST /accounts', function(){
    $request=Flight::request();             // where is the data stored before the class metod
    $data = $request->data->getData();
    Flight::json(Flight::accountDao()->add($data));
});

Flight::route('GET /accounts', function(){
  Flight::json(Flight::accountDao()->get_all());
});

Flight::route('GET /accounts/@email', function(){
  $account = Flight::accountDao() ->get_account_by_email($email);
});

Flight::route('PUT /accounts/@email', function($email){
  $request = Flight::request();
  $data = $request->data->getData();
  $account = Flight::accountDao()->update_account_by_email($email, $data);
  //print_r($data); //when we print in json when in print_r?
  Flight::json($account);
});

Flight::start();

?>
