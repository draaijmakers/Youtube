/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=TELkSmZJRmc//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Het begin van een nieuwe APP - PHP MINI GAME #1 */

<?php

$woord = array('huis','appels','peren');

if (isset($_SESSION['woord']) && (in_array($_SESSION['woord'], $woord))){
	
}else{
	$_SESSION['woord'] = $woord[rand(0, (count($woord)-1))];
} 

?>