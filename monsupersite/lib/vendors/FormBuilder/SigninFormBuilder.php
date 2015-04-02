<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\SelectField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\PasswordValidator;
use \OCFram\EmailValidator;

 
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
	       ]))
	       ->add(new StringField([
	        'label' => 'Confirmation Mot de passe',
	        'name' => 'passwordConfirmation',
	        'type' => 'password',
	        'maxLength' => 50,
	        'type' => 'password',
	        'validators' => [
	          new MaxLengthValidator('Le prenom spécifié est trop long (20 caractères maximum)', 20),
	          new NotNullValidator('Merci de spécifier un mot de passe'),
	          new PasswordValidator('Vos mots de passe de correspondent pas', $this->form(), 'passwordConfirmation'),
	        ],
	       ]))
	       ->add(new StringField([
	        'label' => 'Votre adresse mail',
	        'name' => 'fucMail',
	        'type' => 'email',
	        'validators' => [
	          new NotNullValidator('Merci de spécifier un email'),
	          new EmailValidator('Merci une adresse mail valide'),
	        ],
	       ]))
	       ->add(new SelectField([
	        'label' => 'Type utilisateur',
	        'name' => 'fucType',
	        'values' => [
	        	"option1" => ["value" => "2",
	        				 "label" => "ECRIVAIN"],
	        	"option2" => ["value" => "1",
	        				 "label" => "ADMIN"]],
	        'validators' => [
	          new NotNullValidator('Merci de spécifier un type d\'utilisateur'),
	        ],
	       ]));
  }
}