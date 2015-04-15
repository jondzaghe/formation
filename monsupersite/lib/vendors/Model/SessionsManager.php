<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\Session;
 
abstract class SessionsManager extends Manager{
    
    /**
     * ADD TO THE DATABASE A NEWS SESSION
     * @param [SESSION] $session [SESSION TO ADD]
     */
    abstract function addSession($session);

    /**
     * UPDATE THE STATE OF A SESSION
     * @param  [INT] $id [description]
     * @return [type]     [description]
     */
    abstract function updateSessionStateFinish($id);


    /**
     * RETURN THE SESSION OF THE AUTHOR
     * @return [INT] [description]
     */
    abstract function getSessionById($id);


    /**
   * RETURN THE LAST INSERT ID
   * @return [INT] [LAST INSERT ID]
   */
  abstract public function getLastInsertId();
}