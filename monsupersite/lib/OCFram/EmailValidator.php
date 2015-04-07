<?php
namespace OCFram;

class EmailValidator extends Validator
{
  public function isValid($field){
  		return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $field->value());
  }
}