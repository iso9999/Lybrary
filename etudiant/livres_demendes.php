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
<h2 class="title">Livres demandées :</h2><br>
<?php
list_d_books();
?>
</div>
<?php
include('includes/bottom_e.php');
mysql_close();
?>
