/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=9JOHhiHc6ws//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Van HEX naar RGB - PHP #22 */

<?php
include ('../inc/db.php');

function hextorgb (){
	$hex = $_POST['hex'];
	$r = hexdec(substr($hex, 0, -4));
	$g = hexdec(substr($hex, 2, -2));
	$b = hexdec(substr($hex, -2));
	
	return $r.','.$g.','.$b;
}
?>

<!DOCTYPE html>
<html lang="nl" xml:lang="nl" xmlns="http://www.w3.org/1999/xhtml">
   <head>
	<title>Van HEX naar RGB</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel='shortcut icon' type='image/x-icon' href="favicon.ico" />

	<meta charset="UTF-8">
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<style>body{background: rgb(<?php if (isset($_POST['hex'])){echo hextorgb();} ?>);}</style>
	</head>
<body>
<div class="content_header">&nbsp;</div>
<div class="content_menu"><?php include ('../inc/menu.php'); ?></div>
<div class="content">
	<div class="content_pad">
		<h1>Van HEX naar RGB</h1>
		<?php 
			if (isset($_POST['hex'])){
				echo '<p><strong>HEX('.$_POST['hex'].') = RGB('.hextorgb().')</strong></p>';
			}else{
				echo '<p>Geef hieronder uw HEX kleurcode op, zonder #</p>';
			}
		?>
		<form action="#" method="post">
			<p><input name="hex" type="text" size="6" maxlength="6" placeholder="Zonder #" /></p>
			<p><input value="HEX > RGB" type="submit" /></p>
		<form>
		<h3><a href="/youtube/rgbtohex.php">Van REG naar HEX</a></h3>
	</div>
</div>
<div class="footer">
	<div class="footer_content">
		<p style="float:right; text-align: right"><strong>Davey Raaijmakers</strong><br /><br /><strong>Twitter: </strong> <a href="http://www.twitter.com/draaijmakers_"><em>@draaijmakers_</em></a> <br /><strong>Youtube:</strong> <a href="http://www.youtube.com/daveyraaijmakers/"><em>/Daveyraaijmakers</em></a><br /><br /><strong>&copy; <a href="http://www.drmediaproducties.nl/">DR Mediaproducties</a> - <?php echo date('Y'); ?></strong></p>
    </div>
</div>
<?php include('../linkin/linkin.php'); ?>
</body>
</html>