<?php
/**
 * @OA\Info(title="Pharmacy", version="0.1")
 * @OA\OpenApi(
 *   @OA\Server(url="http://localhost/project/Pharmacy/api/", description="Development enviroment"),
 *   @OA\Server(url="http://Pharmacy.com", description="Host enviroment")
 * )
  */

  /**
 * @OA\Get(path="/accounts", tags={"accounts"},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="offset for pegination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="limit for pegination"),
  *    @OA\Parameter(type="string", in="query", name="search", description="search string for accounts, case insesitive sreach"),
   *   @OA\Parameter(type="sting", in="query", name="order", default="-id", description="sort for return elemnts, -id asccrending, +id descenign based on id"),
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
 * @OA\Get(path="/accounts/{id}", tags={"accounts"},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="get a account by id"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /accounts/@id', function($id){
  Flight::json(Flight::accountService()->get_account_by_id($id)); //we use Flight::json to return-print the result
});

/**
 * @OA\Post(path="/accounts", tags={"accounts"},
 *  @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="email",type="string", example="example@gmail.com", description="email of user"),
 *         @OA\Property(property="password",type="string", example="123", description="password of user"),
 *         @OA\Property(property="user_id",type="integer", example="1", description="")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Add individual account")
 * )
 */
Flight::route('POST /accounts', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/accounts/{id}",tags={"accounts"},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *      @OA\RequestBody(description="Account is going to be updated", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(property="email",type="string", example="example@gmail.com", description="email of user"),
 *           @OA\Property(property="password",type="string", example="123", description="password of user"),
 *           @OA\Property(property="user_id",type="integer", example="1", description="")
 *      )
 *    )
 *  ),
 *     @OA\Response(response="200", description="Update individual account")
 * )
 */
Flight::route('PUT /accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  //print_r($data); //when we print in json when in print_r?
  Flight::json(Flight::accountService()->update($id, $data));
});



?>
