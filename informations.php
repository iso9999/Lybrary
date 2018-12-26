<?php
if(defined(ROOTPATH))
include('includes/config.php');
if(!isset($informations))
{
	$informations = Array(/*Erreur*/
					true,
					'Erreur',
					'Une erreur interne est survenue...',
					'',
					ROOTPATH.'/index.php',
					3
					);
}

if($informations[0] === true) $type = 'erreur';
else $type = 'information';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $informations[1]; ?> : <?php echo TITRESITE; ?></title>
		<meta content="text/html; charset=UTF-8" />
		<meta name="language" content="fr" />
		<meta http-equiv="Refresh" content="<?php echo $informations[5]; ?>;url=<?php echo $informations[4]; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo ROOTPATH; ?>/src/css/styles.css">
	</head>
	
	
	<body>
	    <header>
            <nav>
                <div class="row">
                    <img src="<?php echo ROOTPATH; ?>/src/images/Library-logo-white.png" alt=" logo" class="logo">
                    <ul class="main-nav">
                        <li><a href="#">our class</a></li>
                        <li><a href="#">available books</a></li>
                        <li><a href="#">about us</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="hero-text-box-form">
        <h1><?php echo $informations[1]; ?></h1>
			<p>
			<?php echo $informations[2]; ?> Redirection en cours...<br/>
			<a href="<?php echo $informations[4]; ?>">Cliquez ici si vous ne voulez pas attendre...</a><?php echo $informations[3]; ?>
			</p>
		 </div>
	</body>
</html>
<?php

unset($informations);
?>
