<?php
namespace Entity;

use \OCFram\Entity;

class Users extends Entity{

	protected 	$fuc_id,
				$fuc_nom,
				$fuc_prenom,
				$fuc_mdp,
				$fuc_mail,
				$passwordConfirmation,
				$fuc_fk_type;

	const TYPE_ADMIN = 1; // ID DU TYPE ADMIN
	const TYPE_ECRIVAIN = 2; // ID DU TYPE ECRIVAIN


	/**
	 * GETTER $fuc_id
	 * @return int
	 */
	public function fucId(){
		return $this->fuc_id;
	}


	/**
	 * GETTER $fuc_nom
	 * @return String
	 */
	public function fucLastname(){
		return $this->fuc_nom;
	}

	/**
	 * GETTER $fuc_prenom
	 * @return String
	 */
	public function fucFirstName(){
		return $this->fuc_prenom;
	}

	public function fucType(){
		return $this->fuc_fk_type;
	}

	public function fucPassword(){
		return $this->fuc_mdp;
	}

	public function fucMail(){
		return $this->fuc_mail;
	}


	public function passwordConfirmation(){
		return $this->passwordConfirmation;
	}


	public function setId($id){
		$this->fuc_id = $id;
	}

	public function setLastname($nom){
		$this->fuc_nom = $nom;
	}


	public function setFirstname($prenom){
		$this->fuc_prenom = $prenom;
	}


	public function setType($type){
		$this->fuc_fk_type = $type;
	}

	public function setPassword($mdp){
		$this->fuc_mdp = $mdp;
	}

	public function setMail($mail){
		$this->fuc_mail = $mail;
	}

	public function setpasswordConfirmation($password){
		$this->passwordConfirmation = $password;
	}

	public function getUrlName(){

		return str_replace(" ", "-", $this->fuc_nom. " ".$this->fuc_prenom);
	}


	public function passwordCrypting(){
  		$this->fuc_mdp = crypt($this->fuc_mdp, '$2a$09$mytestsaltforprotectingpassword$');
  }

}