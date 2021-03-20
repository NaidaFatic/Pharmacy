<?php

Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');

  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit));
});

Flight::route('GET /accounts/@email', function(){
  $account = Flight::accountService() ->get_account_by_email($email);
});

Flight::route('POST /accounts', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::accountService()->add($data));
});

Flight::route('PUT /accounts/@email', function($email){
  $data = Flight::request()->data->getData();
  //print_r($data); //when we print in json when in print_r?
  Flight::json(Flight::accountService()->update($email, $data));
});



?>
