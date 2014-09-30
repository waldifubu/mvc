<?php
# Root - Index

# Config stuff
require_once 'config.php';
require_once 'core/autoloader.php';

spl_autoload_register(array('autoloader','autoload'));

$bootstrap = new Core\Bootstrap();
$bootstrap->setControllerPath(CONTROLLER_PATH);
$bootstrap->setModelPath(MODEL_PATH);
$bootstrap->setViewPath(VIEW_PATH);


$bootstrap->init();
