<?php
# Root - Index

# Config stuff
require_once 'config.php';
require_once 'core/autoloader.php';

# register Autoloader
spl_autoload_register(array('autoloader','autoload'));
spl_autoload_extensions('.php');

# Set parameter for FW
$bootstrap = new Core\Bootstrap();
$bootstrap->setControllerPath(CONTROLLER_PATH);
$bootstrap->setModelPath(MODEL_PATH);
$bootstrap->setViewPath(VIEW_PATH);

# Init the action!
$bootstrap->init();
