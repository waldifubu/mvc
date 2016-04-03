<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MVC Example Framework
 *
 * PHP version 5
 *
 * Initial file for whole mvc. Always called for every request
 * Very good framework in MVC Manor
 * You don't really need to read this
 *
 * LICENSE: Don't steal it
 *
 * @category  PHP
 * @package   Mvc
 * @author    Waldi <wfubu@web.de>
 * @copyright 2015 W. Dell
 * @license   BSD Licence
 * @link      http://google.com
*/

// Root - Index

// Config stuff
require_once 'config.php';
require_once 'core/autoloader.php';

// register Autoloader
spl_autoload_register(array('autoloader','autoload'));
spl_autoload_extensions('.php');

// Set parameter for FW
$bootstrap = new Core\Bootstrap();
$bootstrap->setControllerPath(CONTROLLER_PATH);
$bootstrap->setModelPath(MODEL_PATH);
$bootstrap->setViewPath(VIEW_PATH);

// Init the action!
$bootstrap->init();