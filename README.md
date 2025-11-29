# SECRET DIARY - Laravel Diary Website

A beautiful Laravel application with Role-Based Access Control (RBAC) for submitting anonymous diary entries. Features a pink-themed UI, public anonymous message display, and personal story tracking.

## Features

- Beautiful pink-themed UI with custom hero images
- User authentication (login, register, logout)
- Role-Based Access Control (RBAC) using Spatie Laravel Permission
- Anonymous diary entry submission
- Public display of anonymous messages in "DEAR DIARY" section
- Personal "My Stories" section to track all submissions
- Responsive design

## Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- MySQL
- Node.js & npm

### Installation

1. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Configure environment:**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

3. **Setup database:**
   - Update `.env` with your database credentials
   - Create database: `CREATE DATABASE laravel_aivie;`
   - Run migrations: `php artisan migrate --seed`

4. **Start server:**
   ```bash
   php artisan serve
   # Or on Windows: .\start-server.ps1
   ```

5. **Access:** `http://localhost:8000`

## Default Accounts

After running seeders:
- **Admin**: `admin@example.com` / `password`
- **User**: `user@example.com` / `password`

## Documentation

For complete system documentation, architecture details, and code explanations, see **[DOCUMENTATION.md](DOCUMENTATION.md)**

## Tech Stack

- **Backend**: Laravel 10.50.0
- **Database**: MySQL
- **RBAC**: Spatie Laravel Permission
- **Frontend**: Blade Templates, Inline CSS
- **Color Scheme**: Pink (#E94E90, #ec4899)

