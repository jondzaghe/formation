<?php
namespace App\Backend\Modules\User;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\FormHandler;
use \Entity\Comment;
use \Entity\Users;
use \OCFram\Form;
use \OCFram\Crypt;
use \OCFram\StringField;
use \OCFram\TextField;
use \FormBuilder\UpdateUserFormBuilder;

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
        $this->app->httpResponse()->redirect('/accessError.html');
    }

  }


  public function executeUpdate(HttpRequest $request){

    if($this->app->user()->getAttribute('user')->fucType() != Users::TYPE_ADMIN && $this->app->user()->getAttribute('user')->fucType() != Users::TYPE_ECRIVAIN){
        $this->app->httpResponse()->redirect('/accessError.html');
    }
    else{
      if ($request->method() == 'POST'){
            $user = new Users([
            'id' => $request->getData('id'),
            'lastname' => $request->postData('fucLastname'),
            'firstname' => $request->postData('fucFirstname'),
            'mail' => $request->postData('fucMail'),
            'password' => $request->postData('fucPassword'),
            'passwordConfirmation' => $request->postData('passwordConfirmation'),
            'type' => $request->postData('fucType'),
            ]);

            //We generate a news salt
            $user->saltGeneration();
            $user->setPassword(Crypt::crypt($user->fucPassword(), $user->fucSalt()));
            $user->setPasswordConfirmation(Crypt::crypt($user->passwordConfirmation(), $user->fucSalt()));

        }
        else{
            $user = $this->managers->getManagerOf('Users')->getUserId($request->getData('id'));
        }

        //WE BUILD THE FORM
        $formBuilder = new UpdateUserFormBuilder($user);
        $formBuilder->build();

        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);

        if ($formHandler->process()){
            $this->app->user()->setFlash('Compte modifié');
            $this->app->httpResponse()->redirect('/admin/usermanagment.html');
        }

        $this->page->addVar('form', $form->createView()); 
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
