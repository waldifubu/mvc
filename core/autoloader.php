<?php
class Autoloader 
{ 
   public static function autoload($class)
   {
    $pfad = str_replace('\\', DIRECTORY_SEPARATOR , strtolower($class)) . '.php';
    require_once $pfad;
   }
}