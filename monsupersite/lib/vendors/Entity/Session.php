<?php
namespace Entity;

use \OCFram\Entity;

class Session extends Entity
{
  protected $id,
            $user,
            $date,
            $sessionid;

  const SESSION_ENCOURS = 1;
  const SESSION_TERMINEE = 2;


  // public function toArray(){
  //   return array('id' => $this->id, 'news' => $this->news, 'mail' => $this->mail, 'auteur' => $this->auteur, 'contenu' => $this->contenu, 'date' => $this->date()->format('d/m/Y à H\hi'), 'averti' => $this->averti);
  // }

  /**
  ** SETTER
  **/

  public function setId($id){
    $this->id = (int) $id;
  }

  public function setuser($user){
    $this->user =  $user;
  }

  public function setDate($date){
    $this->date =  $date;
  }

  public function setSessionid($id){
    $this->sessionid =  $id;
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

  public function sessionid(){
    return $this->sessionid;
  }

}