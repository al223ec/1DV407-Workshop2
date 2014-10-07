<?php

namespace model\repository;

class BoatRepository extends \core\Repository{
	
	private $columns;
	
	public function __construct(){
		$this->table = 'boat';
		$this->columns = array(
			'id',
			'member_id',
			'type',
			'length'
		);
	}
	
	public function getBoatById($id){
		$result = $this->findBy('id', $id);
		if($result !== null){
			return new \model\Boat($result[$this->columns[0]], $result[$this->columns[1]], $result[$this->columns[2]], $result[$this->columns[3]]);
		}
		return null;
	}
	
	public function create($memberId, $type, $length){
		$sql = "
			INSERT INTO " . $this->table . "(" . $this->columns[1] . ", " . $this->columns[2] . ", " . $this->columns[3] . ")
			VALUES (:memberId, :type, :length)
		";
		$params = array(':memberId' => $memberId, ':type' => $type, ':length' => $length);
		return $this->query($sql, $params, true);
	}
	
	public function save($boat){
		$sql = "
			UPDATE " . $this->table . "
			SET " . $this->columns[2] . " = :type, " . $this->columns[3] . " = :length
			WHERE " . $this->table . ".id = :id
		";
		$params = array(':type' => $boat->getType(), ':length' => $boat->getLength(), ':id' => $boat->getId());
		return $this->query($sql, $params, true);
	}
	
	public function delete($id){
		$sql = "
			DELETE FROM " . $this->table . "
			WHERE " . $this->table . ".id = :id
		";
		$params = array(':id' => $id);
		return $this->query($sql, $params, true);
	}
}