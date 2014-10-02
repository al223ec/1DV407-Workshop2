<?php 

namespace core; 

require_once("./core/config/configs.php"); 
require_once("./src/config/config.php");

class Router{

	public static $route;

	private $controller;
	private $action;
	private $params;

	public function __construct(){
		self::initRoutes(); 

		$route = isset($_GET['url']) ? $_GET['url'] : '';

		//Se till att inte otillåtna tecken skickas med i urlen
		$route = preg_replace(\Configs::AllowedUrlChars, '', $route);
		$routeParts = explode('/', $route);


		$this->controller = $routeParts[0];
		$this->action = isset($routeParts[1]) ? $routeParts[1] : \Configs::DefaultAction;

		//Remove the first element from an array
		array_shift($routeParts);
		array_shift($routeParts);
		
		if($this->controller === ""){
			$this->controller = \Configs::DefaultController; 
		}
		$this->params = $routeParts;
	}

	public function getAction(){
		if (empty($this->action)){ 
			$this->action = \Configs::DefaultAction;
		}    
		return $this->action;
	}  
	public function getController(){
		//Ser till att controller alltid stavas med små bokstäver
		$this->controller = strtolower($this->controller);

		if (empty($this->controller)){ 
			$this->controller = \Configs::DefaultController;
		}  
	    return $this->controller;
	} 
	
	public function getParams(){
	    return $this->params;  
	}


	public static function initRoutes(){
		self::$route = array(
			"member" => array(
				"main" =>  \config\Config::AppRoot . "member/", 
				"view" =>  \config\Config::AppRoot . "member/view/", 
				"edit" =>  \config\Config::AppRoot . "member/edit/",
				"delete" =>  \config\Config::AppRoot . "member/delete/",
				"save" =>  \config\Config::AppRoot . "member/save/",
				"add" =>  \config\Config::AppRoot . "member/add/",
				"setcompact" =>  \config\Config::AppRoot . "member/setCompactList/",
				"setfull" =>  \config\Config::AppRoot . "member/setFullList/",
				),
			"boat" => array(
				"main" =>  \config\Config::AppRoot . "boat/", 
				"view" =>  \config\Config::AppRoot . "boat/view/", 
				"edit" =>  \config\Config::AppRoot . "boat/edit/",
				"delete" =>  \config\Config::AppRoot . "boat/delete/",
				"save" =>  \config\Config::AppRoot . "boat/save/",
				"add" =>  \config\Config::AppRoot . "boat/add/",
				)
			); 
	}


	public function dispatch(){
		$controller = $this->getController();
		$action = $this->getAction();
		$params = $this->getParams();

		$controllerfile = "./src/controller/" . $controller . "_controller.php";
		$controller = "\\controller\\" . ucfirst($controller) . "Controller"; //Alltid stor första bokstav på objekt

		if (file_exists($controllerfile)){
			require_once($controllerfile);
			$app =  new $controller();
			$app->setParams($params);

			if(!method_exists($app, $action)){
				throw new \Exception("Controller $controller doesn't have $action funktion");  
			}
			return $app->$action();
		} else {
			throw new \Exception("Controller $controller not found");  
		}
	} 
}