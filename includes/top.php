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
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" media="screen" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,100' rel='stylesheet' type='text/css'>
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
