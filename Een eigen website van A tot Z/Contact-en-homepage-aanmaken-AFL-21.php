 /////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=Ea4mmtX-xyM//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Een contactpagina en homepage aanmaken - Een eigen website van A tot Z */

<?php
$functie = array('film','page','contact');

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
				echo 'Sorry, er is geen film gevonden.';
			}
		}
		
		function page(){
			global $MySQL;
			
			$where = NULL;
			if (isset($_GET['id'])){
				$where = 'WHERE `pageId` = "'.$_GET['id'].'"';
			}else{
				$where = 'WHERE `pageNaam` = "home"';
			}
			
			$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `page` ".$where);
			$sqlAantal = mysqli_num_rows($sqlUitlezen);

			if ($sqlAantal == 1){
				$sqlData = mysqli_fetch_assoc($sqlUitlezen);
				echo $sqlData['pageData'];
			}else{
				echo 'Er is geen pagina gevonden.';
			}
		}
		
		function contact(){
			echo '<h1>Contact</h1><p>Heeft u een vraag/opmerking, wij staan u graag te woord.</p><p>&nbsp;</p>';
			if (isset($_POST['verzenden'])){
				$headers = 'From: Website <info@daveyraaijmakers.nl>'."\n";
				$headers .= 'Reply-To: '.$_POST['van_naam'].' <'.$_POST['van_email'].'>'."\n";
				$headers .= 'X-Mailer: PHP/' .phpversion();
				$headers .= 'Return-Path: Mail-Error <info@daveyraaijmakers.nl>'."\n";
				$headers .= 'MIME-Version: 1.0'."\n";
				$headers .= 'Content-Transfer-Encoding: 8bit'."\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1'."\n";
					
				if (mail('info@daveyraaijmakers.nl', 'Mail via website: vanAtotZ ('.$_POST['over'].')',$_POST['bericht'],$headers)){
					echo 'Goed';
				}else{
					echo 'Fout';
				}
			}
			?>
			<center>
			<table border="0">
				<form action="/?actie=contact" method="post">
					<tr><td><strong>Uw naam</strong></td><td><input type="text" name="van_naam" placeholder="Voor en achternaam" required="required" /></td></td>
					<tr><td><strong>Uw Email</strong></td><td><input type="email" name="van_email" required="required" /></td></td>
					<tr><td><strong>Het onderwerp</strong></td><td><input type="text" name="" list="onderwerp" />
						<datalist id="onderwerp">
						 <option value="Ik heb een vraag">
						 <option value="Ik heb een opmerking/klacht">
						 <option value="Ik wil meer weten">
						</datalist></td></td>
					<tr><td colspan="2"><strong>Bericht</strong><br /><textarea name="bericht" required="required" ></textarea></td></td>
					<tr><td colspan="2"><input type="submit" name="verzenden" value="verstuur"></td></td>
				</form>
			</table>
			</center>
			<?php
		}
		
		echo $_GET['actie'] ();
	}else{
		echo 'Sorry, deze functie is niet gevonden.';
	}
}
?>