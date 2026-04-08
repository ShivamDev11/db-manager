@echo off
echo Starting Database Manager Server...
echo.
cd /d "%~dp0public"
php -S 127.0.0.1:8080 index.php
pause