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

Flight::route('GET /users/@id', function($id){
    Flight::json(Flight::userService()->get_by_id($id));
});

?>
