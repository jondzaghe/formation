<?php
namespace Model;
 
use \Entity\Historique;
 
class HistoriquesManagerPDO extends HistoriquesManager{
    public function addHistorique($historique){
        $q = $this->dao->prepare('INSERT INTO t_mss_historiquec (mhc_id,mhc_fk_fuc, mhc_date, mhc_fk_msc, mhc_action)
                                    VALUES (:id, :user, :date, :session, :action)');

        $q->bindValue(':id', $historique->id(), \PDO::PARAM_INT);
        $q->bindValue(':user', $historique->user());
        $q->bindValue(':date', $historique->date()->format('Y-m-d H:i:sP'));
        $q->bindValue(':session', $historique->session());
        $q->bindValue(':action', $historique->action());
     
        $q->execute();
    }
}
