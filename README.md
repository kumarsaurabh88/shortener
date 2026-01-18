# URL Shortener Application

A Laravel-based URL shortener service with multi-company support, role-based access control, and advanced authorization features.

## Features

- 🔗 **URL Shortening**: Create short, shareable links from long URLs
- 👥 **Role-Based Access Control**: SuperAdmin, Admin, Member, Sales, Manager roles
- 🏢 **Multi-Company Support**: Multiple companies with isolated data
- 💌 **Invitation System**: Invite users with role-specific permissions
- 🔒 **Secure**: Private short URLs that are not publicly discoverable
- 📊 **Analytics**: Track clicks and engagement on short URLs
- 🔐 **Authentication**: Secure login/logout functionality

## Technology Stack

- **Backend**: Laravel 11
- **Database**: SQLite (or MySQL)
- **Authentication**: Laravel's built-in authentication
- **Testing**: Pest/PHPUnit

## Requirements

- PHP 8.1 or higher
- Composer
- SQLite or MySQL

## Installation

### 1. Clone the repository
```bash
cd /path/to/project
```

### 2. Install dependencies
```bash
composer install
```

### 3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Create database
```bash
touch database/database.sqlite
```

### 5. Run migrations
```bash
php artisan migrate
```

### 6. Seed database with demo data
```bash
php artisan db:seed
```

This creates:
- **SuperAdmin User**: `admin@urlshortener.local` / `password`
- **Admin User**: `admin@demo.local` / `password`
- **Member User**: `member@demo.local` / `password`

### 7. Start development server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Usage

### Authentication

1. **Login**: Visit `/login` and enter your credentials
2. **Register**: Create a new account at `/register`
3. **Logout**: Click logout in the navigation

### Roles and Permissions

#### SuperAdmin
- Cannot create short URLs
- Can invite Admins to new companies
- Can view system-wide invitations

#### Admin
- Cannot create short URLs
- Can invite Members to their company
- Can view short URLs from other companies (but not their own)
- Can manage company invitations

#### Member
- **Can create** short URLs
- Can view short URLs created by others in their company
- Cannot invite other users

### Creating Short URLs

1. Login as a **Member**
2. Click **Create Short URL** on the dashboard
3. Enter a valid URL (must start with `http://` or `https://`)
4. Click **Create Short URL**
5. Share the generated short link

### Accessing Short URLs

- Short URLs are only accessible to authenticated users with proper permissions
- Share the short URL with others who have access
- The short URL redirects to the original destination

### Inviting Users

1. Login as **Admin** or **SuperAdmin**
2. Navigate to **Invitations**
3. Click **Send Invitation**
4. Enter the user's email and select their role
5. They'll receive an invitation (in development, check the logs)

## Access Control Rules

### URL Creation
- ✅ Only Members can create short URLs
- ❌ Admins cannot create short URLs
- ❌ SuperAdmins cannot create short URLs

### URL Visibility
- **Admin**: Can see URLs not created in their own company
- **Member**: Can see URLs not created by themselves
- **SuperAdmin**: Cannot see URL lists

### URL Deletion
- Only the creator can delete their own URLs

### Invitations
- **SuperAdmin**: Can only invite Admins
- **Admin**: Can only invite Members to their company
- **Member**: Cannot invite anyone

## API Routes

### Authentication
- `POST /login` - User login
- `POST /logout` - User logout
- `GET /register` - Show registration form
- `POST /register` - Register new user

### Dashboard
- `GET /dashboard` - Main dashboard

### Short URLs
- `GET /urls` - List URLs based on role
- `GET /urls/create` - Show create URL form
- `POST /urls` - Create new short URL
- `GET /urls/{id}` - View URL details
- `DELETE /urls/{id}` - Delete URL (creator only)
- `GET /s/{code}` - Redirect to original URL

### Invitations
- `GET /invitations` - List invitations
- `GET /invitations/create` - Show invitation form
- `POST /invitations` - Send invitation
- `GET /invitation/{token}` - Accept invitation

## Testing

### Run all tests
```bash
php artisan test
```

### Run specific test
```bash
php artisan test tests/Feature/ShortUrlTest.php
```

### Test Coverage

Tests include:
- ✅ Authentication (login, logout, registration)
- ✅ Authorization (role-based access control)
- ✅ URL Shortening (creation, deletion, access)
- ✅ Redirect functionality
- ✅ Permission violations

## Database Schema

### Tables

**companies**
- id, name, slug, timestamps

**roles**
- id, name, description

**users**
- id, name, email, password, company_id, role_id, timestamps

**short_urls**
- id, short_code, original_url, company_id, created_by, clicks, timestamps

**invitations**
- id, email, company_id, role_id, invited_by, token, accepted_at, timestamps

## File Structure

```
project/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Auth/
│   │       ├── DashboardController.php
│   │       ├── ShortUrlController.php
│   │       └── InvitationController.php
│   └── Models/
│       ├── User.php
│       ├── Company.php
│       ├── Role.php
│       ├── ShortUrl.php
│       └── Invitation.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layout.blade.php
│   ├── auth/
│   ├── urls/
│   └── invitations/
├── routes/
│   └── web.php
├── tests/
│   └── Feature/
├── .env
└── composer.json
```

## Troubleshooting

### Database connection error
- Ensure `database/database.sqlite` exists
- Run `php artisan migrate:fresh` to reset

### Assets not loading
- Run `php artisan storage:link`

### "SQLSTATE[HY000]" errors
- Check database file permissions
- Verify `database/` folder is writable

## AI Usage Disclosure

This project was created with assistance from AI tools:
- **Claude Haiku 4.5**: Used for code generation, Laravel syntax patterns, and project structure
- **Purpose**: Scaffolding Laravel project, creating models, migrations, controllers, and views
- **Original Work**: Role-based authorization logic, access control rules, and business logic implementation

## License

This project is licensed under the MIT License.

## Support

For issues or questions, please check the test files for usage examples or review the controller documentation.

---

**Demo Credentials**
- SuperAdmin: `admin@urlshortener.local` / `password`
- Admin: `admin@demo.local` / `password`
- Member: `member@demo.local` / `password`
