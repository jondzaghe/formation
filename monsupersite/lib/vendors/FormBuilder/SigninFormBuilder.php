<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\SelectField;
use \OCFram\PasswordField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\PasswordValidator;
use \OCFram\EmailValidator;
use \OCFram\TypeValidator;

 
class SigninFormBuilder extends FormBuilder{

	public function build($var = null){

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
	       ->add($password = new PasswordField([
	        'label' => 'Mot de passe',
	        'name' => 'fucPassword',
	        'validators' => [
	          new NotNullValidator('Merci de spécifier un mot de passe'),
	        ],
	       ]))
	       ->add(new PasswordField([
	        'label' => 'Mot de passe',
	        'name' => 'passwordConfirmation',
	        'validators' => [
	          new NotNullValidator('Merci de spécifier un mot de passe'),
	          new PasswordValidator('Les mots de passe ne correspondent pas', $password),
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
	        'values' => $var,
	        'validators' => [
	          new NotNullValidator('Merci de spécifier un type d\'utilisateur'),
	          new TypeValidator('Merci de spécifier un type d\'utilisateur correct', $var),
	        ],
	       ]));
  }

}