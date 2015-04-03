<?php
namespace Model;

use \Entity\Users;

class UsersManagerPDO extends UsersManager{

	public function getUser($login, $mdp){
		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mdp, fuc_fk_fuy FROM T_MEM_userc WHERE fuc_nom = :nom AND fuc_mdp = :mdp');
    
	    $requete->bindValue(':nom', $login);
	    $requete->bindValue(':mdp', $mdp);
	    
	    $requete->execute();

	    //WE CHECK THE NUMBER OF ROW RETURNED
	    
	    if($data =  $requete->fetch()){

	    	$user = new Users();

	    	$user->setId($data['fuc_id']);
	    	$user->setLastname($data['fuc_nom']);
	    	$user->setFirstname($data['fuc_prenom']);
	    	$user->setPassword($data['fuc_mdp']);
	    	$user->setType($data['fuc_fk_fuy']);

	    	return $user;
	    }
	    
	    return null;
	}



	public function getUserByLogin($login){
		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mail, fuc_mdp, fuc_fk_fuy FROM T_MEM_userc WHERE fuc_nom = :nom');
    
	    $requete->bindValue(':nom', $login);
	    
	    $requete->execute();

	    //WE CHECK THE NUMBER OF ROW RETURNED
	    
	    if($data =  $requete->fetch()){

	    	$user = new Users();

	    	$user->setId($data['fuc_id']);
	    	$user->setLastname($data['fuc_nom']);
	    	$user->setFirstname($data['fuc_prenom']);
	    	$user->setMail($data['fuc_mail']);
	    	$user->setPassword($data['fuc_mdp']);
	    	$user->setType($data['fuc_fk_fuy']);

	    	return $user;
	    }
	    
	    return null;
	}



	public function getUserId($id){
		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mdp, fuc_fk_fuy FROM T_MEM_userc WHERE fuc_id = :id');
    
	    $requete->bindValue(':id', $id);
	    
	    $requete->execute();

	    //WE CHECK THE NUMBER OF ROW RETURNED
	    
	    if($requete->rowcount() == 0)
	    	return null;
	    else{
	    	if($requete->rowcount() == 1)
	    	//WE GET THE USER DATAS AND WE INSTANCIATE A NEW USER
	    	$data =  $requete->fetch();
	    	$user = new Users();

	    	$user->setId($data['fuc_id']);
	    	$user->setLastname($data['fuc_nom']);
	    	$user->setFirstname($data['fuc_prenom']);
	    	$user->setPassword($data['fuc_mdp']);
	    	$user->setType($data['fuc_fk_fuy']);

	    	return $user;
	    }
	}


	/**
	 * GET THE ADMIN'S LIST
	 * @return [Users] [List of users]
	 */
	public function getAdmin_a(){

		$listAdmin = array();

		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mail, fuc_mdp, fuc_fk_fuy FROM T_MEM_userc WHERE fuc_fk_fuy = :type');

		$requete->bindValue(':type', Users::TYPE_ADMIN);

		$requete->execute();

		if($requete->rowcount() == 0)
	    	$listeAdmin = null;
	    else{
	    	$Listes = $requete->FetchAll();

	    	/**
	    	 * For each loop, we create a new user and we add it to the listeAdmin
	    	 */
	    	foreach ($Listes as $liste){
	    		$writer = new Users();
	    		$writer->setId($liste['fuc_id']);
	    		$writer->setLastname($liste['fuc_nom']);
	    		$writer->setFirstname($liste['fuc_prenom']);
	    		$writer->setMail($liste['fuc_mail']);
	    		$writer->setPassword($liste['fuc_mdp']);
	    		$writer->setType($liste['fuc_fk_fuy']);

	    		$listeAdmin[] = $writer;
	    	}
	    }

	    return $listeAdmin;
}





	/**
	 * RETURN THE LISTE OF WRITER
	 * @return [ARRAY] [description]
	 */
	public function getListeEcrivain(){

		$listeEcrivain = array();

		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mail, fuc_mdp, fuc_fk_fuy FROM T_MEM_userc WHERE fuc_fk_fuy = :type');

		$requete->bindValue(':type', Users::TYPE_ECRIVAIN);

		$requete->execute();

		if($requete->rowcount() == 0)
	    	$listeEcrivain = null;
	    else{
	    	$Listes = $requete->FetchAll();

	    	/**
	    	 * For each loop, we create a new user and we add it to the listeEcrivain
	    	 */
	    	foreach ($Listes as $liste){
	    		$writer = new Users();
	    		$writer->setId($liste['fuc_id']);
	    		$writer->setLastname($liste['fuc_nom']);
	    		$writer->setFirstname($liste['fuc_prenom']);
	    		$writer->setMail($liste['fuc_mail']);
	    		$writer->setPassword($liste['fuc_mdp']);
	    		$writer->setType($liste['fuc_fk_fuy']);

	    		$listeEcrivain[] = $writer;
	    	}
	    }

	    return $listeEcrivain;
	}


	public function add($user){

		//We Crypt the pass password
		$user->passwordCrypting();

		$requete = $this->dao->prepare('INSERT INTO t_mem_userc (fuc_nom, fuc_prenom, fuc_mdp, fuc_mail, fuc_fk_fuy)
											VALUES (:fuc_nom, :fuc_prenom, :fuc_mdp, :fuc_mail, :fuc_fk_fuy)');
		$requete->bindValue(':fuc_nom', $user->fucLastname());
		$requete->bindValue(':fuc_prenom', $user->fucFirstname());
		$requete->bindValue(':fuc_mdp', $user->fucPassword());
		$requete->bindValue(':fuc_mail', $user->fucMail());
		$requete->bindValue(':fuc_fk_fuy', $user->fucType());

		$requete->execute();
	}


	public function delete($id){
		$requete = $this->dao->prepare('DELETE FROM t_mem_userc WHERE fuc_id = :id');
		$requete->bindValue(':id', $id);

		$requete->execute();
	}
}