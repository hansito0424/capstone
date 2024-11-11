#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DHT.h>
#include <NTPClient.h>
#include <WiFiUdp.h>
#include <TimeLib.h>
#include <ArduinoJson.h>

// WiFi credentials
const char* ssid = "HUAWEI-2.4G-YxM6";
const char* pass = "Nb2suby6";

// NTP Client setup
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", 0, 60000);  // 1 min update interval

// DHT11 sensor setup
DHT dht(D4, DHT11);

// Pin definitions
#define soil A0         // Soil moisture sensor
#define PIR D5          // PIR motion sensor
#define RELAY_PIN_1 D1  // Relay for watering
#define SWITCH_PIN D7    // Switch control

int relay1State = LOW;

// Previous state variables
float lastTemperature = -1;
float lastHumidity = -1;
int lastSoilMoisture = -1;
bool lastPirState = false;

// WiFi client
WiFiClient wifiClient;

// Setup server URLs
String serverUrl = "http://192.168.100.33/capstone/";
String sendDataUrl = serverUrl + "update-sensor-data.php";
String getControlUrl = serverUrl + "get-control-data.php";

void setup() {
  Serial.begin(9600);

  // WiFi connection
  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  // Initialize NTP
  timeClient.begin();
  timeClient.update();
  setSyncProvider(getNtpTime);
  setSyncInterval(3600);  // Sync every hour

  // Initialize sensors and relay
  dht.begin();
  pinMode(soil, INPUT);
  pinMode(PIR, INPUT);
  pinMode(RELAY_PIN_1, OUTPUT);
  pinMode(SWITCH_PIN, INPUT_PULLUP);  // Use pull-up resistor for the switch
  digitalWrite(RELAY_PIN_1, LOW);
}

void loop() {
  // Update NTP time
  timeClient.update();

  // Read sensor data
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  int soilMoisture = analogRead(soil);
  soilMoisture = map(soilMoisture, 0, 1024, 0, 100);
  soilMoisture = (soilMoisture - 100) * -1;
  bool pirState = digitalRead(PIR);

  // Check if any sensor data has changed before sending
  if (hasDataChanged(t, h, soilMoisture, pirState)) {
    sendDataToServer(t, h, soilMoisture, pirState);
  }

  // Check control data from the server
  getControlDataFromServer();

  // Fetch watering schedule periodically (e.g., every minute)
  static unsigned long lastFetchTime = 0;
  if (millis() - lastFetchTime >= 60000) { // fetch every minute
    fetchWateringSchedule();
    lastFetchTime = millis();
  }

  // Check switch state to control relay manually
  if (digitalRead(SWITCH_PIN) == LOW) {  // Switch pressed
    relay1State = !relay1State;           // Toggle relay state
    digitalWrite(RELAY_PIN_1, relay1State);
    Serial.println(relay1State ? "Relay turned ON" : "Relay turned OFF");
    delay(500); // Debounce delay for switch
  }

  delay(500);  // Delay for 0.5 seconds
}

bool hasDataChanged(float temperature, float humidity, int soilMoisture, bool pirState) {
  if (temperature != lastTemperature) {
    lastTemperature = temperature;
    return true;
  }
  if (humidity != lastHumidity) {
    lastHumidity = humidity;
    return true;
  }
  if (soilMoisture != lastSoilMoisture) {
    lastSoilMoisture = soilMoisture;
    return true;
  }
  if (pirState != lastPirState) {
    lastPirState = pirState;
    return true;
  }
  return false;
}

void sendDataToServer(float temperature, float humidity, int soilMoisture, bool pirState) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(wifiClient, sendDataUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String postData = "temperature=" + String(temperature) +
                      "&humidity=" + String(humidity) +
                      "&soilMoisture=" + String(soilMoisture) +
                      "&pirState=" + String(pirState);

    int httpResponseCode = http.POST(postData);
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.println("Error sending data");
    }
    http.end();
  }
}

void getControlDataFromServer() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(wifiClient, getControlUrl);
    int httpResponseCode = http.GET();
    if (httpResponseCode > 0) {
      String response = http.getString();

      // Control the relay based on the response
      if (response == "RELAY_OFF" && relay1State == LOW) {
        relay1State = HIGH;
        digitalWrite(RELAY_PIN_1, HIGH);
      } else if (response == "RELAY_ON" && relay1State == HIGH) {
        relay1State = LOW;
        digitalWrite(RELAY_PIN_1, LOW);
      }
    } else {
      Serial.println("Error receiving control data");
    }
    http.end();
  }
}

// Function to get time from NTP
time_t getNtpTime() {
  return timeClient.getEpochTime();
}

// Function to check if it's time to water based on schedule
