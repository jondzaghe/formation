<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\Historique;
 
abstract class HistoriquesManager extends Manager
{

	/**
	 * ADD TO THE DATABASE A NEW HISTORIQUE
	 * @param [HISTOPTRIQUE] $historique [HISTORIQUE TO ADD]
	 */
    abstract function addHistorique($historique);
}