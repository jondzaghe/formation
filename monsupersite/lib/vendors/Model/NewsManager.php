<?php
namespace Model;

use \OCFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
  /**
   * Méthode retournant une liste de news demandée
   * @param $debut int La première news à sélectionner
   * @param $limite int Le nombre de news à sélectionner
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);



  /**
   * GET BACK ALL NEWS WRITTEN BY THE WRITER
   * @param  [INT] $authorId [AUTHOR ID]
   * @return [type]           [description]
   */
  abstract public function getListauthor($authorId);



  /**
   * GET BACK THE LIST OF NEWS COMMENTED BY THE MAIL
   * @param  [STRING] $mail [THE MAIL OF THE AUTHOR]
   * @return [type]       [description]
   */
  abstract public function getNewsCommentedByEmail($mail);


    /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);

  abstract public function count();


  /**
   * Méthode permettant d'ajouter une news.
   * @param $news News La news à ajouter
   * @return void
   */
  abstract protected function add(News $news);
  
  /**
   * Méthode permettant d'enregistrer une news.
   * @param $news News la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(News $news)
  {
    if ($news->isValid())
    {
      $news->isNew() ? $this->add($news) : $this->modify($news);
    }
    else
    {
      throw new \RuntimeException('La news doit être validée pour être enregistrée');
    }
  }


  /**
   * Méthode permettant de modifier une news.
   * @param $news news la news à modifier
   * @return void
   */
  abstract protected function modify(News $news);


   /**
   * Méthode permettant de supprimer une news.
   * @param $id int L'identifiant de la news à supprimer
   * @return void
   */
  abstract public function delete($id);
}