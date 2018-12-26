<?php
/*
TODO !!!!!!!!!!!!!!!!!
*/
?>


<!DOCTYPE html>
<html>
    <head>
        <?php
        if(isset($titre) && trim($titre) != '')
        $titre = $titre.' : '.TITRESITE;
        
        else
        $titre = TITRESITE;
        
        ?>
        <title><?php echo $titre; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <?php if($_SERVER['PHP_SELF']=='/library/admin/ad_connexion951.php') {?>
        <link rel="stylesheet"  type="text/css" href="src/css/signincss.css">
        <?php } else {?>
        <link rel="stylesheet"  type="text/css" href="src/css/signupcss.css">
        <?php } ?>
        <script type="text/javascript" src="src/js/script.js"></script>
    </head>
    <body>