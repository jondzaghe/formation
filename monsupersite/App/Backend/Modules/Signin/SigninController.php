<?php
namespace App\Backend\Modules\Signin;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\Form;
use \OCFram\StringField;
use \OCFram\TextField;
use \Entity\Users;
use \FormBuilder\SigninFormBuilder;
use \OCFram\FormHandler;
use \OCFram\Crypt;

class SigninController extends BackController{

	/**
	* 	DISPLAY THE SIGN IN INDEX PAGE
	**/
	 public function executeIndex(HTTPRequest $request){

	 	if($this->app->user()->getAttribute('user')->fucType() != Users::TYPE_ADMIN){

        	$this->app->httpResponse()->redirect('/.');
	    }
	    else{

		  	// On ajoute une définition pour le titre.
			$this->page->addVar('title', 'Création d\'un utilisateur');


			if ($request->method() == 'POST'){
				$user = new Users([
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
		      $user = new Users();
		    }

			//WE BUILD THE FORM
			$formBuilder = new SigninFormBuilder($user);
	    	$formBuilder->build($this->managers->getManagerOf('Users')->getType_a());

	    	$form = $formBuilder->form();
	    	$formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);

	    	if ($formHandler->process()){
	      		$this->app->user()->setFlash('Compte créé');
	      		$this->app->httpResponse()->redirect('/admin/usermanagment.html');
	    	}
	 
	   		$this->page->addVar('form', $form->createView());
	   	}
	}

}