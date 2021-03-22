<?php
/**
 * @OA\Info(title="Pharmacy", version="0.1")
 */

/**
 * @OA\Get(path="/accounts",
 *     @OA\Response(response="200", description="List all accounts")
 * )
 */
Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');

  $order = Flight::query('order', "+id");

  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/accounts/{id}",
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /accounts/@id', function($id){
  Flight::json(Flight::accountService()->get_account_by_id($id)); //we use Flight::json to return-print the result
});

/**
 * @OA\Post(path="/accounts",
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Add individual account")
 * )
 */
Flight::route('POST /accounts', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/accounts/{id}",
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Update individual account")
 * )
 */
Flight::route('PUT /accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  //print_r($data); //when we print in json when in print_r?
  Flight::json(Flight::accountService()->update($id, $data));
});



?>
