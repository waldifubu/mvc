<?php
namespace Core;

/**
* - fill out form
* - post to php
* - santitize
* - validate
* - return data
* - write to database
*/
//require 'form/validator.php';
use Core\Form\Validator;

class Form
{
    /** @var array $currentItem - the posted item  */    
    private $currentItem = null;
    
    /** @var array $postData -Stores posted data   */
    private $postData = array();
    
    /** @var object validator object  */
    private $val = array();
    
    /** @var array $error holds the current form errors  */
    private $error = array();
    
    public function __construct()
    {        
        $this->val = new Validator();
    }
    
    /**
    * post - This is to run $_POST
    * 
    * @param string $field
    * @return string
    */
    
    /**
    * 
    * @param string $field - the HTML fieldname to post
    * 
    * @return
    */
    public function post($field)
    {
        $this->postData[$field] = $_POST[$field];
        $this->currentItem = $field;
        return $this;
    }
    
    /**
    * fetch - return the posted data
    * @param mixed $fieldName
    * 
    * @return mixed
    */
    public function fetch($fieldName = false)
    {
        if($fieldName) 
        {
            if(isset($this->postData[$fieldName]))
            return $this->postData[$fieldName];
            else 
            return false;
        } 
        else 
        {
            return $this->postData;    
        }        
    }
    
    
    /**
    * val - This is to validate
    * @param string $type Type of validator
    * @param string Argument
    * 
    * @return mixed
    */
    public function val($type, $arg = null)
    {   
        $postItem = $this->postData[$this->currentItem];        
        
        if ($arg != null)
        $error = $this->val->{$type}($postItem, $arg);
        else
        $error = $this->val->{$type}($postItem);
        
        if ($error)
        {
           $this->error[$this->currentItem] = $error;
        }        
        
        return $this;
    }
    
    /**
    * Handles form
    * 
    * @return boolean
    * @throws Exception
    */
    public function submit()
    {
        if (empty($this->error))        
        return true;
        else 
        {
            $str="";            
            foreach ($this->error as $key => $value)
            {
                $str.=$key.' => '.$value."<br />";
            }
            throw new Exception($str);
        }
    }
}