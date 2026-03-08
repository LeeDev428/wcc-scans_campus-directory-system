# WCC SCAN - Smart Campus Assistant & Navigator

<div align="center">
  <h3>🎓 Interactive Campus Directory & Navigation System</h3>
  <p>A comprehensive web application for navigating campus facilities, managing events, and providing feedback</p>
</div>

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Database Structure](#database-structure)
- [User Roles](#user-roles)
- [Main Modules](#main-modules)
- [API Endpoints](#api-endpoints)
- [Development](#development)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

---

## 🎯 Overview

**WCC SCAN** (Smart Campus Assistant & Navigator) is a Laravel-based web application designed to help students, faculty, and visitors navigate through an 8-floor campus building. The system provides interactive floor plans, room search functionality, campus information, event management, and a feedback system.

### Purpose
- Simplify campus navigation with interactive SVG floor maps
- Provide real-time information about campus events and announcements
- Offer a ticketing system for feedback and support
- Enable administrators to manage campus content efficiently

---

## ✨ Features

### 🗺️ Campus Navigation
- **Interactive Floor Maps**: SVG-based maps for all 8 floors
- **Room Search**: Search for classrooms, labs, offices, restrooms, and facilities
- **Room Types**: Categorized rooms (classrooms, labs, offices, restrooms, exits, stairs, elevators, etc.)
- **Pathfinding**: Basic A* algorithm for navigation between rooms
- **Real-time Filtering**: Filter by floor and room type

### 📢 Information Management
- **Events**: Display active campus events with images
- **Announcements**: Important campus-wide announcements
- **Important Reminders**: Critical reminders for students and staff
- **Campus Policies**: Comprehensive policy documentation

### 🎫 Feedback System
- **Ticket Submission**: Users can submit feedback and issues
- **Ticket Status Tracking**: Pending, Reviewed, Resolved
- **Rating System**: 6-level emoji rating system
- **Admin Management**: Ticket management dashboard for administrators

### 👨‍💼 Admin Panel
- **Dashboard**: Overview of tickets, ratings, and system stats
- **Event Management**: CRUD operations for events
- **Announcement Management**: Create and manage announcements
- **Reminder Management**: Manage important reminders
- **Ticket Management**: View, filter, update status, and delete tickets
- **User Authentication**: Role-based access control

### 🔐 Authentication
- **Laravel Breeze**: Built-in authentication scaffolding
- **User Registration & Login**
- **Password Reset**
- **Email Verification** (ready to configure)
- **Role-based Middleware**: Admin and guest access control

---

## 🛠️ Technology Stack

### Backend
- **Framework**: Laravel 12.0
- **PHP**: 8.2+
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Testing**: Pest (PHP testing framework)

### Frontend
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Alpine.js 3.x
- **Build Tool**: Vite 7.x
- **Forms**: Tailwind Forms
- **HTTP Client**: Axios

### Development Tools
- **Package Manager**: Composer (Backend), NPM (Frontend)
- **Code Quality**: Laravel Pint
- **Logging**: Laravel Pail
- **Development Server**: Concurrently (PHP serve + Queue + Vite)

---

## 💻 System Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18.x or higher
- **NPM**: 9.x or higher
- **MySQL**: 5.7 or higher / MariaDB 10.3 or higher
- **Web Server**: Apache / Nginx (or PHP built-in server for development)

---

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd wcc-scans_campus-directory-system
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wcc_scans_campus_directory_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders
```bash
# Run database migrations
php artisan migrate

# Seed database with initial data
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=RoomSeeder
```

**Default Admin Credentials:**
- Email: `admin@gmail.com`
- Password: `admin123`

### 6. Build Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 7. Start Development Server

**Option 1: Quick Start (Recommended)**
```bash
composer dev
```
This command runs:
- PHP Development Server (http://localhost:8000)
- Queue Worker
- Vite Dev Server

**Option 2: Manual Start**
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev

# Terminal 3: Start queue worker (if needed)
php artisan queue:work
```

### 8. Access the Application
- **Public Site**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/login (use admin credentials)

---

## 🗄️ Database Structure

### Users Table
- `id`: Primary key
- `name`: User's full name
- `email`: Unique email address
- `password`: Hashed password
- `role`: User role (admin, user)
- `email_verified_at`: Email verification timestamp
- `remember_token`: Session token
- `timestamps`

### Rooms Table
- `id`: Primary key
- `name`: Room name (e.g., "Room 102 Classroom")
- `floor`: Floor number (1-8)
- `type`: Room type (classroom, lab, office, restroom, exit, etc.)
- `description`: Room description
- `svg_id`: SVG element reference
- `center_x`: X coordinate for pathfinding
- `center_y`: Y coordinate for pathfinding
- `is_searchable`: Boolean flag for search visibility
- `timestamps`
- **Indexes**: floor, type, name

### Waypoints Table
- `id`: Primary key
- `floor`: Floor number
- `x`: X coordinate
- `y`: Y coordinate
- `type`: Waypoint type
- `timestamps`
- **Relationships**: Many-to-many with itself for connections

### Tickets Table
- `id`: Primary key
- `message`: Feedback message
- `status`: Status (pending, reviewed, resolved)
- `rating`: Optional rating (1-6)
- `timestamps`

### Ratings Table
- `id`: Primary key
- `rating`: Rating value (1-6)
- `timestamps`

### Events Table
- `id`: Primary key
- `title`: Event title
- `description`: Event description
- `image`: Event image path
- `is_active`: Boolean flag for visibility
- `timestamps`

### Announcements Table
- `id`: Primary key
- `title`: Announcement title
- `description`: Announcement description
- `is_active`: Boolean flag for visibility
- `timestamps`

### Important Reminders Table
- `id`: Primary key
- `title`: Reminder title
- `description`: Reminder description
- `is_active`: Boolean flag for visibility
- `timestamps`

---

## 👥 User Roles

### Guest (Public User)
- View homepage with announcements and reminders
- Browse campus events
- Search campus directory
- View floor maps
- Navigate between floors
- Submit tickets/feedback
- Rate experience
- View campus policies

### Admin
- All guest permissions
- Access admin dashboard
- Manage tickets (view, update status, delete)
- Create, edit, delete events
- Create, edit, delete announcements
- Create, edit, delete important reminders
- View ticket statistics and ratings

---

## 📦 Main Modules

### 1. Welcome & Homepage
- **Route**: `/` (welcome), `/homepage`
- **Features**: 
  - Landing page
  - Active announcements display
  - Important reminders display
  - Quick navigation menu

### 2. Campus Directory
- **Route**: `/campus-directory`
- **Features**:
  - Room search with autocomplete
  - Filter by floor and room type
  - Real-time search results
  - Navigate to specific floor with highlighted room

### 3. Floor Maps
- **Routes**: `/floor/1` through `/floor/8`
- **Features**:
  - Interactive SVG floor plans
  - Clickable rooms with information
  - Pathfinding visualization
  - Floor navigation controls

### 4. Events
- **Route**: `/events`
- **Features**:
  - Display active events
  - Event images and descriptions
  - Chronological ordering

### 5. Feedback System
- **Routes**: `/submit-ticket`, `/rate-experience`
- **Features**:
  - Submit feedback messages
  - 6-emoji rating system
  - Success confirmation

### 6. Campus Policies
- **Route**: `/campus-policies`
- **Features**:
  - Display campus rules and regulations
  - Comprehensive policy documentation

### 7. Admin Panel
- **Base Route**: `/admin`
- **Features**:
  - Dashboard with statistics
  - Ticket management
  - Event management (CRUD)
  - Announcement management (CRUD)
  - Important reminder management (CRUD)

---

## 🔌 API Endpoints

### Room Search API

#### Search Rooms
```http
GET /api/rooms/search?q={query}&floor={floor}&type={type}
```
**Parameters:**
- `q` (optional): Search query
- `floor` (optional): Floor number (1-8)
- `type` (optional): Room type

**Response:**
```json
[
  {
    "id": 1,
    "name": "Room 102 Classroom",
    "floor": 1,
    "type": "classroom",
    "description": "Classroom",
    "center_x": 340.00,
    "center_y": 180.00,
    "is_searchable": true
  }
]
```

#### Get Rooms by Floor
```http
GET /api/rooms/floor/{floor}
```

#### Get Room Details
```http
GET /api/rooms/{id}
```

#### Find Path Between Rooms
```http
POST /api/rooms/find-path
Content-Type: application/json

{
  "from_room_id": 1,
  "to_room_id": 5
}
```

**Response:**
```json
{
  "path": [
    {"x": 340.00, "y": 180.00},
    {"x": 580.00, "y": 180.00}
  ],
  "floor": 1,
  "multi_floor": false
}
```

#### Get All Room Types
```http
GET /api/rooms/types
```

---

## 🔧 Development

### Project Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── API/            # API controllers
│   │   ├── Auth/           # Authentication controllers
│   │   ├── ProfileController.php
│   │   └── TicketController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/                 # Eloquent models
└── Providers/

database/
├── migrations/             # Database migrations
└── seeders/               # Database seeders

resources/
├── css/                    # Styles
├── js/                     # JavaScript
└── views/                 # Blade templates

routes/
├── auth.php               # Authentication routes
└── web.php                # Web routes

public/
├── img/                   # Images
└── storage/               # Public storage link
```

### Custom Composer Scripts

#### Setup Project
```bash
composer setup
```
Runs: install, env copy, key generation, migrations, npm install, build

#### Development Server
```bash
composer dev
```
Runs: Laravel server + Queue worker + Vite dev server

#### Run Tests
```bash
composer test
```
Runs: Clear config + Pest tests

### Environment Variables

Key environment configurations:
```env
APP_NAME="WCC SCAN"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_DATABASE=wcc_scans_campus_directory_system

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

### Middleware

#### Admin Middleware
**File**: `app/Http/Middleware/AdminMiddleware.php`

Protects admin routes by checking:
- User is authenticated
- User role is 'admin'

**Usage**: Automatically applied to all `/admin/*` routes

---

## 🧪 Testing

The project uses **Pest PHP** for testing.

### Run All Tests
```bash
php artisan test
# or
composer test
```

### Run Specific Test File
```bash
php artisan test --filter=ExampleTest
```

### Test Structure
```
tests/
├── Feature/               # Feature tests
├── Unit/                  # Unit tests
├── Pest.php              # Pest configuration
└── TestCase.php          # Base test case
```

---

## 📝 Development Guidelines

### Code Style
- Follow Laravel conventions
- Use Laravel Pint for code formatting:
  ```bash
  ./vendor/bin/pint
  ```

### Database Changes
1. Create migration:
   ```bash
   php artisan make:migration create_table_name
   ```
2. Run migration:
   ```bash
   php artisan migrate
   ```
3. Rollback if needed:
   ```bash
   php artisan migrate:rollback
   ```

### Creating New Models
```bash
# Model with migration
php artisan make:model ModelName -m

# Model with migration, factory, and seeder
php artisan make:model ModelName -mfs
```

### Creating Controllers
```bash
# Basic controller
php artisan make:controller ControllerName

# Resource controller
php artisan make:controller ControllerName --resource

# API controller
php artisan make:controller API/ControllerName --api
```

---

## 🎨 Frontend Development

### Tailwind CSS
The project uses Tailwind CSS 3.x with custom configurations.

**Config**: `tailwind.config.js`

### Alpine.js
Alpine.js is used for interactive components.

**Example**: Room search autocomplete in campus directory

### Vite
Asset compilation is handled by Vite.

**Config**: `vite.config.js`

### Building Assets
```bash
# Development (with hot reload)
npm run dev

# Production build
npm run build
```

---

## 🔒 Security

- CSRF protection on all forms
- Password hashing with bcrypt
- Role-based access control
- SQL injection protection (Eloquent ORM)
- XSS protection (Blade templating)
- Session security
- Admin middleware for protected routes

### Security Best Practices
1. Never commit `.env` file
2. Use environment variables for sensitive data
3. Keep dependencies updated
4. Use strong passwords for admin accounts
5. Enable HTTPS in production
6. Regular security audits

---

## 🚢 Deployment

### Production Checklist
1. Set environment to production:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Build assets:
   ```bash
   npm run build
   ```

3. Optimize Laravel:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. Set proper file permissions:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

5. Configure web server (Nginx/Apache)

6. Set up SSL certificate

7. Configure database backups

8. Set up monitoring and logging

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev)
- [Pest PHP Documentation](https://pestphp.com)
- [Laravel Breeze Documentation](https://laravel.com/docs/starter-kits#laravel-breeze)

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Commit Message Guidelines
- Use present tense ("Add feature" not "Added feature")
- Use imperative mood ("Move cursor to..." not "Moves cursor to...")
- Reference issues and pull requests
- Keep first line under 50 characters

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Development Team

**WCC SCAN Development Team**

For questions or support, please contact the development team or create an issue in the repository.

---

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Alpine.js
- WCC Aviation & Maritime Technology Campus
- All contributors and testers

---

<div align="center">
  <p>Made with ❤️ for WCC Campus Community</p>
  <p>© 2026 WCC SCAN - Smart Campus Assistant & Navigator</p>
</div>
