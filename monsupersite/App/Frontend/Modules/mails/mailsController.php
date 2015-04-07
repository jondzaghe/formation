<?php
namespace App\Frontend\Modules\mails;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\Form;
use \OCFram\StringField;
use \Entity\Users;
use \FormBuilder\PasswordRecoveryFormBuilder;
use \OCFram\PasswordRecoverySendMail;
use \OCFram\FormHandler;



class MailsController extends BackController{


	 public function executePasswordRecoveryForm(HTTPRequest $request){

	 	// On ajoute une définition pour le titre.
			$this->page->addVar('title', 'Mot de passe perdu');


			if ($request->postExists('fucLastname')){

			      $login = $request->postData('fucLastname');

			      $user = $this->managers->getManagerOf('Users')->getUserByLogin($login);
			      $mail[] = $user->fucMail();

			 
			      if ($user === null){


			          $this->app->user()->setFlash('Aucun compte ne correspond a ce nom');
			          $this->app->httpResponse()->redirect('/passwordlost.html');
			      }
			      else{
			      	//Generation of the news password
			      	//update the table user with the new password
			      	//sending mail to the user


			      	$contenu = "Bonjour, votre mot de passe est: " . $user->fucPassword();
				    $mailSender = New PasswordRecoverySendMail(array('mails' => $mail,'contenu'=> $contenu));
				    $mailSender->sendMail();

			        $this->app->user()->setFlash('Votre mot de passe vous a été envoyé a l\'adresse assigné au nom saisi');
			        $this->app->httpResponse()->redirect('/passwordlost.html');
			      }
		    }
		    else{

		    	$user = new Users();

		    	$formBuilder = new PasswordRecoveryFormBuilder($user);
			    $formBuilder->build();
			 
			    $form = $formBuilder->form();
			 
			    $this->page->addVar('form', $form->createView());
			    $this->page->addVar('CurrentUser', $user);
		    }

	 }


}