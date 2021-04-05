<?php
/**
 * @OA\Get(path="/users/medicines", tags={"admin", "medicines"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for medicines. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List medicines for user")
 * )
 */
Flight::route('GET /users/medicines', function(){ //why only admin can?????
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::medicineService()->get_medicines($offset, $limit, $search, $order));
});

/**
 * @OA\Post(path="/admin/medicines", tags={"admin" ,"medicines"}, security={{"ApiKeyAuth": {}}},
 *  @OA\RequestBody(description="Add medicine", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="name",type="string", required="true", example="name", description="name for medicine"),
 *         @OA\Property(property="company_name",type="string", required="true", example="company name", description="who made this medicine"),
 *         @OA\Property(property="price",type="double", required="true", example="0.0", description="price of medicie"),
 *         @OA\Property(property="description",type="string", required="true", example="description", description="decription of medicine"),
 *         @OA\Property(property="quantity",type="int", required="true", example=10, description="quantity of medicine")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Add medicine")
 * )
 */
Flight::route('POST /admin/medicines', function(){
    $data=Flight::request()->data->getData();
    Flight::medicineService()->add($data);
    Flight::json(["message" => "Medicine added"]);
});

/**
 * @OA\Put(path="/admin/medicines/{id}",tags={"medicines", "admin"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *      @OA\RequestBody(description="Medicine is going to be updated", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(property="name",type="string", example="new name", description="name of medicine"),
 *           @OA\Property(property="company_name",type="string", example="company name", description="company name"),
 *           @OA\Property(property="price",type="double", example="0.0", description="new price for medicine")
 *      )
 *    )
 *  ),
 *     @OA\Response(response="200", description="Update individual medicine")
 * )
 */
Flight::route('PUT /admin/medicines/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::medicineService()->update($id, $data));
});


?>
