@echo off
title AssetOps Launcher

:: Minta hak Administrator secara otomatis jika belum
net session >nul 2>&1
if %errorlevel% neq 0 (
    echo Meminta izin Administrator...
    powershell -Command "Start-Process cmd -ArgumentList '/c cd /d C:\xampp\htdocs\assetops && jalankan.bat' -Verb RunAs"
    exit
)

color 0B
echo ===================================================
echo             MEMULAI APLIKASI ASSETOPS
echo ===================================================
echo.

echo [1/4] Menghidupkan MySQL (XAMPP)...
net start mysql >nul 2>&1
if %errorlevel% neq 0 (
    echo  [!] Mencoba via mysqld.exe langsung...
    start "" /b "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini"
    timeout /t 2 /nobreak > NUL
)
echo  OK - MySQL siap.

echo.
echo [2/4] Menghidupkan MinIO (Docker) untuk penyimpanan foto...
docker-compose up -d >nul 2>&1
if %errorlevel% neq 0 (
    echo  [!] Docker tidak berjalan atau tidak terinstall.
    echo  [!] Foto tiket mungkin tidak bisa diupload.
    echo  [!] Pastikan Docker Desktop sudah aktif lalu coba lagi.
) else (
    echo  OK - MinIO siap di http://localhost:9001
)

echo.
echo [3/4] Menjalankan Server Laravel...
start "Laravel Server" cmd /k "cd /d C:\xampp\htdocs\assetops && php artisan serve"

echo.
echo [4/4] Menjalankan Server Desain (Vite)...
start "Vite Dev Server" cmd /k "cd /d C:\xampp\htdocs\assetops && npm run dev"

echo.
echo ===================================================
echo  AssetOps berhasil dijalankan!
echo  Browser akan terbuka dalam 5 detik...
echo.
echo  - Web App  : http://localhost:8000
echo  - MinIO    : http://localhost:9001
echo ===================================================
echo.
echo  Tutup jendela Laravel Server dan Vite Dev Server
echo  untuk mematikan, atau jalankan hentikan.bat
echo.

timeout /t 5 /nobreak > NUL
start http://localhost:8000

exit
