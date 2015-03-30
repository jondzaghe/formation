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
	abstract public function getMembre($login, $mdp);

	/**
	 * RECUPERE LA LISTE DES ECRIVAINS
	 * @return [type] [description]
	 */
	abstract public function getlisteEcrivain();



/**
   * Méthode permettant d'enregistrer un user.
   * @param $user Users à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Users $user){
    $this->add($user);
  }

}