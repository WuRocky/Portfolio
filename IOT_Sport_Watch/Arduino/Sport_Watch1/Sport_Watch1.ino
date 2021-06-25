#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

Adafruit_SSD1306 display(128, 64, &Wire, -1);
/////////////////////////////////////////^^^OLED^^^//////////////////////////////////////////
#include "DHT.h"
#define DHTPIN 19
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);
float h;
float t;
float f;
double heat_index = 0;
/////////////////////////////////////////^^^DHT^^^///////////////////////////////////////////
#define keyup 4
#define keydown 23

#define uchar unsigned char
int up_val, down_val;

uchar func_index = 0;
void (*current_operation_index)();

#define sp 5
int val = 0;
int count = 0;
/////////////////////////////////////////////^^^按键管脚^^^////////////////////////////////////////////////
#include <WiFi.h>
#include "time.h"

const char *ssid = "TP-LINK_7F99";
const char *password = "5544332211";
//////////////////////////////////////////////^^^wife^^^//////////////////////////////////////////////////
#include <HTTPClient.h>
bool stride_frequency(float total_acc);
void upload_data_by_http(String http_post);

long upload_sec = 0;
long upload_delta = 0;

const char *serverName = "http://34.92.111.145/test0607.php"; //準備上傳到伺服器端的網址名稱"http://34.92.111.145"為伺服器ip所在，"/insertData.php"為準備執行的php檔
String apiKeyValue = "tPmAT5Ab3j7F9";                         //php檔中所寫好的apikey，必須和php當中的aipkey相同
String sensorName = "Max30102";
String sensorLocation = "Outdoor";
/////////////////////////////////////////////^^^upload^^^//////////////////////////////////////////
#define buzzerPin 18
const int pwm = 0;
const int res = 10;
///////////////////////////////////////////^^^BZ^^^////////////////////////////////////////////////
#include "MAX30105.h"
#include "heartRate.h"

MAX30105 particleSensor;

const byte RATE_SIZE = 4; //要用幾筆數據計算平均心跳
byte rates[RATE_SIZE];    //計算平均心律用的陣列
byte rateSpot = 0;
long lastBeat = 0;    //紀錄上次心跳的時間
float beatsPerMinute; //輸出當下的心跳
int beatAvg;          //平均心跳
float total_acceleration = 0;
//////////////////////////////////////////////////^^^max30102^^^//////////////////////////////////////////////////
const char *ntpServer = "pool.ntp.org";
const long gmtOffset_sec = 25200;
const int daylightOffset_sec = 3600;

struct tm timeinfo;
/////////////////////////////////////////////^^^time^^^/////////////////////////////////////////////////////
typedef struct
{
  uchar current;
  uchar up;   //向上翻索引号
  uchar down; //向下翻索引号
  void (*current_operation)();
} key_table;
/////////////////////////////////////////////^^^按鍵^^^////////////////////////////////////////////////
void (*current)(void);
void menu11(void);
void menu21(void);
void menu31(void);

