<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');

require_once(ROOT_DIR . 'common' . DS . 'html_view.php');
require_once(ROOT_DIR . 'core' . DS . 'config.php');
require_once(ROOT_DIR . 'core' . DS . 'router.php'); 
require_once(ROOT_DIR . 'core' . DS . 'routes.php'); 
require_once(ROOT_DIR . 'core' . DS . 'controller.php');
require_once(ROOT_DIR . 'core' . DS . 'view.php'); 
require_once(ROOT_DIR . 'core' . DS . 'repository.php'); 

$router = new \core\Router();  
$view = new HTMLView();
$view->echoHTML($router->dispatch());