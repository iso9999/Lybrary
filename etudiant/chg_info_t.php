<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexiondb();
actualiser_session();

/********Fin actualisation de session...**********/
if(!isset($_SESSION['id']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}
/* les fcts */



/* fin dec*/

$titre = 'Principale';

include('includes/top_e.php');
?>

<nav class="nav">

<?php
include('includes/nav_e.php');
?>
</nav>

<div class="content">
<?php 
if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['email'])&&isset($_POST['niveau'])&&isset($_POST['filiere']))
{
$update = "UPDATE etudiant SET
nom='".mysql_real_escape_string($_POST['nom'])."',
`prenom`='".mysql_real_escape_string($_POST['prenom'])."',
`email`='".mysql_real_escape_string($_POST['email'])."',
`niveau`='".mysql_real_escape_string($_POST['niveau'])."',
`filiere`='".mysql_real_escape_string($_POST['filiere'])."'
WHERE id=".intval($_SESSION['id']).";";
if(mysql_query($update))
{
	echo '<h2 class="title">le changement d\'information a bien passé !</h2>';
}
else
echo '<h2 class="title">Vous avez rempli le formulaire d\'inscription du site et nous vous en remercions, cependant, nous n\'avons
			pas pu valider votre inscription,</h2>';
}
?>
</div>
<?php
include('includes/bottom_e.php');
mysql_close();
?>
