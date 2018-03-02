/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=JM-X90s7x_Y//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* MySQL vs MySQLi - PHP #15 */

<?php
// OUDE MANIER!!!
$username    = 'root';
$password    = '';
$host        = 'localhost';
$database    = 'daveyraaijmakers';

if(mysql_connect($host,$username,$password)){
	if(!mysql_select_db($database)){
		echo 'Sorry, ik kon helaas geen verbinding maken met de databasetabel!';
		exit();
	}
}else {
	echo 'Sorry, ik kon helaas geen verbinding maken met de databaseserver!';
	exit();
}

$username    = 'root';
$password    = '';
$host        = 'localhost';
$database    = '';

if($MySQL = mysqli_connect($host,$username,$password,$database)){
	if (mysqli_connect_errno()){
		echo "Sorry, er ging iets mis: ".mysqli_connect_error();
		exit();
	}
}else {
	echo 'Sorry, ik kon helaas geen verbinding maken met de databaseserver!';
	exit();
}


// VOORBEELD VOOR MySQLi QUERY 
// mysqli_query($MySQL, "SELECT * FROM `....`");
?>
