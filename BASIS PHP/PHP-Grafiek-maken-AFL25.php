/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=lL-m-1qTYPk//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Grafiek maken in PHP - PHP #25 */

<!DOCTYPE html>
<html lang="nl">
   <head>
	<title>Grafiek in PHP</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="grafiek.css" rel="stylesheet" type="text/css"  media="screen" />
   </head>
<body>
	<main>		
		<?php
			$maxGroot = '500';
			$grafiekInfo = array('Ma' => '25', 'Di' => '50', 'Wo' => '89');
			
			echo '<section style="width: '.$maxGroot.'px">';
			foreach ($grafiekInfo AS $dag => $waarde){
				echo '<div class="grafiekStaaf" style="width: '.$waarde.'%">'.$dag.'</div>';
			}
			echo '</section>';
		?>
	</main>	
</body>
</html>