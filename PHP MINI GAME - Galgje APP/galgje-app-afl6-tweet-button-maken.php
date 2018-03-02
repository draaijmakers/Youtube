/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=LIIbnWqzCDk//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Nodig je vrienden uit met een Tweet Button - PHP MINI GAME #6 */

<?php
session_start();
include('inc/plugin.php');
?>
<!DOCTYPE>
<html>
   <head>
	<title>Galgje APP</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
   </head>

   <body>
    <div class="content_header">
		<?php if ($_SESSION['strike'] > 0){
			echo '<img src="img/strike_'.$_SESSION['strike'].'.png" alt="U heeft '.$_SESSION['strike'].' strike\'s" />';
		}
		?>
	</div>
	<div class="content">
		<div class="content_menu">
			<p><?php woordToDots($_SESSION['woord']) ?></p>
		</div>
		<?php toetsenbord() ?>
		
		<p style="text-align: center"><a data-size="large" class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Speel%20nu%20ook%20mee%20met%20de%20galgje%20APP%20via:&hashtags=galgjeapp&url=http://galgjeapp.daveyraaijmakers.nl">Speel samen met je vrienden</a></p>
	</div>
	<div class="content_alert">
		<h1>Galgje APP</h1>
		<p>Nu te downloaden in de <a href="https://play.google.com/store/apps/details?id=com.">Google Play Store</a></p>
		<p><a href="https://play.google.com/store/apps/details?id=com."><img style="height: 175px;" src="img/screen 1.jpg" /> <img style="height: 175px;" src="img/screen 2.jpg" /> <img style="height: 175px;" src="img/screen 3.jpg" /> <img style="height: 175px;" src="img/screen 4.jpg" /></a></p>
	</div>
	<div class="footer">
		<?php
			echo '<p><strong>Mijn score</strong><br />';
			echo '<em>'.$_SESSION['score'].' punten &bull; '.$_SESSION['strike'].' fouten</em></p>';
			echo '<h3><a href="http://www.daveyraaijmakers.nl/">Gemaakt door: Davey Raaijmakers</a></h3>';
		?>
	</div>
   </body>
</html>