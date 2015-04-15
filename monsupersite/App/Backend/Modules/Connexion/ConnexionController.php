<?php
namespace App\Backend\Modules\Connexion;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use OCFram\Crypt;
use \Entity\Users;
use \Entity\Session;
 
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

      $user = $manager->getUser($login);
 
      if ($user === null){
          $this->app->user()->setFlash('Ce nom n\'existe pas dans notre base');
      }
      else{
        //We cehck the password is write
        if(Crypt::crypt($password, $user->fucSalt() == $user->fucPassword())){
            $this->app->user()->setAuthenticated(true);
            $this->app->user()->setAttribute('user', $user);
            
            //if the connexion succeed we save the session
            $currentDate = new \DateTime();

            $session = new Session(array('user' => $user->fucId(), 'date' => $currentDate, 'sessionid' => session_id()));
            $this->managers->getManagerOf('Sessions')->addSession($session);
            $this->app->user()->setAttribute('sessionid', $this->managers->getManagerOf('Sessions')->getLastInsertId());

            $this->app->httpResponse()->redirect('../');

        }
      }
    }
  }


  public function executeLogout(HTTPRequest $request){
    $this->app->user()->setAuthenticated(false);

    //We update the session state to finish before destroy the session
    $this->managers->getManagerOf('Sessions')->updateSessionStateFinish($this->app->user()->getAttribute('sessionid'));

    session_destroy();
    
    $this->app->httpResponse()->redirect('../../');
  }
}