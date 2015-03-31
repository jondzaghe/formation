<?php
namespace OCFram;

class CheckBoxField extends Field
{
  protected $type;
  protected $checked;

  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    if (empty($this->type)){
        $this->type = 'checkbox';
    }

    $widget .= '<input type="'.$this->type.'" name="'.$this->name.'"';
    
    if (!empty($this->value))
    {
      $widget .= ' value="'.$this->value.'"';
    }

    if($this->checked == 1){
      $widget .= 'checked';
    }

    $widget .= ' />';

    $widget .= '<label>'.$this->label.'</label>';
    
    return $widget;
  }

  public function setType($type){
      $this->type = $type;
  }

  public function setChecked($checked){
      $this->checked = $checked;
  }
}