<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');
define('CONTROLLER_DIR', ROOT_DIR . 'src' . DS . 'controller' . DS);
define('VIEW_DIR', ROOT_DIR . 'src' . DS . 'view' . DS);
define('MODEL_DIR', ROOT_DIR . 'src' . DS . 'model' . DS);
define('SRC_DIR', ROOT_DIR . 'src' . DS);
define('CORE_DIR', ROOT_DIR . 'core' . DS);

require_once(ROOT_DIR . 'common' . DS . 'html_view.php');
require_once(ROOT_DIR . 'core' . DS . 'autoload.php');
require_once(ROOT_DIR . 'core' . DS . 'config.php');
require_once(ROOT_DIR . 'core' . DS . 'router.php'); 
require_once(ROOT_DIR . 'core' . DS . 'routes.php'); 
require_once(ROOT_DIR . 'core' . DS . 'controller.php');
require_once(ROOT_DIR . 'core' . DS . 'view.php'); 
require_once(ROOT_DIR . 'core' . DS . 'repository.php'); 

$router = new \core\Router();  
$view = new HTMLView();
$view->echoHTML($router->dispatch());