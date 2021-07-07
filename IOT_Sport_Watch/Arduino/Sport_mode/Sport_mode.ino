//引入所需要的標頭檔
#include <WiFi.h>  
#include <HTTPClient.h>
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>
#include <Adafruit_MPU6050.h>
#include "MAX30105.h"
#include "heartRate.h"
//#include <MsTimer2.h>

bool stride_frequency(float total_acc);
void upload_data_by_http(String http_post);

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
float total_acceleration = 0;

//步頻計算相關參數
float Total_Acceleration = 0;
float Acc_Previous = 0;
float Acc_Current = 0;
float Acc_Average = 0;
bool Acc_Structrue = false;
long Acc_last = 0;
float Acc_Max = 0;
float Acc_Min = 0;
float Acc_Signal_Max = 0;
float Acc_Signal_Min = 0;
float Acc_Positive = 0;
float Acc_Negative = 0;
float Stride_Cadence = 0;
float Velocity = 0;
float Distance = 0;

long upload_sec = 0;
long upload_delta = 0;

//無線網路的熱點名稱及密碼
const char* ssid     = "BOB123";
const char* password = "open1991525";

//連線至伺服器相關參數
const char* serverName = "http://34.92.111.145/demo.php"; //準備上傳到伺服器端的網址名稱"http://34.92.111.145"為伺服器ip所在，"/insertData.php"為準備執行的php檔
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

  //G-Sensor參數設定
  mpu.setAccelerometerRange(MPU6050_RANGE_8_G);
  mpu.setGyroRange(MPU6050_RANGE_500_DEG);
  mpu.setFilterBandwidth(MPU6050_BAND_5_HZ);
  if (!mpu.begin()) 
  {
    Serial.println("Failed to find MPU6050 chip");
    while (1) 
    {
      delay(10);
    }
  }

//  MsTimer2::set(1000, upload_data_by_http);
//  MsTimer2::start();
}

void loop() 
{
  //心率偵測器執行相關程式
  long irValue = particleSensor.getIR();//讀取IR光強度
  //利用for迴圈量測重複量測光強度計算心率，迴圈之外上傳數據，之後GSensor的整合程式會寫在這裡，並且利用中斷服務程式改寫，加入計時的概念，每一秒中斷一次，中斷程式負責上傳數據
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
  //讀取gsensor數據
  sensors_event_t a, g, temp;
  mpu.getEvent(&a, &g, &temp);
  Total_Acceleration = pow((pow(a.acceleration.x, 2)+pow(a.acceleration.y, 2)+pow(a.acceleration.z, 2)), 0.5);
  
  //將加速度計算成步頻、速度及距離
  if(stride_frequency(Total_Acceleration) == true)
  {
    float Acc_delta = millis() - Acc_last;
    Acc_last = millis();
    Stride_Cadence = 1000/Acc_delta;
    Velocity = Stride_Cadence * 0.65;
    Distance += 0.65;
  }
  //在串列埠中顯示結果
//  Serial.print(", Total_acceleration: ");
//  Serial.print(Total_Acceleration);
//  Serial.println(" m/s^2");
//  Serial.print("Stride_Cadence: ");
//  Serial.print(Stride_Cadence);
//  Serial.print("Velocity: ");
//  Serial.print(Velocity);
//  Serial.print("Distance: ");
//  Serial.println(Distance);
//  Serial.print("IR=");
//  Serial.print(irValue);
//  Serial.print(", BPM=");
//  Serial.println(beatsPerMinute);

  String httpRequwstData = "api_key=" + apiKeyValue + "&sensor=" + sensorName
                          + "&location=" + sensorLocation + "&Heart_Reat=" + String(beatsPerMinute)
                          + "&Stride_Cadence=" + String(Stride_Cadence) + "&Velocity=" + String(Velocity) 
                          + "&Distance=" + String(Distance) + "";
  
  upload_delta = millis() - upload_sec;
  if(upload_delta >= 1010)
  {
    upload_sec = millis();
    upload_delta = 0;
    upload_data_by_http(httpRequwstData);
  }
}

bool stride_frequency(float Total_Acc)
{
  Acc_Structrue = false;
  Acc_Previous = Acc_Current;

  //計算加速度平均(直流DC部分)
  if(Acc_Average == 0)
  {
    Acc_Average = Total_Acc;
  }
  else
  {
    Acc_Average = (Acc_Average + Total_Acc)/2;
  }

  //計算加速度的變化量(交流AC部分)
  Acc_Current = Total_Acc - Acc_Average;

  //旗標及極值判斷，極值用於防止彈跳
  if((Acc_Previous < 0) & (Acc_Current >= 0))//判斷訊號的AC部分的變號，變號由負變正，判斷了合理的峰對峰後，變舉起一個完整周期的旗標，提供外部既時候計算步頻
  {
    Acc_Max = Acc_Signal_Max;
    Acc_Min = Acc_Signal_Min;
    Acc_Positive = 1;
    Acc_Negative = 0;

    Acc_Signal_Max = 0;//進入正半周，最大值初始化，重新開始新一輪的計算
    if((Acc_Max - Acc_Min) > 2 & (Acc_Max - Acc_Min) < 30)//防止彈跳的判斷式
    {
      Acc_Structrue = true;
    }
  }

  if((Acc_Previous > 0) & (Acc_Current <= 0))//判斷AC部分變號，由正轉負，只需初始化最小值，狀態旗標不用改變
  {
    Acc_Positive = 0;
    Acc_Negative = 1;
    Acc_Signal_Min = 0;  
  }

  //儲存極值的判斷
  if((Acc_Positive == 1) & (Acc_Current > Acc_Previous))//極大值
  {
    Acc_Signal_Max = Acc_Current; 
  }
  if((Acc_Negative == 1) & (Acc_Current < Acc_Previous))//極小值
  {
    Acc_Signal_Min = Acc_Current; 
  }
  return(Acc_Structrue);
}

void upload_data_by_http(String http_post)
{
  if(WiFi.status()== WL_CONNECTED)//確認wifi連線狀況，連上便上傳數據，否則報錯
  {
    HTTPClient http;//設定ESP32為Client端
    http.begin(serverName);//根據servername執行網址中的php檔
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");//設定封包標頭，是固定的不用改                          
    Serial.print("httpRequestData: ");//顯示準備上傳的資料
    Serial.println(http_post);   
    int httpResponseCode = http.POST(http_post);//上傳資料

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
}
