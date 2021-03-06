<?php

namespace controller; 

class MemberController extends \core\Controller {

	private $isLoggedIn;

	private $memberModel; 
	private $boatModel; 
	private $memberView; 

	private $formView; 
	private $listView; 

	public function __construct(){
		$authController = new \controller\AuthController();
		$this->isLoggedIn = $authController->checkAuth();

		$this->memberModel = new \model\MemberModel(); 
		$this->boatModel = new \model\BoatModel();

		$this->memberView = new \view\MemberView($this->isLoggedIn); 
		$this->formView = new \view\member\MemberFormView();
		$this->listView = new \view\member\MemberListView($this->isLoggedIn); 
	}

	public function main(){
		$memberFilter = $this->listView->getMemberFilter();
		$members = $this->memberModel->getMembers($memberFilter);
		
		foreach ($members as $member){
			$member->setBoats($this->boatModel->getBoatsByMemberId($member->getId())); 
		}
		
		return $this->listView->getMemeberList($members);
	}

	public function add(){
		$this->beforeAction();
		return $this->formView->getAddEditForm(); 
	}	

	public function delete(){
		$this->beforeAction();
		$member = $this->memberModel->getMemberById(intval($this->params[0]));
		if($member !== null){
			return $this->memberView->confirmDelete($member); 
		}
		return $this->main(); 
	}

	public function confirmDelete(){
		$this->beforeAction();
		$member = $this->memberModel->getMemberById(intval($this->params[0]));
		if($member === null){
			return $this->main(); 
		}
		//TODO: Vyn ska sköta detta!
		if($this->memberModel->deleteMember(intval($this->params[0]))){
			if($this->boatModel->deleteBoatsByMemberId(intval($this->params[0]))){
				return $this->memberView->memberDeletedSuccessfully($member); 
			}
		}else{
			//Något gick fel detta sker endast om det blir något fel när medlemmen tas bort på db sidan mao väldigt osannolikt
			return $this->memberView->unknownError();  
		}

	}

	public function edit(){
		$this->beforeAction();
		return $this->formView->getAddEditForm($this->memberModel->getMemberById(intval($this->params[0])));
	}

	public function save(){
		$this->beforeAction();
		//Kanske separera på create och update
		$member = $this->formView->getMember(); 
		$successfull = $member !== null && $this->memberModel->saveMember($member);

		if($successfull){
			$this->redirectTo('member');
		}else{
			return $this->formView->getAddEditForm($this->memberModel->getMemberById($this->formView->getMemberId()));
		}
	}

	public function view(){
		$member = $this->memberModel->getMemberById(intval($this->params[0])); 
		if($member !== null){
			$member->setBoats($this->boatModel->getBoatsByMemberId($member->getId())); 
			return $this->memberView->view($member);
		}
		$this->redirectTo('member');
	}

	public function setCompactList(){
		$this->listView->setDisplayCompactList(); 
		$this->redirectTo('member');

	}
	public function setFullList(){
		$this->listView->setDisplayFullList();
		$this->redirectTo('member');
	}

	private function beforeAction(){
		if(!$this->isLoggedIn){
			$this->redirectTo('member', 'main');
		}
	}
}