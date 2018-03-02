/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=C_6NJG5QDzw//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Bezoekers teller ZONDER database - PHP #28 */

<?php
session_start();

$ip = md5($_SERVER['REMOTE_ADDR']);
$bezoekers = 'data/bezoekers.txt';

$bezoekersBestand = fopen($bezoekers,"r");
$bezoekersDataInBestand = fgets($bezoekersBestand);
$bezoekersDataInArray = explode(',', $bezoekersDataInBestand);

if (in_array($ip, $bezoekersDataInArray)){
	echo '<h1>Welkom terug</h1>';
}else{
	$bestandSchrijven = fopen($bezoekers,"w");
	fwrite($bestandSchrijven, $bezoekersDataInBestand.','.$ip);
	fclose($bestandSchrijven);
	
	echo '<h1>Welkom</h1>';
}

echo '<h4>U bent bezoeker nummer: '.(count($bezoekersDataInArray)-1).'</h4>';
?>