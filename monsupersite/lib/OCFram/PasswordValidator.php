<?php
namespace OCFram;

class PasswordValidator extends Validator
{

	public function __construct($errorMessage){
		parent::__construct($errorMessage);
	}

	public function isValid($value){
		// var_dump($this->values);
		// exit;
		// if(){
		// 	return false;
		// }
		// else{
		// 	return true;
		// }
		return true;
	}

}