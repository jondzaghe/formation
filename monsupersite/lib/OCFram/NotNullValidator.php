<?php
namespace OCFram;

class NotNullValidator extends Validator
{
  public function isValid($field)
  {
    return $field->value() != '';
  }
}