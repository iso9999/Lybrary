<?php
session_start();
include('../includes/config.php');
include('../includes/fonctions.php');
vider_cookie();
session_destroy();

$informations = Array(/*Déconnexion*/
        false,
        'Déconnexion',
        'Vous êtes à présent déconnecté.',
        ' - <a href="'.ROOTPATH.'/etudiant/signin.php">Se connecter</a>',
        ROOTPATH.'/index.php',
        5
        );

require_once('../informations.php');
exit();
?>
