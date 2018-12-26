<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexiondb();
actualiser_session();

/********Fin actualisation de session...**********/
if(!isset($_SESSION['id_admin']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}
/* les fcts */

if(!isset($_GET['id']))
{
	header('Location: '.ROOTPATH.'/index.php');
  	exit();
}

/* fin dec*/

$titre = 'Principale';

include('includes/top_a.php');
?>

<nav class="nav">

<?php
include('includes/nav_a.php');
?>
</nav>

<div class="content">
<?php 
if(isset($_POST['libelle']) && isset($_POST['theme']) && isset($_POST['description']) && isset($_POST['auteur']))
{
$update = "UPDATE livre SET
libelle_livre='".mysql_real_escape_string($_POST['libelle'])."',
auteur='".mysql_real_escape_string($_POST['auteur'])."',
theme='".intval($_POST['theme'])."',
description='".mysql_real_escape_string($_POST['description'])."'
WHERE id_livre=".intval($_GET['id']).";";

if(mysql_query($update))
{
	echo '<h2 class="title">le changement d\'information a bien passé !</h2>';
}

else
echo "SQL_ERROR";
}
else
echo '<h2 class="title">Vous avez rempli le formulaire d\'inscription du site et nous vous en remercions, cependant, nous n\'avons
			pas pu valider votre inscription,</h2>';
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
