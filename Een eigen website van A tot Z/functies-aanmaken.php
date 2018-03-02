/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=H_fdopqwCz8//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Het aanmaken van de eerste functie - Een eigen website van A tot Z  */


<?php
$functie = array('film');

if (isset($_GET['actie'])){
	if (in_array($_GET['actie'], $functie)){
		function film(){
			echo 'Film';
		}
		
		echo $_GET['actie'] ();
	}else{
		echo 'Sorry, deze functie is niet gevonden';
	}
}
?>