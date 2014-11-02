<?php
/**
 * Created by PhpStorm.
 * User: Waldi
 * Date: 25.10.2014
 * Time: 23:15
 */

class Cupcake {

    public $cupcake = array();

    public function Nuts($str)
    {
        echo '<p>'.__METHOD__.'</p>';
        $this->cupcake['Nuts'] = $str;
        return $this;
    }

    public function Frosting($str)
    {
        echo '<p>'.__METHOD__.'</p>';
        $this->cupcake['Frosting'] = $str;
        return $this;
    }

    public function Sprinkles($str)
    {
        echo '<p>'.__METHOD__.'</p>';
        $this->cupcake['Sprinkles'] = $str;
        return $this;
    }
}


$cupcake = new Cupcake();

$cupcake->Nuts('10')
        ->Frosting('choco')
        ->Sprinkles('200');


var_dump($cupcake);

ini_set('xdebug.auto_trace', 'On');
echo xdebug_get_function_count();
var_dump(xdebug_get_function_stack());
var_dump(debug_backtrace());
