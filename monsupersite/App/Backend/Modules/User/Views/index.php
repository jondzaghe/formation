<p style="text-align: center">LISTE DES UTILISATEURS</p>
 

<h2>Liste des Administrateurs</h2>
<p>&nbsp;</p>
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Actions</th></tr>
<?php
foreach ($listAdmin as $liste)
{
  echo '<tr><td>', $liste->fucLastname(), '</td><td>', $liste->fucFirstname(), '</td><td>', $liste->fucMail(), '</td><td><a href="user-delete-', $liste->fucId(), '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}

?>
</table>

<p>&nbsp;</p>
<h2>Liste des Ecrivains</h2>
<p>&nbsp;</p>
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Actions</th></tr>
<?php
foreach ($listWriter as $liste)
{
  echo '<tr><td>', $liste->fucLastname(), '</td><td>', $liste->fucFirstname(), '</td><td>', $liste->fucMail(), '</td><td><a href="user-delete-', $liste->fucId(), '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}

?>
</table>

<p>&nbsp;</p>
<a href="adduser.html"><h1>Ajouter un utilisateur</h1></a>
