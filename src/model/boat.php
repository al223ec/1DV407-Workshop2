<?php

namespace model; 

class Boat{
	private $id; 
	private $memberId; 
	private $type; 
	private $length; 
	public $var; 

	public function __construct($id, $memberId, $type, $length){
		$this->id = intval($id);
		$this->memberId = intval($memberId);
		$this->type = $type; 
		$this->length = intval($length); 
	}

	public function __toString(){
		return $this->type; 
	}
	
	
	public function getId(){
		return $this->id; 
	}
	public function getMemberId(){
		return $this->memberId; 
	}
	public function getType(){
		return $this->type; 
	}
	public function getLength(){
		return $this->length; 
	}
	
	public function setMemberId($i){
		$this->memberId = intval($i);
	}
	public function setType($s){
		$this->type = '' . $s;
	}
	public function setLength($i){
		$this->length = intval($i);
	}
}