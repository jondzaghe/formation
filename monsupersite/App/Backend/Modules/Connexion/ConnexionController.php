<?php
namespace App\Backend\Modules\Connexion;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');

      // On récupère le manager des users
      $manager = $this->managers->getManagerOf('Users');

      $membre = $manager->getMembre($login, $password);
 
      if ($membre === null){
          $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
      else{
        $this->app->user()->setAuthenticated(true);
        $this->app->user()->setUser($membre);
        $this->app->httpResponse()->redirect('.');
      }
    }
  }


  public function executeLogout(HTTPRequest $request){
    $this->app->user()->setAuthenticated(false);
    $this->app->httpResponse()->redirect('../../');
  }
}