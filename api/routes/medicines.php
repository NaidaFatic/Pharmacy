<?php

Flight::route('POST /medicine', function(){
    $data=Flight::request()->data->getData();            // where is the data stored before the class metod
    Flight::json(Flight::medicineService()->add($data));
});



?>
