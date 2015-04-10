<?php
namespace OCFram;

use OCFram\ApplicationComponent;

class Page extends ApplicationComponent
{
  protected $contentFile;
  protected $vars = [];
  protected $datatype = null;
  protected $code;


  public function __construct(Application $app, $datatype){
    parent::__construct($app);
    $this->setDataType($datatype);
  }


  public function addVar($var, $value)
  {
    if (!is_string($var) || is_numeric($var) || empty($var))
    {
      throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
    }

    $this->vars[$var] = $value;
  }

  public function getGeneratedPage()
  {
    if (!file_exists($this->contentFile))
    {
      throw new \RuntimeException('La vue spécifiée n\'existe pas');
    }

    $user = $this->app->user();

    extract($this->vars);

    ob_start();
      require $this->contentFile;
    $content = ob_get_clean();


    // ob_start();

    // if($this->datatype == null || $this->datatype == 'html'){
    //   require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
    // }
    // else{
    //   require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.'.$this->datatype.'.php';
    // }
    // // var_dump(ob_get_clean());
    // // exit;
    // return ob_get_clean();



    // ob_start();

    // if($this->datatype == null || $this->datatype == 'html'){
    //   require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
    // }
    // else{
    //   echo json_encode(include __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.'.$this->datatype.'.php');
    // }
    // // var_dump(ob_get_clean());
    // // exit;
    // return ob_get_clean();

    
    if($this->datatype == null || $this->datatype == 'html'){
      ob_start();
      require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
      return ob_get_clean();
    }
    else{
      return json_encode(include __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.'.$this->datatype.'.php');
    }
    // var_dump(ob_get_clean());
    // exit;
    

  }

  public function setContentFile($contentFile)
  {
    if (!is_string($contentFile) || empty($contentFile))
    {
      throw new \InvalidArgumentException('La vue spécifiée est invalide');
    }

    $this->contentFile = $contentFile;
  }


  public function setDataType($type){
      //TODO
      //Check the type: if it's a known type
      
      $this->datatype = $type;
  }

  public function setCode($code){
    $this->code = $code;
  }
}