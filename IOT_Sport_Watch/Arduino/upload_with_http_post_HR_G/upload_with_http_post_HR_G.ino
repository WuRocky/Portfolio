//引入所需要的標頭檔
#include <WiFi.h>  
#include <HTTPClient.h>
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>
#include <Adafruit_MPU6050.h>
#include "MAX30105.h"
#include "heartRate.h"

//感測器物件設定
MAX30105 particleSensor;
Adafruit_MPU6050 mpu;

//心律感測器變數定義
const byte RATE_SIZE = 4; //要用幾筆數據計算平均心跳
byte rates[RATE_SIZE]; //計算平均心律用的陣列
byte rateSpot = 0;
long lastBeat = 0; //紀錄上次心跳的時間
float beatsPerMinute;//輸出當下的心跳
int beatAvg;//平均心跳

//無線網路的熱點名稱及密碼
const char* ssid     = "BOB123";
const char* password = "open1991525";

//連線至伺服器相關參數
const char* serverName = "http://34.92.111.145/insertData.php"; //準備上傳到伺服器端的網址名稱"http://34.92.111.145"為伺服器ip所在，"/insertData.php"為準備執行的php檔
String apiKeyValue = "tPmAT5Ab3j7F9";//php檔中所寫好的apikey，必須和php當中的aipkey相同
String sensorName = "Max30102";
String sensorLocation = "Outdoor";

//其他參數設定
#define SEALEVELPRESSURE_HPA (1013.25)//大氣壓力????????
Adafruit_BME280 bme;  // 開啟I2C通訊協定，並且不定義任何腳位

void setup() 
{
  Serial.begin(115200);//鮑率設定
  
  //wifi設定
  WiFi.begin(ssid, password);//透過ssid、password開啟wifi通訊
  Serial.println("Connecting");//顯示wifi狀態
  while(WiFi.status() != WL_CONNECTED) 
  { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  //心率偵測器I2C狀態顯示
  if (!particleSensor.begin(Wire, I2C_SPEED_FAST)) //Use default I2C port, 400kHz speed
  {
    Serial.println("MAX30105 was not found. Please check wiring/power. ");
    while (1);
  }
  Serial.println("Place your index finger on the sensor with steady pressure.");
  //心率偵測器其他參數設定
  particleSensor.setup(); //Configure sensor with default settings
  particleSensor.setPulseAmplitudeRed(0x0A); //Turn Red LED to low to indicate sensor is running
  particleSensor.setPulseAmplitudeGreen(0); //Turn off Green LED
}

void loop() 
{
  //心率偵測器執行相關程式
  long irValue = particleSensor.getIR();//讀取IR光強度
  //利用for迴圈量測重複量測光強度計算心率，迴圈之外上傳數據，之後GSensor的整合程式會寫在這裡，並且利用中斷服務程式改寫，加入計時的概念，每一秒中斷一次，中斷程式負責上傳數據
  for(int i = 0 ; i < 2000 ; i++)
    {
      if (checkForBeat(irValue) == true)//偵測心跳一下旗標為真，之後計算時間差之後便可得到心率
      {
        //計算心率的主要部分
        long delta = millis() - lastBeat;//計算時間差(單位毫秒)，用來計算頻率
        lastBeat = millis();
        beatsPerMinute = 60 / (delta / 1000.0);
        
        //當心率在合理範圍內，便用來計算平均心率(之後可刪掉測試，減輕效能)
        if (beatsPerMinute < 255 && beatsPerMinute > 20)
        {
          rates[rateSpot++] = (byte)beatsPerMinute; //Store this reading in the array
          rateSpot %= RATE_SIZE; //Wrap variable
          //Take average of readings
          beatAvg = 0;
          for (byte x = 0 ; x < RATE_SIZE ; x++)
            beatAvg += rates[x];
          beatAvg /= RATE_SIZE;
        }
      }
      //Gsensor程式開始
  }
  
  //上傳資料程式執行
  if(WiFi.status()== WL_CONNECTED)//確認wifi連線狀況，連上便上傳數據，否則報錯
  {
    HTTPClient http;//設定ESP32為Client端
    http.begin(serverName);//根據servername執行網址中的php檔
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");//設定封包標頭，是固定的不用改
    
    //設定http post上傳的資料設定名稱必須和資料庫、php檔當中一致，數值須符合其資料型態
    String httpRequestData = "api_key=" + apiKeyValue + "&sensor=" + sensorName
                          + "&location=" + sensorLocation + "&value1=" + String(irValue)
                          + "&value2=" + String(beatAvg) + "&value3=" + String(beatsPerMinute) + "";
                          
    Serial.print("httpRequestData: ");//顯示準備上傳的資料
    Serial.println(httpRequestData);   
    int httpResponseCode = http.POST(httpRequestData);//上傳資料

    //回傳上傳數據的狀態，可透過Respondecode來得知封包的狀況，問google大神
    if (httpResponseCode>0) 
    {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else 
    {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    http.end();//釋放http的資源
  }
  else 
  {
    Serial.println("WiFi Disconnected");
  }
  //Send an HTTP POST request every 30 seconds
//  delay(10000);  
}
