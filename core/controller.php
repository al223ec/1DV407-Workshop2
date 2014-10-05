<?php

namespace core; 

abstract class Controller{

	protected $params; 

	public abstract function main(); 

	public function setParams($params){
		$this->params = $params; 
	}
	
	protected function redirectTo($controller = '', $action = ''){
		header('Location: ' . ROOT_PATH . $controller . '/' . $action);
		exit;
	}
}