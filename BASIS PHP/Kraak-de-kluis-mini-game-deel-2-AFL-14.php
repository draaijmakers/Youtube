/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=CcOZhsl3zrU//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Kraak de kluis DEEL 2 - PHP #14 */


<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="nl" xml:lang="nl" xmlns="http://www.w3.org/1999/xhtml">
   <head>
	<title>Mijn Eerste webpagina - 2015</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
   </head>
<body>
<div class="header">
	<div class="menu"><a href="#">Kraak de kluis</a> - <a href="#">Contact</a></div>
</div>
<div class="content">
	<div class="content_pad">
		<h1>Kraak de kluis</h1>
		<p>[ de text ]</p>

		<?php
			if (!isset($_SESSION['code'])){
				$_SESSION['code'] = rand(1,9).'/'.rand(1,9).'/'.rand(1,9).'/'.rand(1,9);
			}

			if (isset($_POST['controleer'])){
				$code = explode('/', $_SESSION['code']);

				if ($_POST['invoer_0'] == $code[0] && $_POST['invoer_1'] == $code[1] && $_POST['invoer_2'] == $code[2] && $_POST['invoer_3'] == $code[3]){
					echo '<p class="goed">De code is goed</p>';
				}else{
					for ($invoer = 0; $invoer <= 3; $invoer++){
						if (in_array($_POST['invoer_'.$invoer], $code)){
							echo '<p class="goed">'.$_POST['invoer_'.$invoer].' zit wel in de code</p>';
						}else{
							echo '<p class="fout">'.$_POST['invoer_'.$invoer].' zit NIET in de code</p>';
						}	
					}
				}
			}

		?>

		<form method="post" action="#">
		  <input type="text" name="invoer_0" /> 
		  <input type="text" name="invoer_1" /> 
		  <input type="text" name="invoer_2" /> 
		  <input type="text" name="invoer_3" />
		  <input class="submit" type="submit" name="controleer" value="Controleer" />
		</form>
		<p>&nbsp;</p>
	</div>

	<div class="footer">
		<div class="footer_content">
		<p style="text-align: center"><a href="http://www.daveyraaijmakers.nl"><strong>Gemaakt door, Davey Raaijmakers</strong></a></p>
		</div>
	</div>
</div>
</body>
</html>
