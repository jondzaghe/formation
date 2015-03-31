<?php
namespace App\Backend\Modules\User;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \OCFram\Form;
use \OCFram\StringField;
use \OCFram\TextField;

class UserController extends BackController
{


   public function executeIndex(HTTPRequest $request){
    if($this->app->user()->getUser()->fucType() == 1){
        $this->page->addVar('title', 'Gestion des Ecrivain');
     
        $manager = $this->managers->getManagerOf('Users');
     
        $this->page->addVar('listeEcrivain', $manager->getListeEcrivain());
    }
    else{
        $this->app->httpResponse()->redirect('../');
    }
  }

  public function executeDelete(HttpRequest $request){

    if($this->app->user()->getUser()->fucType() == 1){
      	$manager = $this->managers->getManagerOf('Users');

    	  $userId = $request->getData('id');
      	$manager->delete($userId);
      	$this->app->httpResponse()->redirect('.');
    }
    else{
        $this->app->httpResponse()->redirect('../');
    }

  }


}
