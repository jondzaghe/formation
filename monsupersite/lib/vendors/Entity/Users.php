<?php
namespace Entity;

use \OCFram\Entity;

class Users extends Entity{

	protected 	$fuc_id,
				$fuc_nom,
				$fuc_prenom,
				$fuc_mdp,
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
	public function fucNom(){
		return $this->fuc_nom;
	}

	/**
	 * GETTER $fuc_prenom
	 * @return String
	 */
	public function fucPrenom(){
		return $this->fuc_prenom;
	}

	public function fucType(){
		return $this->fuc_fk_type;
	}

	public function fucMdp(){
		return $this->fuc_mdp;
	}


	public function setId($id){
		$this->fuc_id = $id;
	}

	public function setNom($nom){
		$this->fuc_nom = $nom;
	}


	public function setPrenom($prenom){
		$this->fuc_prenom = $prenom;
	}


	public function setType($type){
		$this->fuc_fk_type = $type;
	}

	public function setMdp($mdp){
		$this->fuc_mdp = $mdp;
	}

}