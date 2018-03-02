/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=dFTYhLVPA1U//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* PHP bezoekersteller, zonder DataBase */

<?php
// Gegevens naam maken //
$userIp = md5($_SERVER['REMOTE_ADDR']);
$userBezoek = "bezoekers.txt";

// Open bezoekers.txt //
$userBestand = fopen($userBezoek, "r");
$userDataInBestand = fgets($userBestand);
$userDataArray = explode("-", $userDataInBestand);

// Ga kijken of het IP adres in bezoekers.txt staat //
if (in_array($userIp, $userDataArray)){
	// Ja, de bezoeker staat //
	echo 'Welkom terug';
}else{
	// Nee, schijf de bezoeker dan bij in bezoekers.txt //
	echo 'Welkom nieuweling';
	$linkinBestandSchrijven = fopen($userBezoek, "w");
	fwrite($linkinBestandSchrijven, $userIp.'-'.$userDataInBestand);
	fclose($linkinBestandSchrijven);
}

// Sluit bezoekers.txt weer //
fclose($userBestand);
?>