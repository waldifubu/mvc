<?php

/**
 * MVC Example Framework
 *
 * Initial file for whole mvc. Always called for every request
 * Very good framework in MVC Manor
 * You don't really need to read this
 *
 * PHP version 5
 * LICENSE: Don't steal it
 *
 * @category  PHP
 * @package   Mvc
 * @author    Waldi <wfubu@web.de>
 * @copyright 2015 W. Dell
 * @license   BSD Licence
 * @link      http://google.com
 *
 * Class Bootstrap
 */

namespace Core;

use Controller;

/**
 * Die unten aufgeführten Tag werden üblicherweise für Klassen benutzt.
 * Die Tags @category bis @version sind erforderlich. Die Übrigen
 * sollten ergänzt werden, wenn erforderlich. Verwenden Sie die Tags
 * in der Reihenfolge, wie hier aufgeführt. phpDocumentor bietet
 * weitere Tags, verwenden Sie diese, wenn erforderlich.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      Class available since Release 1.2.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Bootstrap
{
    //<editor-fold desc="Attribute">
    private $_url;

    /**
     * @var \Core\Controller
     */
    private $_controller;
    private $_controllerPath = 'controller/';
    private $_modelPath = 'model/';
    private $_viewPath = 'view/';
    //</editor-fold>

    /**
     * Construct Bootstrap
     */
    public function __construct()
    {

    }

    /**
     * Here starts the magic ^^
     *
     * @return void
     */
    public function init()
    {
        // gets URL query
        $this->_getUrl();

        //Keeps for debugging
        //var_dump($this->_url);

        //no controller was called, so loads index page
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
        } else {
            /**
             * First try to load controller
             * and optional load model, if possible (TRUE)
             */
            if ($this->_loadExistingController()) {
                $this->_callControllerMethod();
            }
        } //Controller was given
    }

    /**
     * Sets controller path
     *
     * @param string $path path
     *
     * @return void
     */
    public function setControllerPath($path)
    {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * Sets model path, models are optional
     *
     * @param string $path path
     *
     * @return void
     */
    public function setModelPath($path)
    {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * Sets path for views and so on
     *
     * @param string $path pfad
     *
     * @return void
     */
    public function setViewPath($path)
    {
        $this->_viewPath = trim($path, '/') . '/';
    }

    /**
     * Seperates URL data in a String
     * @return null
     */
    private function _getUrl()
    {
        $url = @filter_var($_GET['url'], FILTER_SANITIZE_URL);
        $this->_url = @explode('/', rtrim($url, '/'));
    }

    /**
     * Call: /mvc/index OR /mvc
     * @return null
     */
    private function _loadDefaultController()
    {
        $this->_controller = new Controller\Index();
        $this->_controller->index();
    }

    /**
     * Call: /mvc/XXX
     * @return boolean
     */
    private function _loadExistingController()
    {
        $nameClass = 'Controller\\' . $this->_url[0];

        $pfad = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($nameClass)) . '.php';
        if (file_exists($pfad)) {
            // Check if class exists in file, then Autoloader is called
            if (class_exists($nameClass)) {
                $this->_controller = new $nameClass();

                if (isset($this->_controller->haveModel) && $this->_controller->haveModel) {
                    // Model not found
                    if (!file_exists($this->_modelPath . DIRECTORY_SEPARATOR . $this->_url[0] . '_model.php')) {
                        $this->_error(2);
                        return false;
                    }

                    $this->_controller->loadModel($this->_url[0], $this->_modelPath);
                }
                return true;
            } else {
                // Class isn't found
                $this->_error(1);
                return false;
            }
        } else {
            // File not found
            $this->_error(404);
            return false;
        }
    }

    /**
     * Already checked, if controller is given, check for existence and loading
     *
     * @return mixed
     */
    private function _callControllerMethod()
    {
        /*
        http://localhost/Controller/Method/ (Parameter) /(Parameter) /(Parameter)
        url[0] = Controller
        url[1] = Method
        url[2] = Parameter
        url[3] = Parameter
        ..
        */
        $length = count($this->_url);

        if ($length == 1) {
            $this->_controller->index();
        } elseif ($length == 2) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error(1404);
            } else {
                $this->_controller->{$this->_url[1]}();
            }
        } else {
            if (method_exists($this->_controller, $this->_url[1]) === false) {
                $this->_error(1404);
            }
            $params = '';
            for ($i = 2; $i < $length; $i++) {
                $params .= $this->_url[$i] . ',';
            }
            $params = rtrim($params, ',');
            @$this->_controller->{$this->_url[1]}($params);
        }
    }

    /**
     * For error controller
     *
     * @param int $arg Errorcode
     *
     * @return void
     */
    private function _error($arg = 0)
    {
        $this->_controller = new Controller\Error();
        $this->_controller->errorCode = $arg;
        $this->_controller->index();
    }
}
