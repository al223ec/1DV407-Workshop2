<?php
abstract class Config{

	const DEFAULT_CONTROLLER = "member";
	const DEFAULT_ACTION = "main"; 
	const ALLOWED_URL_CHARS = "/[^A-z0-9\/\^]/"; 
	const DEBUG = true;
	const ERROR_LOG = "myerrors.log"; 
	
	const DB_PASSWORD = "";
	const DB_USERNAME = "root";
	const DB_CONNECTION_STRING = "mysql:host=127.0.0.1;dbname=workshopdb";
	
}