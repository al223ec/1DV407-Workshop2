<?php

namespace view; 

class View{
/*
	protected $model; 
	public function __construct($model){
		$this->model = $model; 
	}
*/
	protected function getInput($inputName){
		return isset($_POST[$inputName]) ? $_POST[$inputName] : "";
	}
	protected function getCleanInput($inputName) {
		return isset($_POST[$inputName]) ? $this->sanitize($_POST[$inputName]) : "";
	}
	protected function sanitize($input) {
        $temp = trim($input);
        return filter_var($temp, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }	

    public function redirect(){
		header("Location: " . \config\Config::AppRoot);
    }
}