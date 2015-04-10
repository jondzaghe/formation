<?php
namespace App\Backend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Users;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
  public function executeDelete(HTTPRequest $request){

    $Userid = $this->app->user()->getAttribute('user')->fucId();
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

    if($this->app->user()->getAttribute('user')->fucType() == Users::TYPE_ADMIN || $UserId = $news['author']){
        $newsId = $request->getData('id');
     
        $this->managers->getManagerOf('News')->delete($newsId);
        $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
     
        $this->app->user()->setFlash('La news a bien été supprimée !');
     
        $this->app->httpResponse()->redirect('.');
    }
    else{
        $this->app->httpResponse()->redirect('/accessError.html');
    }
  }
 
  public function executeDeleteComment(HTTPRequest $request)
  {
    if($this->app->user()->getAttribute('user')->fucType() == Users::TYPE_ADMIN){
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
     
        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
     
        $this->app->httpResponse()->redirect('/.');
    }
    else{
        $this->app->httpResponse()->redirect('/accessError.html');
    }
  }
 
  public function executeIndex(HTTPRequest $request)
  {

    if($this->app->user()->getAttribute('user')->fucType() != Users::TYPE_ADMIN){

        $this->app->httpResponse()->redirect('/accessError.html');
    }
    else{
        $this->page->addVar('title', 'Gestion des news');
     
        $manager = $this->managers->getManagerOf('News');
     
        $this->page->addVar('listeNews', $manager->getList());
        $this->page->addVar('nombreNews', $manager->count());
    }
  }
 
 
  public function executeUpdate(HTTPRequest $request)
  {
    $UserId = $this->app->user()->getAttribute('user')->fucId();
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));


    if($this->app->user()->getAttribute('user')->fucType() != Users::TYPE_ADMIN && $UserId != $news['auteur']){

        $this->app->httpResponse()->redirect('/accessError.html');
    }
    else{
        $this->processForm($request);
        $this->page->addVar('title', 'Modification d\'une news');  
    }
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {

    if($this->app->user()->getAttribute('user')->fucType() == 1){
        $this->page->addVar('title', 'Modification d\'un commentaire');
     
        if ($request->method() == 'POST')
        {
          if($request->postData('averti')){
              $bool = 1;
          }
          else{
              $bool = 0;
          }

          $comment = new Comment([
            'id' => $request->getData('id'),
            'news' => $request->getData('news'),
            'mail' => $request->postData('mail'),
            'auteur' => $request->postData('auteur'),
            'contenu' => $request->postData('contenu'),
            'averti' => $bool,
          ]);
        }
        else
        {
          $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

        }
     
        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
     
        $form = $formBuilder->form();
     
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
     
        if ($formHandler->process())
        {
          $this->app->user()->setFlash('Le commentaire a bien été modifié');
     
          $this->app->httpResponse()->redirect('/admin/');
        }
     
        $this->page->addVar('form', $form->createView());
    }
    else{
        $this->app->httpResponse()->redirect('/accessError.html');
    }
  }


  public function executeInsert(HTTPRequest $request)
  {

    // $this->processForm($request);
    
    if ($request->method() == 'POST')
    {

      $userId = $this->app->user()->getAttribute('user')->fucId();

      $currentDate = new \DateTime();

      $news = new News([
        'auteur' => $userId,
        'titre' => htmlspecialchars($request->postData('titre')),
        'contenu' => htmlspecialchars($request->postData('contenu')),
        'dateAjout' => $currentDate,
        'dateModif' => $currentDate
      ]);
 
      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
      $news =  new News();

    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);

    // var_dump($request->getData('datatype'));
    // exit;


    if ($formHandler->process()){

        $this->page->addVar('data', $news);
        $this->page->setCode(200);
    }
    else{
         $this->page->addVar('data', $form->createView());
         $this->page->setCode(200);
    }

 
  }


 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {

      $userId = $this->app->user()->getAttribute('user')->fucId();

      $news = new News([
        'auteur' => $userId,
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }
 
    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
 
      $this->app->httpResponse()->redirect('/');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  public function executeGetInsertForm(HTTPRequest $request){

      $news = new News;

      $formBuilder = new NewsFormBuilder($news);
      $formBuilder->build();
 
      $form = $formBuilder->form();

      $this->page->addVar('data', $form->createView());
      $this->page->setCode(200);
  }
}