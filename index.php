<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('includes/config.php');

/********Actualisation de la session...**********/

include('includes/fonctions.php');
connexiondb();
actualiser_session();

if(isset($_SESSION['id']))
{
 header('Location: etudiant/');
}
if(isset($_SESSION['id_admin']))
{
 header('Location: admin/');
 echo "haaaaaafbrjbvkbvhjbfk";
}
else{
/********Fin actualisation de session...**********/


include('includes/top.php');
?>

<div class="content">
<?php
include('includes/content.php');
?>
</div>
<?php
include('includes/bottom.php');
mysql_close();}
?>
