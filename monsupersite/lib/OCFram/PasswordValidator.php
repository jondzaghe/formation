<?php
namespace OCFram;

class PasswordValidator extends Validator
{
	protected $entity;

	public function __construct($errorMessage, $entity){
		parent::__construct($errorMessage);
		$this->entity = $entity;
	}

	public function isValid($value){
		if($this->entity->fucPassword() != $this->entity->passwordConfirmation()){
			return false;
		}
		else{
			return true;
		}
	}

}