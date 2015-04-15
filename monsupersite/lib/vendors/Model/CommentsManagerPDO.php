<?php
namespace Model;
 
use \Entity\Comment;
 
class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, mail = :mail, contenu = :contenu, date = :date, avertissement = :averti');

    $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':mail', $comment->mail());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':date', $comment->date()->format('Y-m-d H:i:sP'));
    $q->bindValue(':averti', $comment->averti());
 
    $q->execute();
 
    // $comment->setId($this->dao->lastInsertId());
  }


 
  public function delete($id){
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }


 
  public function deleteFromNews($news){
    $this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);
  }
 
  public function getListOf($news){
    if (!ctype_digit($news))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, news, auteur, mail, contenu, date FROM comments WHERE news = :news');
    $q->bindValue(':news', $news, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
 
    return $comments;
  }


 
  protected function modify(Comment $comment){
    $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, mail = :mail, contenu = :contenu, avertissement = :averti WHERE id = :id');
 
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':mail', $comment->mail());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':averti', $comment->averti());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }
 

 
  public function get($id){
    $q = $this->dao->prepare('SELECT id, news, auteur, mail, contenu, avertissement AS averti FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    return $q->fetch();
  }



  /**
   *  GET ALL COMMENT'S MAIL FORM NEWS WHERE THE USER WANT TO RECEIVE MAIL FOR NEW COMMENT
   * @param $id L'identifiant du commentaire
   * @return string[] an email list 
   */
  public function getCommentMail($newsId, $email){
      $q = $this->dao->prepare('SELECT comments.mail FROM comments 
                                    INNER JOIN t_mss_news ON t_mss_news.id = comments.news
                                    WHERE t_mss_news.id = :id AND avertissement = 1 AND comments.mail != :email
                                    GROUP BY comments.mail');

      $q->bindValue(':id', $newsId);
      $q->bindValue(':email', $email);

      $q->execute();

      return $q->FetchAll(\PDO::FETCH_COLUMN);
  }


  public function getLastInsertId(){
    return $this->dao->lastInsertId();
  }

  public function getNewComment($id){

    $q = $this->dao->prepare('SELECT id, news, auteur, mail, contenu, date, avertissement AS averti FROM comments WHERE id > :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    return $q->fetchAll();

  }
}