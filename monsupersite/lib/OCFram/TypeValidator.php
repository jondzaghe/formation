<?php
namespace OCFram;

class TypeValidator extends Validator
{
	protected $types;

	public function __construct($errorMessage, $types){
		parent::__construct($errorMessage);
		$this->types = $types;
	}

	public function isValid($value){
		foreach($this->types as $type){
			if($type['value'] == $value){
				return true;
			}
		}

		return false;
	}

}