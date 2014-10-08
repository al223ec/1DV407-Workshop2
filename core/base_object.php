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
		
		/** Prepare validation process, set up model and it's attributes. Might not be needed, try an refactor*/
		$this->_setup();
		
		/** run validation */
		$this->_validate();
		return $this->_valid;
	}

	/**
	*	Make sure that the attributes in validation are attributes in the class.
	*	Re-builds array of attributes and assigns validaton methods with their potential parameters and error messages.
	*	TODO: Try and get rid of this. If validation array has a more simple structure this could be done in _validate()
	*	@return void
	*/
	private function _setup(){
		/** loop throug attributes with rules in validation-array */
		foreach($this->validation as $field => $rules){
			/** make sure the attribute in validation array exists in model attributes */
			if(in_array($field, $this->attributes)){
				/** build array for validation based on rules */
				foreach($rules as $rule){
					/** Vissa regler kräver parameter tex max_length kräver en siffra*/
					$r = (is_array($rule['rule'])) ? $rule['rule'][0] : $rule['rule'];
					$p = (is_array($rule['rule'])) ? $rule['rule'][1] : null;
					$m = (isset($rule['message'])) ? $rule['message'] : null;
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
		/** Loop trough fields aka model attributes with validation rules */
		foreach($this->_fields as $field => $rules){
			
			/** Loop through each fields' set of rules */
			foreach($rules as $method => $options){
				/** get value from model attribute to validate */
				$value = call_user_func_array(array($this, 'get' . $field), array());
				/** Some validation methods need params, this prepares the function call for either*/
				$params = ($options['param'] !== null) ? array($value, $options['param'] ) : array($value);
				/** call validation function, save result */
				$result = call_user_func_array(array($this, '_' . $method), $params);
				
				/** If one validation failed, set the attribute to false and add error message */
				if(!$result){
					$this->_valid = false;
					/** Error Message can be passed as an option in validation array in the model, if it was not a generic one will be made */
					if($options['message'] !== null){
						$this->_errors[] = $option['message'];
					}
					else{
						$this->_errors[] = 'Model attribute "' . $field . '" with with value "' . $value . '" did not pass validation "' . $method . '"';
					}
				}
			}
		}
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

	private function _not_empty($var){
		return !empty($var);
	}

	private function _alpha_num($var){
		return !preg_match('/[^a-z0-9]/i', $var);
	}

	private function _regex($var, $regex){
		return !preg_match($regex, $var);
	}
	
	/**
	*	Integer validation methods
	*/
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