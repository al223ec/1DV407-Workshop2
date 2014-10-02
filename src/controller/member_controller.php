<?php

namespace controller; 

require_once("src/controller/controller.php"); 
require_once("src/view/member_view.php"); 
 
require_once("src/view/member/member_list_view.php"); 
require_once("src/view/member/member_form_view.php"); 
require_once("src/model/member_model.php"); 

class MemberController extends Controller {

	private $memberModel; 
	private $memberView; 
	private $formView; 
	private $listView; 

	public function __construct(){
		$this->memberModel = new \model\MemberModel(); 
		$this->memberView = new \view\MemberView($this->memberModel); 
		$this->formView = new \view\member\MemberFormView($this->memberModel); 
		$this->listView = new \view\member\MemberListView($this->memberModel); 
	}

	public function main(){
		$listView = new \view\member\MemberListView($this->memberModel); 
		
		if($this->listView->shouldDispalyFullList()){
			return $this->listView->fullList();
		}
		return $this->listView->compactList(); 
	}

	public function add(){

		return $this->formView->add(); 
	}	

	public function create(){
		return "create"; 
	}

	public function delete(){
		return "delete"; 
	}

	public function edit(){
		//Samma som create??
		return "edit";  
	}

	public function save(){
		$un = $this->formView->getUserName(); 
		$ssn = $this->formView->getSsnPost();
		$this->memberModel->saveMember($un, $ssn); 

		//Spara sen redirect
		return "Du har tryckt på sparat, $un, $ssn"; 

	}

	public function view(){
		$member = $this->memberModel->getMemberById(intval($this->params[0])); 
		return $this->memberView->view($member);
	}

	public function setCompactList(){
		$this->listView->setDisplayCompactList(); 
		$this->listView->redirect(); 

	}
	public function setFullList(){
		$this->listView->setDisplayFullList();	
		$this->listView->redirect(); 
	}
}
