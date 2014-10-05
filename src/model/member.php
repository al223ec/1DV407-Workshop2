<?php

namespace model; 

class Member{
	private $id; 
	private $ssn = 123124241; 
	private $name; 
	private $boats; 

	public function __construct($id, $name, $ssn, array $boats){
		$this->id = $id; 
		$this->name = $name; 
		$this->boats = $boats; 
		$this->ssn = $ssn; 
	}

	public function getBoats(){
		//Tror att detta inte innebär en privacy leak, arrayer hantares ej via refrens
		return $this->boats; 
	}

	public function __toString(){
		return $this->name . ' ssn: '. $this->ssn; 

	}

	public function getId(){
		return $this->id;
	}

	public function getNumberOfBoats(){
		return sizeof($this->boats);
	}

	public function setName($name){
		$this->name = $name; 
	}

	public function getSsn(){
		return $this->ssn;
	}
}
