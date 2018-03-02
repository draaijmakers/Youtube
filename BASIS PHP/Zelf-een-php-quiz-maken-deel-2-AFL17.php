/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=jfsXX81FSLs//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Zelf een quiz maken, deel 2 - PHP #17  */


<?php
// Maakt de vraag.
$vraag = array(
	// Maak een vraag - Eerst de vraag - dan het antwoord - en het goed antwoord
	array("Dit is de eerst vraag", "Ja, dat klopt-Nee, dit klopt niet","Ja, dat klopt"),
	array("Dit is de tweede vraag", "Ja, dat klopt-Nee, dit klopt niet","Ja, dat klopt"),
);

// Kijk of er een vraag gezet is.
if (isset($_GET['vraagnummer'])){
	$vraagNummer = $_GET['vraagnummer'];
}else{
	$vraagNummer = 0;
}

// Lees de vraag uit
if (count($vraag) <= $_GET['vraagnummer']){
	echo 'Bedankt voor het spelen';
}else{
	echo '<h1>'.$vraag[$vraagNummer][0].'</h1>';

	// Controleer de vraag
	if (isset($_POST['verzenden'])){
		if ($vraag[$vraagNummer][2] == $_POST['verzenden']){
			echo 'Ja,  dit is goed';
		}else{
			echo 'Nee, dit is niet goed: '.$vraag[$vraagNummer][2];
		}
		echo '<a href="?vraagnummer='.($vraagNummer+1).'">Ga naar de volgende vraag</a>';
	}

	// Geef de antwoorden weer
	$antwoord = explode('-', $vraag[$vraagNummer][1]);
	echo '<form method="post" action="?vraagnummer='.$vraagNummer.'">';
	foreach($antwoord AS $antwoordLus){
		echo '<input type="submit" value="'.$antwoordLus.'" name="verzenden" /><br />';
	}
}
?>
</form>