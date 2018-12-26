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
if(!isset($_POST['niveau']) || !isset($_POST['filiere']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}
/* les fcts */



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
<form method="post" action="etudsl.php">
<?php if (!isset($_POST['niveau']) || !isset($_POST['filiere']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}
?>
<h2 class="title"> Liste des etudiants de <?php echo $_POST['niveau'].", ".$_POST['filiere']." : " ?></h2><br>
<?php
    $requete="SELECT * FROM etudiant WHERE niveau='".$_POST['niveau']."' AND filiere='".$_POST['filiere']."' AND isConfirmed='c';";
    $result=sqlquery($requete,2);
    for($i=0;$i<count($result);$i++)
    {
      //'<a class ="etudi" href="etud.php?id='.$result[$i]['id'].'">'.$result[$i]['nom'].' '.$result[$i]['prenom'].'</a><br>';
      echo '<div class="etude_line">
      <a class ="etudi" href="etud.php?id='.$result[$i]['id'].'"><img class="img_line" src="../etudiant/src/images/users/'.$result[$i]['id'].'.jpg">
      <span class="e_line">'.$result[$i]['nom'].' '.$result[$i]['prenom'].'</a> <span class="label e_line">  Email : </span><span class="e_line">'.$result[$i]['email'].'</span></span></div>';
    }
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
