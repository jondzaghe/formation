<?php 
  trait Hydrator{
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $attribut => $valeur)
    {
      $methode = 'set'.ucfirst($attribut);

      if (is_callable([$this, $methode]))
      {
        $this->$methode($valeur);
      }
    }
  }
}
?>