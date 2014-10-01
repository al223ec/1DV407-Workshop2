<?php

namespace controller; 

require_once("src/controller/controller.php"); 
require_once("src/view/member_view.php"); 
require_once("src/model/member_model.php"); 

class MemberController extends Controller {

	private $memberModel; 
	private $memberView; 

	public function __construct(){
		$this->memberModel = new \model\MemberModel(); 
		$this->memberView = new \view\MemberView($this->memberModel); 
	}

	public function main(){
		if($this->memberView->shouldDispalyFullList()){
			//return fulla listan
			return $this->memberView->fullList();
		}

		return $this->memberView->compactList(); 

		//return "<a href='" . \core\router::$route["member"]["view"]  . "'> alla medlemmar</a>"; 
	}

	public function add(){

		return $this->memberView->add(); 
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
		$un = $this->memberView->getUserName(); 
		$ssn = $this->memberView->getSsnPost();

		//Spara sen redirect
		return "Du har tryckt på sparat, $un, $ssn"; 

	}

	public function view(){
		$member = $this->memberModel->getMemberById(intval($this->params[0])); 
		return $this->memberView->view($member);
	}
}
