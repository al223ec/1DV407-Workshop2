<?php

namespace model; 

class Boat{
	private $id; 
	private $memberId; 
	private $type; 
	private $length; 

	public function __construct($type, $memberId, $id = 0){
		$this->type = $type; 
	}

	public function __toString(){
		return $this->type; 
	}
}