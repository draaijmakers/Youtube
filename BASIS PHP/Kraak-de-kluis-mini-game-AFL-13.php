/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=MXdqDkjU054//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Kraak de kluis - PHP #13  */


<?php
session_start();

if (!isset($_SESSION['code'])){
	$_SESSION['code'] = rand(1,9).'/'.rand(1,9).'/'.rand(1,9).'/'.rand(1,9);
}
echo $_SESSION['code'];

if (isset($_POST['controleer'])){
	$code = explode('/', $_SESSION['code']);

	if ($_POST['invoer_0'] == $code[0] && $_POST['invoer_1'] == $code[1] && $_POST['invoer_2'] == $code[2] && $_POST['invoer_3'] == $code[3]){
		echo 'De code is goed';
	}else{
		for ($invoer = 0; $invoer <= 3; $invoer++){
			if (in_array($_POST['invoer_'.$invoer], $code)){
				echo 'Ja';
			}else{
				echo 'Nee';
			}	
		}
	}
}

?>

<form method="post" action="#">
  <input type="text" name="invoer_0" /> 
  <input type="text" name="invoer_1" /> 
  <input type="text" name="invoer_2" /> 
  <input type="text" name="invoer_3" />

  <input type="submit" name="controleer" />
</form>