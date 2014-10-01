<?php 

require_once("./core/config/Configs.php"); 
require_once("./src/config/Config.php");

class Router{

	public static $route;

	private $controller;
	private $action;
	private $params;

	public function __construct(){
		self::initRoutes(); 

		$route = isset($_GET['url']) ? $_GET['url'] : '';

		$route = preg_replace(Configs::AllowedUrlChars, '', $route);
		$routeParts = explode('/', $route);
		//Se till att inte otillåtna tecken skickas med i urlen

		$this->controller = $routeParts[0];
		$this->action = isset($routeParts[1]) ? $routeParts[1] : Configs::DefaultAction;

		//Remove the first element from an array
		array_shift($routeParts);
		array_shift($routeParts);
		
		if($this->controller === ""){
			$this->controller = Configs::DefaultController; 
		}
		$this->params = $routeParts; 
		isset($_GET['url']) ? $_GET['url'] = "" : ""; 
	}

	public function getAction(){
		if (empty($this->action)){ 
			$this->action = Configs::DefaultAction;
		}    
		return $this->action;
	}  
	public function getController(){
		//Ser till att controller alltid stavas med först bokstaven kapital
		$this->controller = strtolower($this->controller); 
		$this->controller = ucfirst($this->controller); 

		if (empty($this->controller)){ 
			$this->controller = Configs::DefaultController;
		}  
	    return $this->controller . "Controller";
	} 
	
	public function getParams(){
	    return $this->params;  
	}


	public static function initRoutes(){
		self::$route = array(
			"Auth" => array(
				"login" =>  \config\Config::AppRoot . "Auth/login", 
				"logout" => \config\Config::AppRoot . "Auth/Logout"
				),
			"Registeruser" => array(
				"registerUser" => \config\Config::AppRoot . "Registeruser/",
				"saveNewUser" => \config\Config::AppRoot .  "Registeruser/SaveNewUser" 
				)
			); 
	} 
}