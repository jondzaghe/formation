<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Users;

abstract class UsersManager extends Manager{


	/**
	 * RECUPERE UN MEMEBRE A PARTIR DE SONL LOGIN ET DE SON MDP
	 * @param  STRING $login [description]
	 * @param  STRING $mdp   [description]
	 * @return users        [description]
	 */
	abstract public function getUser($login);


	/**
	 * GET BACK A User FROM ITS ID
	 * @param  [int] $id [User id]
	 * @return [type]        [description]
	 */
	abstract public function getUserId($id);

	/**
	 * RECUPERE LA LISTE DES ECRIVAINS
	 * @return [type] [description]
	 */
	abstract public function getlisteEcrivain();


	/**
	 * GET THE ADMIN'S LIST
	 * @return [Users] [List of users]
	 */
	abstract public function getAdmin_a();


	/**
	 * DELETE ON USER
	 * @param  [int] $id [User id]
	 * @return [type]     [description]
	 */
	abstract public function delete($id);


	/**
	 * GET ALL USER TYPE
	 * @return [ARRAY] [LIST OF TYPE]
	 */
  	abstract public function getType_a();

  	/**
  	 * Add a user in the db
  	 * @param [Users] $user The user to add
  	 */
  	abstract public function add($user);
  	
  	/**
  	 * Updat a user in the db
  	 * @param  [Users] $user [description]
  	 */
  	abstract public function update($user);

/**
   * Méthode permettant d'enregistrer un user.
   * @param $user Users à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Users $user){
  	if($user->isNew()){
    	$this->add($user);
  	}
  	else{
  		$this->update($user);
  	}
  }




}