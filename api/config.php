<?php

class Config{
  const DATE_FORMAT = "Y-m-d H:i:s";

  public static function DB_HOST(){
    return Config::get_env("DB_HOST", "pharmacy-db-do-user-9168844-0.b.db.ondigitalocean.com");
  }

  public static function DB_USERNAME(){
    return Config::get_env("DB_USERNAME", "doadmin");
  }

  public static function DB_PASSWORD(){
    return Config::get_env("DB_PASSWORD", "u6grz0ix1ygzq2l6");
  }

  public static function DB_SCHEME(){
    return Config::get_env("DB_SCHEME", "pharmacy");
  }

  public static function DB_PORT(){
    return Config::get_env("DB_PORT", "25060");
  }

  public static function SMTP_HOST(){
    return Config::get_env("SMTP_HOST", "smtp.gmail.com");
  }

  public static function SMTP_PORT(){
    return Config::get_env("SMTP_PORT", "587");
  }

  public static function SMTP_USER(){
    return Config::get_env("SMTP_USER", NULL);
  }

  public static function SMTP_PASSWORD(){
    return Config::get_env("SMTP_PASSWORD", NULL);
  }

  const JWP_SECRET = "JWT SECRET";
  const JWT_TIME = 604800;

  public static function get_env($name, $default){
    return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }

}

?>
