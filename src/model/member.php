<?php

namespace model; 

class Validation {

	public static $max_length = "_max_length"; 
	
	private $errorMessages; 
	private $fields; 

	public function __construct(){
		$this->errorMessages = array();
		$this->fields = array();   
	}

	public function setFieldToValidate($field, $method, $arg, $message){
		//kontrollera om methoden redan är satt??
		$this->fields[$field][] = new ValidationMethod($method, $arg, $message); 
	}
	public function validate($that){
		foreach ($this->fields as $field => $validationMethods) {
			if(!method_exists($that,'get' . $field)){ 
				throw new \Exception("Validation::validate funktion get" . $field . " saknas");
			}

			$valueToValidate = call_user_func_array(array($that, 'get' . $field), array());
			
			foreach ($validationMethods as $validationMethod) {
				$method = $validationMethod->getMethod(); 

				if(!method_exists($this, $method)){ 
					throw new \Exception("Validation::validate Validation Saknar $method funktionene");
				}

				$result = $this->$method($valueToValidate, $validationMethod->getArg());
				$validationMethod->setValid($result);

				if(!$result){ 
					$this->errorMessages[$field][] = $validationMethod->getMessage(); 
				}
			}
		}
		
		return $this->isValid(); 
	}
	
	private function isValid(){
		foreach ($this->fields as $validationMethods) {
			foreach ($validationMethods as $validationMethod) {
				if(!$validationMethod->isValid()){
					return false; 
				}
			}
		}
		return true; 
	}

	public function getErrors(){
		return $this->errorMessages; 
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

class ValidationMethod {
	private $method; 
	private $arg;
	private $message;
	private $valid; 

	public function __construct($method, $arg = null, $message = "Ett error message"){
		$this->method = $method; 
		$this->arg = $arg; 
		$this->message = $message;  
	}

	public function getMethod(){
		return $this->method; 
	}

	public function getArg(){
		return $this->arg; 
	}

	public function getMessage(){
		return $this->message;
	}

	public function setValid($valid){
		$this->valid = $valid; 
	}
	public function isValid(){
		return $this->valid; 
	}
}


class Member extends \core\BaseObject {

	private static $nameMinLength = 3; 
	private static $nameMaxLength = 45; 
	private static $ssnMinLength = 10; 
	private static $ssnMaxLength = 12; 
	private static $validChars = "/\D/";

	private $id; 
	private $ssn = "111111111"; 
	private $name; 
	private $boats; 

	public function __construct($id = 0){
		if(!is_numeric($id)){
			throw new \Exception("Member::Construct id måste vara ett nummer");
		}

		$this->id = $id; 
		$this->setValidation();

		$val = new \model\Validation();
		$val->setFieldToValidate('ssn', '_max_length', self::$ssnMaxLength, "Error message max length");
		$val->setFieldToValidate('ssn', '_min_length', self::$ssnMinLength, "Error message min length");

		var_dump($val->validate($this));
		foreach ($val->getErrors() as $field => $errors) {
			foreach ($errors as $error) {
				echo "Fel på fältet $field " . $error;
			}
		}
		die(); 

	}
	
	private function setValidation(){
	
		$this->validation = array(
			'name' => array(
				array('not_empty', 'Namet får inte vara tomt.'),
				array(array('min_length', self::$nameMinLength), 'Namet måste vara minst '. self::$nameMinLength .' tecken.'),
				array(array('max_length', self::$nameMaxLength), 'Namnet får inte vara längre än  '. self::$nameMaxLength .' tecken')
			),
			'ssn' => array(
				array(array('regex', self::$validChars), 'Endast siffror är tillåtet'),
				array('not_empty', 'Ssn får inte vara tomt'),
				array(array('min_length', self::$ssnMinLength), 'Måste vara minst '. self::$ssnMinLength .' tecken.'),
				array(array('max_length', self::$ssnMaxLength), 'Får inte vara längre än  '. self::$ssnMaxLength .' tecekn')
			)
		);
	}

	public function setName($name){
		$this->name = $name; 
	}

	public function setSsn($ssn){
		$this->ssn = $ssn; 
	}

	public function setBoats($boats){
		$this->boats = $boats; 
	}

	public function getSsn(){
		return $this->ssn;
	}

	public function getName(){
		return $this->name; 
	}

	public function getBoats(){
		return $this->boats; 
	}

	public function getId(){
		return $this->id;
	}

	public function getNumberOfBoats(){
		return sizeof($this->boats);
	}

	public function __toString(){
		return $this->name . ' ssn: '. $this->ssn; 
	}
}
