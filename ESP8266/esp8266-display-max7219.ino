/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=uBTpCNf4d64//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* MAX7219 aansturen met WEMOS D1 - ESP8226 #8 */

/*
    0x00    //0
    0x01    //1
    0x02    //2
    0x03    //3
    0x04    //4
    0x05    //5
    0x06    //6
    0x07    //7
    0x08    //8
    0x09    //9
    0x0A    //-
    0x0B    //E
    0x0C    //H
    0x0D    //L
    0x0E    //P
    0x0F    //BLANK
 */

#define MAX7219_Data_IN D4
#define MAX7219_Chip_Select  D3
#define MAX7219_Clock D2

void shift(byte send_to_address, byte send_this_data){
  digitalWrite(MAX7219_Chip_Select, LOW);
  shiftOut(MAX7219_Data_IN, MAX7219_Clock, MSBFIRST, send_to_address);
  shiftOut(MAX7219_Data_IN, MAX7219_Clock, MSBFIRST, send_this_data);
  digitalWrite(MAX7219_Chip_Select, HIGH);
}

void setup() {
  pinMode(MAX7219_Data_IN, OUTPUT);
  pinMode(MAX7219_Chip_Select, OUTPUT);
  pinMode(MAX7219_Clock, OUTPUT);
  digitalWrite(MAX7219_Chip_Select, HIGH);
  
  //Setup
  shift(0x0f, 0x00); // Haal hem uit de test modus
  shift(0x0c, 0x01); // Gebruik de normale stand
  shift(0x0b, 0x07); // Uit hoeveel caracters bestaat het scherm, tussen de 0 en de 7
  shift(0x0a, 0x0f); // Zet het schrem op maximale felte
  shift(0x09, 0xff); // Welke code gaan we gebruiken - CodeB
}

void loop() {  
  //Data transfer
  shift(0x01, 0x0f);
  shift(0x02, 0x00);//O
  shift(0x03, 0x0D);//L
  shift(0x04, 0x0D);//L
  shift(0x05, 0x0B);//E
  shift(0x06, 0x0C);//H
  shift(0x07, 0x0f); 
  shift(0x08, 0x0f); 
  delay(1000);

  shift(0x01, 0x0f);
  shift(0x02, 0x0f);
  shift(0x03, 0x08);//8
  shift(0x04, 0x01);//1
  shift(0x05, 0x00);//0
  shift(0x06, 0x02);//2
  shift(0x07, 0x0f); 
  shift(0x08, 0x0f); 
  delay(1000);
 }
