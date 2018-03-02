/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=GQzGRTeoZzU//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Zelf KERSTVERLICHTING maken met een WEMOS D1 MINI - ESP8226 #7 */

/*
 ESP8266 Blinky door Davey Raaijmakers
 Met deze code kunnen we de verschilden poorten op de ESP8266 testen
 
 WEMOS POORT   pinMode
    D0      GPIO16
    D1      GPIO5
    D2      GPIO4
    D3      GPIO0
    D4      GPIO2 (BUILTIN_LED)
    D5      GPIO14
    D6      GPIO12
    D7      GPIO13
    D8      GPIO15
    G       Ground

*/

#define LEDlamp1  0    //0 straat voor D3
#define LEDlamp2  4    //4 straat voor D2

void setup() {
  pinMode(LEDlamp1, OUTPUT);     // Geef aan welke pin we willen aanroepen, en dat het gaat om een OUTPUT
  pinMode(LEDlamp2, OUTPUT);     // Geef aan welke pin we willen aanroepen, en dat het gaat om een OUTPUT
}

// Strat de LOOP
void loop() {
  digitalWrite(LEDlamp1, LOW);   // Zet de LED lamp aan
  delay(1000);                  // Wacht een seconde
  digitalWrite(LEDlamp2, LOW);   // Zet de LED lamp aan
  delay(1000);                  // Wacht een seconde
  
  digitalWrite(LEDlamp1, HIGH);  // Zet de LED uit
  delay(1000);                  // Wacht twee seconde
  digitalWrite(LEDlamp2, HIGH);  // Zet de LED uit
  delay(1000);                  // Wacht twee seconde
}