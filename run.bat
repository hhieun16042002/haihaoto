@echo off
echo ==============================================
echo   Dang khoi dong Website O To Hai Ha...
echo ==============================================
cd /d "%~dp0"
docker compose up -d
echo.
echo Website dang chay tai: http://localhost:8888
echo Trang quan tri: http://localhost:8888/wp-admin
start http://localhost:8888
pause

