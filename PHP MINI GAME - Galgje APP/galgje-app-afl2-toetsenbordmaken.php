/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=ulmLZ0HZ_FE//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Een toetsenbord maken - PHP MINI GAME #2 */

<?php
session_start();
$woord = array('huis','appels','peren');

if (isset($_SESSION['woord']) && (in_array($_SESSION['woord'], $woord))){
	if (isset($_POST['letter'])){
		$letterInPost = $_POST['letter'];
		$letterInWoord = str_split($_SESSION['woord']);
		
		if (in_array($letterInPost, $letterInWoord)){
			echo 'goed';
		}else{
			echo 'fout';
		}
	}
}else{
	$_SESSION['woord'] = $woord[rand(0, (count($woord)-1))];
} 

echo '<div class="content_menu"><p>'.$_SESSION['woord'].'</p></div>';

echo '<form action="#" method="post">';
foreach (range('a','z') AS $letter){
	echo '<input type="submit" name="letter" value="'.$letter.'" />';
}
echo '<input type="submit" name="letter" value="?" />';
echo '</form>';

?>