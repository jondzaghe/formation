<?php
namespace App\Backend\Modules\Connexion;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Users;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $user = new Users(array('lastname' => $request->postData('login'), 'password' => $request->postData('password')));
      $user->passwordCrypting();

      // On récupère le manager des users
      $manager = $this->managers->getManagerOf('Users');

      $user = $manager->getUser($user->fucLastname(), $user->fucPassword());
 
      if ($user === null){
          $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
      else{
        $this->app->user()->setAuthenticated(true);
        $this->app->user()->setAttribute('user', $user);
        $this->app->httpResponse()->redirect('.');
      }
    }
  }


  public function executeLogout(HTTPRequest $request){
    $this->app->user()->setAuthenticated(false);
    $this->app->httpResponse()->redirect('../../');
  }
}