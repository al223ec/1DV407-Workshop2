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
		try{
			$this->boatModel->create($memberId, $type, $length);
			//$this->boatView->addMessage('Success! Boat added to member X');
			$this->redirectTo('member', 'view', $memberId);
		}
		catch(\Exception $e){
			var_dump($e);
			exit;
			//$this->boatView->addMessage($e->getMessage());
		}
		//return $this->add($memberId);
		//return $this->boatview->add($memberId);
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
		try{
			$this->boatModel->save($boat);
			//$this->boatView->addMessage('Success! Boat added to member X');
			$this->redirectTo('member', 'view', $boat->getMemberId());
		}
		catch(\Exception $e){
			var_dump($e);
			exit;
			//$this->boatView->addMessage($e->getMessage());
		}
		$this->redirectTo('boat', 'edit', $id);
	}
	
	public function view(){
		$id = $this->params[0];
		$boat = $this->boatModel->getBoatById($id);
		$boat->setLength('asd');
		if($boat->valid()){
			var_dump('valid båt!');
		}
		else{
			var_dump($boat->getErrors());
		}
		exit;
	}
}