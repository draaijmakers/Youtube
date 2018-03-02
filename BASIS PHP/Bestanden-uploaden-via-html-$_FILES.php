/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=Isrg63wHvbw//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Bestanden uploaden, via een html formulier */

<!DOCTYPE html>
<html>
	<head>
		<title>Dit is een test</title>
		<link href="http://daveyraaijmakers.nl/css/style.css" type="text/css" rel="stylsheet" />
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Afbeelding uploaden</h1>

		<form action="#" method="post" enctype="multipart/form-data">
			<input type="file" name="gekozenAfbeelding"><br />
			<input type="submit" value="Plaatsen" name="submit">
		</form>
		
		<?php
			// Ga kijken of er een bestand gekozen is
			if (isset($_FILES["gekozenAfbeelding"])){
				$uploadenNaar = "uploads/";
				$uploadenBestand = $uploadenNaar . basename($_FILES["gekozenAfbeelding"]["name"]);
				$errorLog = '';
				$bestandsType = pathinfo($uploadenBestand,PATHINFO_EXTENSION);
				
				// Kijk of het bestand echt is
				$check = getimagesize($_FILES["gekozenAfbeelding"]["tmp_name"]);
				if($check !== false) {
					echo "Dit bestand is een afbeelding - " . $check["mime"] . ".";
					$errorLog = 1;
				} else {
					echo "Dit bestand is GEEN afbeelding.";
					$errorLog = 0;
				}
					
				// Kijk of het bestand bestaat
				if (file_exists($uploadenBestand)) {
					echo "Sorry, maar dit bestand bestaat al.";
					$errorLog = 'Error';
				}
				
				// Is het bestand niet te groot
				if ($_FILES["gekozenAfbeelding"]["size"] > 500000) {
					echo "Sorry, dit bestand is te groot.";
					$errorLog = 'Error';
				}
				// Kijk of de extentie goed is
				if($bestandsType != "jpg" && $bestandsType != "png" && $bestandsType != "jpeg" && $bestandsType != "gif" ) {
					echo "Sorry, ik kan alleen .jpg, .png, .jpeg of .gif bestanden plaatsen.";
					$errorLog = 'Error';
				}
				
				// Kijk of $errorLog errors bevat
				if ($errorLog == 'Error') {
					echo "Het bestand is niet geplaatst!!";
				}else {
					// Plaats als alles goed is het bestand
					if (move_uploaded_file($_FILES["gekozenAfbeelding"]["tmp_name"], $uploadenBestand)) {
						echo "Het bestand ". basename( $_FILES["gekozenAfbeelding"]["name"]). " is geplaatst.";
					}else{
						echo "Sorry, er ging iets helemaal mis.";
					}
				}
			}
			?>
	</body>
</html>