<?php

Flight::route('POST /medicine', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::medicineService()->add($data));
});

Flight::route('GET /medicine', function(){
    $name = Flight::query('name');
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', '-price');

    Flight::json(Flight::medicineService()->get_medicines($name, $offset, $limit, $search, $order));
});

Flight::route('GET /medicine/@id', function($id){
  Flight::json(Flight::medicineService()->get_by_id($id));
});

Flight::route('PUT /medicine/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::medicineService()->update($id, $data));
});

?>