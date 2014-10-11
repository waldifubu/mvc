<?php
namespace Util;

use Core\Session;

class Auth
{
    public static function handleLogin()
    {                   
        if(!isset($_SESSION))
        {
            Session::init();
        }

        if (isset($_SESSION['timeout']))
        {
            $logged = $_SESSION['loggedIn'];

            if (time() > $_SESSION['timeout'])
            {
                $logged = false;
            }
            else
            {
                $_SESSION['timeout'] = time() + 15 * 60;
                $logged = true;
            }
        }


        if ($logged == false)
		{
			session_destroy();
		    header('Location: ' . URL . 'login');
		}
    }
}