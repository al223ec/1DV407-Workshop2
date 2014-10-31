<?php

namespace controller; 

class BoatController extends \core\Controller {
	
	private $boatModel;
	private $boatView;
	
	private $isLoggedIn;

	public function __construct(){
		$authController = new \controller\AuthController();
		$this->isLoggedIn = $authController->checkAuth();

		$this->boatModel = new \model\BoatModel();
		$this->boatView = new \view\BoatView($this->boatModel);
	}
	
	public function main(){
		return 'main';
	}

	public function add(){
		$this->beforeAction();
		$memberId = intval($this->params[0]);
		return $this->boatView->add($memberId); 
	}	

	public function create(){
		$this->beforeAction();
		$boat = $this->boatView->getBoatFromPost();
		if($boat !== null && $this->boatModel->create($boat)){
			$this->redirectTo('member', 'view', $boat->getMemberId());
		}
		$this->redirectTo('boat', 'add', $this->boatView->getMemberId());
	}

	public function delete(){
		$this->beforeAction();
		$id = $this->params[0];
		$boat = $this->boatModel->getBoatById($id);
		if($boat !== null){
			return $this->boatView->delete($boat);
		}
		$this->redirectTo('member');
	}

	public function confirmDelete(){
		$this->beforeAction();
		$id = $this->params[0];
		$boat = $this->boatModel->getBoatById($id);
		if($boat !== null && $this->boatModel->delete($boat)){
			$this->redirectTo('member', 'view', $boat->getMemberId());
		}
		$this->redirectTo('member');
	}

	public function edit(){
		$this->beforeAction();
		return $this->boatView->edit($this->params[0]);
	}

	public function save(){
		$this->beforeAction();
		$boat = $this->boatView->getBoatFromPost();
		if($boat !== null && $this->boatModel->save($boat)){
			$this->redirectTo('member', 'view', $boat->getMemberId());
		}
		$this->redirectTo('boat', 'edit', $this->boatView->getId());
	}

	private function beforeAction(){
		if(!$this->isLoggedIn){
			$this->redirectTo('member', 'main');
		}
	}
}