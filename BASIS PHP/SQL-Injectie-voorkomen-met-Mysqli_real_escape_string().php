/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=RzS50XKX2D8//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* SQL-Injectie voorkomen met Mysqli_real_escape_string() */

<?php
// input data
$data = "test";

// MySQL Query
$query = mysqli_query($MySQL, "
	SELECT 
		* 
	FROM 
		`User` 
	WHERE 
		`userName` = '".$data."'
	");
	
// geeft terug [SELECT * FROM `User` WHERE `userName` = 'test']
?>

SQL-inject
<?php
// input SQL-inject
$data = "' OR 1=1 #";

// MySQL Query
$query = mysqli_query($MySQL, "
	SELECT 
		* 
	FROM 
		`User` 
	WHERE 
		`userName` = '".$data."'
	");

// geeft terug [SELECT * FROM `User` WHERE `userName` = '' OR 1=1]
?>

Antie SQL-inject
<?php
// input SQL-inject
$data = mysqli_real_escape_string($MySQL, "' OR 1=1 #");

// MySQL Query
$query = mysqli_query($MySQL, "
	SELECT 
		* 
	FROM 
		`User` 
	WHERE 
		`userName` = '".$data."'
	");

// geeft terug [SELECT * FROM `User` WHERE `userName` = '' OR 1=1]
?>