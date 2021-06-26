<?php
use \Firebase\JWT\JWT;
require_once dirname(__FILE__)."/middleware.php";
require_once dirname(__FILE__)."/../config.php";

/**
 * @OA\Info(title="Pharmacy", version="0.1")
 * @OA\OpenApi(
 *   @OA\Server(url="http://localhost/project/Pharmacy/api/", description="Development enviroment"),
 *   @OA\Server(url="https://pharmacy-dfr2g.ondigitalocean.app/api/", description="Production enviroment")
 * ),
 * @OA\SecurityScheme(
 *      securityScheme="ApiKeyAuth", in="header", name="Authentication", type="apiKey")
 */

/**
 * @OA\Get(path="/admin/accounts", tags={"accounts", "admin"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="offset for pegination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="limit for pegination"),
 *    @OA\Parameter(type="string", in="query", name="search", description="search string for accounts, case insesitive sreach"),
 *   @OA\Parameter(type="sting", in="query", name="order", default="-id", description="sort for return elemnts, -id asccrending, +id descenign based on id"),
 *     @OA\Response(response="200", description="List all accounts")
 * )
 */
Flight::route('GET /admin/accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', "+id");
  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/admin/accounts/{id}", tags={"accounts", "admin"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="get a account by id"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /admin/accounts/@id', function($id){
  Flight::json(Flight::accountService()->get_by_id($id));
});

/**
 * @OA\Post(path="/admin/accounts", tags={"accounts", "admin"}, security={{"ApiKeyAuth":{}}},
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
Flight::route('POST /admin/accounts', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/admin/accounts/{id}",tags={"accounts", "admin"}, security={{"ApiKeyAuth":{}}},
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
Flight::route('PUT /admin/accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id, $data));
});

/**
 * @OA\Post(path="/login", tags={"login"}, description="Login user",
 *  @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="email",type="string", required=true, example="example@gmail.com", description="email of user"),
 *         @OA\Property(property="password",type="string", required=true, example="123", description="password of user")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Login user")
 * )
 */
Flight::route('POST /login', function(){
    Flight::json(Flight::JWT(Flight::accountService()->login(Flight::request()->data->getData())));
});

/**
 * @OA\Post(path="/forgot", tags={"login"}, description="Forgot password",
 *  @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="email",type="string", required=true, example="example@gmail.com", description="Email of user")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Recovery token")
 * )
 */
Flight::route('POST /forgot', function(){
    $data = Flight::request()->data->getData();
    Flight::accountService()->forgot($data);
    Flight::json(["message" => "Recovery link has been send!"]);
});

/**
 * @OA\Post(path="/reset", tags={"login"}, description="Reset password",
 *  @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="token",type="string", required=true, example="1212121121212", description="Recovery token for user"),
 *         @OA\Property(property="password",type="string", required=true, example="123", description="New password for user")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Reset password")
 * )
 */
Flight::route('POST /reset', function(){
    Flight::json(Flight::JWT(Flight::accountService()->reset(Flight::request()->data->getData())));
});

/**
 * @OA\Get(path="/confirm/{token}", tags={"login"},
 *     @OA\Parameter(type="string", in="path", name="token", default=123, description="Conformation token"),
 *     @OA\Response(response="200", description="Send conformation token")
 * )
 */
Flight::route('GET /confirm/@token', function($token){
    Flight::json(Flight::JWT(Flight::accountService()->confirm($token)));
});

/**
 * @OA\Get(path="/users/account", tags={"users"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="Fetch user account")
 * )
 */
Flight::route('GET /users/account', function(){
  Flight::json(Flight::accountService()->get_by_id(Flight::get('user')['id']));
});
?>
