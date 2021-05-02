<?php

class Util{

  public static function TO_STRING($array){
    $string="";
    foreach($array as $i){
      $string =$string.', '.$i;
    }
     $string = substr($string, 1);
    return $string;
  }

}




?>
