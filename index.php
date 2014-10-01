<?php

require_once("common/html_view.php");
require_once("core/router.php"); 

session_start();

$router = new \core\Router();  
$view = new  HTMLView();
$view->echoHTML($router->dispatch());