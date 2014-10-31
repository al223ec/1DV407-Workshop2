<?php
namespace model;

class AuthModel extends \core\Model{
	private $sessionAuthKey = 'auth';
	public function auth($username, $password){
		if($username === 'admin' && $password === 'password'){
			$this->setAuthSession();
			return true;
		}
		return false;
	}
	
	private function setAuthSession(){
		$_SESSION[$this->sessionAuthKey] = true;
	}
	
	public function signOut(){
		unset($_SESSION[$this->sessionAuthKey]);
	}
}