<?php
namespace OCFram;

class PasswordValidator extends Validator
{
	protected $form;
	protected $fieldName;

	public function __construct($errorMessage, $form, $fieldName){
		parent::__construct($errorMessage);
		$this->form = $form;
		$this->fieldName = $fieldName;
	}

	public function isValid($value){
		// var_dump($this->form->field()[2]->value());
		// var_dump($value);
		// exit;
		foreach($this->form->field() as $field){
			if($field->value() == $value  && $field->name() != $this->fieldName){
				return true;
			}
		}

		return false;
	}
}