key_table code_table[8] =
    {
        {0, 2, 1, (*menu11)}, //主界面 上 下 E time
        {1, 0, 2, (*menu21)}, // temperature
        {2, 1, 0, (*menu31)}, // Heart
};
////////////////////////////////////////////^^^menu^^^//////////////////////////////////////////////
void setup()
{
  Serial.begin(115200);
  Serial.printf("Connecting to %s ", ssid);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println(" CONNECTED");

  //init and get the time
  configTime(gmtOffset_sec, daylightOffset_sec, ntpServer);
  ptLTime();

  //disconnect WiFi as it's no longer needed
  //WiFi.disconnect(true);
  //WiFi.mode(WIFI_OFF);
  ////////////////////////////////////////////^^^wifi+time^^^^////////////////////////////////////////////////////
  if (!particleSensor.begin(Wire, I2C_SPEED_FAST)) //Use default I2C port, 400kHz speed
  {
    Serial.println("MAX30105 was not found. Please check wiring/power. ");
    while (1)
      ;
  }
  Serial.println("Place your index finger on the sensor with steady pressure.");
  //心率偵測器其他參數設定
  particleSensor.setup();                    //Configure sensor with default settings
  particleSensor.setPulseAmplitudeRed(0x0A); //Turn Red LED to low to indicate sensor is running
  particleSensor.setPulseAmplitudeGreen(0);  //Turn off Green LED
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  dht.begin();
  /////////////////////////////////////////^^^^DHT^^^////////////////////////////////////////////////////
  display.begin(SSD1306_SWITCHCAPVCC, 0x3C);
  display.setTextColor(WHITE); //开像素点发光
  display.clearDisplay();      //清屏 vc
  ////////////////////////////////////////////^^^OLED^^^///////////////////////////////////////////////////
  menu11();
  //////////////////////////////////////^^^menu^^^////////////////////////////////////////////////
  pinMode(keyup, INPUT_PULLUP); //上拉输入模式
  pinMode(keydown, INPUT_PULLUP);
  pinMode(sp, INPUT_PULLUP);
  ///////////////////////////////////^^^button^^^/////////////////////////////////////////////////////////////
  pinMode(buzzerPin, OUTPUT);
  ledcAttachPin(buzzerPin, pwm);
  ledcSetup(pwm, 1000, res);
  ///////////////////////////////////^^^BZ^^^////////////////////////////////////////////////////////////
}
void loop()
{
  up_val = digitalRead(keyup);
  down_val = digitalRead(keydown);
  val = digitalRead(sp);
  /////////////////////////////////////^^^button^^^////////////////////////////////////////////////////////////////////////
  h = dht.readHumidity();        //讀取濕度值 h
  t = dht.readTemperature();     //讀取攝氏溫度值 t
  f = dht.readTemperature(true); //讀取華氏溫度值 f
                                 ///////////////////////////////////////////^^^DHT^^^////////////////////////////////////////////////////////////////////////////
  ptLTime();
  ///////////////////////////////////////////^^^time^^^///////////////////////////////////////////////////////////////////////////////
  heat_index = -42.379 + (2.04901523 * f) + (10.14333127 * h) + (-0.22475541 * h * f) + (-6.83783E-3 * pow(f, 2)) + (-5.481717E-2 * pow(h, 2)) + (1.22874E-3 * pow(f, 2) * h) + (8.5282E-4 * f * pow(h, 2)) + (-1.99E-6 * pow(f, 2) * pow(h, 2));
  //////////////////////////////////////^^^heat_index^^^///////////////////////////////////////////////////////////////////////
  long irValue = particleSensor.getIR(); //讀取IR光強度

  if (checkForBeat(irValue) == true) //偵測心跳一下旗標為真，之後計算時間差之後便可得到心率
  {
    //計算心率的主要部分
    long delta = millis() - lastBeat; //計算時間差(單位毫秒)，用來計算頻率
    lastBeat = millis();
    beatsPerMinute = 60 / (delta / 1000.0);

    //當心率在合理範圍內，便用來計算平均心率(之後可刪掉測試，減輕效能)
    if (beatsPerMinute < 255 && beatsPerMinute > 20)
    {
      rates[rateSpot++] = (byte)beatsPerMinute; //Store this reading in the array
      rateSpot %= RATE_SIZE;                    //Wrap variable
      //Take average of readings
      beatAvg = 0;
      for (byte x = 0; x < RATE_SIZE; x++)
      {
        beatAvg += rates[x];
      }
      beatAvg /= RATE_SIZE;
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ((up_val == LOW) || (down_val == LOW))
  {
    delay(10); //消抖
    if (up_val == LOW)
    {
      while (!up_val) //松手检
      {
        up_val = digitalRead(keyup);
        current_operation_index = code_table[func_index].current_operation;
        (*current_operation_index)(); //执行当前操作函数
      }
      display.clearDisplay();
      func_index = code_table[func_index].up; //向上
    }

    if (down_val == LOW)
    {
      while (!down_val) //松手检
      {
        down_val = digitalRead(keydown);
        current_operation_index = code_table[func_index].current_operation;
        (*current_operation_index)(); //执行当前操作函数
      }
      display.clearDisplay();
      func_index = code_table[func_index].down; //向下翻
    }
  }

  /////////////////////////////////////^^^button^^^/////////////////////////////////////////////
  if (val == LOW)
  {
    delay(200);
    while (digitalRead(sp) == LOW)
      ;
    count++;
    Serial.printf("count = %d \n", count);
    if (count == 1)
    {
      bz_mode();
      while (count == 1)
      {
        val = digitalRead(sp);
        if (val == LOW)
        {
          delay(200);
          while (digitalRead(sp) == LOW)
            ;
          count++;
        }
      }
      while (count == 2)
      {
        display.clearDisplay();   //清屏
        display.setTextSize(2);   //设置字体大小
        display.setCursor(5, 25); //设置显示位置
        display.println("Sport Mode");
        display.setTextSize(1);    //设置字体大小
        display.setCursor(45, 50); //设置显示位置
        display.println("<stop>");
        display.display();                     // 开显示
        long irValue = particleSensor.getIR(); //讀取IR光強度
        if (checkForBeat(irValue) == true)
        {
          //計算心率的主要部分
          long delta = millis() - lastBeat; //計算時間差(單位毫秒)，用來計算頻率
          lastBeat = millis();
          beatsPerMinute = 60 / (delta / 1000.0);
        }

        String httpRequwstData = "api_key=" + apiKeyValue + "&sensor=" + sensorName + "&location=" + sensorLocation + "&Heart_Rate=" + String(beatsPerMinute) + "";

        upload_delta = millis() - upload_sec;
        if (upload_delta >= 1010)
        {
          upload_sec = millis();
          upload_delta = 0;
          upload_data_by_http(httpRequwstData);
        }
        val = digitalRead(sp);
        if (val == LOW)
        {
          delay(200);
          while (digitalRead(sp) == LOW)
            ;
          count++;
        }
      }
      count = 0;
    }
  }
  ///////////////////////////////////////^^^sp_mode^^^////////////////////////////////////////////////
  current_operation_index = code_table[func_index].current_operation;
  (*current_operation_index)(); //执行当前操作函数
}

void menu11(void)
{
  display.clearDisplay();  //清屏
  display.setTextSize(1);  //设置字体大小
  display.setCursor(0, 0); //设置显示位置
  display.println(&timeinfo, "%B %d %Y");
  display.setTextSize(3);
  display.setCursor(20, 20); //设置显示位置
  display.println(&timeinfo, "%H:%M");
  display.setTextSize(1);
  display.setCursor(110, 55);
  display.println("WX>");
  display.setTextSize(1);
  display.setCursor(0, 55);
  display.println("<BPM");
  display.setCursor(60, 55);
  display.println("SP");
  display.display(); // 开显示
}
void menu21(void)
{
  display.clearDisplay();  //清屏
  display.setTextSize(1);  //设置字体大小
  display.setCursor(0, 0); //设置显示位置
  display.print("Humidity:");
  display.setCursor(55, 0);
  display.print(h);
  display.setCursor(0, 15);
  display.print("*C:");
  display.setCursor(20, 15);
  display.print(t);
  display.setCursor(0, 30);
  display.print("heat index:");
  display.setCursor(65, 30);
  display.println(heat_index);
  heat();
  display.setCursor(101, 55);
  display.println("BPM>");
  display.setTextSize(1);
  display.setCursor(0, 55);
  display.println("<TIME");
  display.setCursor(60, 55);
  display.println("SP");
  display.display(); // 开显示
}
void menu31(void)
{
  display.clearDisplay();  //清屏
  display.setTextSize(1);  //设置字体大小
  display.setCursor(0, 0); //设置显示位置
  display.println("BPM=");
  display.setCursor(25, 0);
  display.println(beatsPerMinute);
  display.setCursor(0, 30);
  display.println("beatAvg=");
  display.setCursor(52, 30);
  display.println(beatAvg);
  display.setTextSize(1);
  display.setCursor(98, 55);
  display.println("TIME>");
  display.setTextSize(1);
  display.setCursor(0, 55);
  display.println("<WX");
  display.setCursor(60, 55);
  display.println("SP");
  display.display(); // 开显示
}
/////////////////////////////////////////////////////////////////////////////////////////////////
void ptLTime()
{

  if (!getLocalTime(&timeinfo))
  {
    Serial.println("Failed to obtain time");
    return;
  }
  //Serial.println(&timeinfo, "%A, %B %d %Y %H:%M:%S");
}
////////////////////////////////////////////^^^time^^^///////////////////////////////////////////
void upload_data_by_http(String http_post)
{
  if (WiFi.status() == WL_CONNECTED) //確認wifi連線狀況，連上便上傳數據，否則報錯
  {
    HTTPClient http;                                                     //設定ESP32為Client端
    http.begin(serverName);                                              //根據servername執行網址中的php檔
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //設定封包標頭，是固定的不用改
    Serial.print("httpRequestData: ");                                   //顯示準備上傳的資料
    Serial.println(http_post);
    int httpResponseCode = http.POST(http_post); //上傳資料

    //回傳上傳數據的狀態，可透過Respondecode來得知封包的狀況，問google大神
    if (httpResponseCode > 0)
    {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else
    {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    http.end(); //釋放http的資源
  }
  else
  {
    Serial.println("WiFi Disconnected");
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////
void bz_mode()
{
  int i = 0;
  display.clearDisplay(); //清屏
  display.setTextSize(2);

  if (heat_index >= 80 && heat_index <= 90)
  {
    display.setCursor(25, 25);
    display.print("Caution ");
    display.display(); // 开显示
    ledcWrite(pwm, 512);
    delay(50);
    ledcWrite(pwm, 0);
    delay(100);
  }
  else if (heat_index > 90 && heat_index <= 105)
  {
    for (i = 0; i < 2; i++)
    {
      display.setCursor(20, 15); //设置显示位置
      display.print("Extreme");
      display.setCursor(20, 35); //设置显示位置
      display.print("Caution");
      display.display(); // 开显示
      ledcWrite(pwm, 512);
      delay(50);
      ledcWrite(pwm, 0);
      delay(100);
    }
  }
  else if (heat_index > 105 && heat_index <= 124)
  {
    for (i = 0; i < 3; i++)
    {
      display.setCursor(25, 25);
      display.print("Danger ");
      display.display(); // 开显示
      ledcWrite(pwm, 512);
      delay(50);
      ledcWrite(pwm, 0);
      delay(100);
    }
  }
  else if (heat_index > 124)
  {
    for (i = 0; i < 4; i++)
    {
      display.setCursor(20, 15); //设置显示位置
      display.print("Extreme Danger ");
      display.setCursor(20, 35); //设置显示位置
      display.print("Extreme Danger ");
      display.display(); // 开显示
      ledcWrite(pwm, 512);
      delay(50);
      ledcWrite(pwm, 0);
      delay(100);
    }
  }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
void heat()
{
  display.setCursor(20, 40);
  if (heat_index >= 80 && heat_index <= 90)
  {
    display.print("Caution ");
  }
  else if (heat_index > 90 && heat_index <= 105)
  {
    display.print("Extreme Caution ");
  }
  else if (heat_index > 105 && heat_index <= 124)
  {
    display.print("Danger ");
  }
  else if (heat_index > 124)
  {
    display.print("Extreme Danger ");
  }
}