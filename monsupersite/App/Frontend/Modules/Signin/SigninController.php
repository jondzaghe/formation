<?php
namespace App\Frontend\Modules\Signin;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\Form;
use \OCFram\StringField;
use \OCFram\TextField;
use \Entity\Users;
use \FormBuilder\SigninFormBuilder;
use \OCFram\FormHandler;

class SigninController extends BackController{

	/**
	* 	DISPLAY THE SIGN IN INDEX PAGE
	**/
	 public function executeIndex(HTTPRequest $request){

	  	// On ajoute une définition pour le titre.
		$this->page->addVar('title', 'Création d\'un compte écrivain');


		if ($request->method() == 'POST'){
			$user = new Users([
			'fuc_nom' => $request->getData('lastname'),
			'fuc_prenom' => $request->postData('firstname'),
			'fuc_mdp' => $request->postData('password'),
			'fuc_fk_fuy' => 2,
			]);
	    }
	    else{
	      $user = new Users();
	    }

		//WE BUILD THE FORM
		$formBuilder = new SigninFormBuilder($user);
    	$formBuilder->build();

    	$form = $formBuilder->form();
    	$formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);

    	if ($formHandler->process()){
      		$this->app->user()->setFlash('Compte créé');
      		$this->app->httpResponse()->redirect('/admin/');
    	}
 
   		$this->page->addVar('form', $form->createView());
	}

}