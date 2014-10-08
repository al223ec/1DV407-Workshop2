<?php

namespace controller; 

class BoatController extends \core\Controller {
	
	private $boatModel;
	private $boatView;
	
	public function __construct(){
		$this->boatModel = new \model\BoatModel();
		$this->boatView = new \view\BoatView($this->boatModel);
	}
	
	public function main(){
		return 'main';
	}

	//public function add($memberId = 0){
	public function add(){
		//$memberId = ($memberId !== 0) ? $memberId : intval($this->params[0]);
		$memberId = intval($this->params[0]);
		return $this->boatView->add($memberId); 
	}	

	public function create(){
		$memberId = $this->boatView->getMemberId();
		$type = $this->boatView->getType();
		$length = $this->boatView->getLength();
		$newBoat = new \model\Boat($memberId, $type, $length);
		if($newBoat->valid()){
			$this->boatModel->create($newBoat);
			//$this->boatView->addMessage('Success! Boat added to member X');
			$this->redirectTo('member', 'view', $memberId);
		}
		
		foreach($newBoat->getErrors() as $error){
			//$this->boatView->addMessage($error);
		}
		$this->redirectTo('boat', 'add', $memberId);
	}

	public function delete(){
		$id = $this->params[0];
		$boat = $this->boatModel->getBoatById($id);
		try{
			$this->boatModel->delete($id);
			$this->redirectTo('member', 'view', $boat->getMemberId());
		}
		catch(\Exception $e){
			var_dump($e);
			exit;
		}
	}

	public function edit(){
		return $this->boatView->edit($this->params[0]);
	}

	public function save(){
		$id = $this->boatView->getId();
		$boat = $this->boatModel->getBoatById($id);
		$boat->setType($this->boatView->getType());
		$boat->setLength($this->boatView->getLength());
		
		if($boat->valid()){
			$this->boatModel->save($boat);
			//$this->boatView->addMessage('Success! Boat added to member X');
			$this->redirectTo('member', 'view', $boat->getMemberId());
		}
		foreach($boat->getErrors() as $error){
			//$this->boatView->addMessage($error);
		}
		$this->redirectTo('boat', 'edit', $id);
	}
	
	public function view(){
		$id = $this->params[0];
		$boat = $this->boatModel->getBoatById($id);
		if($boat->valid()){
			var_dump('valid båt!');
		}
		else{
			var_dump($boat->getErrors());
		}
		exit;
	}
}