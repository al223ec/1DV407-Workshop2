<?php

namespace model; 

class Member implements \model\Ivalidatable {

	public static $nameMinLength = 3; 
	public static $ssnMinLength = 10; 
	public static $ssnMaxLength = 12; 
	public static $validChars = "/\D/";

	private $id; 
	private $ssn; 
	private $name; 
	private $boats; 

	private $validSsn;
	private $validName;  

	public function __construct($id = 0){
		$this->validSsn = false;
		$this->validName = false;  

		$this->id = $id; 
	}

	public function setName($name){
		$name = trim($name); 
		$this->validName = strlen($name) > self::$nameMinLength; 
		$this->name = $name; 
	}

	public function setSsn($ssn){
		$ssn = preg_replace(self::$validChars, '', $ssn);
		$this->validSsn = strlen($ssn) >= self::$ssnMinLength && strlen($ssn) <= self::$ssnMaxLength; 
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

	public function isValid(){
		return $this->validSsn && $this->validName; 
	}

	public function validate(){
		$this->setName($this->name); 
		$this->setSsn($this->ssn);
		return $this->isValid(); 
	} 

	public function __toString(){
		return $this->name . ' ssn: '. $this->ssn; 
	}
}
