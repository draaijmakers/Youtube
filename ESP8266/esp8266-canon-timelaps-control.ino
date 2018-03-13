/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://youtu.be/6mk28cH3hLc               //
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Hoe maak je een TIMELAPSE Controller [CANON] | ESP8226 #11 */

// Geef de start waarden op
#define MAX7219_Data_IN D4
#define MAX7219_Chip_Select  D3
#define MAX7219_Clock D2

// Poort waar de Camera op zit
#define Camera  D5  //4 straat voor D2

// Wat is de tijd tsseun elke foto
int Delay = 10; // SEC
int Time = Delay; // SEC

// Hoeveel fotos zijn er gemaakt
int Countphoto = 0;

byte adr = 0x08;
byte num = 0x00;

void shift(byte send_to_address, byte send_this_data){
  digitalWrite(MAX7219_Chip_Select, LOW);
  shiftOut(MAX7219_Data_IN, MAX7219_Clock, MSBFIRST, send_to_address);
  shiftOut(MAX7219_Data_IN, MAX7219_Clock, MSBFIRST, send_this_data);
  digitalWrite(MAX7219_Chip_Select, HIGH);
}

void setup() {
  Serial.begin(115200);
  pinMode(MAX7219_Data_IN, OUTPUT);
  pinMode(MAX7219_Chip_Select, OUTPUT);
  pinMode(MAX7219_Clock, OUTPUT);
  digitalWrite(MAX7219_Chip_Select, HIGH);

  // Maak een outpoet aan
  pinMode(Camera, OUTPUT);     // Geef aan welke pin we willen aanroepen, en dat het gaat om een OUTPUT
  digitalWrite(Camera, LOW);   // Zet de LED lamp UIT
  
  //Setup
  shift(0x0f, 0x00); // Haal hem uit de test modus
  shift(0x0c, 0x01); // Gebruik de normale stand
  shift(0x0b, 0x07); // Uit hoeveel caracters bestaat het scherm, tussen de 0 en de 7
  shift(0x0a, 0x0f); // Zet het schrem op maximale felte
  shift(0x09, 0xff); // Welke code gaan we gebruiken - CodeB
}

void startTijd(){
  digitalWrite(Camera, LOW);   // Zet de LED lamp UIT
  Time = Time-1;

  if (Time < 1){
    digitalWrite(Camera, HIGH);   // Zet de LED lamp AAN
    Time = Delay;
    Countphoto = Countphoto+1;  
  }
}

void loop() {
  startTijd();
  
  // Vraag de legint van de string op
  String totaaltijd = String(Countphoto,DEC) + "---" + String(Time,DEC);
  int tijdArray = totaaltijd.length();
  if(tijdArray==8){shift(0x0b, 0x07); adr=0x01;}        
  if(tijdArray==7){shift(0x0b, 0x06); adr=0x01;}
  if(tijdArray==6){shift(0x0b, 0x05); adr=0x01;}
  if(tijdArray==5){shift(0x0b, 0x04); adr=0x01;}
  if(tijdArray==4){shift(0x0b, 0x03); adr=0x01;}
  if(tijdArray==3){shift(0x0b, 0x02); adr=0x01;}
  if(tijdArray==2){shift(0x0b, 0x01); adr=0x01;}
  if(tijdArray==1){shift(0x0b, 0x00); adr=0x01;}
  tijdArray = tijdArray-1;

  // Schrijf de cijvers op
  while (tijdArray >= 0){
    if(totaaltijd[tijdArray] == '-'){num = 0x0F;}
    if(totaaltijd[tijdArray] == '9'){num = 0x09;}
    if(totaaltijd[tijdArray] == '8'){num = 0x08;}
    if(totaaltijd[tijdArray] == '7'){num = 0x07;}
    if(totaaltijd[tijdArray] == '6'){num = 0x06;}
    if(totaaltijd[tijdArray] == '5'){num = 0x05;}
    if(totaaltijd[tijdArray] == '4'){num = 0x04;}
    if(totaaltijd[tijdArray] == '3'){num = 0x03;}
    if(totaaltijd[tijdArray] == '2'){num = 0x02;}
    if(totaaltijd[tijdArray] == '1'){num = 0x01;}
    if(totaaltijd[tijdArray] == '0'){num = 0x00;}

    shift(adr, num);  
    adr=adr+0x01;
    tijdArray = tijdArray-1; 
  }
  
  delay(999);
}
