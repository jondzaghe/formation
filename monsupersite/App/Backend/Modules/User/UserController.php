<?php
namespace App\Backend\Modules\User;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \Entity\Users;
use \OCFram\Form;
use \OCFram\StringField;
use \OCFram\TextField;

class UserController extends BackController
{


   public function executeIndex(HTTPRequest $request){
    if($this->app->user()->getAttribute('user')->fucType() == 1){
        $this->page->addVar('title', 'Gestion des utilisateurs');
     
        $manager = $this->managers->getManagerOf('Users');
     
        $this->page->addVar('listWriter', $manager->getListeEcrivain());
        $this->page->addVar('listAdmin', $manager->getAdmin_a());
    }
    else{
        $this->app->httpResponse()->redirect('/accessError.html');
    }
  }

  public function executeDelete(HttpRequest $request){

    if($this->app->user()->getAttribute('user')->fucType() == 1){
      	$manager = $this->managers->getManagerOf('Users');

    	  $userId = $request->getData('id');
      	$manager->delete($userId);
      	$this->app->httpResponse()->redirect('/admin/usermanagment.html');
    }
    else{
        $this->app->httpResponse()->redirect('../');
    }

  }


  public function executeWriterNews(HttpRequest $request){
      if($this->app->user()->getAttribute('user')->fucType() != 2){
        $this->app->httpResponse()->redirect('.');
    }
    else{
        
        $listNews = $this->managers->getManagerOf('News')->getListAuthor($request->getData('id')); 
        $this->page->addVar('title', 'Liste des news');
        $this->page->addVar('listNews', $listNews);
    }
  }


}
