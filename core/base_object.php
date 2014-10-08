<?php

namespace core;

class BaseObject{
	
	private $_valid = true;
	private $_model;
	private $_fields;
	private $_errors;
	protected $validation = array();
	
	/**
	*	@return array error messages 
	*/
	public function getErrors(){
		return $this->_errors;
	}
	
	/**
	*	Runs validation process to check if object validates to rules specified in child class in  $validation variable
	*	@return bool validates model object/entity
	*/
	public function valid(){
		/** If no rules are specified validation is always true*/
		if(!is_array($this->validation) || empty($this->validation)){
			return true;
		} 
		/** Prepare validation process, set up model and it's attributes. Might not be needed*/
		//$this->setup();
		$this->_validate();
		return $this->_valid;
	}
}