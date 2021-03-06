<?php
namespace OCFram;

class StringField extends Field
{
  protected $maxLength;
  protected $type;

  
  public function buildWidget()
  {
    $widget = '';
    $flag = "";
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
      $flag = "error";
    }
    
    if (empty($this->type)){
        $this->type = '';
    }

    $widget .= '<div id="'.$this->name.'"></div>';

    $widget .= '<label>'.$this->label.'</label><input class="'.$flag.'" type="'.$this->type.'" name="'.$this->name.'"';
    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
    
    return $widget .= ' />';
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }

  public function setType($type){
      $this->type = $type;
  }
}