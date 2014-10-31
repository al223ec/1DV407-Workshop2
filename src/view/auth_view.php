<?php
namespace view;

class AuthView extends \core\View{
	private $usernameKey = 'AuthView::username';
	private $passwordKey = 'AuthView::password';

	public function getUsernamePost(){
		return (isset($_POST[$this->usernameKey])) ? $_POST[$this->usernameKey] : '';
	}

	public function getPasswordPost(){
		return (isset($_POST[$this->passwordKey])) ? $_POST[$this->passwordKey] : '';
	}

	public function login($error){
		$errorMessage = ($error !== null) ? $error : '';
		return '
			<div>
				' . $errorMessage . '
			</div>
			<form method="post" action="' . \Routes::getRoute('auth', 'auth') . '">
				<label>username</label>
				<input type="text" name="' . $this->usernameKey . '" id="' . $this->usernameKey . '" />
				<label>username</label>
				<input type="text" name="' . $this->passwordKey . '" id="' . $this->passwordKey . '" />
				<input type="submit" />
			</form>
		';
	}
}