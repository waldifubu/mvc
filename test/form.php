<?php
namespace Test;

use \Core\Form;

require '../config.php';
require '../core/autoloader.php';
spl_autoload_register(array('autoloader','autoload'));
//require '../core/form.php';
//require '../core/database.php';

if (isset($_REQUEST['run']))
{   
    try
    {
        $form = new \Form();

        $form    ->post('name')
                 ->val('minlength', 2)
                 ->post('age')
                 ->val('minlength', 2)
                 ->val('digit')
                 ->post('gender');                                             
        $form->submit();
        $db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $db->insert(PERSON, $form->fetch());
    }    
    catch (Exception $e) 
    {
        echo $e->getMessage();
    }    
}
?>

<form method="post" action="?run">
    Name <input name="name" type="text"/><br />
    Age <input name="age" type="text"/><br />
    Gender <select name="gender">
        <option value="m">Male</option>
        <option value="f">Female</option>
    </select><br />    
    
    <input type="submit"/>
</form>