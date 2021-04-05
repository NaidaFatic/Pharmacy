<?php

function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
Flight::route('/user/*', function(){
  try {
      $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWP_SECRET, ["HS256"]);
      if (Flight::request()->method != "GET" && $user["r"] == "USER_READ_ONLY"){
        throw new Exception("Read only user can't change anything.", 403);
      }
      Flight::set('user', $user);
      return TRUE;
  } catch (\Exception $e) {
      Flight::json(["messsage" => $e->getMessage()], 401);
      die;
  }
});

Flight::route('/admin/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWP_SECRET, ["HS256"]);
    if ($user['r'] != "ADMIN"){
      throw new Exception("Admin access required", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});
?>
