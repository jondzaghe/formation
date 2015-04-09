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
  public function build($var = null)
  {

    $this->form->add(new StringField([
        'label' => 'Auteur',
        'name' => 'auteur',
        'value' => '',
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
        'value' => '',
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
        'value' => '',
        /*'value' => 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.',*/
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