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
if(!isset($_GET['id']) || !isset($_GET['c']))
{

  header('Location: '.ROOTPATH.'/index.php');
  exit();
}

/* les fcts */
if($_GET['c']==1)
$requete="UPDATE `etudiant` SET `isConfirmed` = 'c' WHERE id = ".$_GET['id'].";";
elseif($_GET['c']==0)
$requete="UPDATE `etudiant` SET `isConfirmed` = 'r' WHERE id = ".$_GET['id'].";";

if(sqlquery($requete,0))
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
<h2 class="title"> Confirmation echouer !</h2>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
