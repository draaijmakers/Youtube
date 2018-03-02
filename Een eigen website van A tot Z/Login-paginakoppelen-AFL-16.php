/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=KG9wZtK7xe0//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Inlogpagina koppelen met de website - Een eigen website van A tot Z */

<?php 
session_start();
include ('inc/db.php'); ?>
<!DOCTYPE html>
<html lang="nl">
   <head>
	<title>Film totaal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="copyright" content="Davey Raaijmakers - 2016" />
	<meta name="description" content=" " />
	<meta name="keywords" content="" />
	<meta name="DISTRIBUTION" content="global" />
	<link rel="DR Mediaproductie.nl" href="favicon.ico" />

	<meta name="ROBOTS" content="INDEX, FOLLOW" />
	<meta name="REVISIT-AFTER" content="7 DAYS" />
	<meta name="author" content="Davey Raaijmakers" />

	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
	<?php if (date('n') == 12 && date('j') > 6){echo '<script src="js/jquery.snow.js"></script><script>$(document).ready(function(){$.fn.snow();});</script>';} ?>
</head>
<body>
	<nav>
		<ul id="menuPc">
			<li class="headlink"><a href="/website/" title="home">Home</a></li>
			<li class="headlink">-</li>
			<li class="headlink"><a href="?actie=film" title="Film's">Film's <span class="icon-white">&nbsp;</span></a>
				<ul><div id="submenu">
					<?php
					$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `genre`,`film` WHERE `film`.`filmGenreId` = `genre`.`genreId` ORDER BY `genreNaam` ASC");
					$sqlAantal = mysqli_num_rows($sqlUitlezen);
					
					if ($sqlAantal > 0){
						while ($sqlData = mysqli_fetch_assoc($sqlUitlezen)){
							echo '<li><a href="?actie=film&genre='.$sqlData['genreId'].'">'.$sqlData['genreNaam'].'</a></li>';
						}
					}
					?>
				</div></ul>
			</li>
			<li class="headlink">-</li>
			<li class="headlink"><a href="?actie=contact" title="Contact">Contact</a></li>
			<li class="headlink">-</li>
			<li class="headlink"><a href="?module=beheer" title="Beheer">Beheer</a></li>
		</ul>
		<ul id="menuMob">
			<li class="headlink"><a href="#" title="home">Menu <span class="icon-white">&nbsp;</span></a>
				<ul><div id="submenu">
					<li><a href="/webesite/" title="home">Home</a></li>
					<li><a href="" title="Film's">Films</a></li>
					<li><a href="?actie=contact" title="Contact">Contact</a></li>
					<li><a href="?module=beheer" title="BEHEER">BEHEER</a></li>
				</div></ul>
			</li>
		</ul>
	</nav>

	<header>&nbsp;</header>
	<div class="overlay">&nbsp;</div>

	<section id="content">
		<?php 
		if (isset($_GET['module']) && ($_GET['module'] == 'beheer')){
			include('inc/beheer.php');
		}else{
			include('inc/plugin.php');
		} 
		?>
	</section>

	<footer>
		<p>&copy; <?php echo date('Y'); ?> - website Davey Raaijmakers Mediaproductie</p>
	</footer>
</body>
</html>
