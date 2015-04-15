<?php
namespace Model;

use \Entity\Users;
use \Entity\Session;
use \OCFram\Crypt;

class UsersManagerPDO extends UsersManager{

	public function getUser($login){
		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mdp, fuc_fk_fuy , fuc_salt FROM T_MEM_userc WHERE fuc_nom = :nom');
    
	    $requete->bindValue(':nom', $login);
	    $requete->execute();

	    //WE CHECK THE NUMBER OF ROW RETURNED
	    
	    if($data =  $requete->fetch()){

	    	$user = new Users();

	    	$user->setId($data['fuc_id']);
	    	$user->setLastname($data['fuc_nom']);
	    	$user->setFirstname($data['fuc_prenom']);
	    	$user->setPassword($data['fuc_mdp']);
	    	$user->setType($data['fuc_fk_fuy']);
	    	$user->setSalt($data['fuc_salt']);

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
		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mdp, fuc_mail, fuc_fk_fuy FROM T_MEM_userc WHERE fuc_id = :id');
    
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
	    	$user->setMail($data['fuc_mail']);
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


	/**
	 * RETURN THE LISTE OF CONNECTED WRITER
	 * @return
	 */
	public function getWriterConnected_a(){

		$listeEcrivain = array();
		$i = 0;

		$requete = $this->dao->prepare('SELECT fuc_id, fuc_nom, fuc_prenom, fuc_mail, fuc_mdp, fuc_fk_fuy, MAX(mhc_date) AS date FROM T_MEM_userc 
											INNER JOIN t_mss_sessionc ON msc_fk_fuc = fuc_id AND msc_fk_mse = :mse
											INNER JOIN 	t_mss_historiquec ON mhc_fk_msc = msc_id
											WHERE fuc_fk_fuy = :type
											GROUP BY fuc_id');

		$requete->bindValue(':type', Users::TYPE_ECRIVAIN);
		$requete->bindValue(':mse', Session::SESSION_ENCOURS);

		$requete->execute();

		if($requete->rowcount() == 0)
	    	$listeEcrivain = null;
	    else{
	    	$Listes = $requete->FetchAll();

	    	/**
	    	 * For each loop, we create a new user and we add it to the list
	    	 */
	    	

	    	foreach ($Listes as $liste){
	    		$writer = new Users();
	    		$writer->setId($liste['fuc_id']);
	    		$writer->setLastname($liste['fuc_nom']);
	    		$writer->setFirstname($liste['fuc_prenom']);
	    		$writer->setMail($liste['fuc_mail']);
	    		$writer->setPassword($liste['fuc_mdp']);
	    		$writer->setType($liste['fuc_fk_fuy']);

	    	
	    		$date = \DateTime::createFromFormat('Y-m-d H:i:s', $liste['date']);
	    		var_dump($currentDate = new \DateTime());
	    		var_dump($date);

	    		$diff = date_diff($currentDate, $date);

	    		$diff = $diff->format('il y a %i minutes');

	    		$listeEcrivain[$i]['writer'] = $writer;
	    		$listeEcrivain[$i]['date'] = $diff;
	    		$i++;
	    	}
	    }

	    return $listeEcrivain;
	}


	public function add($user){

		$user->setPassword(Crypt::crypt($user->fucPassword(), $user->fucSalt()));
        $user->setPasswordConfirmation(Crypt::crypt($user->passwordConfirmation(), $user->fucSalt()));

		$requete = $this->dao->prepare('INSERT INTO t_mem_userc (fuc_nom, fuc_prenom, fuc_mdp, fuc_mail, fuc_fk_fuy, fuc_salt)
											VALUES (:fuc_nom, :fuc_prenom, :fuc_mdp, :fuc_mail, :fuc_fk_fuy, :fuc_salt)');
		$requete->bindValue(':fuc_nom', $user->fucLastname());
		$requete->bindValue(':fuc_prenom', $user->fucFirstname());
		$requete->bindValue(':fuc_mdp', $user->fucPassword());
		$requete->bindValue(':fuc_mail', $user->fucMail());
		$requete->bindValue(':fuc_fk_fuy', $user->fucType());
		$requete->bindValue(':fuc_salt', $user->fucSalt());

		$requete->execute();
	}


	public function update($user){

		$user->setPassword(Crypt::crypt($user->fucPassword(), $user->fucSalt()));
		$user->setPasswordConfirmation(Crypt::crypt($user->passwordConfirmation(), $user->fucSalt()));

		$requete = $this->dao->prepare('UPDATE t_mem_userc
											SET fuc_nom = :fuc_nom, fuc_prenom = :fuc_prenom, fuc_mdp = :fuc_mdp, fuc_mail = :fuc_mail, fuc_salt = :fuc_salt
											WHERE fuc_id = :fuc_id');
		$requete->bindValue(':fuc_nom', $user->fucLastname());
		$requete->bindValue(':fuc_prenom', $user->fucFirstname());
		$requete->bindValue(':fuc_mdp', $user->fucPassword());
		$requete->bindValue(':fuc_mail', $user->fucMail());
		$requete->bindValue(':fuc_salt', $user->fucSalt());
		$requete->bindValue(':fuc_id', $user->fucId());

		$requete->execute();
	}


	public function delete($id){
		$requete = $this->dao->prepare('DELETE FROM t_mem_userc WHERE fuc_id = :id');
		$requete->bindValue(':id', $id);

		$requete->execute();
	}


	public function getType_a(){
		$requete = $this->dao->prepare('SELECT muy_id AS value, muy_descriptif AS label FROM t_mem_usery');

		$requete->execute();

		return $requete->fetchAll();
	}
}