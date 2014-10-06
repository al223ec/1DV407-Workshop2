<?php

define('CONTROLLER_DIR', ROOT_DIR . 'src' . DS . 'controller' . DS);
define('VIEW_DIR', ROOT_DIR . 'src' . DS . 'view' . DS);
define('MODEL_DIR', ROOT_DIR . 'src' . DS . 'model' . DS);
define('SRC_DIR', ROOT_DIR . 'src' . DS);
define('CORE_DIR', ROOT_DIR . 'core' . DS);

abstract class Config{
	
	const DEFAULT_CONTROLLER = "member";
	const DEFAULT_ACTION = "main"; 
	const ALLOWED_URL_CHARS = "/[^A-z0-9\/\^]/"; 
	const DEBUG = true;
	const ERROR_LOG = "myerrors.log"; 
	
	const DB_PASSWORD = "";
	const DB_USERNAME = "root";
	const DB_CONNECTION_STRING = "mysql:host=127.0.0.1;dbname=workshopdb";
	

}