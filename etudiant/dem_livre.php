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
$titre = 'demande d\'un livre';

include('includes/top_e.php');
?>

<nav class="nav">

<?php
include('includes/nav_e.php');
?>
</nav>

<div class="content">
<?php
dem_livre($_GET['id_livre']);
?>
<br>
<br>
<input class="book__button" type="button" name="prendre" onclick="window.location = 'index.php'" value="Go back">
</div>
<?php
include('includes/bottom_e.php');
mysql_close();
?>
