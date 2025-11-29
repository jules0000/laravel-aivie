# Laravel Development Server Starter
# This script uses the PHP path we found earlier

$phpPath = "C:\wamp64\bin\php\php8.3.6\php.exe"
$composerPath = ".\composer.phar"

Write-Host "=" * 60 -ForegroundColor Cyan
Write-Host "Laravel Diary Website - Server Starter" -ForegroundColor Cyan
Write-Host "=" * 60

# Check if .env exists
if (-not (Test-Path ".env")) {
    Write-Host "`n⚠️  .env file not found. Creating it..." -ForegroundColor Yellow
    # Create .env from template if needed
    Write-Host "Please ensure .env file exists with database configuration." -ForegroundColor Yellow
}

Write-Host "`nStarting Laravel development server..." -ForegroundColor Green
Write-Host "Server will be available at: http://localhost:8000" -ForegroundColor Cyan
Write-Host "`nPress Ctrl+C to stop the server`n" -ForegroundColor Yellow

# Start the server
& $phpPath artisan serve

