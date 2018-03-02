/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=		   //
//                                             //
//                                             //
/////////////////////////////////////////////////

<?php
$functie = array('film');

if (isset($_GET['actie'])){
	if (in_array($_GET['actie'], $functie)){
		function film(){
			global $MySQL;
			
			$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `film` ORDER BY `filmTitel` ASC");
			$sqlAantal = mysqli_num_rows($sqlUitlezen);
			
			echo '<h1>FILM\'S <em>('.$sqlAantal.')</em></h1>';
			if ($sqlAantal > 0){
				while ($sqlData = mysqli_fetch_assoc($sqlUitlezen)){
					echo '<article>';
						echo '<img src="img/film/'.$sqlData['filmBeeld'].'" />';
						echo '<h2>'.$sqlData['filmTitel'].'</h2>';
						echo $sqlData['filmInfo'];
					echo '</article>';
				}
			}else{
				echo 'Sorry, ik heb niet kunnen vinden';
			}
		}
		
		echo $_GET['actie'] ();
	}else{
		echo 'Sorry, deze functie is niet gevonden';
	}
}
?>