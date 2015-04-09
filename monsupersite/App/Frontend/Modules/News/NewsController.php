<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
use \OCFram\Form;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\SendMail;
use \OCFram\NewCommentSendMail;

class NewsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {

    $listItem = array();
    $i = 0; //Loop counter

    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreNews.' dernières news');
    
    // On récupère le manager des news.
    $managerNews = $this->managers->getManagerOf('News');

    //we get back user manager
    $managerUser = $this->managers->getManagerOf('Users');
    
    $listeNews = $managerNews->getList(0, $nombreNews);
    
    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres)
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $news->setContenu($debut);
      }

      $listItem[$i]['news'] = $news;
      $listItem[$i]['user'] = $managerUser->getUserId($news['auteur']);

      $i++;
    }
    
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('listItem', $listItem);
  }
  
  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
    
    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }


    //comment form construction
    $comment = new Comment();
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    $this->page->addVar('form', $form->createView());
    
    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
     $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
  }


    public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {

      if($request->postData('averti')){
          $bool = 1;
      }
      else{
          $bool = 0;
      }

      $currentDate = new \DateTime();

      $comment = new Comment([
        'news' => $request->getData('news'),
        'mail' => $request->postData('mail'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'date' => $currentDate,
        'averti' => $bool,
      ]);
    }
    // else
    // {
    //   $comment = new Comment;
    // }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    $this->page->setDataType($request->getData('datatype'));


    if ($formHandler->process()){
        //$this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');

        //WE SEND THE MAIL
        //$this->newCommentSendMail($request->getData('news'), $comment);
   
        // $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
        

        $this->page->addVar('data', $comment->toArray());
        $this->page->addVar('code', array('code' => 200));
    }
    else{
         $this->page->addVar('data', $form->createView());
         $this->page->addVar('code', array('code' => 500));
    }
 
    // $this->page->addVar('comment', $comment);
    // $this->page->addVar('title', 'Ajout d\'un commentaire');
    // // $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
  }


  public function executeListNewsOfAuthor(HTTPRequest $request){

      $managerNews = $this->managers->getManagerOf('News');
      $managerUser = $this->managers->getManagerOf('Users');

      $userId = $request->getData('id');

      echo "test";
      $listNews = $managerNews->getListAuthor($userId);


      $this->page->addVar('listNews', $listNews);
      $this->page->addVar('writer', $managerUser->getUserId($userId));
  }


  public function executeGetNewsCommentedByEmail(HTTPRequest $request){
      
      //We get back the mail
      $mail = $request->getData('mail');

      $managerNews = $this->managers->getManagerOf('News');
      $listNews = $managerNews->getNewsCommentedByEmail($mail);

      $this->page->addVar('listNews', $listNews);
      $this->page->addVar('mail', $mail);
      $this->page->addVar('mail', $mail);
  }


  public function newCommentSendMail($newsId, $comment){

      $managers = $this->managers->getManagerOf('Comments');
      $listadressMail = $managers->getCommentMail($newsId, $comment->mail());

      $authorName = $comment->auteur();

      $contenu = "Un nouveau commentaire vient d'etre ajouté par: $authorName";

      $mailSender = New NewCommentSendMail(array('mails'=>$listadressMail,'contenu'=> $contenu));
      $mailSender->sendMail();
  }
}


