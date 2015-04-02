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

    foreach($this->values as $val){
        $widget .= '<option value="'.$val['value'].'">'.$val['label']. '</option>';
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