<?php
namespace OCFram;

class Route
{
  protected $action;
  protected $module;
  protected $url;
  protected $varsNames;
  protected $vars = [];
  protected $datatype;
  protected $historique;

  public function __construct($url, $module, $action, array $varsNames, $datatype = null, $historique = null)
  {
    $this->setUrl($url);
    $this->setModule($module);
    $this->setAction($action);
    $this->setVarsNames($varsNames);
    $this->setDatatype($datatype);
    $this->setHistorique($historique);
  }

  public function hasVars()
  {
    return !empty($this->varsNames);
  }

  public function match($url)
  {
    if (preg_match('`^'.$this->url.'$`', $url, $matches))
    {
      return $matches;
    }
    else
    {
      return false;
    }
  }

  public function setAction($action)
  {
    if (is_string($action))
    {
      $this->action = $action;
    }
  }

  public function setModule($module)
  {
    if (is_string($module))
    {
      $this->module = $module;
    }
  }

  public function setUrl($url)
  {
    if (is_string($url))
    {
      $this->url = $url;
    }
  }

  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }


  public function setDatatype($datatype)
  {
    $this->datatype = $datatype;
  }

  public function setHistorique($historique)
  {
    $this->historique = $historique;
  }

  public function setVars(array $vars)
  {
    $this->vars = $vars;
  }

  public function action()
  {
    return $this->action;
  }

  public function module()
  {
    return $this->module;
  }

  public function vars()
  {
    return $this->vars;
  }

  public function varsNames()
  {
    return $this->varsNames;
  }

  public function datatype(){
    return $this->datatype;
  }


  public function historique(){
    return $this->historique;
  }
}