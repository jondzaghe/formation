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
    $this->page->addVar('title', 'Gestion des Ecrivain');
 
    $manager = $this->managers->getManagerOf('Users');
 
    $this->page->addVar('listeEcrivain', $manager->getListeEcrivain());
  }

  public function executeDelete(HttpRequest $request){
  	$manager = $this->managers->getManagerOf('Users');

	$userId = $request->getData('id');
  	$manager->delete($userId);
  	$this->app->httpResponse()->redirect('.');
  }


}
