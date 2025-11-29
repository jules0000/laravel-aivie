# SECRET DIARY - Complete System Documentation

## Table of Contents
1. [Project Overview](#project-overview)
2. [System Architecture](#system-architecture)
3. [Technology Stack](#technology-stack)
4. [Project Structure](#project-structure)
5. [Database Schema](#database-schema)
6. [Features & Functionality](#features--functionality)
7. [Controllers & Routes](#controllers--routes)
8. [Models & Relationships](#models--relationships)
9. [Authentication & Authorization](#authentication--authorization)
10. [Frontend Structure](#frontend-structure)
11. [Installation & Setup](#installation--setup)
12. [Configuration](#configuration)
13. [Deployment](#deployment)

---

## Project Overview

**SECRET DIARY** is a Laravel-based web application that allows users to submit anonymous diary entries. The application features a beautiful pink-themed UI, role-based access control (RBAC), and a responsive design.

### Key Features:
- Anonymous diary entry submission
- User authentication (login/register)
- Role-Based Access Control (RBAC)
- Public display of anonymous messages
- Personal story tracking
- Modern, responsive pink-themed UI

---

## System Architecture

### MVC Architecture
The application follows Laravel's Model-View-Controller (MVC) pattern:

- **Models**: `User`, `DiaryEntry` - Handle data and business logic
- **Views**: Blade templates in `resources/views/` - Handle presentation
- **Controllers**: Handle HTTP requests and coordinate between models and views

### Request Flow
```
User Request → Routes (web.php) → Middleware → Controller → Model → Database
                                                              ↓
                                                        View (Blade)
                                                              ↓
                                                        HTML Response
```

---

## Technology Stack

### Backend
- **Framework**: Laravel 10.50.0
- **PHP**: 8.1+
- **Database**: MySQL
- **Authentication**: Laravel's built-in authentication
- **RBAC**: Spatie Laravel Permission 5.11.1

### Frontend
- **Templating**: Blade (Laravel's templating engine)
- **Styling**: Inline CSS with pink color scheme (#E94E90, #ec4899)
- **Font**: Inter (Google Fonts)
- **Images**: PNG assets for hero and section graphics

### Tools
- **Package Manager**: Composer (PHP), npm (JavaScript)
- **Build Tool**: Vite
- **Version Control**: Git

---

## Project Structure

```
laravel-aivie/
├── app/
│   ├── Console/
│   │   └── Kernel.php                    # Console command scheduling
│   ├── Exceptions/
│   │   └── Handler.php                   # Exception handling
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php   # Handle login/logout
│   │   │   │   └── RegisterController.php # Handle registration
│   │   │   ├── Controller.php            # Base controller
│   │   │   ├── DiaryController.php       # Diary entry operations
│   │   │   └── HomeController.php        # Homepage logic
│   │   ├── Kernel.php                    # HTTP middleware configuration
│   │   └── Middleware/
│   │       ├── EncryptCookies.php        # Cookie encryption
│   │       ├── RedirectIfAuthenticated.php # Guest middleware
│   │       ├── ValidateSignature.php     # Signed URL validation
│   │       └── VerifyCsrfToken.php       # CSRF protection
│   ├── Models/
│   │   ├── DiaryEntry.php                # Diary entry model
│   │   └── User.php                      # User model with RBAC
│   └── Providers/
│       ├── AppServiceProvider.php        # Application services
│       ├── AuthServiceProvider.php       # Authentication services
│       └── RouteServiceProvider.php      # Route configuration
├── bootstrap/
│   ├── app.php                           # Application bootstrap
│   └── cache/                            # Cached files
├── config/
│   ├── app.php                           # Application configuration
│   ├── auth.php                          # Authentication config
│   ├── cache.php                         # Cache configuration
│   ├── database.php                      # Database configuration
│   ├── permission.php                    # Spatie Permission config
│   ├── queue.php                         # Queue configuration
│   ├── session.php                       # Session configuration
│   └── view.php                          # View configuration
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_diary_entries_table.php
│   │   ├── 2024_01_01_000002_create_permission_tables.php
│   │   ├── 2024_01_01_000003_create_cache_table.php
│   │   └── 2024_01_01_000004_create_jobs_table.php
│   └── seeders/
│       └── DatabaseSeeder.php            # Database seeding
├── public/
│   ├── images/
│   │   ├── hero-image.png                # Hero section image
│   │   └── second-section.png            # Second section image
│   └── index.php                         # Application entry point
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php             # Main layout template
│   │   ├── auth/
│   │   │   ├── login.blade.php           # Login page
│   │   │   └── register.blade.php        # Registration page
│   │   ├── diary/
│   │   │   └── my-stories.blade.php      # My Stories page
│   │   ├── vendor/
│   │   │   └── pagination/               # Pagination views
│   │   └── welcome.blade.php             # Landing page
│   ├── css/
│   │   └── app.css                       # Stylesheet
│   └── js/
│       └── app.js                        # JavaScript
├── routes/
│   ├── api.php                           # API routes
│   ├── console.php                       # Console routes
│   └── web.php                           # Web routes
├── storage/                              # Storage directory
├── vendor/                               # Composer dependencies
├── .env                                  # Environment configuration
├── .env.example                          # Environment template
├── .gitignore                            # Git ignore rules
├── artisan                               # Artisan CLI
├── composer.json                         # PHP dependencies
├── composer.lock                         # Locked PHP dependencies
├── package.json                          # Node dependencies
├── vite.config.js                        # Vite configuration
└── start-server.ps1                      # Server startup script
```

---

## Database Schema

### Tables

#### 1. `users`
Stores user account information.
```sql
- id (bigint, primary key)
- name (varchar 255)
- email (varchar 255, unique)
- email_verified_at (timestamp, nullable)
- password (varchar 255)
- remember_token (varchar 100, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### 2. `diary_entries`
Stores anonymous diary messages.
```sql
- id (bigint, primary key)
- user_id (bigint, foreign key → users.id)
- message (text)
- is_anonymous (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

#### 3. `roles`
RBAC roles (Spatie Permission).
```sql
- id (bigint, primary key)
- name (varchar 191)
- guard_name (varchar 191)
- created_at (timestamp)
- updated_at (timestamp)
```

#### 4. `permissions`
RBAC permissions (Spatie Permission).
```sql
- id (bigint, primary key)
- name (varchar 191)
- guard_name (varchar 191)
- created_at (timestamp)
- updated_at (timestamp)
```

#### 5. `model_has_roles`
User-role relationships (pivot table).
```sql
- role_id (bigint, foreign key → roles.id)
- model_type (varchar 191)
- model_id (bigint)
- PRIMARY KEY (role_id, model_id, model_type)
```

#### 6. `model_has_permissions`
User-permission relationships (pivot table).
```sql
- permission_id (bigint, foreign key → permissions.id)
- model_type (varchar 191)
- model_id (bigint)
- PRIMARY KEY (permission_id, model_id, model_type)
```

#### 7. `role_has_permissions`
Role-permission relationships (pivot table).
```sql
- permission_id (bigint, foreign key → permissions.id)
- role_id (bigint, foreign key → roles.id)
- PRIMARY KEY (permission_id, role_id)
```

#### 8. `sessions`
Session storage.
```sql
- id (varchar 255, primary key)
- user_id (bigint, nullable, foreign key → users.id)
- ip_address (varchar 45, nullable)
- user_agent (text, nullable)
- payload (longtext)
- last_activity (integer)
```

#### 9. `cache`
Cache storage.
```sql
- key (varchar 255, primary key)
- value (mediumtext)
- expiration (integer)
```

#### 10. `jobs`
Queue jobs.
```sql
- id (bigint, primary key)
- queue (varchar 255)
- payload (longtext)
- attempts (tinyint)
- reserved_at (integer, nullable)
- available_at (integer)
- created_at (integer)
```

---

## Features & Functionality

### 1. Landing Page (`/`)
The landing page consists of multiple sections:

#### Hero Section
- Displays hero image (`hero-image.png`)
- Responsive, centered layout
- Padding-top for spacing from header

#### Second Section
- Image on the left (`second-section.png`)
- Inspirational text on the right:
  *"Share your thoughts with us in this secret diary. Confess freely, express honestly, and let your heart breathe in a space made just for you."*
- Flexbox layout, responsive

#### DEAR DIARY Section
- **Title**: "DEAR DIARY" in pink (#E94E90)
- **Background**: Light pink (#F8E8E8)
- **Content**: Grid of anonymous message cards
- Displays up to 12 latest anonymous entries
- Each card shows:
  - Message preview (150 characters)
  - Date (formatted: "M d, Y")
  - "Anonymous" badge
- Hover effects on cards

#### SECRET DIARY Form Section
- **For authenticated users**:
  - Textarea for diary entry
  - Submit button
  - Message validation (max 5000 characters)
- **For guests**:
  - Login/Register prompts
  - Call-to-action buttons

#### My Stories Section (Authenticated Only)
- Displays user's latest 5 diary entries
- Shows full messages with timestamps
- Link to view all stories (`/my-stories`)

### 2. Authentication System

#### Registration (`/register`)
- Form fields: Name, Email, Password, Confirm Password
- Validation:
  - Name: required, string, max 255
  - Email: required, email, unique
  - Password: required, confirmed, follows Laravel password rules
- On success:
  - Creates user account
  - Assigns 'user' role
  - Auto-login
  - Redirects to home

#### Login (`/login`)
- Form fields: Email, Password, Remember Me
- Validation:
  - Email: required, email
  - Password: required
- On success:
  - Creates session
  - Redirects to intended page or home
- Error handling with validation messages

#### Logout (`POST /logout`)
- Destroys session
- Regenerates CSRF token
- Redirects to home

### 3. Diary Functionality

#### Submit Diary Entry (`POST /diary`)
- **Requires**: Authentication
- **Validation**:
  - Message: required, string, max 5000 characters
- **Behavior**:
  - Creates diary entry
  - Sets `is_anonymous = true`
  - Links to authenticated user
  - Redirects back with success message

#### View My Stories (`GET /my-stories`)
- **Requires**: Authentication
- **Features**:
  - Paginated list (10 per page)
  - Shows all user's diary entries
  - Ordered by date (newest first)
  - Full message display
  - Timestamp and anonymous badge

### 4. Role-Based Access Control (RBAC)

#### Roles
- **user**: Default role for registered users
  - Can submit diary entries
  - Can view own entries
- **admin**: Administrative role
  - All user permissions
  - Additional admin access

#### Permissions
- `submit diary entry`: Allow users to create diary entries
- `view own entries`: Allow users to view their own submissions
- `admin access`: Administrative privileges

#### Implementation
- Uses Spatie Laravel Permission package
- Roles and permissions stored in database
- Checked via middleware and model methods
- Automatic role assignment on registration

---

## Controllers & Routes

### HomeController
**Location**: `app/Http/Controllers/HomeController.php`

**Methods**:
- `index()`: Displays landing page
  - Fetches user's latest 5 entries (if authenticated)
  - Fetches latest 12 anonymous entries (public)
  - Returns `welcome` view

### DiaryController
**Location**: `app/Http/Controllers/DiaryController.php`

**Methods**:
- `store(Request $request)`: Creates new diary entry
  - Validates message input
  - Creates DiaryEntry with user_id and anonymous flag
  - Returns success message
- `myStories()`: Displays paginated list of user's entries
  - Fetches user's diary entries
  - Paginates (10 per page)
  - Returns `diary.my-stories` view

### LoginController
**Location**: `app/Http/Controllers/Auth/LoginController.php`

**Methods**:
- `showLoginForm()`: Displays login form
- `login(Request $request)`: Processes login
  - Validates credentials
  - Creates session
  - Handles "remember me"
- `logout(Request $request)`: Logs out user
  - Destroys session
  - Regenerates CSRF token

### RegisterController
**Location**: `app/Http/Controllers/Auth/RegisterController.php`

**Methods**:
- `showRegistrationForm()`: Displays registration form
- `register(Request $request)`: Processes registration
  - Validates input
  - Creates user account
  - Assigns 'user' role
  - Auto-logs in user

### Routes

**File**: `routes/web.php`

```php
GET  /              → HomeController@index
GET  /login         → LoginController@showLoginForm (guest only)
POST /login         → LoginController@login (guest only)
GET  /register      → RegisterController@showRegistrationForm (guest only)
POST /register      → RegisterController@register (guest only)
POST /logout        → LoginController@logout (auth required)
POST /diary         → DiaryController@store (auth required)
GET  /my-stories    → DiaryController@myStories (auth required)
```

**Middleware**:
- `guest`: Prevents authenticated users from accessing login/register
- `auth`: Requires authentication for protected routes

---

## Models & Relationships

### User Model
**Location**: `app/Models/User.php`

**Traits**:
- `HasRoles` (Spatie Permission): Enables RBAC functionality

**Relationships**:
- `diaryEntries()`: HasMany DiaryEntry
  - Returns all diary entries created by the user

**Fields**:
- `fillable`: name, email, password
- `hidden`: password, remember_token
- `casts`: email_verified_at (datetime), password (hashed)

**RBAC Methods** (via HasRoles trait):
- `hasRole($role)`: Check if user has role
- `assignRole($role)`: Assign role to user
- `hasPermissionTo($permission)`: Check permission

### DiaryEntry Model
**Location**: `app/Models/DiaryEntry.php`

**Relationships**:
- `user()`: BelongsTo User
  - Returns the user who created the entry

**Fields**:
- `fillable`: user_id, message, is_anonymous
- `casts`: is_anonymous (boolean), timestamps (datetime)

---

## Authentication & Authorization

### Authentication System
- **Driver**: Session-based authentication
- **Provider**: Eloquent (users table)
- **Guards**: `web` (default)

### Middleware

#### Authentication Middleware
- `auth`: Ensures user is authenticated
- Applied to: `/logout`, `/diary`, `/my-stories`

#### Guest Middleware
- `guest`: Ensures user is NOT authenticated
- Applied to: `/login`, `/register`

### Authorization (RBAC)

#### Role Assignment
- New users automatically get 'user' role
- Admin role assigned via seeder or manually

#### Permission Checks
- Diaries can only be submitted by authenticated users
- Users can only view their own entries
- Admin has access to all features

---

## Frontend Structure

### Layout Template
**File**: `resources/views/layouts/app.blade.php`

**Features**:
- HTML5 structure
- Inter font from Google Fonts
- Navigation bar:
  - Logo: "SECRET DIARY" (pink #ec4899)
  - Auth buttons (Login/Sign Up or Logout)
  - "My Stories" link (if authenticated)
- Success/error message display
- CSRF token in meta tag

**Color Scheme**:
- Primary Pink: #ec4899 / #E94E90
- Light Pink Background: #F8E8E8
- Button Hover: Pink gradient
- Links: Pink color

### Views

#### Landing Page
**File**: `resources/views/welcome.blade.php`

**Sections**:
1. Hero image section
2. Second section (image + text)
3. DEAR DIARY section (anonymous cards)
4. SECRET DIARY form section
5. My Stories section (if authenticated)

#### Login Page
**File**: `resources/views/auth/login.blade.php`

- Email input
- Password input
- Remember me checkbox
- Login button
- Link to registration

#### Register Page
**File**: `resources/views/auth/register.blade.php`

- Name input
- Email input
- Password input
- Confirm password input
- Sign Up button
- Link to login

#### My Stories Page
**File**: `resources/views/diary/my-stories.blade.php`

- Page title
- Paginated list of entries
- Each entry shows:
  - Full message
  - Date and time
  - Anonymous badge
- "Back to Home" link

### Styling Approach
- Inline styles for simplicity
- Pink color palette throughout
- Responsive design with flexbox/grid
- Hover effects and transitions
- Consistent button styling

---

## Installation & Setup

### Prerequisites
1. PHP 8.1 or higher
2. Composer
3. MySQL 5.7+ or MariaDB 10.3+
4. Node.js and npm
5. Web server (Apache/Nginx) or PHP built-in server

### Installation Steps

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd laravel-aivie
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   - Update `.env` file:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=laravel_aivie
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```

6. **Create Database**
   ```sql
   CREATE DATABASE laravel_aivie CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

7. **Run Migrations**
   ```bash
   php artisan migrate --seed
   ```

8. **Build Frontend Assets** (optional for production)
   ```bash
   npm run build
   ```

9. **Start Development Server**
   ```bash
   php artisan serve
   # Or use: .\start-server.ps1 (Windows)
   ```

10. **Access Application**
    - URL: `http://localhost:8000`
    - Admin: `admin@example.com` / `password`
    - User: `user@example.com` / `password`

---

## Configuration

### Environment Variables

**Key Variables**:
```env
APP_NAME="Diary Website"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_aivie
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Configuration Files

#### `config/app.php`
- Application name, environment, debug mode
- Service providers (including Spatie Permission)
- Timezone, locale settings

#### `config/database.php`
- MySQL connection configuration
- Character set: utf8mb4
- Collation: utf8mb4_unicode_ci

#### `config/permission.php`
- Spatie Permission configuration
- Table names for roles/permissions
- Cache settings

#### `config/auth.php`
- Authentication guards (web)
- User provider (Eloquent)
- Password reset configuration

---

## Application Flow

### User Registration Flow
```
1. User visits /register
2. Fills registration form
3. RegisterController validates input
4. Creates User record
5. Assigns 'user' role
6. Auto-logs in user
7. Redirects to homepage
```

### Diary Submission Flow
```
1. Authenticated user visits homepage
2. Fills diary form in "SECRET DIARY" section
3. Submits form (POST /diary)
4. DiaryController validates message
5. Creates DiaryEntry with user_id
6. Sets is_anonymous = true
7. Redirects back with success message
8. Entry appears in "DEAR DIARY" section (public)
9. Entry appears in "My Stories" (user's view)
```

### Anonymous Entry Display Flow
```
1. HomeController fetches latest 12 anonymous entries
2. Entries displayed in "DEAR DIARY" section
3. Cards show message preview, date, anonymous badge
4. No user information displayed (anonymous)
```

---

## Security Features

1. **CSRF Protection**: All forms protected with CSRF tokens
2. **Password Hashing**: Bcrypt hashing for passwords
3. **SQL Injection Prevention**: Eloquent ORM with parameter binding
4. **XSS Protection**: Blade template escaping
5. **Session Security**: Secure session handling
6. **Authentication**: Session-based auth with remember token
7. **Authorization**: RBAC via Spatie Permission
8. **Input Validation**: Server-side validation on all forms

---

## Key Code Examples

### Creating a Diary Entry
```php
DiaryEntry::create([
    'user_id' => Auth::id(),
    'message' => $request->message,
    'is_anonymous' => true,
]);
```

### Checking User Role
```php
if ($user->hasRole('admin')) {
    // Admin actions
}
```

### Fetching Anonymous Entries
```php
$anonymousEntries = DiaryEntry::where('is_anonymous', true)
    ->orderBy('created_at', 'desc')
    ->limit(12)
    ->get();
```

### Assigning Role to User
```php
$user->assignRole('user');
```

---

## Testing

### Default Accounts
After running `php artisan migrate --seed`:

**Admin**:
- Email: `admin@example.com`
- Password: `password`

**User**:
- Email: `user@example.com`
- Password: `password`

---

## 🔧 Maintenance & Troubleshooting

### Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Regenerate Application Key
```bash
php artisan key:generate
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

### Common Issues

**Database connection error**:
- Check MySQL is running
- Verify credentials in `.env`
- Ensure database exists

**Permission errors**:
- Ensure `storage/` and `bootstrap/cache/` are writable

**Routes not working**:
- Clear route cache: `php artisan route:clear`
- Check RouteServiceProvider is registered

---

## Dependencies

### PHP Packages (composer.json)
- `laravel/framework`: ^10.10
- `spatie/laravel-permission`: ^5.10
- `laravel/sanctum`: ^3.2
- `laravel/tinker`: ^2.8

### Node Packages (package.json)
- `vite`: ^4.4.5
- `laravel-vite-plugin`: ^0.8.1
- `axios`: ^1.1.2

---

## Deployment Considerations

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate secure `APP_KEY`
- [ ] Configure proper database credentials
- [ ] Set up proper session storage
- [ ] Configure cache driver
- [ ] Set up queue worker (if using queues)
- [ ] Configure web server (Apache/Nginx)
- [ ] Set proper file permissions
- [ ] Set up SSL certificate
- [ ] Configure environment variables securely

### Server Requirements
- PHP 8.1+ with extensions: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath
- MySQL 5.7+ or MariaDB 10.3+
- Web server with mod_rewrite (Apache) or proper Nginx configuration

---

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs/10.x)
- [Spatie Permission Documentation](https://spatie.be/docs/laravel-permission)
- [MySQL Documentation](https://dev.mysql.com/doc/)

---

## Default Users

After seeding:
- **Admin**: admin@example.com / password
- **User**: user@example.com / password



