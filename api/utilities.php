<?php

class Util{

  public static function GET_ORDER($carts){
    $string ="";

    foreach($carts as $id){
      $string = $string.", ".$id['name']." => ".$id['quantity'];
    }

    $string = substr($string, 2);
    return $string;
  }

}

?>
