<?php
namespace OCFram;

use Entity\Historique;

abstract class BackController extends ApplicationComponent
{
  protected $action = '';
  protected $module = '';
  protected $page = null;
  protected $view = '';
  protected $managers = null;
  protected $datatype = null;
  protected $historique = null;

  public function __construct(Application $app, $module, $action, $datatype, $historique)
  {
    parent::__construct($app);
    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
    $this->page = new Page($app, $datatype);

    $this->setModule($module);
    $this->setAction($action);
    $this->setView($action);
    $this->datatype = $datatype;
    $this->historique = $historique;
  }

  public function execute()
  {
    $method = 'execute'.ucfirst($this->action);

    if (!is_callable([$this, $method]))
    {
      throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
    }

    $this->$method($this->app->httpRequest());
  }

  public function page()
  {
    return $this->page;
  }

  public function setModule($module)
  {
    if (!is_string($module) || empty($module))
    {
      throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
    }

    $this->module = $module;
  }

  public function setAction($action)
  {
    if (!is_string($action) || empty($action))
    {
      throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
    }

    $this->action = $action;
  }

  public function setView($view)
  {
    if (!is_string($view) || empty($view))
    {
      throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
    }

    $this->view = $view;
    $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
  }


  public function setDatatype($datatype){
      $this->datatype = $datatype;
  }

  public function setHistorique($historique){
    $this->historique = $historique;
  }

  public function historique(){
     return $this->historique;
  }


  public function save(){
      if($this->historique == 'true'){
          //WE SAVE THE ACTION
          $userId = $this->app->user()->getAttribute('user')->fucId();
          $sessionId = $this->app->user()->getAttribute('sessionid');
          $currentDate = new \DateTime();

          $historique = new Historique(array('user' => $userId, 'date' => $currentDate, 'session' => $sessionId, 'action' => $this->action));
          $this->managers->getManagerOf('Historiques')->addHistorique($historique);
      }
  }
}