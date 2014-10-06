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

	/*
	public static function initRoutes(){
		self::$route = array(
			'member' => array(
				'main' =>  \config\Config::AppRoot . 'member/', 
				'view' =>  \config\Config::AppRoot . 'member/view/', 
				'edit' =>  \config\Config::AppRoot . 'member/edit/',
				'delete' =>  \config\Config::AppRoot . 'member/delete/',
				'save' =>  \config\Config::AppRoot . 'member/save/',
				'add' =>  \config\Config::AppRoot . 'member/add/',
				'setcompact' =>  \config\Config::AppRoot . 'member/setCompactList/',
				'setfull' =>  \config\Config::AppRoot . 'member/setFullList/',
				),
			'boat' => array(
				'main' =>  \config\Config::AppRoot . 'boat/', 
				'view' =>  \config\Config::AppRoot . 'boat/view/', 
				'edit' =>  \config\Config::AppRoot . 'boat/edit/',
				'delete' =>  \config\Config::AppRoot . 'boat/delete/',
				'save' =>  \config\Config::AppRoot . 'boat/save/',
				'add' =>  \config\Config::AppRoot . 'boat/add/',
				)
			);
	}
	*/

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

function AutoLoadClasses($class){
	$class = ltrim($class, '\\');
	
	
	$classFile = lcfirst(substr($class, strripos($class, '\\') + 1));
	preg_match_all( '/[A-Z]/', $classFile, $matches, PREG_OFFSET_CAPTURE );
	if(!empty($matches)){
		for($i=0; $i < count($matches[0]); $i++){
			if(!empty($matches[0][$i])){
				$m = $matches[0][$i];
				$classFile = substr_replace($classFile, '_' . strToLower($m[0]), $m[1] + $i, 1);
			}
		}
	}
	
	$fileDir = explode('\\', $class, -1);
	$fileDir = strToLower(implode(DS, $fileDir));
	
	$filePath = SRC_DIR . $fileDir . DS . $classFile . '.php';
	if(!file_exists($filePath)){
		return false;
	}
	require_once($filePath);
}

spl_autoload_register('core\AutoLoadClasses');