<?php
namespace Entity;

use \OCFram\Entity;

class Comment extends Entity
{
  protected $news,
            $auteur,
            $mail,
            $contenu,
            $date,
            $averti;

  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;

  public function isValid()
  {
    return !(empty($this->auteur) || empty($this->contenu));
  }



  /**
  ** SETTER
  **/

  public function setNews($news)
  {
    $this->news = (int) $news;
  }

  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }

    $this->auteur = $auteur;
  }

  public function setMail($mail)
  {
    $this->mail = $mail;
  }

  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->contenu = $contenu;
  }

  public function setDate(\DateTime $date)
  {
    $this->date = $date;
  }

  public function setAverti($bool)
  {
    $this->averti = $bool;
  }


 /**
  ** GETTER
  **/

  public function news()
  {
    return $this->news;
  }

  public function auteur()
  {
    return $this->auteur;
  }

  public function mail()
  {
    return $this->mail;
  }

  public function contenu()
  {
    return $this->contenu;
  }

  public function date()
  {
    return $this->date;
  }

  public function averti()
  {
    return $this->averti;
  }
}