<?php
/**
 * @OA\Get(path="/users/individual/cart", tags={"users", "carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="List medicines for user")
 * )
 */
Flight::route('GET /users/individual/cart', function(){
   Flight::json(Flight::cartService()->get_accounts_medicines(Flight::get('user')['id']));
});

/**
 * @OA\Post(path="/users/cart/{id}", tags={"users" ,"carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *        @OA\RequestBody(description="Add medicine", required=true,
 *        @OA\MediaType( mediaType="application/json",
 *         @OA\Schema(
 *         @OA\Property(property="quantity",type="integer", required="true", example=1, description="qunatity of medicine")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Add medicine")
 * )
 */
Flight::route('POST /users/cart/@id', function($id){
    $data=Flight::request()->data->getData();
    $data["account_id"] = Flight::get('user')['id'];
    $data["medicine_id"] = $id;
    Flight::cartService()->add($data);
    Flight::json(["message" => "Medicine added to cart!"]);
});

/**
 * @OA\Put(path="/users/cart/{id}",tags={"carts", "users"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *      @OA\RequestBody(description="Medicine is going to be removed", required=true,
 *      @OA\MediaType( mediaType="application/json") ),
 *     @OA\Response(response="200", description="Remove medicine from cart")
 * )
 */
Flight::route('PUT /users/cart/@id', function($id){
  Flight::cartService()->remove_medicine(Flight::get('user')['id'], $id);
  Flight::json(["message" => "Medicine removed from cart!"]);
});

/**
 * @OA\Get(path="/users/total/cart", tags={"users", "carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="List total for user")
 * )
 */
Flight::route('GET /users/total/cart', function(){
    Flight::json(Flight::cartService()->get_total(Flight::get('user')['id']));
});

/**
 * @OA\Get(path="/admin/cart", tags={"admin", "carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="List total for user")
 * )
 */
Flight::route('GET /admin/cart', function(){
    Flight::json(Flight::cartService()->get_carts());
});

/**
 * @OA\Put(path="/users/buy/cart",tags={"carts", "users"}, security={{"ApiKeyAuth":{}}},
 *      @OA\RequestBody(description="Medicine is going to be bought", required=true,
 *      @OA\MediaType( mediaType="application/json") ),
 *      @OA\Response(response="200", description="Change status in cart")
 * )
 */
Flight::route('PUT /users/buy/cart', function(){
  Flight::cartService()->buy_medicine(Flight::get('user')['id']);
  Flight::json(["message" => "Medicines bought from cart!"]);
});

/**
 * @OA\Get(path="/users/cart/{id}", tags={"users", "carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *      @OA\RequestBody(description="Medicine is going to be removed", required=true,
 *      @OA\MediaType( mediaType="application/json") ),
 *     @OA\Response(response="200", description="List total for user")
 * )
 */
Flight::route('GET /users/cart/@id', function($id){
    Flight::json(Flight::cartService()->get_cart($id));
});

/**
 * @OA\Put(path="/users/cart/update/{id}",tags={"carts", "users"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *      @OA\RequestBody(description="Cart is going to be updated", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(property="quantity",type="integer", example="1", description="quantity"),
 *           @OA\Property(property="medicine_id",type="integer", example="1", description="")
 *      )
 *    )
 *  ),
 *     @OA\Response(response="200", description="Update cart")
 * )
 */
Flight::route('PUT /users/cart/update/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::cartService()->update($id, $data));
});

?>
