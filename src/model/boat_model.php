<?php

namespace model;

class BoatModel{
	
	private $boatRepository;
	private $memberModel;
	
	public function __construct(){
		$this->boatRepository = new \model\repository\BoatRepository();
		$this->memberModel = new \model\memberModel();
	}
	
	public function getBoatById($id){
		return $this->boatRepository->getBoatById($id);
	}
	
	public function getOwner($id){
		return $this->memberModel->getMemberById($id);
	}
	
	public function create($memberId, $type, $length){
		try{
			$this->validateMemberId($memberId);
			$this->validateType($type);
			$this->validateLength($length);
		}
		catch(\Exception $e){
			return false;
		}
		return $this->boatRepository->create($memberId, $type, $length);
	}
	
	public function save($boat){
		try{
			$this->validateMemberId($boat->getMemberId());
			$this->validateType($boat->getType());
			$this->validateLength($boat->getLength());
		}
		catch(\Exception $e){
			var_dump($e);
			exit;
			return false;
		}
		return $this->boatRepository->save($boat);
	}
	
	public function delete($id){
		return $this->boatRepository->delete($id);
	}
	
	/**
	*	Member Id is the foreign key for boats that indicates a members ownership
	*	Declare rules for validation.
	*	Is integer, > 0, ?, ?
	*	@return void
	*	@throws Exception
	*/
	private function validateMemberId($memberId){
		if(empty($memberId) || !is_int($memberId) || $memberId < 1){
			throw new \Exception('MemberId must be integer greater than 0');
		}
	}
	
	/**
	*	Not empty, length between 1-39 characters, ?, ?
	*	@return void
	*	@throws Exception
	*/
	private function validateType($type){
		if(empty($type) || strlen($type) < 1 || strlen($type) >= 40){
			throw new \Exception('Type must be string with length 1-40');
		}
	}
	
	/**
	*	Is integer, > 0, ?, ?
	*	@return void
	*	@throws Exception
	*/
	private function validateLength($length){
		if(empty($length) || !is_int($length) || $length < 1){
			throw new \Exception('Length must be integer greater than 0');
		}
	}
}