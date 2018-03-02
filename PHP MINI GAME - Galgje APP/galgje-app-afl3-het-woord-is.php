/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=ND12aDyCCPE//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Het woord is? - PHP MINI GAME #3 */

<?php
$woord = array('huis','appels','peren');

if (isset($_SESSION['woord']) && (in_array($_SESSION['woord'], $woord))){
	if (isset($_POST['letter'])){
		$letterInPost = $_POST['letter'];
		$letterInWoord = str_split($_SESSION['woord']);
		$_SESSION['letterGok'] = $_SESSION['letterGok'].$letterInPost;
		
		if (in_array($letterInPost, $letterInWoord)){
			echo 'goed';
		}else{
			echo 'fout';
		}
	}
}else{
	$_SESSION['woord'] = $woord[rand(0, (count($woord)-1))];
} 

function woordToDots($woordInFuction){
	$lettersInFunction = str_split($woordInFuction);
	
	foreach ($lettersInFunction AS $lettersInLus){
		if (in_array($lettersInLus, str_split($_SESSION['letterGok']))){
			echo $lettersInLus;
		}else{
			echo '&bull;';
		}
	}
}

function toetsenbord(){
	echo '<form action="#" method="post">';
	foreach (range('a','z') AS $letter){
		echo '<input type="submit" name="letter" value="'.$letter.'" />';
	}
	echo '<input type="submit" name="letter" value="?" /></form>';
}


?>