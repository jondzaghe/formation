<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager
{
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id , auteur, titre, contenu, dateAjout, dateModif FROM news 
                ORDER BY id DESC';
    
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    $listeNews = $requete->fetchAll();
    
    foreach ($listeNews as $news)
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeNews;
  }



  public function getListauthor($authorId)
  {
    $sql = 'SELECT id , auteur, titre, contenu, dateAjout, dateModif FROM news
                WHERE auteur = ' . $authorId .'
                ORDER BY id DESC';
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    $listeNews = $requete->fetchAll();
    
    foreach ($listeNews as $news)
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeNews;
  }




  /**
   * GET BACK THE LIST OF NEWS COMMENTED BY THE MAIL
   * @param  [STRING] $mail [THE MAIL OF THE AUTHOR]
   * @return [type]       [description]
   */
  public function getNewsCommentedByEmail($mail){
      $requete = $this->dao->prepare('SELECT news.id , news.auteur, news.titre, news.contenu, news.dateAjout, news.dateModif FROM news 
                                        INNER JOIN comments ON news.id = comments.news
                                        WHERE comments.mail = :mail
                                        GROUP BY news.id , news.auteur, news.titre, news.contenu, news.dateAjout, news.dateModif');
      $requete->bindValue(':mail', $mail);

      $requete->execute();

      $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
 
      $comments = $requete->fetchAll();

      return $comments;
  }



    public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news
                                      INNER JOIN t_mem_userc ON auteur = fuc_id
                                      WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    if ($news = $requete->fetch())
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
      
      return $news;
    }
    
    return null;
  }


  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
  }



  protected function add(News $news)
  {
    $requete = $this->dao->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':auteur', $news->auteur());
    $requete->bindValue(':contenu', $news->contenu());
    
    $requete->execute();
  }



   protected function modify(News $news)
  {
    $requete = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':auteur', $news->auteur());
    $requete->bindValue(':contenu', $news->contenu());
    $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }


  public function delete($id)
  {
    $this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
  }
}