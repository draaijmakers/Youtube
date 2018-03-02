/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=cGVzOsoU7No//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* WEMOS board testen met BLINKY - ESP8226 #4 */

/*
 ESP8266 Blinky door Davey Raaijmakers
 Met deze code kunnen we de ingeboude LED op de ESP8266 laten knipperen
 
 De blauwe LED zal werken op de GPIO1 pin, gelijk aan de D2 op de WEMOS
*/

void setup() {
  pinMode(LED_BUILTIN, OUTPUT);     // Geef aan welke pin we willen aanroepen, en dat het gaat om een OUTPUT
}

// the loop function runs over and over again forever
void loop() {
  digitalWrite(LED_BUILTIN, LOW);   // Zet de LED lamp aan
  delay(1000);                      // Wacht een seconde
  digitalWrite(LED_BUILTIN, HIGH);  // Zet de LED uit
  delay(2000);                      // Wacht twee seconde
}