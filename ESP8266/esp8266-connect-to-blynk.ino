/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=qRPz9cpLlFw//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* WEMOS aansturen met BLYNK APP - ESP8226 #6 */


/*************************************************************
  Download de laatse versie via:
    https://github.com/blynkkk/blynk-library/releases/latest
 *************************************************************/

#define BLYNK_PRINT Serial
#include <ESP8266WiFi.h>
#include <BlynkSimpleEsp8266.h>

// Geef hier de toegangs Token op, deze is per mail verzonden!
char auth[] = "7323226a196a4f92abaf39a45853c8d2";

// Geef tussen de "" je Wifi naam en je Wifi wachtwoord op
char ssid[] = "draay";
char pass[] = "KorenB114";

void setup(){
  // Open de Debug monitor
  Serial.begin(9600);

  // Zet alle warden in de BLYNK functie
  Blynk.begin(auth, ssid, pass);
}

void loop(){ 
  // Run de code
  Blynk.run();
}
