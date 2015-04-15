<?php
namespace Entity;

use \OCFram\Entity;

class Historique extends Entity
{
  protected $id,
            $user,
            $date,
            $session,
            $action;

  // public function toArray(){
  //   return array('id' => $this->id, 'news' => $this->news, 'mail' => $this->mail, 'auteur' => $this->auteur, 'contenu' => $this->contenu, 'date' => $this->date()->format('d/m/Y à H\hi'), 'averti' => $this->averti);
  // }

  /**
  ** SETTER
  **/

  public function setId($id){
    $this->id = (int) $id;
  }

  public function setUser($user){
    $this->user =  $user;
  }

  public function setDate($date){
    $this->date =  $date;
  }

  public function setSession($session){
    $this->session =  $session;
  }

  public function setAction($action){
    $this->action = $action;
  }


 /**
  ** GETTER
  **/

  public function id(){
    return $this->id;
  }

  public function user(){
    return $this->user;
  }

  public function date(){
    return $this->date;
  }

  public function session(){
    return $this->session;
  }

  public function action(){
    return $this->action;
  }

}