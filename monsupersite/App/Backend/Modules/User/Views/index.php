<p style="text-align: center">Liste des ecrivains enregistrés</p>
 
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Actions</th></tr>
<?php
foreach ($listeEcrivain as $liste)
{
  echo '<tr><td>', $liste->fucLastname(), '</td><td>', $liste->fucFirstname(), '</td><td><a href="user-delete-', $liste->fucId(), '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}

?>
</table>