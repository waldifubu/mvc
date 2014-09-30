<?php

# Pizza Model
namespace Model;

use Core\Model;

class Pizza_Model extends Model
{
	public function __construct()
    {
		parent::__construct();        
	}	
    
    public function pizzaList()
	{	
        return $this->db->select('select * from ' . PIZZA_TAB);               		
	}      
    
    public function create($data, $types)    
	{	    	
		$this->db->insertTypes(PIZZA_TAB, $data, $types);	
	}
    
    public function delete($pizza)
	{	        
		$this->db->delete(PIZZA_TAB, "`id` = $pizza");						
	}
}    