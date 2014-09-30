<?php
namespace Core\Form;

class Validator
{
   public function __construct() 
   {
       
   }
   
   public function minLength($data, $arg)
   {
       if (strlen($data)<$arg)
       {
           return 'Your input data is too short';
       }
   }
   
   public function maxLength($data, $arg)
   {
       if (strlen($data)>$arg)
       {
           return 'Your input data is too long';
       }
   }
   
   public function digit($data)
   {
       if (!ctype_digit($data))
       {
           return 'Please give me a number';
       }
   }
   
   public function __call($name, $arguments)
   {
       throw new Exception("$name does not exist inside ".__CLASS__);
   }
}