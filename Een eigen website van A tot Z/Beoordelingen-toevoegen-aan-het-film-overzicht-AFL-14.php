/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=ufUmx94A0k0//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Films beoodelen  - Een eigen website van A tot Z */

<?php
$functie = array('film');

if (isset($_GET['actie'])){
	if (in_array($_GET['actie'], $functie)){
		function film(){
			global $MySQL;
			
			function beoordeling($beoordeling){
				echo '<img src="img/beoordeling/'.$beoordeling.'.png" alt="Deze film heeft '.$beoordeling.' sterren" />';
			}
			
			$where = NULL;
			if (isset($_GET['genre'])){
				$where = 'WHERE `filmGenreId` = "'.$_GET['genre'].'"';
			}else if (isset($_GET['id'])){
				$where = 'WHERE `filmTitel` = "'.$_GET['id'].'"';
			}
			
			$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `film` ".$where." ORDER BY `filmTitel` ASC");
			$sqlAantal = mysqli_num_rows($sqlUitlezen);
			
			if ($sqlAantal == 1 && isset($_GET['id'])){
				echo '<h1>'.ucfirst(str_replace('+',' ',$_GET['id'])).'</h1>';
			}else{
				echo '<h1>FILM\'S <em>('.$sqlAantal.')</em></h1>';
			}
						
			if ($sqlAantal > 0){
				while ($sqlData = mysqli_fetch_assoc($sqlUitlezen)){
					$info = explode('<hr />',$sqlData['filmInfo']);
					echo '<article>';
						echo '<img class="film" src="img/film/'.$sqlData['filmBeeld'].'" />';
						if ($sqlAantal == 1 && isset($_GET['id'])){
							echo beoordeling($sqlData['filmBeoordeling']);
							echo str_replace('<hr />','',$sqlData['filmInfo']);
						}else{
							echo '<h2><a href="?actie=film&amp;id='.str_replace(' ','+',$sqlData['filmTitel']).'">'.$sqlData['filmTitel'].'</a></h2>';						
							echo beoordeling($sqlData['filmBeoordeling']);
							echo $info[0];
						}
					echo '</article>';
				}
			}else{
				echo 'Sorry, ik heb niets kunnen vinden';
			}
		}
		
		echo $_GET['actie'] ();
	}else{
		echo 'Sorry, deze functie is niet gevonden';
	}
}
?>