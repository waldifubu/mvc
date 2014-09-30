<?php
namespace Util;

class Auth
{
    public static function handleLogin()
    {                   
        if(!isset($_SESSION))
        {
            session_start();
        }
		$logged = $_SESSION['loggedIn'];		
		if ($logged == false) 
		{
			session_destroy();
		    header('Location: ' . URL . 'login');
		}
    }
}