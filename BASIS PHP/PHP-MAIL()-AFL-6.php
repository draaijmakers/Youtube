/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=OvsiNhVdCCs//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* MAIL() - PHP #6 */


<?php
	$tijd = date('G');

	if ($tijd <= 6){
		$groet = 'Goedenacht';
	}elseif ($tijd > 6 && $tijd <= 12){
		$groet = 'Goedemorgen';
	}elseif ($tijd > 12 && $tijd <= 18){
		$groet = 'Goedemiddag';
	}elseif ($tijd > 18 && $tijd <= 23){
		$groet = 'Goedeavond';
	}else{
		$groet = 'Welkom';
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="nl" xml:lang="nl" xmlns="http://www.w3.org/1999/xhtml">
   <head>
	<title>Mijn Eerste webpagina - 2015</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
   </head>

   <body>
	<div class="menu"><a href="#">Link 1</a> - <a href="#">Link 2</a> - <a href="#">Link 3</a></div>
	<div class="banner"><?php echo $groet; ?></div>
	<div class="content"><center>
		<h1>Vraag stellen</h1>
		<p>Heb je een vraag, vraag het:</p>
		<?php

			if (isset($_POST['submit'])){
				if (isset($_POST['jeBevesteging'])){
					$headers = 'From: Website <info@daveyraaijmakers.nl>'."\n";
					$headers .= 'Reply-To: '.$_POST['jeNaam'].' <'.$_POST['jeEmail'].'>'."\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					$headers .= 'Return-Path: Mail-Error <info@daveyraaijmakers.nl>'."\n";
					$headers .= 'MIME-Version: 1.0'."\n";
					$headers .= 'Content-Transfer-Encoding: 8bit'."\n";
					$headers .= 'Bcc: '.$_POST['jeEmail']."\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1'."\n";
			
					if (mail(
						'Davey Raaijmakers <info@daveyraaijmakers.nl>', 
						'Vraag van, '.$_POST['jeNaam'], 
						$_POST['jeVraag'], 
						$headers)
					){
						echo 'De mail is verzonden';
					}
		
				}
			}
		?>

		<form action="#" method="POST">
			<table border="0">
				<tr>
					<td><strong>Naam: </strong></td>
					<td><input name="jeNaam" type="text" /></td>
				</tr>
				<tr>
					<td><strong>Email: </strong></td>
					<td><input name="jeMail" type="text" /></td>
				</tr>
				<tr>
					<td><strong>Ik een: </strong></td>
					<td>Man <input name="jeGeslacht" type="radio" value="m" />
					Vrouw <input name="jeGeslacht" type="radio" value="v" /></td>
				</tr>
				<tr>
					<td colspan="2"><strong>Je vraag:</strong><br /><textarea name="jeVraag"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input name="jeBevesteging" type="checkbox" /> <strong>Ja, ik wil dit vragen</strong></td>
				</tr>
				<tr>
					<td colspan="2"><input name="submit" type="submit" value="Verzenden" /></td>
				</tr>
			</table>
		</form>
	</center></div>
	<div class="footer">Deze website is gemaakt door: Davey raaijmakers</div>
   </body>
</html>