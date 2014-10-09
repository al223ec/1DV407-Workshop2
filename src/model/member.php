<?php

namespace model; 

class Member extends \core\BaseObject {

	private static $nameMinLength = 3; 
	private static $ssnMinLength = 10; 
	private static $ssnMaxLength = 12; 
	private static $validChars = "/\D/";

	private $id; 
	private $ssn; 
	private $name; 
	private $boats; 

	public function __construct($id = 0){
		$this->errors = array(); 

		$this->id = $id; 
		$this->setValidation();
	}
	
	private function setValidation(){
		$this->validation = array(
			'name' => array(
				array('not_empty', 'Not empty message.'),
				array(array('min_length', 2), 'Måste vara minst 2 tecken.'),
				array(array('max_length', 20))
			),
			'ssn' => array(
				array(array('regex', "/\D/")),
				array('not_empty', 'får inte vara tom'),
				array(array('min_length', self::$ssnMinLength), 'Måste vara minst 10 tecken.'),
				array(array('max_length', self::$ssnMaxLength), 'Får inte vara längre än 12 tecekn')
			)
		);
	}

	private function setId($id){

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
