<?php

class HTMLView{
	public function echoHTML($body){
		if($body === NULL){
			throw new \Exception('HTMLView::echoHTML does not allow body to be null');
		}

		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="UTF-8">

				<link href="' . ROOT_PATH . 'css/bootstrap.min.css" rel="stylesheet" />
				<link href="' . ROOT_PATH . 'css/style.css" rel="stylesheet" />
				<title> Workshop 2 - Design </title>
			</head>
			<body>
				<div class="wrapper">
					<h1>Workshop 2 - Design</h1>
					' . $body . '
				</div>
			</body>
			</html>
		';
	}
}