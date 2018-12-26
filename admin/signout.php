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
        '',
        ROOTPATH.'/index.php',
        5
        );

require_once('../informations.php');
exit();
?>