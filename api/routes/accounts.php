<?php


Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);

  $search = Flight::query('search');
  if($search){
      Flight::json(Flight::accountDao()->get_account($search, $offset, $limit));
  }
  else{
    Flight::json(Flight::accountDao()->get_all($offset, $limit));
  }
});

Flight::route('GET /accounts/@email', function(){
  $account = Flight::accountDao() ->get_account_by_email($email);
});

Flight::route('POST /accounts', function(){
    $request=Flight::request();             // where is the data stored before the class metod
    $data = $request->data->getData();
    Flight::json(Flight::accountDao()->add($data));
});

Flight::route('PUT /accounts/@email', function($email){
  $request = Flight::request();
  $data = $request->data->getData();
  $account = Flight::accountDao()->update_account_by_email($email, $data);
  //print_r($data); //when we print in json when in print_r?
  Flight::json($account);
});



?>
