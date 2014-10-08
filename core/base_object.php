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
		//$this->_setup();
		$this->_validate();
		return $this->_valid;
	}

	/**
	*	Make sure that the attributes in validation are attributes in the class.
	*	Re-builds array of attributes and assigns validaton methods with their potential parameters and error messages
	*	@return void
	*/
	private function _setup(){
		/** loop throug attributes with rules in validation-array */
		foreach($this->validation as $field => $rules){
			/** make sure the attribute in validation array exists in model attributes */
			if(in_array($field, $attributes)){
				/** build array for validation based on rules */
				foreach($rules as $rule){
					/** Vissa regler kräver parameter tex max_length kräver en siffra*/
					$r = (is_array($rule['rule'])) ? $rule['rule'][0] : $rule['rule'];
					$p = (is_array($rule['rule'])) ? $rule['rule'][1] : null;
					$m = (isset($rule['message'])) ? $rule['message'] : '';
					$this->_fields[$field][$r] = array('param' => $p, 'message' => $m);
				}
			}
			else{
				/** Attributet finns inte men det finns en regel för attributet*/
			}
		}
	}

	/**
	*	Runs all vlaidation methods assigned to the attributes by setup
	*	@return void
	*/
	private function _validate(){

	}

	private function _is_int($var){
		return is_int($var);
	}

	private function _is_string($var){
		return is_string($var);
	}

	private function _min_length($var, $min){
		return (is_string($var) && strlen($var) >= $min);
	}

	private function _max_length($var, $max){
		return (is_string($var) && strlen($var) <= $max);
	}

	private function _not_empty($var){
		return empty($var);
	}

	private function _alpha_num($var){
		if(preg_match('/^[a-z0-9]/i', $var) > 0){
			return false;
		}
		return true;
	}

	private function _regex($var, $regex){
		if(preg_match($regex, $var) > 0){
			return false;
		}
		return true;
	}
}