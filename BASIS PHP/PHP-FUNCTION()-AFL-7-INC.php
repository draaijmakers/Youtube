/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=Buc7CZ5m6d8//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* FUNCTION() - PHP #7 INC */


<?php

function groet (){
	$tijd = date('G');
	if ($tijd <= 6){echo 'Goedenacht';}
	elseif ($tijd > 6 && $tijd <= 12){echo 'Goedemorgen';}
	elseif ($tijd > 12 && $tijd <= 18){echo 'Goedemiddag';}
	elseif ($tijd > 18 && $tijd <= 23){echo 'Goedeavond';}
	else{echo 'Welkom';}
}

function page (){
	echo '<center><h1>Welkom op deze website</h1></center>';
}

function contact (){
	echo '<center><h1>Vraag stellen</h1><p>Heb je een vraag, vraag het:</p>';
	if (isset($_POST['submit'])){
		if (isset($_POST['jeBevesteging'])){
			$headers = 'From: Website <info@daveyraaijmakers.nl>'."\n";
			$headers .= 'Reply-To: '.$_POST['jeNaam'].' <'.$_POST['jeEmail'].'>'."\n";
			$headers .= 'X-Mailer: PHP/' . phpversion()."\n";;
			$headers .= 'Return-Path: Mail-Error <info@daveyraaijmakers.nl>'."\n";
			$headers .= 'MIME-Version: 1.0'."\n";
			$headers .= 'Content-Transfer-Encoding: 8bit'."\n";
			$headers .= 'Bcc: '.$_POST['jeEmail']."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1'."\n";
			
			if (mail('Davey Raaijmakers <info@daveyraaijmakers.nl>', 'Vraag van, '.$_POST['jeNaam'], $_POST['jeVraag'], $headers)){
				echo 'De mail is verzonden';
			}
		
		}
	}

	echo '<form action="#" method="POST"><table border="0">
	<tr><td><strong>Naam: </strong></td><td><input name="jeNaam" type="text" /></td></tr>
	<tr><td><strong>Email: </strong></td><td><input name="jeMail" type="text" /></td></tr>
	<tr><td><strong>Ik een: </strong></td><td>Man <input name="jeGeslacht" type="radio" value="m" />Vrouw <input name="jeGeslacht" type="radio" value="v" /></td></tr>
	<tr><td colspan="2"><strong>Je vraag:</strong><br /><textarea name="jeVraag"></textarea></td></tr>
	<tr><td colspan="2"><input name="jeBevesteging" type="checkbox" /> <strong>Ja, ik wil dit vragen</strong></td></tr>
	<tr><td colspan="2"><input name="submit" type="submit" value="Verzenden" /></td></tr>
	</table></form></center>';
}

?>