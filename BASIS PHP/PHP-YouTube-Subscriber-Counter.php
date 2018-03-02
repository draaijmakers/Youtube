/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=Iztkx-qOAZk//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Youtube subscriber counter - Maken in PHP */

<?php
	// YouTube link
	$url = 'https://www.youtube.com/user/draaijmaker/about';

	// Haal de html code op
	$html = file_get_contents($url);
	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML($html);
	$xpath = new DOMXpath($doc);
	
	// Ga opzoek naar alle SPAN tages die beginnen met class="about-stat"
	$links = $xpath->query('//span[starts-with(@class, "about-stat")]');

	// Lees $links uit en vul deze in een Array
	$youtubedataArray = array();
	foreach ($links AS $youtubedata){
		// Gebruik allen de gegevens in textContent
		$youtubedataArray[] = $youtubedata->textContent;
	}
	
	// Laat het resultaat zien
	echo '<p><strong>Davey Raaijmakers Stats</strong><br />';
	echo '<em>'.$youtubedataArray[0].$youtubedataArray[1].'</em>';
?>