<?php

namespace model; 

class Member extends \core\BaseObject {

	private static $nameMinLength = 3; 
	private static $nameMaxLength = 45; 
	private static $ssnMinLength = 10; 
	private static $ssnMaxLength = 12; 
	private static $validChars = "/\D/";

	private $id; 
	private $ssn; 
	private $name; 
	private $boats; 

	public function __construct($id = 0){
		if(!is_numeric($id)){
			throw new \Exception("Member::Construct id måste vara ett nummer");
		}
		$this->id = $id; 
		$this->setValidation();
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
