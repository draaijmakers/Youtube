/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=o1KXlhBaNeM//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Aanmaken en bedenken van functies - PHP APP maken */

<?php
$actie = array("home", "videos", "fotos", "overmij", "tweets", "insta");

function home (){
	echo 'Dit is de homepage';
}

function overmij (){
	echo 'Hoi ik ben Gio';
}

if (isset($_GET['actie']) && (in_array($_GET['actie'], $actie))){
	echo $_GET['actie']();
}else{
	echo home();
}
?>