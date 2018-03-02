/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=9GvIiumDDnY//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Halloween countdown - PHP #18 */


<?php
function countdown($naam, $dag, $maand, $jaar){
	$aantalDagen = mktime(0,0,0, $maand, $dag, $jaar)-time();
	$deelFactor = 86400;
	
	$antwoord = ceil($aantalDagen / $deelFactor);
	
	if ($antwoord > 0){
		echo 'Het is nog '.$antwoord.' dagen tot '.$naam;
	}elseif ($antwoord == 0){
		echo 'Het is vandaag '.$naam;
	}
}

echo countdown('Halloween', 31, 10, 2015);
?>