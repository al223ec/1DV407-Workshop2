<?php
namespace controller;

class AuthController extends \core\Controller{
	private $view;
	private $model;
	
	public function __construct(){
		$this->model = new \model\AuthModel();
		$this->view = new \view\AuthView($this->model);
	}
	
	public function main(){
		return $this->login();
	}

	public function login(){
		return $this->view->login($this->model->getError());
	}

	public function signOut(){
		$this->model->signOut();
		$this->redirectTo('member', 'main');
	}
	
	public function auth(){
		$username = $this->view->getUsernamePost();
		$password = $this->view->getPasswordPost();
		if($this->model->auth($username, $password)){
			$this->redirectTo('member', 'main');
		}
		$this->redirectTo('auth', 'login');
	}

	public function checkAuth(){
		return $this->model->checkAuth();
	}
}