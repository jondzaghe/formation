<?php
namespace OCFram;


class Crypt{
	public static function crypt($password, $salt){
		$salt = str_replace(array('$', '.', '/'), '', $salt);

		$salt = '$2a$07$'.$salt.'DreamCenturyEntertaiment';

		// var_dump($this->fuc_salt);
		// var_dump($salt);
		// exit;

  		return crypt($password, $salt);
	}
}