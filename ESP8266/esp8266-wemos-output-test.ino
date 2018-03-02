/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=Nj4OWB8rTG4//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* WEMOS outputs TESTEN met LED - ESP8226 #5 */

/*
 ESP8266 Blinky door Davey Raaijmakers
 Met deze code kunnen we de verschilden poorten op de ESP8266 testen
 
 WEMOS POORT   pinMode
	  D0	    GPIO16
	  D1	    GPIO5
	  D2	    GPIO4
	  D3	    GPIO0
	  D4	    GPIO2 (BUILTIN_LED)
	  D5	    GPIO14
	  D6	    GPIO12
	  D7	    GPIO13
	  D8	    GPIO15
	  G	        Ground

*/

#define LEDlamp  0    //0 straat voor D3

void setup() {
  pinMode(LEDlamp, OUTPUT);     // Geef aan welke pin we willen aanroepen, en dat het gaat om een OUTPUT
}

// the loop function runs over and over again forever
void loop() {
  digitalWrite(LEDlamp, LOW);   // Zet de LED lamp aan
  delay(1000);                  // Wacht een seconde
  digitalWrite(LEDlamp, HIGH);  // Zet de LED uit
  delay(2000);                  // Wacht twee seconde
}