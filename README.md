# Laravel Admin Panel

A complete, modern admin panel built with Laravel 12, featuring user authentication and full CRUD user management.

## Features

- ✅ **Authentication System** (Login, Register, Forgot/Reset Password)
- ✅ **Admin Dashboard** with statistics widgets
- ✅ **User Management** (Full CRUD operations)
- ✅ **Profile Photo Upload** with preview
- ✅ **Status Toggle** (Active/Inactive) with AJAX
- ✅ **DataTables** integration for user listing
- ✅ **SweetAlert2** for delete confirmations
- ✅ **Toastr** for notifications
- ✅ **Bootstrap 5.3** modern UI
- ✅ **Responsive Design**
- ✅ **Secure Routes** with authentication middleware

## Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5.3
- jQuery
- DataTables
- SweetAlert2
- Toastr

## Installation

### Step 1: Navigate to Project Directory

```bash
cd laravel-admin-panel
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Environment Setup

Copy the `.env.example` file to `.env`:

```bash
copy .env.example .env
```

Or on Linux/Mac:

```bash
cp .env.example .env
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Configure Database

Edit the `.env` file and update your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Step 6: Run Migrations

```bash
php artisan migrate
```

### Step 7: Seed Admin User

```bash
php artisan db:seed
```

This will create an admin user with the following credentials:
- **Email:** admin@admin.com
- **Password:** password

### Step 8: Create Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public` for profile photo uploads.

### Step 9: Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Login Credentials

After running the seeder, you can login with:

- **Email:** admin@admin.com
- **Password:** password

**⚠️ Important:** Change the default password after first login in production!

## Project Structure

```
laravel-admin-panel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   └── ResetPasswordController.php
│   │   │   ├── DashboardController.php
│   │   │   └── UserController.php
│   │   └── Requests/
│   │       ├── StoreUserRequest.php
│   │       └── UpdateUserRequest.php
│   └── Models/
│       └── User.php
├── database/
│   ├── migrations/
│   │   └── 0001_01_01_000000_create_users_table.php
│   └── seeders/
│       ├── AdminSeeder.php
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── forgot-password.blade.php
│       │   └── reset-password.blade.php
│       ├── dashboard.blade.php
│       └── users/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
└── routes/
    └── web.php
```

## Features Overview

### Authentication

- **Login:** Email and password authentication with "Remember Me" option
- **Register:** User registration with password confirmation
- **Forgot Password:** Password reset via email
- **Reset Password:** Secure password reset functionality

### Dashboard

- Total Users count
- Active Users count
- Inactive Users count
- New Users Today count
- Recent Users list (last 5 users)

### User Management

- **List Users:** DataTables with search, sort, and pagination
- **Add User:** Create new users with profile photo upload
- **Edit User:** Update user information and profile photo
- **View User:** Detailed user information display
- **Delete User:** Soft delete with SweetAlert confirmation
- **Toggle Status:** AJAX-powered active/inactive status toggle

## Security Features

- CSRF Protection
- Authentication Middleware
- Form Request Validation
- Password Hashing
- Protected Routes
- Secure File Uploads

## UI/UX Features

- Modern Bootstrap 5.3 design
- Responsive sidebar navigation
- Collapsible sidebar
- Profile photo support
- Image preview on upload
- Toast notifications
- SweetAlert confirmations
- Smooth animations
- Mobile-friendly design

## Database Schema

### Users Table

- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `status` - Enum: 'active' or 'inactive'
- `profile_photo` - Profile photo path (nullable)
- `remember_token` - Remember me token
- `created_at` - Creation timestamp
- `updated_at` - Update timestamp
- `deleted_at` - Soft delete timestamp

## Routes

### Authentication Routes

- `GET /login` - Show login form
- `POST /login` - Process login
- `POST /logout` - Logout user
- `GET /register` - Show registration form
- `POST /register` - Process registration
- `GET /forgot-password` - Show forgot password form
- `POST /forgot-password` - Send reset link
- `GET /reset-password/{token}` - Show reset password form
- `POST /reset-password` - Process password reset

### Protected Routes

- `GET /` or `/dashboard` - Dashboard
- `GET /users` - List users (DataTables)
- `GET /users/create` - Show create user form
- `POST /users` - Store new user
- `GET /users/{user}` - Show user details
- `GET /users/{user}/edit` - Show edit user form
- `PUT /users/{user}` - Update user
- `DELETE /users/{user}` - Delete user
- `POST /users/{user}/toggle-status` - Toggle user status

## Customization

### Change Admin Credentials

Edit `database/seeders/AdminSeeder.php` to change default admin credentials.

### Modify Sidebar Menu

Edit `resources/views/layouts/app.blade.php` to add/remove menu items.

### Change Theme Colors

Edit CSS variables in `resources/views/layouts/app.blade.php`:

```css
:root {
    --sidebar-width: 250px;
    --sidebar-bg: #2c3e50;
    --sidebar-hover: #34495e;
    --primary-color: #3498db;
}
```

## Troubleshooting

### Storage Link Issue

If profile photos are not displaying, ensure the storage link is created:

```bash
php artisan storage:link
```

### Permission Issues

On Linux/Mac, ensure storage directory has write permissions:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Database Connection Error

Verify your database credentials in `.env` file and ensure the database exists.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues and questions, please create an issue in the repository.

---

**Built with ❤️ using Laravel 12**
