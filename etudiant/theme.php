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
if(isset($_GET['id_theme']))
list_books_by_themes($_GET['id_theme']);
else{
header('Location: '.ROOTPATH.'/index.php');
  exit();}
?>
</div>
<?php
include('includes/bottom_e.php');
mysql_close();
?>
