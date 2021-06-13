<?php

/**
 * @OA\Post(path="/users/purchases", tags={"users" ,"purchases"}, security={{"ApiKeyAuth": {}}},
 *  @OA\RequestBody(description="Add medicine", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="city",type="string", required="true", example="Sarajevo", description="city for deilvery"),
 *         @OA\Property(property="phone_number",type="integer", required="true", example=033033033, description="phone for delivery"),
 *         @OA\Property(property="zip",type="integer", required="true", example=17000, description="zip of city")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Purchase medicine")
 * )
 */
Flight::route('POST /users/purchases', function(){
    $data=Flight::request()->data->getData();
    $data["account_id"] = Flight::get('user')['id'];
    Flight::purchaseService()->add($data);
    Flight::json(["message" => "Medicine purchased! Check email!"]);
});

/**
 * @OA\Get(path="/admin/purchases", tags={"admin", "purchases"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search id of purchase. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List purchases")
 * )
 */
Flight::route('GET /admin/purchases', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::purchaseService()->get_purchase($offset, $limit, $search, $order));
});

/**
 * @OA\Put(path="/admin/purchases/{id}",tags={"purchases", "admin"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", example=1),
 *      @OA\RequestBody(description="Purchase is going to be removed", required=true),
 *     @OA\Response(response="200", description="Remove individual purchase")
 * )
 */
Flight::route('PUT /admin/purchases/@id', function($id){
  Flight::purchaseService()->remove($id);
  Flight::json(["message" => "Purchase deleted"]);
});

/**
 * @OA\Get(path="/admin/purchases/chart", tags={"purchases", "admin"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="Get purchase chart data")
 * )
 */
Flight::route('GET /admin/purchases/chart', function(){
  $res=Flight::purchaseService()->getChart();
  Flight::json($res);
});

/**
 * @OA\Get(path="/users/purchases/individual", tags={"users" ,"purchases"}, security={{"ApiKeyAuth": {}}},
 *  @OA\Response(response="200", description="Purchase medicine")
 * )
 */
Flight::route('GET /users/purchases/individual', function(){
    Flight::json(Flight::purchaseService()->getPurchase(Flight::get('user')['id']));
});

/**
 * @OA\Get(path="/admin/purchases/individual/{id}", tags={"purchases", "admin"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="get a purchase by id"),
 *     @OA\Response(response="200", description="Fetch individual medicine")
 * )
 */
Flight::route('GET /admin/purchases/individual/@id', function($id){
  Flight::json(Flight::purchaseService()->getIndividualPurchase($id));
});
?>
