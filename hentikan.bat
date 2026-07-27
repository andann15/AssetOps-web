@echo off
title Mematikan AssetOps
color 0C

echo ===================================================
echo             MENGHENTIKAN ASSETOPS
echo ===================================================
echo.

echo [1/4] Mematikan Server Laravel (PHP)...
taskkill /F /IM php.exe >nul 2>&1
echo  OK.

echo [2/4] Mematikan Server Desain (Node/Vite)...
taskkill /F /IM node.exe >nul 2>&1
echo  OK.

echo [3/4] Mematikan Database MySQL...
net stop mysql >nul 2>&1
if %errorlevel% neq 0 (
    taskkill /F /IM mysqld.exe >nul 2>&1
)
echo  OK.

echo [4/4] Menghentikan MinIO (Docker)...
docker-compose down >nul 2>&1
if %errorlevel% neq 0 (
    echo  [!] Docker tidak aktif atau MinIO sudah mati.
) else (
    echo  OK.
)

echo.
echo ===================================================
echo  Semua layanan AssetOps berhasil dimatikan!
echo ===================================================
echo.
pause
