<?php
/**
 * @OA\Get(path="/users/cart", tags={"users", "carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="List medicines for user")
 * )
 */
Flight::route('GET /users/cart', function(){ //why only admin can?????
    Flight::json(Flight::cartService()->get_accounts_medicines(Flight::get('user')['id']));
});

/**
 * @OA\Get(path="/admin/cart", tags={"admin", "carts"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="List medicines for user")
 * )
 */
Flight::route('GET /admin/cart', function(){
    Flight::json(Flight::cartService()->get_accounts_medicines());
});

/**
 * @OA\Post(path="/users/cart", tags={"users" ,"carts"}, security={{"ApiKeyAuth": {}}},
 *  @OA\RequestBody(description="Add medicine", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="quantity",type="integer", required="true", example=1, description="qunatity of medicine"),
 *         @OA\Property(property="medicine_id",type="integer", required="true", example=1, description="which medicine to buy")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Add medicine")
 * )
 */
Flight::route('POST /users/cart', function(){
    $data=Flight::request()->data->getData();
    $data["account_id"] = Flight::get('user')['id'];
    Flight::cartService()->add($data);
    Flight::json(["message" => "Medicine added to cart!"]);
});
//remove
//buy

?>
