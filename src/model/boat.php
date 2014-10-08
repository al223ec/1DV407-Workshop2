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
			'type' => array(
				'rule1' => array('rule' => 'not_empty', 'message' => 'Boat type cannot be empty!'),
				'rule-characters' => array('rule' => 'alpha_num', 'message' => 'Only alpha-numerical chartacters allowed(a-z 0-9).'),
				'rule-min-length' => array('rule' => array('min_length', 2)),
				'rule-max-length' => array('rule' => array('max_length', 40))
			),
			'length' => array(
				'rule-is-int' => array('rule' => 'is_int', 'message' => 'Must be of type integer!'),
				'rule-noit-empty' => array('rule' => 'not_empty', 'message' => 'Length cannot be empty'),
				'rule-min' => array('rule' => array('min_value', 3)),
				'rule-max' => array('rule' => array('max_value', 20))
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
		$this->memberId = intval($i);
	}
	public function setType($s){
		$this->type = '' . $s;
	}
	public function setLength($i){
		$this->length = intval($i);
	}
}