<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

 
class SigninFormBuilder extends FormBuilder{

	public function build(){

	    $this->form->add(new StringField([
	        'label' => 'Nom (login)',
	        'name' => 'fucLastname',
	        'type' => 'text',
	        'maxLength' => 50,
	        'validators' => [
	          new MaxLengthValidator('Le nom spécifié est trop long (20 caractères maximum)', 20),
	          new NotNullValidator('Merci de spécifier un nom'),
	        ],
	       ]))
	       ->add(new StringField([
	        'label' => 'Prenom',
	        'name' => 'fucFirstname',
	        'type' => 'text',
	        'maxLength' => 50,
	        'validators' => [
	          new MaxLengthValidator('Le prenom spécifié est trop long (20 caractères maximum)', 20),
	          new NotNullValidator('Merci de spécifier un prenom'),
	        ],
	       ]))
	       ->add(new StringField([
	        'label' => 'Mot de passe',
	        'name' => 'fucPassword',
	        'type' => 'password',
	        'maxLength' => 50,
	        'type' => 'password',
	        'validators' => [
	          new MaxLengthValidator('Le prenom spécifié est trop long (20 caractères maximum)', 20),
	          new NotNullValidator('Merci de spécifier un mot de passe'),
	        ],
	       ]));
  }
}