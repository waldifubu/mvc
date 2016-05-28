<?php
# Help Model
namespace Model;

use Core\Model;

class HelpModel extends Model
{
	function __construct()
	{
		//echo 'Help Model';
	}
    
    public function index()
    {
        return 'Das ist die Hilfe<br />Hier geht es zu <a href="'.URL.'help/other">Other</a>';
    }
	
	public function bla($arg)
	{
        if(empty($arg)) return 'Kein Parameter angegeben';
		return 'Parameter: '.$arg;
	}
}
