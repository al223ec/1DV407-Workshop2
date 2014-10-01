<?php

namespace model; 

class Member{
	private $id; 
	private $ssn; 
	private $name; 
	private $boats; 

	public function __construct($id, $name, array $boats){
		$this->id = $id; 
		$this->name = $name; 
		$this->boats = $boats; 
	}

	public function getBoatString(){
		$ret = ""; 

		foreach ($this->boats as $key => $value) {
			$ret .= $value . "\n"; 
		}

		return $ret; 
	}

	public function __toString(){
		return $this->name; 

	}

}
