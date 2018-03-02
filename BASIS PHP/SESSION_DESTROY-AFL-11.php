/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=6SgeMLJNPvA//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* SESSION_DESTROY - PHP #11 */


<?php include('inc/plugin.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="nl" xml:lang="nl" xmlns="http://www.w3.org/1999/xhtml">
   <head>
	<title>Mijn Eerste webpagina - 2015</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
   </head>

   <body>
	<div class="menu"><a href="?actie=page">Home</a> - <a href="?actie=contact">Contact</a> - <a href="?actie=login">Login</a></div>
	<div class="banner"><?php echo groet(); ?></div>
	<div class="content">
		<?php 
			if (isset($_GET['actie'])){
				if ($_GET['actie'] == 'page' OR $_GET['actie'] == 'contact' OR $_GET['actie'] == 'login' OR $_GET['actie'] == 'logout'){
					echo $_GET['actie']();
				}
			}
		?>
	</div>
	<div class="footer">Deze website is gemaakt door: Davey Raaijmakers</div>
   </body>
</html>