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

$titre = 'Suppression';

include('includes/top_a.php');
?>

<nav class="nav">

<?php
include('includes/nav_a.php');
?>
</nav>

<div class="content">
<?php 

$update = "DELETE FROM `livre` WHERE `livre`.`id_livre` = ".intval($_GET['id']).";";

if(mysql_query($update))
{
	echo '<h2 class="title">le suppression a bien été passer !</h2>';
}
else
echo "SQL_ERROR";
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
