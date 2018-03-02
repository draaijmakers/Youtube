/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=aQDQkURNRn4//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* De galg maken - PHP MINI GAME #5 */

<?php
$woord = array('huis','appels','peren');

if (isset($_POST['del'])){session_destroy();}

if (isset($_SESSION['woord']) && (in_array($_SESSION['woord'], $woord))){
	if (isset($_POST['letter'])){
		$letterInPost = $_POST['letter'];
		$letterInWoord = str_split($_SESSION['woord']);
		$_SESSION['letterGok'] = $_SESSION['letterGok'].$letterInPost;
		
		if (in_array($letterInPost, $letterInWoord)){
			$_SESSION['score'] = $_SESSION['score']+2;
		}else{
			if ($_SESSION['score'] > 0){
				$_SESSION['score'] = $_SESSION['score']-1;
			}
			$_SESSION['strike'] = $_SESSION['strike']+1;
		}
	}
}else{
	$_SESSION['woord'] = $woord[rand(0, (count($woord)-1))];
	$_SESSION['letterGok'] = '';
	$_SESSION['score'] = 0;
	$_SESSION['strike'] = 0;
} 

function woordToDots($woordInFuction){
	$lettersInFunction = str_split($woordInFuction);
	
	$nietGeraden = 0;
	foreach ($lettersInFunction AS $lettersInLus){
		if (in_array($lettersInLus, str_split($_SESSION['letterGok']))){
			echo $lettersInLus;
		}else{
			echo '&bull;';
			$nietGeraden = $nietGeraden+1;
		}
	}

	if ($_SESSION['strike'] >= 9){
		echo '<div class="popup">
			<h1>Jammer</h1><p>Je hebt te woord niet geraden.</p><p><a href="/galgje/" class="button">Nog een woord</a></p>
		</div>';
		
		$_SESSION['woord'] = $woord[rand(0, (count($woord)-1))];
		$_SESSION['letterGok'] = '';
		$_SESSION['score'] = 0;
		$_SESSION['strike'] = 0;
	}
	
	if (isset($nietGeraden) && ($nietGeraden == 0)){
		echo '<div class="popup">
			<h1>Goedzo</h1><p>Je hebt te woord geraden.</p><p><a href="/galgje/" class="button">Nog een woord</a></p>
		</div>';
		
		$_SESSION['woord'] = $woord[rand(0, (count($woord)-1))];
		$_SESSION['letterGok'] = '';
		$_SESSION['score'] = $_SESSION['score']+5;
		$_SESSION['strike'] = 0;
	}
}

function toetsenbord(){
	echo '<form action="#" method="post">';
	foreach (range('a','z') AS $letter){
		if (in_array($letter, str_split($_SESSION['letterGok']))){
			echo '<input type="button" name="letter" value="'.$letter.'" class="strike" />';
		}else{
			echo '<input type="submit" name="letter" value="'.$letter.'" />';
		}
	}
	echo '<input type="submit" name="del" value="&#10227;" class="strike" /></form>';
}

?>