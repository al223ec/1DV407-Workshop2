<?php

namespace core;

class BaseObject{
	
	private $_valid = true;
	private $_fields = array();
	private $_errors = array();
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
		/** run validation */
		$this->_validate();
		return $this->_valid;
	}

	/**
	*	Runs all vlaidation methods assigned to the attributes by setup
	*	@return void
	*/
	private function _validate(){
		foreach($this->validation as $field => $rules){
			foreach($rules as $rule){
				/**
				*	Use the models get-method for this field to get its value
				*	@example field "username" runs $this->getUsername()
				*/
				$value = call_user_func_array(array($this, 'get' . $field), array());
				
				/**
				*	First post in a rule is the validation method, either as string or as array with string and paramter
				*	@example 'not_empty' | array('min_value', 5)
				*/
				if(is_array($rule[0])){
					$method = '_' . $rule[0][0];
					$params = array($value, $rule[0][1]);
				}
				else{
					$method = '_' . $rule[0];
					$params = array($value);
				}
				$result = call_user_func_array(array($this, $method), $params);
				
				if(!$result){
					$this->_valid = false;
					if(isset($rule[1])){
						$this->_errors[] = $rule[1];
					}
					else{
						$this->_errors[] = 'Model attribute:"' . $field . '" with with value:"' . $value . '" did not pass validation "' . $method  . (isset($params[1]) ? '(' . $params[1] . ')' : '');
					}
				}
			}
		}
	}


	/**
	*	Generic validation methods
	*/
	private function _not_empty($var){
		return !empty($var);
	}
	private function _regex($var, $regex){
		return !preg_match($regex, $var);
	}
	
	/**
	*	String validation methods
	*/
	private function _is_string($var){
		return is_string($var);
	}
	private function _min_length($var, $min){
		return (is_string($var) && strlen($var) >= $min);
	}
	private function _max_length($var, $max){
		return (is_string($var) && strlen($var) <= $max);
	}
	private function _alpha_num($var){
		return !preg_match('/[^a-z0-9]/i', $var);
	}
	
	/**
	*	Numeric validation methods
	*/
	private function _is_numeric($var){
		return is_numeric($var);
	}
	private function _is_int($var){
		return is_int($var);
	}
	private function _max_value($var, $max){
		return (is_numeric($var) && $var <= $max);
	}
	private function _min_value($var, $min){
		return (is_numeric($var) && $var >= $min);
	}
}