@ECHO OFF
CLS

set webdriver.ie.driver=%~dp0IEDriverServer.exe
set webdriver.chrome.driver=%~dp0chromedriver.exe
set selenium.server=%~dp0selenium-server-standalone-2.33.0.jar
set drivers=-Dwebdriver.ie.driver=%webdriver.ie.driver% -Dwebdriver.chrome.driver=%webdriver.chrome.driver%

java %drivers% -jar %selenium.server%