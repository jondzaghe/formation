<?php
namespace Model;

use \Entity\Users;

class UsersManagerPDO extends UsersManager{

	public function getMembre($login, $mdp){
		$requete = $this->dao->prepare('SELECT fuc_nom, fuc_prenom, fuc_mdp, fuc_fk_type FROM T_MEM_userc WHERE fuc_nom = :nom AND fuc_mdp = :mdp');
    
	    $requete->bindValue(':nom', $login);
	    $requete->bindValue(':mdp', $mdp);
	    
	    $requete->execute();

	    //WE CHECK THE NUMBER OF ROW RETURNED
	    
	    if($requete->rowcount() == 0)
	    	return null;
	    else{
	    	if($requete->rowcount() == 1)
	    	//WE GET THE USER DATAS AND WE INSTANCIATE A NEW USER
	    	$data =  $requete->fetch();
	    	$user = new Users();

	    	$user->setNom($data['fuc_nom']);
	    	$user->setPrenom($data['fuc_prenom']);
	    	$user->setMdp($data['fuc_mdp']);
	    	$user->setType($data['fuc_fk_type']);

	    	return $user;
	    }
	}



	/**
	 * RETURN THE LISTE OF WRITER
	 * @return [ARRAY] [description]
	 */
	public function getListeEcrivain(){

		$listeEcrivain = array();

		$requete = $this->dao->prepare('SELECT fuc_nom, fuc_prenom, fuc_mdp, fuc_fk_type FROM T_MEM_userc WHERE fuc_fk_type = :type');

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

	    		$writer->setNom($liste['fuc_nom']);
	    		$writer->setPrenom($liste['fuc_prenom']);
	    		$writer->setMdp($liste['fuc_mdp']);
	    		$writer->setType($liste['fuc_fk_type']);

	    		$listeEcrivain[] = $writer;
	    	}
	    }

	    return $listeEcrivain;
	}
}