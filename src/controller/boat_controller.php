<?php

namespace controller; 
require_once("src/controller/controller.php");
class BoatController extends Controller {

	public function main(){
		return "boat"; 
	}

	public function add(){
				return "boat add"; 
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
		return "Du har tryckt på sparat, $un, $ssn"; 

	}

	public function view(){
		return "boatview"; 
	}
}