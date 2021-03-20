<?php

Flight::route('POST /users/register', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::userService()->register($data));
});

Flight::route('GET /users/confirm/@token', function($token){
    Flight::userService()->confirm($token);
    Flight::json(["message" => "your account has been activated"]);
});

?>
