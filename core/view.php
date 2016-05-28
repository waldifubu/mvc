<?php
# Main View Controller
namespace Core;

class View
{
    public $title;
    public $js;

    public function __construct()
    {

    }

    public function render($name, $include = true)
    {
        if ($include == true) {
            require VIEW_PATH . 'header.php';
        }

        require VIEW_PATH . $name . '.php';

        if ($include == true) {
            require VIEW_PATH . 'footer.php';
        }
    }
}
