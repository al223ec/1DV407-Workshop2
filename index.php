<?php

require_once("common/HTMLView.php");
require_once("core/Main.php"); 
require_once("core/Router.php"); 

session_start();

$router = new \core\Router();  
$view = new  HTMLView();
$view->echoHTML($router->dispatch());