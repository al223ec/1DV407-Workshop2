<?php


require_once("src/model/User.php");
require_once("common/HTMLView.php");
require_once("core/Main.php"); 
require_once("core/Router.php"); 

session_start();

$router = new Router();  
$view = new  HTMLView();
$view->echoHTML(Main::dispatch($router));
