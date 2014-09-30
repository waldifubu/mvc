<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

// Get damn error message away. Must set TZ
date_default_timezone_set("Europe/Berlin");


// Never change it
define('HASH_PASS_KEY', 'gfdlkjgkjfdngvgdfgknfdjghvik23254379gjvncx');


// Config data
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASS', '');
define('USERS_TAB', 'users');
define('PERSON', 'person');
define('NOTES_TAB', 'note');
define('PIZZA_TAB', 'pizza');


// Paths
define('TITLE', 'Moddy');
define('URL', '/mvc/');
define('MODEL_PATH', 'model/');
define('VIEW_PATH', 'view/');
define('CONTROLLER_PATH', 'controller/');
