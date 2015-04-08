<?php
namespace OCFram;

class SelectField extends Field
{
  protected $values = [];
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    

    $widget .= '<label>'.$this->label.'</label><select name="'.$this->name.'">';

    $widget .= '<option value=""></option>';

    foreach($this->values as $val){
        if($this->value == $val['value']){
          $widget .= '<option value="'.$val['value'].'" selected >'.$val['label']. '</option>';
        }
        else{
          $widget .= '<option value="'.$val['value'].'">'.$val['label']. '</option>';
        }
    }

    $widget .= '</select>';
    
    return $widget;
  }


  public function setValues(array $values)
  {
    foreach ($values as $value)
    {
        $this->values[] = $value;
    }
  }

}