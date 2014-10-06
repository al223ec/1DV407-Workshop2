<?php

namespace core; 

abstract class Controller{

	protected $params; 

	public abstract function main(); 

	public function setParams($params){
		$this->params = $params; 
	}
	
	protected function redirectTo($controller = null, $action = null, $param = null){
		$path = ($controller !== null) ? $controller : \Config::DEFAULT_CONTROLLER;
		if($action !== null){
			$path .= '/' . $action;
			if($param !== null){
				$path.= '/' . $param;
			}
		}
		header('Location: ' . ROOT_PATH . $path);
		exit;
	}
}