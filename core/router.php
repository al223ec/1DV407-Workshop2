<?php 

namespace core; 

class Router{

	//public static $route;

	private $controller;
	private $action;
	private $params;

	public function __construct(){
		//self::initRoutes(); 

		$route = isset($_GET['url']) ? $_GET['url'] : '';

		//Se till att inte otillåtna tecken skickas med i urlen
		$route = preg_replace(\Config::ALLOWED_URL_CHARS, '', $route);
		$routeParts = explode('/', $route);


		$this->controller = $routeParts[0];
		$this->action = isset($routeParts[1]) ? $routeParts[1] : \Config::DEFAULT_ACTION;

		//Remove the first element from an array
		array_shift($routeParts);
		array_shift($routeParts);
		
		if($this->controller === ''){
			$this->controller = \Config::DEFAULT_CONTROLLER; 
		}
		$this->params = $routeParts;
	}

	public function getAction(){
		if (empty($this->action)){ 
			$this->action = \Config::DEFAULT_ACTION;
		}    
		return $this->action;
	}  
	public function getController(){
		//Ser till att controller alltid stavas med små bokstäver
		$this->controller = strtolower($this->controller);

		if (empty($this->controller)){ 
			$this->controller = \Config::DEFAULT_CONTROLLER;
		}  
	    return $this->controller;
	} 
	
	public function getParams(){
	    return $this->params;  
	}

	public function dispatch(){
		$controller = $this->getController();
		$action = $this->getAction();
		$params = $this->getParams();

		$controllerfile = CONTROLLER_DIR . $controller . '_controller.php';
		$controller = '\\controller\\' . ucfirst($controller) . 'Controller'; //Alltid stor första bokstav på objekt

		if (file_exists($controllerfile)){
			require_once($controllerfile);
			$app =  new $controller();
			$app->setParams($params);

			if(!method_exists($app, $action)){
				throw new \Exception('Controller ' . $controller . ' does not have ' . $action . ' function');  
			}
			return $app->$action();
		} else {
			throw new \Exception('Controller ' . $controller . ' not found');  
		}
	} 
}