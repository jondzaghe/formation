<?php
namespace OCFram;

class PasswordField extends Field
{
  protected $maxLength;

  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }

    $widget .= '<div id="'.$this->name.'"></div>';
    
    $widget .= '<label>'.$this->label.'</label><input type="password" name="'.$this->name.'"';
    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }

    return $widget .= ' /><br>';
    
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

  public function setLabelCheck($lc){
      $this->labelCheck = $lc;
  }

  public function setNameCheck($nc){
      $this->nameCheck = $nc;
  }

  public function setValueCheck($vc){
      $this->valueCheck = $vc;
  }


  public function labelCheck(){
    return $this->labelCheck;
  }

  public function nameCheck(){
    return $this->nameCheck;
  }

  public function valueCheck(){
    return $this->valueCheck;
  }
}