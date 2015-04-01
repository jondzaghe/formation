<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\CheckBoxField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\EmailValidator;

class CommentFormBuilder extends FormBuilder
{
  public function build()
  {

    $this->form->add(new StringField([
        'label' => 'Auteur',
        'name' => 'auteur',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
        ],
       ]))
      ->add(new StringField([
        'label' => 'Mail',
        'name' => 'mail',
        'type' => 'email',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('L\'email spécifié est trop long (100 caracteres max)', 50),
          new NotNullValidator('Merci de spécifier votre adresse mail'),
          new EmailValidator('Merci de spécifier une adresse mail valide'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'contenu',
        'rows' => 7,
        'cols' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]))
       ->add(new CheckBoxfield([
        'label' => 'Etre averti par mail des nouveaux commentaires',
        'name' => 'averti',
        'type' => 'checkbox',
        'value' => 1,
        'checked' => $this->form()->entity()->averti()
       ]));
  }
}