<?php

namespace model; 

class Boat extends \core\BaseObject{
	private $id; 
	private $memberId; 
	private $type; 
	private $length;
	
	/** dafuq is dis? */
	public $var; 

	
	public $attributes = array('id', 'member_id', 'type', 'length');
	
	public function __construct($id, $memberId, $type, $length){
		$this->id = intval($id);
		$this->memberId = intval($memberId);
		$this->type = $type; 
		$this->length = intval($length); 
		
		$this->setValidation();
	}
	
	private function setValidation(){
		$this->validation = array(
			'memberId' => array(
				array('not_empty'),
				array('is_int'),
				array(array('min_value', 0)),
			),
			'type' => array(
				array('not_empty', 'Not empty message.'),
				array('alpha_num'),
				array(array('min_length', 2), 'Måste vara minst 2 tecken.'),
				array(array('max_length', 20)),
			),
			'length' => array(
				array('is_int'),
				array('not_empty', 'får inte vara tom'),
				array(array('min_value', 3)),
				array(array('max_value', 20), 'inte båtar längre än 20 meter plix.'),
			)
		);
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
		$this->memberId = $i;
	}
	public function setType($s){
		$this->type = $s;
	}
	public function setLength($i){
		$this->length = $i;
	}
}