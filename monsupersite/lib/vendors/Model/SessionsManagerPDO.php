<?php
namespace Model;
 
use \Entity\Session;
 
class SessionsManagerPDO extends SessionsManager{
    
    public function addSession($session){
        $q = $this->dao->prepare('INSERT INTO t_mss_sessionc (msc_fk_fuc, msc_date, msc_session, msc_fk_mse)
                                    VALUES (:user, :date, :session, :mse)');

        $q->bindValue(':user', $session->user());
        $q->bindValue(':date', $session->date()->format('Y-m-d H:i:sP'));
        $q->bindValue(':session', $session->sessionid());
        $q->bindValue(':mse', Session::SESSION_ENCOURS);
     
        $q->execute();

    }

    public function updateSessionStateFinish($id){
        $q = $this->dao->prepare('UPDATE t_mss_sessionc SET msc_fk_mse = :mse');
        $q->bindValue(':mse', Session::SESSION_TERMINEE);

        $q->execute();
    }

    public function getLastInsertId(){
        return $this->dao->lastInsertId();
  }
}