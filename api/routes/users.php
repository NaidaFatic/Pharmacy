<?php
/**
 * @OA\Post(path="/users/register", tags={"users"},
 *  @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="email",type="string", required="true", example="example@gmail.com", description="email of user"),
 *         @OA\Property(property="password",type="string", required="true", example="123", description="password of user"),
 *         @OA\Property(property="name",type="string", required="true", example="name", description="fist name of user"),
 *       @OA\Property(property="surname",type="string", required="true", example="surname", description="last name of user")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Add individual account")
 * )
 */
Flight::route('POST /users/register', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::userService()->register($data);
    Flight::json(["message" => "Please check your email"]);
});

/**
* @OA\Get(path="/users/{id}", tags={"users"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="get a user by id"),
 *     @OA\Response(response="200", description="Fetch individual user")
 * )
 */
Flight::route('GET /users/@id', function($id){
    Flight::json(Flight::userService()->get_by_id($id));
});

/**
 * @OA\Get(path="/user/{name}", tags={"users"},
 *     @OA\Parameter(type="string", in="path", name="name", default="name", description="get a user by name"),
 *     @OA\Response(response="200", description="Fetch individual user")
 * )
 */
 Flight::route('GET /user/@name', function($name){
    Flight::json(Flight::userService()->get_user_by_name($name));
 });

?>
