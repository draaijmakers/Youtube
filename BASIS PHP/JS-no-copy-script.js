/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=PKzdh7SGJ5c//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* ﻿js code copyright code */

function clickExplorer() {
	if( document.all ) {
		alert('Al het materiaal op deze site is copyright beschermd.');
	}
	return false;
}

function clickOther(e) {
	if( document.layers  || ( document.getElementById && !document.all ) ) {
		if ( e.which == 2 || e.which == 3 ) {
			alert('Al het materiaal op deze site is copyright beschermd.');
			return false;
		}
	}
}

if( document.layers ) {
	document.captureEvents( Event.MOUSEDOWN );
	document.onmousedown=clickOther;
}else {
	document.onmouseup = clickOther;
	document.oncontextmenu = clickExplorer;
}   
window.addEvent('domready', function() { 
	document.body.oncopy = function() { 
		alert('Al het materiaal op deze site is copyright beschermd.'); 
		return false; 
	} 
});  
	 
if( typeof( document.onselectstart ) != 'undefined' )
document.onselectstart = function(){ return false };
document.ondragstart = function(){ return false }