/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=L7W7plvOIRY//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* HTML Viewport instellen en eerste APP ontwerp - APP maken */

<head>
	<title>GIO&reg; APP</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css"  media="screen" />
   </head>

   <body>
    <div class="content_header">&nbsp;</div>
	<div class="content_menu">
		<ul id="inmenuMob">
			<li class="headlink"><a href="#">Menu</a><ul><div id="submenu">
				<li><a href="/" title="Home">Home</a></li>
				<li><a href="/over+mij.html" title="Over mijn - Gio">Over mij</a></li>
				<li><a href="/mijn+videos.html" title="Mijn videos"> - Mijn videos</a></li>
				<li><a href="/mijn+tweets.html" title="Mijn tweets"> - Mijn tweets</a></li>
				<li><a href="/mijn+instagram.html" title="Mijn Intagram"> - Mijn instragram</a></li>
				<li><a href="http://www.gioxl.nl" title="Webshop" target="_blank"> >> Mijn Webshop << </a></li>
			</div></ul></li>
		</ul>
	</div>
	<div class="content">
		<h1>De GIO<sup>&reg;</sup> APP</h1>
	</div>
	<div class="content_alert">
		<h1>De GIO<sup>&reg;</sup> APP</h1>
		<p>Nu te douwloden in de Google Play Store</p>
	</div>
	<div class="footer">
		<?php
			$url = 'https://www.youtube.com/user/GameplayWorldXL/about';
	
			$html = file_get_contents($url);
			$doc = new DOMDocument();
			$doc->loadHTML($html);
			
			$xpath = new DOMXpath($doc);
			$links = $xpath->query('//span[starts-with(@class, "about-stat")]');
		
			$youtubedataArray = array();
			foreach ($links AS $youtubedata){
				$youtubedataArray[] = $youtubedata->textContent;
			}
		
			echo '<p><strong>Gio Latooy / GameplayWorldXL</strong><br />';
			echo '<em>'.$youtubedataArray[0].$youtubedataArray[1].'</em>';
		?>
	</div>
   </body>
</html>